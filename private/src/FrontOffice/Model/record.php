<?php

/**
 * Model to record
 *
 * @category  	src
 * @package   	src\FrontOffice\Model
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\FrontOffice\Model;

use \Venus\core\Model as Model;
use \Venus\core\UrlManager as UrlManager;
use \Venus\lib\Date as Date;
use \Venus\lib\Orm\Where as Where;

/**
 * Model to record
 *
 * @category  	src
 * @package   	src\FrontOffice\Model
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class record extends Model {

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getBestMovies($sType = 'film', $iLimit = 10, $iOffset = 0) {

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'like_movie',
						'as' => 'lm',
						'left_field' => 'lm.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', 'r.*', 'IF(lm.id_record IS NULL, 0, count(*)) AS num'))
					   ->from($this->_sTableName, 'r')
					   ->where(
					   		$oWhere->whereInf('date_cinema', 'NOW()')
					   			   ->andWhereEqual('type', $sType)
					   	)
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['num DESC'])
					   ->limit($iLimit, $iOffset)
					   ->load();

		$result[0]->count = $this->orm
								 ->select(array('FOUND_ROWS()'))
								 ->load();

		$result[0]->pages = floor($result[0]->count / $iLimit);

		return $result;
	}

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getWantedMovies($sType = 'film', $iLimit = 10, $iOffset = 0) {

		$oWhere = new Where;
		$oHaving = new Where;

		if ($sType == 'film') {

			$aJoin = [
						[
							'type' => 'left',
							'table' => 'like_movie',
							'as' => 'lm',
							'left_field' => 'lm.id_record',
							'right_field' => 'r.id'
						]
			];

			$aSelect = array('SQL_CALC_FOUND_ROWS', '*', 'IF(lm.id_record IS NULL, 0, count(*)) AS num');

			$oWhereToAdd = $oWhere->whereSup('date_cinema', 'NOW()')
				   				  ->andWhereEqual('type', $sType);

			$oHavingToAdd = array();
		}
		else {

			$aJoin = [
						[
							'type' => 'left',
							'table' => 'like_movie',
							'as' => 'lm',
							'left_field' => 'lm.id_record',
							'right_field' => 'r.id'
						],
						[
							'type' => 'right',
							'table' => 'record_episode',
							'as' => 're',
							'left_field' => 're.id_record',
							'right_field' => 'r.id'
						]
			];

			$aSelect = array('SQL_CALC_FOUND_ROWS', '*', 'IF(lm.id_record IS NULL, 0, count(*)) AS num');

			$oWhereToAdd = $oWhere->whereEqual('type', $sType)
								  ->andWhereInf('YEAR(NOW())', '|production_date + season|');

			$oHavingToAdd = $oHaving->whereEqual('season', '|MAX(season)|');
		}

		$result = $this->orm
					   ->select($aSelect)
					   ->from($this->_sTableName, 'r')
					   ->join($aJoin)
					   ->where($oWhereToAdd)
					   ->groupBy(['r.id'])
					   ->having($oHavingToAdd)
					   ->orderBy(['num DESC'])
					   ->limit($iLimit, $iOffset)
					   ->load();

		if (!isset($result[0])) { $result[0] = new \stdClass(); }

		$result[0]->count = $this->orm
								 ->select(array('FOUND_ROWS()'))
								 ->load();

		$result[0]->pages = floor($result[0]->count / 10);

		return $result;
	}

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getMoviesOfWeek($sType = 'film', $iLimit = 10, $iOffset = 0) {

		$aDate = Date::getActualMiddleWeek();

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'like_movie',
						'as' => 'lm',
						'left_field' => 'lm.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', '*', 'IF(lm.id_record IS NULL, 0, count(*)) AS num'))
					   ->from($this->_sTableName, 'r')
					   ->join($aJoin)
					   ->where(
					   		$oWhere->whereSupOrEqual('date_cinema', $aDate[0])
					   			   ->andWhereInf('date_cinema', $aDate[1])
					   			   ->andWhereEqual('type', $sType)
					   	)
					   ->groupBy(['r.id'])
					   ->orderBy(['num DESC'])
					   ->limit($iLimit, $iOffset)
					   ->load();

		if (!isset($result[0])) { $result[0] = new \stdClass(); }

		$result[0]->count = $this->orm
								 ->select(array('FOUND_ROWS()'))
								 ->load();

		$result[0]->pages = floor($result[0]->count / 10);

		return $result;
	}

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @return array
	 */

	public function getMoviesOf4Week($sType = 'film', $iLimit = 10, $iOffset = 0) {

		$aDate = Date::getActualMiddleWeek();

		if ((int)date('W') > 4) { $aDateBefore4 = Date::getMiddleWeek(date('W') - 4, date('Y')); }
		else { $aDateBefore4 = Date::getMiddleWeek(52 - date('W') - 4, date('Y') - 1); }

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'like_movie',
						'as' => 'lm',
						'left_field' => 'lm.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', '*', 'count(*) AS num'))
					   ->from($this->_sTableName, 'r')
					   ->join($aJoin)
					   ->where(
							$oWhere->whereSupOrEqual('date_cinema', $aDateBefore4[0])
								   ->andWhereInf('date_cinema', $aDate[1])
					   			   ->andWhereEqual('type', $sType)
						)
					   ->groupBy(['r.id'])
					   ->orderBy(['num DESC'])
					   ->limit($iLimit, $iOffset)
					   ->load();

		if (count($result) < 1) { $result = array(); $result[0] = new \StdClass;  }
		
		$result[0]->count = $this->orm
								 ->select(array('FOUND_ROWS()'))
								 ->load();

		$result[0]->pages = floor($result[0]->count / 10);

		return $result;
	}

	/**
	 * Get the best dvd record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  int $iOffset
	 * @return array
	 */

	public function getBestDvdOrBluray($sType = 'all', $iOffset = 0) {

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'critic',
						'as' => 'c',
						'left_field' => 'c.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;
		$oWhere2 = new Where;
		$oWhere3 = new Where;

		if ($sType === 'all') {

			$oWhere->addWhere(
						$oWhere2->whereInf('date_dvd', 'NOW()')
								->andWhereSup('date_dvd', '1920-02-02')
					)
					->orAddWhere(
						$oWhere3->whereInf('date_bluray', 'NOW()')
								->andWhereSup('date_bluray', '1920-02-02')
			);
		}
		else if ($sType === 'bluray') {

			$oWhere->whereInf('date_bluray', 'NOW()')
				   ->andWhereSup('date_bluray', '1980-00-00');
		}
		else {

			$oWhere->whereInf('date_dvd', 'NOW()')
				   ->andWhereSup('date_dvd', '1980-00-00');
		}

		if ($iOffset < 1) { $iOffset = '0'; }

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', 'r.*', 'ROUND(SUM(c.score) / COUNT(*), 2) AS num'))
					   ->from($this->_sTableName, 'r')
					   ->where($oWhere)
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['num DESC'])
					   ->limit(10, $iOffset)
					   ->load();

		$result[0]->count = $this->orm
					   			 ->select(array('FOUND_ROWS()'))
					   			 ->load();

		$result[0]->pages = floor($result[0]->count / 10);

		return $result;
	}

	/**
	 * Get the best dvd record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  int $iOffset
	 * @return array
	 */

	public function getDvdOrBlurayByDate($sType = 'all', $iOffset = 0) {

		$oWhere = new Where;
		$oWhere2 = new Where;
		$oWhere3 = new Where;

		if ($sType === 'all') {

			$oWhere->addWhere(
							$oWhere2->whereInf('date_dvd', 'NOW()')
									->andWhereSup('date_dvd', '1920-02-02')
			)
			->orAddWhere(
							$oWhere3->whereInf('date_bluray', 'NOW()')
									->andWhereSup('date_bluray', '1920-02-02')
			);
		}
		else if ($sType === 'bluray') {

			$oWhere->whereInf('date_bluray', 'NOW()')
				   ->andWhereSup('date_bluray', '1980-00-00');
		}
		else {

			$oWhere->whereInf('date_dvd', 'NOW()')
				   ->andWhereSup('date_dvd', '1980-00-00');
		}

		if ($iOffset < 1) { $iOffset = '0'; }

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', 'r.*'))
					   ->from($this->_sTableName, 'r')
					   ->where($oWhere)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_dvd DESC'])
					   ->limit(10, $iOffset)
					   ->load();

		$result[0]->count = $this->orm
				  ->select(array('FOUND_ROWS()'))
				  ->load();

		$result[0]->pages = floor($result[0]->count / 10);

		return $result;
	}

	/**
	 * Get the best dvd record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  int $iOffset
	 * @return array
	 */

	public function getBestDvdOrBlurayForUs($sType = 'all', $iOffset = 0) {

		$oWhere = new Where;
		$oWhere2 = new Where;
		$oWhere3 = new Where;

		if ($sType === 'all') {

			$oWhere->addWhere(
							$oWhere2->whereInf('date_dvd', 'NOW()')
							->andWhereSup('date_dvd', '1920-02-02')
			)
			->orAddWhere(
							$oWhere3->whereInf('date_bluray', 'NOW()')
							->andWhereSup('date_bluray', '1920-02-02')
			);
		}
		else if ($sType === 'bluray') {

			$oWhere->whereInf('date_bluray', 'NOW()')
				   ->andWhereSup('date_bluray', '1980-00-00');
		}
		else {

			$oWhere->whereInf('date_dvd', 'NOW()')
				   ->andWhereSup('date_dvd', '1980-00-00');
		}

		if ($iOffset < 1) { $iOffset = '0'; }

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', 'r.*'))
					   ->from($this->_sTableName, 'r')
					   ->where($oWhere)
					   ->groupBy(['r.id'])
					   ->orderBy(['score DESC'])
					   ->limit(10, $iOffset)
					   ->load();

		$result[0]->count = $this->orm
				  ->select(array('FOUND_ROWS()'))
				  ->load();

		$result[0]->pages = floor($result[0]->count / 10);

		return $result;
	}

	/**
	 * Get the last movies for an actor
	 *
	 * @access public
	 * @param  int $iIdPerson type
	 * @return array
	 */

	public function getLastMoviesByRecord($iIdPerson) {

		$aFinalReturn = [];

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'record_has_actor',
						'as' => 'rha',
						'left_field' => 'rha.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('r.*'))
					   ->from($this->_sTableName, 'r')
					   ->where(
							$oWhere->whereEqual('rha.id_person', $iIdPerson)
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_cinema DESC'])
					   ->limit(8)
					   ->load();

		foreach ($result as $aOne) {

			$aFinalReturn[$aOne->get_id()] = $aOne;
		}

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'record_has_creator',
						'as' => 'rhc',
						'left_field' => 'rhc.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('r.*'))
					   ->from($this->_sTableName, 'r')
					   ->where(
							$oWhere->WhereEqual('rhc.id_person', $iIdPerson)
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_cinema DESC'])
					   ->limit(8)
					   ->load();

		foreach ($result as $aOne) {

			$aFinalReturn[$aOne->get_id()] = $aOne;
		}

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'record_has_distributor',
						'as' => 'rhd',
						'left_field' => 'rhd.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('r.*'))
					   ->from($this->_sTableName, 'r')
					   ->where(
					   		$oWhere->WhereEqual('rhd.id_person', $iIdPerson)
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_cinema DESC'])
					   ->limit(8)
					   ->load();

		foreach ($result as $aOne) {

			$aFinalReturn[$aOne->get_id()] = $aOne;
		}

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'record_has_technical_team',
						'as' => 'rhtt',
						'left_field' => 'rhtt.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('r.*'))
					   ->from($this->_sTableName, 'r')
					   ->where(
					   		$oWhere->WhereEqual('rhtt.id_person', $iIdPerson)
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_cinema DESC'])
					   ->limit(8)
					   ->load();

		foreach ($result as $aOne) {

			$aFinalReturn[$aOne->get_id()] = $aOne;
		}

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'record_has_productor',
						'as' => 'rhp',
						'left_field' => 'rhp.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('r.*'))
					   ->from($this->_sTableName, 'r')
					   ->where(
					   		$oWhere->WhereEqual('rhp.id_person', $iIdPerson)
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_cinema DESC'])
					   ->limit(8)
					   ->load();

		foreach ($result as $aOne) {

			$aFinalReturn[$aOne->get_id()] = $aOne;
		}

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'record_has_realisator',
						'as' => 'rhr',
						'left_field' => 'rhr.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('r.*'))
					   ->from($this->_sTableName, 'r')
					   ->where(
					   		$oWhere->WhereEqual('rhr.id_person', $iIdPerson)
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_cinema DESC'])
					   ->limit(8)
					   ->load();

		foreach ($result as $aOne) {

			$aFinalReturn[$aOne->get_id()] = $aOne;
		}

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'record_has_screenwriter',
						'as' => 'rhs',
						'left_field' => 'rhs.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('r.*'))
					   ->from($this->_sTableName, 'r')
					   ->where(
					   		$oWhere->WhereEqual('rhs.id_person', $iIdPerson)
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_cinema DESC'])
					   ->limit(8)
					   ->load();

		foreach ($result as $aOne) {

			$aFinalReturn[$aOne->get_id()] = $aOne;
		}

		return $result;
	}

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @param  integer $iKind id_kind
	 * @return array
	 */

	public function getMoviesByKind($sType = 'film', $iLimit = 10, $iOffset = 0, $iKind = 1) {

		$aJoin = [
					[
						'type' => 'right',
						'table' => 'record_has_kind',
						'as' => 'rhk',
						'left_field' => 'rhk.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', 'r.*'))
					   ->from($this->_sTableName, 'r')
					   ->where(
							$oWhere->whereEqual('rhk.id_kind', $iKind)
								   ->andWhereEqual('type', $sType)
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['title'])
					   ->limit($iLimit, $iOffset)
					   ->load();

		if (!isset($result[0])) { $result[0] = new \stdClass(); }

		$result[0]->count = $this->orm
				  ->select(array('FOUND_ROWS()'))
				  ->load();

		$result[0]->pages = floor($result[0]->count / 10);

		return $result;
	}

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getMovies($sType = 'film', $iLimit = 10, $iOffset = 0) {

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'like_movie',
						'as' => 'lm',
						'left_field' => 'lm.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', 'r.*', 'count(*) AS num'))
					   ->from($this->_sTableName, 'r')
					   ->where($oWhere->andWhereEqual('type', $sType))
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['num DESC'])
					   ->limit($iLimit, $iOffset)
					   ->load();

		$result[0]->count = $this->orm
				  ->select(array('FOUND_ROWS()'))
				  ->load();

		$result[0]->pages = floor($result[0]->count / 10);

		return $result;
	}

	/**
	 * Get the record by Word
	 *
	 * @access public
	 * @param  string $sWord word
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getLikeWord($sWord, $iLimit = 10, $iOffset = 0) {

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', 'r.*'))
					   ->from($this->_sTableName, 'r')
					   ->where($oWhere->whereSoundex('title', $sWord))
					   ->orderBy(['date_cinema DESC'])
					   ->limit($iLimit, $iOffset)
					   ->load();

		if (!isset($result[0])) { $result[0] = new \stdClass(); }

		$result[0]->count = $this->orm
				  ->select(array('FOUND_ROWS()'))
				  ->load();

		$result[0]->pages = floor($result[0]->count / 10);

		return $result;
	}
}

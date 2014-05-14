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

namespace Venus\src\WebSite\Model;

use \Venus\core\Model as Model;
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

	public function getMoviesOfWeek($sType = 'film', $iLimit = 10, $iOffset = 0, $iIntNumberWeeks = 1) {

		$result = array();
		$aDate = Date::getActualMiddleWeek();

		if ($iIntNumberWeeks > 1) {

			if ((int)date('W') > $iIntNumberWeeks) { $aDateBefore4 = Date::getMiddleWeek(date('W') - $iIntNumberWeeks, date('Y')); }
			else { $aDateBefore4 = Date::getMiddleWeek(52 - date('W') - $iIntNumberWeeks, date('Y') - 1); }

			$aDate[0] = $aDateBefore4[0];
		}

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

		$result['items'] = $this->orm
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

		$result['count'] = $this->orm
								->select(array('FOUND_ROWS()'))
								->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}

	/**
	 * Get the best movie/serie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getBestMovies($sType = 'film', $iLimit = 10, $iOffset = 0) {

		$result = array();

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

		$result['items'] = $this->orm
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

		$result['count'] = $this->orm
				  				->select(array('FOUND_ROWS()'))
				  				->load();

		$result['pages'] = floor($result['count'] / $iLimit);

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

	public function getMovies($sType = 'film', $iLimit = 10, $iOffset = 0, $sFirstLetter = null, $iKind = 0) {

		$result = array();

		$this->orm
			 ->select(array('SQL_CALC_FOUND_ROWS', 'r.*'))
			 ->from($this->_sTableName, 'r');

		if ($iKind > 0) {

			$aJoin = [
						[
							'type' => 'left',
							'table' => 'record_has_kind',
							'as' => 'rhk',
							'left_field' => 'rhk.id_record',
							'right_field' => 'r.id'
						]
			];

			if ($sFirstLetter !== null) {  $this->where->whereLikeStartBy('title', $sFirstLetter); }

			$this->orm
				 ->join($aJoin)
			 	 ->where($this->where->whereEqual('type', $sType)->andWhereEqual('id_kind', $iKind));
		}
		else {

			if ($sFirstLetter !== null) {  $this->where->whereLikeStartBy('title', $sFirstLetter); }

			$this->orm
			 	 ->where($this->where->andWhereEqual('type', $sType));
		}

		$result['items'] = $this->orm
					   			->groupBy(['r.id'])
					   			->orderBy(['title'])
					   			->limit($iLimit, $iOffset)
					   			->load();

		$result['count'] = $this->orm
				  				->select(array('FOUND_ROWS()'))
				  				->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}

	/**
	 * Get the wanted movie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getWantedMovies($sType = 'film', $iLimit = 10, $iOffset = 0) {

		$result = array();
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

			$oWhereToAdd = $this->where
								->whereSup('date_cinema', 'NOW()')
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

			$oWhereToAdd = $this->where
								->whereEqual('type', $sType)
								->andWhereInf('YEAR(NOW())', '|production_date + season|');

			$oHavingToAdd = $oHaving->whereEqual('season', '|MAX(season)|');
		}

		$result['items'] = $this->orm
					   			->select($aSelect)
					  		 	->from($this->_sTableName, 'r')
					   			->join($aJoin)
					   			->where($oWhereToAdd)
					   			->groupBy(['r.id'])
					   			->having($oHavingToAdd)
					   			->orderBy(['num DESC'])
					   			->limit($iLimit, $iOffset)
					   			->load();

		$result['count'] = $this->orm
				  				->select(array('FOUND_ROWS()'))
				  				->load();

		$result['pages'] = floor($result['count'] / $iLimit);

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

	public function getDvdOrBlurayByDate($sType = 'all', $iLimit = 4, $iOffset = 0) {

		$result = array();
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

		$result['items'] = $this->orm
					   			->select(array('SQL_CALC_FOUND_ROWS', 'r.*'))
					   			->from($this->_sTableName, 'r')
					   			->where($oWhere)
					   			->groupBy(['r.id'])
					   			->orderBy(['date_dvd DESC'])
					   			->limit($iLimit, $iOffset)
					   			->load();

		$result['count'] = $this->orm
				  				->select(array('FOUND_ROWS()'))
				  				->load();

		$result['pages'] = floor($result['count'] / $iLimit);

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

	public function getBestDvdOrBluray($sType = 'all', $iLimit = 4, $iOffset = 0) {

		$result = array();

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

		$result['items'] = $this->orm
					   			->select(array('SQL_CALC_FOUND_ROWS', 'r.*', 'ROUND(SUM(c.score) / COUNT(*), 2) AS num'))
					   			->from($this->_sTableName, 'r')
					   			->where($oWhere)
					   			->join($aJoin)
					   			->groupBy(['r.id'])
					   			->orderBy(['num DESC'])
					   			->limit($iLimit, $iOffset)
					   			->load();

		$result['count'] = $this->orm
				  				->select(array('FOUND_ROWS()'))
				  				->load();

		$result['pages'] = floor($result['count'] / $iLimit);

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

	public function getWantedDvdOrBluray($sType = 'all', $iLimit = 4, $iOffset = 0) {

		$result = array();

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
						$oWhere2->whereSup('date_dvd', 'NOW()')
								->andWhereinf('date_dvd', "DATE_ADD('NOW()', INTERVAL 6 MONTH)")
					)
					->orAddWhere(
						$oWhere3->whereSup('date_bluray', 'NOW()')
								->andWhereInf('date_bluray', "DATE_ADD('NOW()', INTERVAL 6 MONTH)")
			);
		}
		else if ($sType === 'bluray') {

			$oWhere->whereSup('date_bluray', 'NOW()')
				   ->andWhereinf('date_bluray', "DATE_ADD('NOW()', INTERVAL 6 MONTH)");
		}
		else {

			$oWhere->whereSup('date_dvd', 'NOW()')
				   ->andWhereinf('date_dvd', "DATE_ADD('NOW()', INTERVAL 6 MONTH)");
		}

		if ($iOffset < 1) { $iOffset = '0'; }

		$result['items'] = $this->orm
					   			->select(array('SQL_CALC_FOUND_ROWS', 'r.*', 'ROUND(SUM(c.score) / COUNT(*), 2) AS num'))
					   			->from($this->_sTableName, 'r')
					   			->where($oWhere)
					   			->join($aJoin)
					   			->groupBy(['r.id'])
					   			->orderBy(['num DESC'])
					   			->limit($iLimit, $iOffset)
					   			->load();

		$result['count'] = $this->orm
				  				->select(array('FOUND_ROWS()'))
				  				->load();

		$result['pages'] = floor($result['count'] / $iLimit);

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

	public function getDvdOrBluray($sType = 'all', $iLimit = 4, $iOffset = 0) {

		$result = array();
		$oWhere = new Where;
		$oWhere2 = new Where;
		$oWhere3 = new Where;

		if ($iOffset < 1) { $iOffset = '0'; }

		$result['items'] = $this->orm
					   			->select(array('SQL_CALC_FOUND_ROWS', 'r.*'))
					   			->from($this->_sTableName, 'r')
					   			->where($oWhere)
					   			->groupBy(['r.id'])
					   			->orderBy(['date_dvd DESC'])
					   			->limit($iLimit, $iOffset)
					   			->load();

		$result['count'] = $this->orm
				  				->select(array('FOUND_ROWS()'))
				  				->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}

	/**
	 * Get the last movies for an actor
	 *
	 * @access public
	 * @param  int $iIdPerson type
	 * @return array
	 */

	public function getLastMoviesByActor($iIdPerson) {

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
					   		$this->where->WhereEqual('rhs.id_person', $iIdPerson)
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_cinema DESC'])
					   ->limit(8)
					   ->load();

		foreach ($result as $aOne) {

			$aFinalReturn[$aOne->get_id()] = $aOne;
		}

		return $aFinalReturn;
	}

	/**
	 * Get the best movie/serie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getBestMoviesForRecordIds($iIds) {

		$result = array();

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

		$result['items'] = $this->orm
								->select(array('SQL_CALC_FOUND_ROWS', 'r.*', 'IF(lm.id_record IS NULL, 0, count(*)) AS num'))
								->from($this->_sTableName, 'r')
								->where($oWhere->whereIn('r.id', $iIds))
								->join($aJoin)
								->groupBy(['r.id'])
								->orderBy(['num DESC'])
								->load();

		$result['count'] = $this->orm
								->select(array('FOUND_ROWS()'))
								->load();

		return $result;
	}

	/**
	 * Get the best movie/serie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getMaxActorFriendsForRecordIds($iIds, $iPersonIdToExclude) {

		$aPersons = array();
		$aPersonsObject = array();
		$result = array();

		$aJoin = [
			[
				'type' => 'right',
				'table' => 'record_has_actor',
				'as' => 'rha',
				'left_field' => 'rha.id_record',
				'right_field' => 'r.id'
			],
			[
				'type' => 'right',
				'table' => 'person',
				'as' => 'p',
				'left_field' => 'rha.id_person',
				'right_field' => 'p.id'
			]
		];

		$oWhere = new Where;

		$result['items'] = $this->orm
								->select(array('SQL_CALC_FOUND_ROWS', 'rha.*', 'p.*', 'r.*', 'COUNT(*) AS num'))
								->from($this->_sTableName, 'r')
								->where($oWhere->whereIn('r.id', $iIds)->andWhereNotEqual('p.id', $iPersonIdToExclude))
								->join($aJoin)
								->groupBy(['rha.id_person'])
								->orderBy(['num DESC'])
								->load();

		foreach ($result['items'] as $oOne) {

			if (!isset($aPersons[$oOne->record_has_actor->get_id_person()])) {

				$aPersons[$oOne->record_has_actor->get_id_person()] = (int)$oOne->num;
				$aPersonsObject[$oOne->record_has_actor->get_id_person()] = $oOne->person;
			}
			else { $aPersons[$oOne->record_has_actor->get_id_person()] += (int)$oOne->num; }
		}

		$result = array();

		$aJoin = [
			[
				'type' => 'right',
				'table' => 'record_has_creator',
				'as' => 'rha',
				'left_field' => 'rha.id_record',
				'right_field' => 'r.id'
			],
			[
				'type' => 'right',
				'table' => 'person',
				'as' => 'p',
				'left_field' => 'rha.id_person',
				'right_field' => 'p.id'
			]
		];

		$oWhere = new Where;

		$result['items'] = $this->orm
								->select(array('SQL_CALC_FOUND_ROWS', 'rha.*', 'p.*', 'r.*', 'COUNT(*) AS num'))
								->from($this->_sTableName, 'r')
								->where($oWhere->whereIn('r.id', $iIds)->andWhereNotEqual('p.id', $iPersonIdToExclude))
								->join($aJoin)
								->groupBy(['rha.id_person'])
								->orderBy(['num DESC'])
								->load();

		foreach ($result['items'] as $oOne) {

			if (!isset($aPersons[$oOne->record_has_creator->get_id_person()])) {

				$aPersons[$oOne->record_has_creator->get_id_person()] = (int)$oOne->num;
				$aPersonsObject[$oOne->record_has_creator->get_id_person()] = $oOne->person;
			}
			else { $aPersons[$oOne->record_has_creator->get_id_person()] += (int)$oOne->num; }
		}

		$result = array();

		$aJoin = [
			[
				'type' => 'right',
				'table' => 'record_has_distributor',
				'as' => 'rha',
				'left_field' => 'rha.id_record',
				'right_field' => 'r.id'
			],
			[
				'type' => 'right',
				'table' => 'person',
				'as' => 'p',
				'left_field' => 'rha.id_person',
				'right_field' => 'p.id'
			]
		];

		$oWhere = new Where;

		$result['items'] = $this->orm
								->select(array('SQL_CALC_FOUND_ROWS', 'rha.*', 'p.*', 'r.*', 'COUNT(*) AS num'))
								->from($this->_sTableName, 'r')
								->where($oWhere->whereIn('r.id', $iIds)->andWhereNotEqual('p.id', $iPersonIdToExclude))
								->join($aJoin)
								->groupBy(['rha.id_person'])
								->orderBy(['num DESC'])
								->load();

		foreach ($result['items'] as $oOne) {

			if (!isset($aPersons[$oOne->record_has_distributor->get_id_person()])) {

				$aPersons[$oOne->record_has_distributor->get_id_person()] = (int)$oOne->num;
				$aPersonsObject[$oOne->record_has_distributor->get_id_person()] = $oOne->person;
			}
			else { $aPersons[$oOne->record_has_distributor->get_id_person()] += (int)$oOne->num; }
		}

		$result = array();

		$aJoin = [
			[
				'type' => 'right',
				'table' => 'record_has_technical_team',
				'as' => 'rha',
				'left_field' => 'rha.id_record',
				'right_field' => 'r.id'
			],
			[
				'type' => 'right',
				'table' => 'person',
				'as' => 'p',
				'left_field' => 'rha.id_person',
				'right_field' => 'p.id'
			]
		];

		$oWhere = new Where;

		$result['items'] = $this->orm
								->select(array('SQL_CALC_FOUND_ROWS', 'rha.*', 'p.*', 'r.*', 'COUNT(*) AS num'))
								->from($this->_sTableName, 'r')
								->where($oWhere->whereIn('r.id', $iIds)->andWhereNotEqual('p.id', $iPersonIdToExclude))
								->join($aJoin)
								->groupBy(['rha.id_person'])
								->orderBy(['num DESC'])
								->load();

		foreach ($result['items'] as $oOne) {

			if (!isset($aPersons[$oOne->record_has_technical_team->get_id_person()])) {

				$aPersons[$oOne->record_has_technical_team->get_id_person()] = (int)$oOne->num;
				$aPersonsObject[$oOne->record_has_technical_team->get_id_person()] = $oOne->person;
			}
			else { $aPersons[$oOne->record_has_technical_team->get_id_person()] += (int)$oOne->num; }
		}

		$result = array();

		$aJoin = [
			[
				'type' => 'right',
				'table' => 'record_has_productor',
				'as' => 'rha',
				'left_field' => 'rha.id_record',
				'right_field' => 'r.id'
			],
			[
				'type' => 'right',
				'table' => 'person',
				'as' => 'p',
				'left_field' => 'rha.id_person',
				'right_field' => 'p.id'
			]
		];

		$oWhere = new Where;

		$result['items'] = $this->orm
								->select(array('SQL_CALC_FOUND_ROWS', 'rha.*', 'p.*', 'r.*', 'COUNT(*) AS num'))
								->from($this->_sTableName, 'r')
								->where($oWhere->whereIn('r.id', $iIds)->andWhereNotEqual('p.id', $iPersonIdToExclude))
								->join($aJoin)
								->groupBy(['rha.id_person'])
								->orderBy(['num DESC'])
								->load();

		foreach ($result['items'] as $oOne) {

			if (!isset($aPersons[$oOne->record_has_productor->get_id_person()])) {

				$aPersons[$oOne->record_has_productor->get_id_person()] = (int)$oOne->num;
				$aPersonsObject[$oOne->record_has_productor->get_id_person()] = $oOne->person;
			}
			else { $aPersons[$oOne->record_has_productor->get_id_person()] += (int)$oOne->num; }
		}

		$result = array();

		$aJoin = [
			[
				'type' => 'right',
				'table' => 'record_has_realisator',
				'as' => 'rha',
				'left_field' => 'rha.id_record',
				'right_field' => 'r.id'
			],
			[
				'type' => 'right',
				'table' => 'person',
				'as' => 'p',
				'left_field' => 'rha.id_person',
				'right_field' => 'p.id'
			]
		];

		$oWhere = new Where;

		$result['items'] = $this->orm
								->select(array('SQL_CALC_FOUND_ROWS', 'rha.*', 'p.*', 'r.*', 'COUNT(*) AS num'))
								->from($this->_sTableName, 'r')
								->where($oWhere->whereIn('r.id', $iIds)->andWhereNotEqual('p.id', $iPersonIdToExclude))
								->join($aJoin)
								->groupBy(['rha.id_person'])
								->orderBy(['num DESC'])
								->load();

		foreach ($result['items'] as $oOne) {

			if (!isset($aPersons[$oOne->record_has_realisator->get_id_person()])) {

				$aPersons[$oOne->record_has_realisator->get_id_person()] = (int)$oOne->num;
				$aPersonsObject[$oOne->record_has_realisator->get_id_person()] = $oOne->person;
			}
			else { $aPersons[$oOne->record_has_realisator->get_id_person()] += (int)$oOne->num; }
		}

		$result = array();

		$aJoin = [
			[
				'type' => 'right',
				'table' => 'record_has_screenwriter',
				'as' => 'rha',
				'left_field' => 'rha.id_record',
				'right_field' => 'r.id'
			],
			[
				'type' => 'right',
				'table' => 'person',
				'as' => 'p',
				'left_field' => 'rha.id_person',
				'right_field' => 'p.id'
			]
		];

		$oWhere = new Where;

		$result['items'] = $this->orm
								->select(array('SQL_CALC_FOUND_ROWS', 'rha.*', 'p.*', 'r.*', 'COUNT(*) AS num'))
								->from($this->_sTableName, 'r')
								->where($oWhere->whereIn('r.id', $iIds)->andWhereNotEqual('p.id', $iPersonIdToExclude))
								->join($aJoin)
								->groupBy(['rha.id_person'])
								->orderBy(['num DESC'])
								->load();

		foreach ($result['items'] as $oOne) {

			if (!isset($aPersons[$oOne->record_has_screenwriter->get_id_person()])) {

				$aPersons[$oOne->record_has_screenwriter->get_id_person()] = (int)$oOne->num;
				$aPersonsObject[$oOne->record_has_screenwriter->get_id_person()] = $oOne->person;
			}
			else { $aPersons[$oOne->record_has_screenwriter->get_id_person()] += (int)$oOne->num; }
		}

		arsort($aPersons);
		$i = 0;

		foreach ($aPersons as $iKey => $oOne) {

			if ($i < 8) { $aPersons[$iKey] = $aPersonsObject[$iKey]; }
			else { unset($aPersons[$iKey]); }

			$i++;
		}

		return $aPersons;
	}

	/**
	 * Get the last movies for an actor
	 *
	 * @access public
	 * @param  int $iIdPerson type
	 * @return array
	 */

	public function getLastMoviesDvdByActor($iIdPerson) {

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
					   			   ->andWhereInf('r.date_dvd', 'NOW()')
					   			   ->andWhereSup('r.date_dvd', '1950-01-01')
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_dvd DESC'])
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
					   			   ->andWhereInf('r.date_dvd', 'NOW()')
					   			   ->andWhereSup('r.date_dvd', '1950-01-01')
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_dvd DESC'])
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
					   			   ->andWhereInf('r.date_dvd', 'NOW()')
					   			   ->andWhereSup('r.date_dvd', '1950-01-01')
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_dvd DESC'])
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
					   			   ->andWhereInf('r.date_dvd', 'NOW()')
					   			   ->andWhereSup('r.date_dvd', '1950-01-01')
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_dvd DESC'])
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
					   			   ->andWhereInf('r.date_dvd', 'NOW()')
					   			   ->andWhereSup('r.date_dvd', '1950-01-01')
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_dvd DESC'])
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
					   			   ->andWhereInf('r.date_dvd', 'NOW()')
					   			   ->andWhereSup('r.date_dvd', '1950-01-01')
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_dvd DESC'])
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
					   			   ->andWhereInf('r.date_dvd', 'NOW()')
					   			   ->andWhereSup('r.date_dvd', '1950-01-01')
					   )
					   ->join($aJoin)
					   ->groupBy(['r.id'])
					   ->orderBy(['date_dvd DESC'])
					   ->limit(8)
					   ->load();

		foreach ($result as $aOne) {

			$aFinalReturn[$aOne->get_id()] = $aOne;
		}

		return $aFinalReturn;
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

		$result = array();

		$result['items'] = $this->orm
					   			->select(array('SQL_CALC_FOUND_ROWS', 'r.*'))
					   			->from($this->_sTableName, 'r')
					   			->where($this->where->whereSoundex('title', $sWord))
					   			->orderBy(['date_cinema DESC'])
					   			->limit($iLimit, $iOffset)
					   			->load();

		$result['count'] = $this->orm
				  				->select(array('FOUND_ROWS()'))
				  				->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}
}

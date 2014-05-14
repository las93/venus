<?php

/**
 * Model to trailer

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
use \Venus\lib\Entity as LibEntity;
use \Venus\lib\Orm\Where as Where;

/**
 * Model to trailer
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

class trailer extends Model {

	/**
	 * Get Lasts trailers
	 *
	 * @access public
	 * @param  integer $iLimit limit
	 * @param  string $sType type of trailers
	 * @param  int $iRecordId record_id
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getLastRows($iLimit = 4, $sType = null, $iRecordId = null, $iOffset = 0) {

		if ($iRecordId > 0) {

			$result = $this->orm
						   ->select(array('SQL_CALC_FOUND_ROWS', '*'))
						   ->from($this->_sTableName)
						   ->where(['id_record' => $iRecordId])
						   ->orderBy(array(LibEntity::getPrimaryKeyName($this->entity).' DESC'))
						   ->limit($iLimit, $iOffset)
						   ->load();

			if (count($result) < 1) {

				$result[0] = new \StdClass();
				$result[0]->count = 0;
			}

			$result[0]->count = $this->orm
									 ->select(array('FOUND_ROWS()'))
									 ->load();

			$result[0]->pages = floor(($result[0]->count - 1) / $iLimit);
		}
		else if ($sType === null) {

			$result = $this->orm
						   ->select(array('SQL_CALC_FOUND_ROWS', '*'))
						   ->from($this->_sTableName)
						   ->orderBy(array(LibEntity::getPrimaryKeyName($this->entity).' DESC'))
						   ->limit($iLimit, $iOffset)
						   ->load();

			$result[0]->count = $this->orm
									 ->select(array('FOUND_ROWS()'))
									 ->load();

			$result[0]->pages = floor(($result[0]->count - 1) / $iLimit);
		}
		else {

			$aJoin = [
						[
							'type' => 'left',
							'table' => 'record',
							'as' => 'r',
							'left_field' => 't.id_record',
							'right_field' => 'r.id'
						]
			];

			$result = $this->orm
						   ->select(array('SQL_CALC_FOUND_ROWS', 't.*'))
						   ->from($this->_sTableName, 't')
						   ->join($aJoin)
						   ->where(['type' => $sType])
						   ->orderBy(array('r.'.LibEntity::getPrimaryKeyName($this->entity).' DESC'))
						   ->limit($iLimit, $iOffset)
						   ->load();

			$result[0]->count = $this->orm
									 ->select(array('FOUND_ROWS()'))
									 ->load();

			$result[0]->pages = floor(($result[0]->count - 1) / $iLimit);
		}

		return $result;
	}

	/**
	 * Get Lasts trailers
	 *
	 * @access public
	 * @param  string $sIds ids
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getLastsTrailerByRecordIds($sIds, $iLimit = 8, $iOffset = 0) {

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', '*'))
					   ->from($this->_sTableName)
					   ->where($oWhere->whereIn('id_record', explode(',', $sIds)))
					   ->orderBy(array('created DESC'))
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
	 * Get the best dvd record
	 *
	 * @access public
	 * @param  string $sIds ids
	 * @return array
	 */

	public function getDvdOrBlurayByIdPerson($sIds) {

		$aJoin = [
					[
						'type' => 'inner',
						'table' => 'person',
						'as' => 'p',
						'left_field' => 'p.id_record',
						'right_field' => 'r.id'
					],
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName, 'r')
					   ->where($oWhere)
					   ->join($aJoin)
					   ->where($oWhere->whereIn('p.id_person', $sIds))
					   ->groupBy(['r.id'])
					   ->orderBy(['num DESC'])
					   ->limit()
					   ->load();

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

	public function getBestTrailers($sType = 'film', $iLimit = 10, $iOffset = 0) {

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'like_movie',
						'as' => 'lm',
						'left_field' => 'lm.id_record',
						'right_field' => 't.id_record'
					],
					[
						'type' => 'right',
						'table' => 'record',
						'as' => 'r',
						'left_field' => 't.id_record',
						'right_field' => 'r.id'
					]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', 't.*', 'count(*) AS num'))
					   ->from($this->_sTableName, 't')
					   ->where(
								$oWhere->whereInf('date_cinema', 'NOW()')
									   ->andWhereEqual('type', $sType)
					   )
					   ->join($aJoin)
					   ->groupBy(['t.id'])
					   ->orderBy(['num DESC'])
					   ->limit($iLimit, $iOffset)
					   ->load();

		$result[0]->count = $this->orm
				  ->select(array('FOUND_ROWS()'))
				  ->load();

		$result[0]->pages = ceil($result[0]->count / 10);

		return $result;
	}
}

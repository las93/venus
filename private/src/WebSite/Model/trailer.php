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

namespace Venus\src\WebSite\Model;

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

		$result = array();

		if ($iRecordId > 0) {

			$result['items'] = $this->orm
						   			->select(array('SQL_CALC_FOUND_ROWS', '*'))
						   			->from($this->_sTableName)
						   			->where(['id_record' => $iRecordId])
						   			->orderBy(array(LibEntity::getPrimaryKeyName($this->entity).' DESC'))
						   			->limit($iLimit, $iOffset)
						   			->load();

			$result['count'] = $this->orm
									->select(array('FOUND_ROWS()'))
									->load();

			$result['pages'] = floor(($result['count'] - 1) / $iLimit);
		}
		else if ($sType === null) {

			$result['items'] = $this->orm
						  	 		->select(array('SQL_CALC_FOUND_ROWS', '*'))
						   			->from($this->_sTableName)
						   			->orderBy(array(LibEntity::getPrimaryKeyName($this->entity).' DESC'))
						   			->limit($iLimit, $iOffset)
						   			->load();

			$result['count'] = $this->orm
									->select(array('FOUND_ROWS()'))
									->load();

			$result['pages'] = floor(($result['count'] - 1) / $iLimit);
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

			$result['items'] = $this->orm
						   			->select(array('SQL_CALC_FOUND_ROWS', 't.*'))
						   			->from($this->_sTableName, 't')
						   			->join($aJoin)
						   			->where(['r.type' => $sType])
						   			->orderBy(array('r.'.LibEntity::getPrimaryKeyName($this->entity).' DESC'))
						   			->limit($iLimit, $iOffset)
						   			->load();

			$result['count'] = $this->orm
									->select(array('FOUND_ROWS()'))
									->load();

			$result['pages'] = floor(($result['count'] - 1) / $iLimit);
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
	 * @return array
	 */

	public function getByRecordIds($aRecordIds, $iLimit = 10, $iOffset = 0) {

		$result = array();

		$result['items'] = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', 't.*'))
					   ->from($this->_sTableName, 't')
					   ->where(
							$this->where->whereIn('id_record', $aRecordIds)
					   )
					   ->limit($iLimit, $iOffset)
					   ->load();

		$result['count'] = $this->orm
								->select(array('FOUND_ROWS()'))
								->load();

		$result['pages'] = floor($result['count'] / $iLimit);

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

		$result = array();

		$oWhere = new Where;

		$result['items'] = $this->orm
					   			->select(array('SQL_CALC_FOUND_ROWS', '*'))
					   			->from($this->_sTableName)
					   			->where($oWhere->whereIn('id_record', explode(',', $sIds)))
					   			->orderBy(array('created DESC'))
					   			->limit($iLimit, $iOffset)
					   			->load();

		$result['count'] = $this->orm
								->select(array('FOUND_ROWS()'))
								->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}
}

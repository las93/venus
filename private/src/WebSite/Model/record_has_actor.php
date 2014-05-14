<?php

/**
 * Model to record_has_actor
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

/**
 * Model to record_has_actor
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

class record_has_actor extends Model {

	/**
	 * Get actors for a record
	 *
	 * @access public
	 * @param  integer $iIdRecord id_record
	 * @return array
	 */

	public function getActorsByRecordId($iIdRecord, $iLimit = 1000) {

		$result = array();

		$aJoin = [
					[
						'type' => 'rigth',
						'table' => 'person',
						'as' => 'p',
						'left_field' => 'p.id',
						'right_field' => 'pha.id_person'
					],
					[
						'type' => 'left',
						'table' => 'like_person',
						'as' => 'lp',
						'left_field' => 'lp.id_person',
						'right_field' => 'pha.id_person'
					]
		];

		$result['items'] = $this->orm
					   			->select(array('SQL_CALC_FOUND_ROWS', '*', 'COUNT(*) AS num'))
					   			->from($this->_sTableName, 'pha')
					   			->join($aJoin)
					   			->where(['id_record' => $iIdRecord])
					   			->groupBy(['pha.id_person'])
					   			->orderBy(['num DESC'])
					   			->load();

		$result['count'] = $this->orm
								->select(array('FOUND_ROWS()'))
								->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}

	/**
	 * Get actors for a record
	 *
	 * @access public
	 * @param  integer $iIdPerson id_record
	 * @return array
	 */

	public function getRecordByPersonId($iIdPerson) {

		$aJoin = [
					[
						'type' => 'rigth',
						'table' => 'record',
						'as' => 'r',
						'left_field' => 'r.id',
						'right_field' => 'pha.id_record'
					]
		];

		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName, 'pha')
					   ->join($aJoin)
					   ->where(['id_person' => $iIdPerson])
					   ->load();

		return $result;
	}
}

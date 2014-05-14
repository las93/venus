<?php

/**
 * Model to record_has_actor
 *
 * @category  	src
 * @package   	src\BackOffice\Model
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\BackOffice\Model;

use \Venus\core\Model as Model;
use \Venus\lib\Orm\Where as Where;

/**
 * Model to record_has_actor
 *
 * @category  	src
 * @package   	src\BackOffice\Model
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
	
	public function getActorsByRecordId($iIdRecord) {
	
		$aJoin = [
					[
						'type' => 'rigth',
						'table' => 'person',
						'as' => 'p',
						'left_field' => 'p.id',
						'right_field' => 'pha.id_person'
					]
		];
	
		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName, 'pha')
					   ->join($aJoin)
					   ->where(['id_record' => $iIdRecord])
					   ->orderBy(['firstname DESC', 'name DESC'])
					   ->limit()
					   ->load();
	
		return $result;
	}

	/**
	 * Get realisators for a record
	 *
	 * @access public
	 * @param  int $iIdPerson id_person
	 * @param  int $iIdRecord id_record
	 * @return array
	 */
	
	public function isRecordHasActorExists($iIdPerson, $iIdRecord) {
	
		$oWhere = new Where;
		
		$result = $this->orm
						->select(array('*'))
						->from($this->_sTableName)
						->where(
								$oWhere->whereEqual('id_person', $iIdPerson)
								->andWhereEqual('id_record', $iIdRecord)
						)
						->limit(1)
						->load();
	
		if (isset($result[0])) { return $result[0]; }
		else { return false; }
	}
}

<?php

/**
 * Model to record_has_productor
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

/**
 * Model to record_has_productor
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

class record_has_productor extends Model {

	/**
	 * Get productors for a record
	 *
	 * @access public
	 * @param  integer $iIdRecord id_record
	 * @return array
	 */
	
	public function getProductorsByRecordId($iIdRecord) {
	
		$aJoin = [
					[
						'type' => 'rigth',
						'table' => 'person',
						'as' => 'p',
						'left_field' => 'p.id',
						'right_field' => 'rhp.id_person'
					]
		];
	
		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName, 'rhp')
					   ->join($aJoin)
					   ->where(['id_record' => $iIdRecord])
					   	->load();
	
		return $result;
	}
}

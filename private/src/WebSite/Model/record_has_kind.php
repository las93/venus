<?php

/**
 * Model to record_has_kind
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
 * Model to record_has_kind
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

class record_has_kind extends Model {

	/**
	 * Get realisators for a record
	 *
	 * @access public
	 * @param  integer $iIdRecord id_record
	 * @return array
	 */

	public function getKindsByRecordId($iIdRecord, $iLimit = 1000) {

		$result = array();

		$aJoin = [
					[
						'type' => 'rigth',
						'table' => 'kind',
						'as' => 'k',
						'left_field' => 'k.id',
						'right_field' => 'rhk.id_kind'
					]
		];

		$result['items'] = $this->orm
					   			->select(array('SQL_CALC_FOUND_ROWS', '*'))
					   			->from($this->_sTableName, 'rhk')
					   			->join($aJoin)
					   			->where(['rhk.id_record' => $iIdRecord])
					   			->load();

		$result['count'] = $this->orm
								->select(array('FOUND_ROWS()'))
								->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}
}

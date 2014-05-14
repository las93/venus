<?php

/**
 * Model to photo
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
use \Venus\core\UrlManager as UrlManager;
use \Venus\lib\Date as Date;
use \Venus\lib\Orm\Where as Where;

/**
 * Model to photo
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

class photo extends Model {

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @param  integer $iIdRecord id record
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getPhotosByRecord($iIdRecord, $iLimit = 10, $iOffset = 0) {

		$result = array();

		$result['items'] = $this->orm
					   			->select(array('SQL_CALC_FOUND_ROWS', 'p.*'))
					   			->from($this->_sTableName, 'p')
					   			->where(
					   				$this->where->whereEqual('id_record', $iIdRecord)
					   			)
					   			->orderBy(['p.id DESC'])
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
	 * @param  integer $iIdPerson id photo
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getPhotoByIdPerson($iIdPerson, $iLimit = 10, $iOffset = 0) {

		$result = array();

		$aJoin = [
			[
				'type' => 'right',
				'table' => 'photo_has_person',
				'as' => 'php',
				'left_field' => 'php.id_photo',
				'right_field' => 'p.id'
			]
		];

		$result['items'] = $this->orm
					   			->select(array('SQL_CALC_FOUND_ROWS', '*'))
					  	 		->from($this->_sTableName, 'p')
					   			->where(
									$this->where->whereEqual('php.id_person', $iIdPerson)
					   			)
					   			->join($aJoin)
					   			->groupBy(['p.id'])
					   			->limit($iLimit, $iOffset)
					   			->load();

		$result['count'] = $this->orm
								->select(array('FOUND_ROWS()'))
								->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}
}

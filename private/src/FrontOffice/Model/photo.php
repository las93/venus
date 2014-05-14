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

namespace Venus\src\FrontOffice\Model;

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

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', 'p.*'))
					   ->from($this->_sTableName, 'p')
					   ->where(
					   		$oWhere->whereEqual('id_record', $iIdRecord)
					   	)
					   ->orderBy(['p.id DESC'])
					   ->limit($iLimit, $iOffset)
					   ->load();

		if (!isset($result[0])) {

			$result[0] = new \StdClass;
			$result[0]->count = 0;
		}
		else {

			$result[0]->count = $this->orm
								 	 ->select(array('FOUND_ROWS()'))
								 	 ->load();
		}

		$result[0]->pages = ceil($result[0]->count / 10);

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

		$aJoin = [
			[
				'type' => 'left',
				'table' => 'photo_has_person',
				'as' => 'php',
				'left_field' => 'php.id_photo',
				'right_field' => 'p.id'
			]
		];

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', '*'))
					   ->from($this->_sTableName, 'p')
					   ->where(
							$oWhere->whereInf('php.id_person', $iIdPerson)
					   )
					   ->join($aJoin)
					   ->groupBy(['p.id'])
					   ->limit($iLimit, $iOffset)
					   ->load();

		if (!isset($result[0])) {

			$result[0] = new \StdClass;
			$result[0]->count = 0;
		}
		else {

			$result[0]->count = $this->orm
				  	  ->select(array('FOUND_ROWS()'))
				  	  ->load();
		}

		$result[0]->pages = floor($result[0]->count / $iLimit);

		return $result;
	}
}

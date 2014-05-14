<?php

/**
 * Model to photo_has_person
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
 * Model to photo_has_person
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

class photo_has_person extends Model {

	/**
	 * Get actors for a record
	 *
	 * @access public
	 * @param  integer $iIdPhoto id_record
	 * @return array
	 */

	public function getPersonsByPhotoId($iIdPhoto) {

		$aJoin = [
					[
						'type' => 'rigth',
						'table' => 'person',
						'as' => 'p',
						'left_field' => 'p.id',
						'right_field' => 'php.id_person'
					]
		];

		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName, 'php')
					   ->join($aJoin)
					   ->where(['id_photo' => $iIdPhoto])
					   ->orderBy(['firstname DESC', 'name DESC'])
					   ->limit()
					   ->load();

		return $result;
	}
}

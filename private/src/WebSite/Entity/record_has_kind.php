<?php

/**
 * Entity to record_has_kind
 *
 * @category  	src
 * @package   	src\FrontOffice\Entity
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\WebSite\Entity;

use \Venus\core\Entity as Entity;
use \Venus\lib\Orm as Orm;

/**
 * Entity to record_has_kind
 *
 * @category  	src
 * @package   	src\FrontOffice\Entity
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class record_has_kind extends Entity {

	/**
	 * id_record
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $id_record = null;



	/**
	 * id_kind
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $id_kind = null;



	/**
	 * get id_record of record_has_kind
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_record() {

		return $this->id_record;
	}

	/**
	 * set id_record of record_has_kind
	 *
	 * @access public
	 * @param  int $id_record id_record of record_has_kind
	 * @return \Venus\src\FrontOffice\Entity\record_has_kind
	 */

	public function set_id_record($id_record) {

		$this->id_record = $id_record;
		return $this;
	}

	/**
	 * get id_kind of record_has_kind
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_kind() {

		return $this->id_kind;
	}

	/**
	 * set id_kind of record_has_kind
	 *
	 * @access public
	 * @param  int $id_kind id_kind of record_has_kind
	 * @return \Venus\src\FrontOffice\Entity\record_has_kind
	 */

	public function set_id_kind($id_kind) {

		$this->id_kind = $id_kind;
		return $this;
	}
}
<?php

/**
 * Entity to record_has_company
 *
 * @category  	src
 * @package   	src\BackOffice\Entity
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\BackOffice\Entity;

use \Venus\core\Entity as Entity;
use \Venus\lib\Orm as Orm;

/**
 * Entity to record_has_company
 *
 * @category  	src
 * @package   	src\BackOffice\Entity
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class record_has_company extends Entity {

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
	 * id_company
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $id_company = null;



	/**
	 * role
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $role = null;



	/**
	 * get id_record of record_has_company
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_record() {

		return $this->id_record;
	}

	/**
	 * set id_record of record_has_company
	 *
	 * @access public
	 * @param  int $id_record id_record of record_has_company
	 * @return \Venus\src\BackOffice\Entity\record_has_company
	 */

	public function set_id_record($id_record) {

		$this->id_record = $id_record;
		return $this;
	}

	/**
	 * get id_company of record_has_company
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_company() {

		return $this->id_company;
	}

	/**
	 * set id_company of record_has_company
	 *
	 * @access public
	 * @param  int $id_company id_company of record_has_company
	 * @return \Venus\src\BackOffice\Entity\record_has_company
	 */

	public function set_id_company($id_company) {

		$this->id_company = $id_company;
		return $this;
	}

	/**
	 * get role of record_has_company
	 *
	 * @access public
	 * @return int
	 */

	public function get_role() {

		return $this->role;
	}

	/**
	 * set role of record_has_company
	 *
	 * @access public
	 * @param  int $role role of record_has_company
	 * @return \Venus\src\BackOffice\Entity\record_has_company
	 */

	public function set_role($role) {

		$this->role = $role;
		return $this;
	}
}
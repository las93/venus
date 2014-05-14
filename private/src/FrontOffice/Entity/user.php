<?php

/**
 * Entity to user
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

namespace Venus\src\FrontOffice\Entity;

use \Venus\core\Entity as Entity;
use \Venus\lib\Orm as Orm;

/**
 * Entity to user
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

class user extends Entity {

	/**
	 * id
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $id = null;



	/**
	 * login
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $login = null;



	/**
	 * password
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $password = null;



	/**
	 * name
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $name = null;



	/**
	 * type
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $type = null;



	/**
	 * cgu
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $cgu = null;



	/**
	 * validation
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $validation = null;



	/**
	 * email
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $email = null;



	/**
	 * firstname
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $firstname = null;



	/**
	 * get id of user
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of user
	 *
	 * @access public
	 * @param  int $id id of user
	 * @return \Venus\src\FrontOffice\Entity\user
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get login of user
	 *
	 * @access public
	 * @return string
	 */

	public function get_login() {

		return $this->login;
	}

	/**
	 * set login of user
	 *
	 * @access public
	 * @param  string $login login of user
	 * @return \Venus\src\FrontOffice\Entity\user
	 */

	public function set_login($login) {

		$this->login = $login;
		return $this;
	}

	/**
	 * get password of user
	 *
	 * @access public
	 * @return string
	 */

	public function get_password() {

		return $this->password;
	}

	/**
	 * set password of user
	 *
	 * @access public
	 * @param  string $password password of user
	 * @return \Venus\src\FrontOffice\Entity\user
	 */

	public function set_password($password) {

		$this->password = $password;
		return $this;
	}

	/**
	 * get name of user
	 *
	 * @access public
	 * @return string
	 */

	public function get_name() {

		return $this->name;
	}

	/**
	 * set name of user
	 *
	 * @access public
	 * @param  string $name name of user
	 * @return \Venus\src\FrontOffice\Entity\user
	 */

	public function set_name($name) {

		$this->name = $name;
		return $this;
	}

	/**
	 * get type of user
	 *
	 * @access public
	 * @return string
	 */

	public function get_type() {

		return $this->type;
	}

	/**
	 * set type of user
	 *
	 * @access public
	 * @param  string $type type of user
	 * @return \Venus\src\FrontOffice\Entity\user
	 */

	public function set_type($type) {

		$this->type = $type;
		return $this;
	}

	/**
	 * get cgu of user
	 *
	 * @access public
	 * @return string
	 */

	public function get_cgu() {

		return $this->cgu;
	}

	/**
	 * set cgu of user
	 *
	 * @access public
	 * @param  string $cgu cgu of user
	 * @return \Venus\src\FrontOffice\Entity\user
	 */

	public function set_cgu($cgu) {

		$this->cgu = $cgu;
		return $this;
	}

	/**
	 * get validation of user
	 *
	 * @access public
	 * @return string
	 */

	public function get_validation() {

		return $this->validation;
	}

	/**
	 * set validation of user
	 *
	 * @access public
	 * @param  string $validation validation of user
	 * @return \Venus\src\FrontOffice\Entity\user
	 */

	public function set_validation($validation) {

		$this->validation = $validation;
		return $this;
	}

	/**
	 * get email of user
	 *
	 * @access public
	 * @return string
	 */

	public function get_email() {

		return $this->email;
	}

	/**
	 * set email of user
	 *
	 * @access public
	 * @param  string $email email of user
	 * @return \Venus\src\FrontOffice\Entity\user
	 */

	public function set_email($email) {

		$this->email = $email;
		return $this;
	}

	/**
	 * get firstname of user
	 *
	 * @access public
	 * @return string
	 */

	public function get_firstname() {

		return $this->firstname;
	}

	/**
	 * set firstname of user
	 *
	 * @access public
	 * @param  string $firstname firstname of user
	 * @return \Venus\src\FrontOffice\Entity\user
	 */

	public function set_firstname($firstname) {

		$this->firstname = $firstname;
		return $this;
	}
}
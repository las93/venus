<?php

/**
 * Entity to person
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
 * Entity to person
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

class person extends Entity {

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
	 * id_nationality
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_nationality = null;



	/**
	 * name
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $name = null;



	/**
	 * firstname
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $firstname = null;



	/**
	 * biography
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $biography = null;



	/**
	 * birthday
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $birthday = null;



	/**
	 * visible
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $visible = null;



	/**
	 * created
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $created = null;



	/**
	 * sex
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $sex = null;



	/**
	 * get id of person
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of person
	 *
	 * @access public
	 * @param  int $id id of person
	 * @return \Venus\src\FrontOffice\Entity\person
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get id_nationality of person
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_nationality() {

		return $this->id_nationality;
	}

	/**
	 * set id_nationality of person
	 *
	 * @access public
	 * @param  int $id_nationality id_nationality of person
	 * @return \Venus\src\FrontOffice\Entity\person
	 */

	public function set_id_nationality($id_nationality) {

		$this->id_nationality = $id_nationality;
		return $this;
	}

	/**
	 * get name of person
	 *
	 * @access public
	 * @return string
	 */

	public function get_name() {

		return $this->name;
	}

	/**
	 * set name of person
	 *
	 * @access public
	 * @param  string $name name of person
	 * @return \Venus\src\FrontOffice\Entity\person
	 */

	public function set_name($name) {

		$this->name = $name;
		return $this;
	}

	/**
	 * get firstname of person
	 *
	 * @access public
	 * @return string
	 */

	public function get_firstname() {

		return $this->firstname;
	}

	/**
	 * set firstname of person
	 *
	 * @access public
	 * @param  string $firstname firstname of person
	 * @return \Venus\src\FrontOffice\Entity\person
	 */

	public function set_firstname($firstname) {

		$this->firstname = $firstname;
		return $this;
	}

	/**
	 * get biography of person
	 *
	 * @access public
	 * @return string
	 */

	public function get_biography() {

		return $this->biography;
	}

	/**
	 * set biography of person
	 *
	 * @access public
	 * @param  string $biography biography of person
	 * @return \Venus\src\FrontOffice\Entity\person
	 */

	public function set_biography($biography) {

		$this->biography = $biography;
		return $this;
	}

	/**
	 * get birthday of person
	 *
	 * @access public
	 * @return string
	 */

	public function get_birthday() {

		return $this->birthday;
	}

	/**
	 * set birthday of person
	 *
	 * @access public
	 * @param  string $birthday birthday of person
	 * @return \Venus\src\FrontOffice\Entity\person
	 */

	public function set_birthday($birthday) {

		$this->birthday = $birthday;
		return $this;
	}

	/**
	 * get visible of person
	 *
	 * @access public
	 * @return string
	 */

	public function get_visible() {

		return $this->visible;
	}

	/**
	 * set visible of person
	 *
	 * @access public
	 * @param  string $visible visible of person
	 * @return \Venus\src\FrontOffice\Entity\person
	 */

	public function set_visible($visible) {

		$this->visible = $visible;
		return $this;
	}

	/**
	 * get created of person
	 *
	 * @access public
	 * @return string
	 */

	public function get_created() {

		return $this->created;
	}

	/**
	 * set created of person
	 *
	 * @access public
	 * @param  string $created created of person
	 * @return \Venus\src\FrontOffice\Entity\person
	 */

	public function set_created($created) {

		$this->created = $created;
		return $this;
	}

	/**
	 * get sex of person
	 *
	 * @access public
	 * @return string
	 */

	public function get_sex() {

		return $this->sex;
	}

	/**
	 * set sex of person
	 *
	 * @access public
	 * @param  string $sex sex of person
	 * @return \Venus\src\FrontOffice\Entity\person
	 */

	public function set_sex($sex) {

		$this->sex = $sex;
		return $this;
	}
}
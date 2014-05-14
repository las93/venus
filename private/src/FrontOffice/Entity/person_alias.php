<?php

/**
 * Entity to person_alias
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
 * Entity to person_alias
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

class person_alias extends Entity {

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
	 * alias
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $alias = null;



	/**
	 * id_person
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_person = null;



	/**
	 * get id of person_alias
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of person_alias
	 *
	 * @access public
	 * @param  int $id id of person_alias
	 * @return \Venus\src\FrontOffice\Entity\person_alias
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get alias of person_alias
	 *
	 * @access public
	 * @return string
	 */

	public function get_alias() {

		return $this->alias;
	}

	/**
	 * set alias of person_alias
	 *
	 * @access public
	 * @param  string $alias alias of person_alias
	 * @return \Venus\src\FrontOffice\Entity\person_alias
	 */

	public function set_alias($alias) {

		$this->alias = $alias;
		return $this;
	}

	/**
	 * get id_person of person_alias
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_person() {

		return $this->id_person;
	}

	/**
	 * set id_person of person_alias
	 *
	 * @access public
	 * @param  int $id_person id_person of person_alias
	 * @return \Venus\src\FrontOffice\Entity\person_alias
	 */

	public function set_id_person($id_person) {

		$this->id_person = $id_person;
		return $this;
	}
}
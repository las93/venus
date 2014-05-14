<?php

/**
 * Entity to distributor
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
 * Entity to distributor
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

class distributor extends Entity {

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
	 * name
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $name = null;



	/**
	 * id_nationality
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_nationality = null;



	/**
	 * get id of distributor
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of distributor
	 *
	 * @access public
	 * @param  int $id id of distributor
	 * @return \Venus\src\FrontOffice\Entity\distributor
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get name of distributor
	 *
	 * @access public
	 * @return string
	 */

	public function get_name() {

		return $this->name;
	}

	/**
	 * set name of distributor
	 *
	 * @access public
	 * @param  string $name name of distributor
	 * @return \Venus\src\FrontOffice\Entity\distributor
	 */

	public function set_name($name) {

		$this->name = $name;
		return $this;
	}

	/**
	 * get id_nationality of distributor
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_nationality() {

		return $this->id_nationality;
	}

	/**
	 * set id_nationality of distributor
	 *
	 * @access public
	 * @param  int $id_nationality id_nationality of distributor
	 * @return \Venus\src\FrontOffice\Entity\distributor
	 */

	public function set_id_nationality($id_nationality) {

		$this->id_nationality = $id_nationality;
		return $this;
	}
}
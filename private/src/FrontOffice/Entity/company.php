<?php

/**
 * Entity to company
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
 * Entity to company
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

class company extends Entity {

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
	 * get id of company
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of company
	 *
	 * @access public
	 * @param  int $id id of company
	 * @return \Venus\src\FrontOffice\Entity\company
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get name of company
	 *
	 * @access public
	 * @return string
	 */

	public function get_name() {

		return $this->name;
	}

	/**
	 * set name of company
	 *
	 * @access public
	 * @param  string $name name of company
	 * @return \Venus\src\FrontOffice\Entity\company
	 */

	public function set_name($name) {

		$this->name = $name;
		return $this;
	}

	/**
	 * get id_nationality of company
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_nationality() {

		return $this->id_nationality;
	}

	/**
	 * set id_nationality of company
	 *
	 * @access public
	 * @param  int $id_nationality id_nationality of company
	 * @return \Venus\src\FrontOffice\Entity\company
	 */

	public function set_id_nationality($id_nationality) {

		$this->id_nationality = $id_nationality;
		return $this;
	}
}
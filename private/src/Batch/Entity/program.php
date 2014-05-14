<?php

/**
 * Entity to program
 *
 * @category  	src
 * @package   	src\Batch\Entity
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\Batch\Entity;

use \Venus\core\Entity as Entity;
use \Venus\lib\Orm as Orm;

/**
 * Entity to program
 *
 * @category  	src
 * @package   	src\Batch\Entity
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class program extends Entity {

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
	 * @var    int
	 *
	 */

	private $name = null;



	/**
	 * get id of program
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of program
	 *
	 * @access public
	 * @param  int $id id of program
	 * @return \Venus\src\Batch\Entity\program
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get name of program
	 *
	 * @access public
	 * @return int
	 */

	public function get_name() {

		return $this->name;
	}

	/**
	 * set name of program
	 *
	 * @access public
	 * @param  int $name name of program
	 * @return \Venus\src\Batch\Entity\program
	 */

	public function set_name($name) {

		$this->name = $name;
		return $this;
	}
}
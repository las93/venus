<?php

/**
 * Entity to channel
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
 * Entity to channel
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

class channel extends Entity {

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
	 * id_xml
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $id_xml = null;



	/**
	 * get id of channel
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of channel
	 *
	 * @access public
	 * @param  int $id id of channel
	 * @return \Venus\src\BackOffice\Entity\channel
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get name of channel
	 *
	 * @access public
	 * @return string
	 */

	public function get_name() {

		return $this->name;
	}

	/**
	 * set name of channel
	 *
	 * @access public
	 * @param  string $name name of channel
	 * @return \Venus\src\BackOffice\Entity\channel
	 */

	public function set_name($name) {

		$this->name = $name;
		return $this;
	}

	/**
	 * get id_xml of channel
	 *
	 * @access public
	 * @return string
	 */

	public function get_id_xml() {

		return $this->id_xml;
	}

	/**
	 * set id_xml of channel
	 *
	 * @access public
	 * @param  string $id_xml id_xml of channel
	 * @return \Venus\src\BackOffice\Entity\channel
	 */

	public function set_id_xml($id_xml) {

		$this->id_xml = $id_xml;
		return $this;
	}
}
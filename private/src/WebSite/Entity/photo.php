<?php

/**
 * Entity to photo
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
 * Entity to photo
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

class photo extends Entity {

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
	 * title
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $title = null;



	/**
	 * type
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $type = null;



	/**
	 * id_record
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_record = null;



	/**
	 * get id of photo
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of photo
	 *
	 * @access public
	 * @param  int $id id of photo
	 * @return \Venus\src\FrontOffice\Entity\photo
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get title of photo
	 *
	 * @access public
	 * @return string
	 */

	public function get_title() {

		return $this->title;
	}

	/**
	 * set title of photo
	 *
	 * @access public
	 * @param  string $title title of photo
	 * @return \Venus\src\FrontOffice\Entity\photo
	 */

	public function set_title($title) {

		$this->title = $title;
		return $this;
	}

	/**
	 * get type of photo
	 *
	 * @access public
	 * @return string
	 */

	public function get_type() {

		return $this->type;
	}

	/**
	 * set type of photo
	 *
	 * @access public
	 * @param  string $type type of photo
	 * @return \Venus\src\FrontOffice\Entity\photo
	 */

	public function set_type($type) {

		$this->type = $type;
		return $this;
	}

	/**
	 * get id_record of photo
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_record() {

		return $this->id_record;
	}

	/**
	 * set id_record of photo
	 *
	 * @access public
	 * @param  int $id_record id_record of photo
	 * @return \Venus\src\FrontOffice\Entity\photo
	 */

	public function set_id_record($id_record) {

		$this->id_record = $id_record;
		return $this;
	}
}
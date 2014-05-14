<?php

/**
 * Entity to trailer
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
 * Entity to trailer
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

class trailer extends Entity {

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
	 * id_record
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_record = null;



	/**
	 * created
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $created = null;



	/**
	 * link
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $link = null;

	/**
	 * type
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $type = null;



	/**
	 * get id of trailer
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of trailer
	 *
	 * @access public
	 * @param  int $id id of trailer
	 * @return \Venus\src\FrontOffice\Entity\trailer
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get title of trailer
	 *
	 * @access public
	 * @return string
	 */

	public function get_title() {

		return $this->title;
	}

	/**
	 * set title of trailer
	 *
	 * @access public
	 * @param  string $title title of trailer
	 * @return \Venus\src\FrontOffice\Entity\trailer
	 */

	public function set_title($title) {

		$this->title = $title;
		return $this;
	}

	/**
	 * get id_record of trailer
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_record() {

		return $this->id_record;
	}

	/**
	 * set id_record of trailer
	 *
	 * @access public
	 * @param  int $id_record id_record of trailer
	 * @return \Venus\src\FrontOffice\Entity\trailer
	 */

	public function set_id_record($id_record) {

		$this->id_record = $id_record;
		return $this;
	}

	/**
	 * get created of trailer
	 *
	 * @access public
	 * @return string
	 */

	public function get_created() {

		return $this->created;
	}

	/**
	 * set created of trailer
	 *
	 * @access public
	 * @param  string $created created of trailer
	 * @return \Venus\src\FrontOffice\Entity\trailer
	 */

	public function set_created($created) {

		$this->created = $created;
		return $this;
	}

	/**
	 * get link of trailer
	 *
	 * @access public
	 * @return string
	 */

	public function get_link() {

		return $this->link;
	}

	/**
	 * set link of trailer
	 *
	 * @access public
	 * @param  string $link link of trailer
	 * @return \Venus\src\FrontOffice\Entity\trailer
	 */

	public function set_link($link) {

		$this->link = $link;
		return $this;
	}

	/**
	 * get type of trailer
	 *
	 * @access public
	 * @return string
	 */

	public function get_type() {

		return $this->type;
	}

	/**
	 * set type of trailer
	 *
	 * @access public
	 * @param  string $type type of trailer
	 * @return \Venus\src\FrontOffice\Entity\trailer
	 */

	public function set_type($type) {

		$this->type = $type;
		return $this;
	}
}
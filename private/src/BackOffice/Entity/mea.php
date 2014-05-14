<?php

/**
 * Entity to mea
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
 * Entity to mea
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

class mea extends Entity {

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
	 * link
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $link = null;



	/**
	 * title
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $title = null;



	/**
	 * button
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $button = null;



	/**
	 * id_mea_page
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $id_mea_page = null;



	/**
	 * get id of mea
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of mea
	 *
	 * @access public
	 * @param  int $id id of mea
	 * @return \Venus\src\BackOffice\Entity\mea
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get link of mea
	 *
	 * @access public
	 * @return string
	 */

	public function get_link() {

		return $this->link;
	}

	/**
	 * set link of mea
	 *
	 * @access public
	 * @param  string $link link of mea
	 * @return \Venus\src\BackOffice\Entity\mea
	 */

	public function set_link($link) {

		$this->link = $link;
		return $this;
	}

	/**
	 * get title of mea
	 *
	 * @access public
	 * @return string
	 */

	public function get_title() {

		return $this->title;
	}

	/**
	 * set title of mea
	 *
	 * @access public
	 * @param  string $title title of mea
	 * @return \Venus\src\BackOffice\Entity\mea
	 */

	public function set_title($title) {

		$this->title = $title;
		return $this;
	}

	/**
	 * get button of mea
	 *
	 * @access public
	 * @return string
	 */

	public function get_button() {

		return $this->button;
	}

	/**
	 * set button of mea
	 *
	 * @access public
	 * @param  string $button button of mea
	 * @return \Venus\src\BackOffice\Entity\mea
	 */

	public function set_button($button) {

		$this->button = $button;
		return $this;
	}

	/**
	 * get id_mea_page of mea
	 *
	 * @access public
	 * @return string
	 */

	public function get_id_mea_page() {

		return $this->id_mea_page;
	}

	/**
	 * set id_mea_page of mea
	 *
	 * @access public
	 * @param  string $id_mea_page id_mea_page of mea
	 * @return \Venus\src\BackOffice\Entity\mea
	 */

	public function set_id_mea_page($id_mea_page) {

		$this->id_mea_page = $id_mea_page;
		return $this;
	}
}
<?php

/**
 * Entity to story
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
 * Entity to story
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

class story extends Entity {

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
	 * content
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $content = null;

	/**
	 * get id of record
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of record
	 *
	 * @access public
	 * @param  int $id id of record
	 * @return \Venus\src\FrontOffice\Entity\record
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get title of record
	 *
	 * @access public
	 * @return string
	 */

	public function get_title() {

		return $this->title;
	}

	/**
	 * set title of record
	 *
	 * @access public
	 * @param  string $title title of record
	 * @return \Venus\src\FrontOffice\Entity\record
	 */

	public function set_title($title) {

		$this->title = $title;
		return $this;
	}

	/**
	 * get id_record of record
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_record() {

		return $this->id_record;
	}

	/**
	 * set id_record of record
	 *
	 * @access public
	 * @param  int $id_nationality id_record of record
	 * @return \Venus\src\FrontOffice\Entity\record
	 */

	public function set_id_record($id_record) {

		$this->id_record = $id_record;
		return $this;
	}

	/**
	 * get content of record
	 *
	 * @access public
	 * @return string
	 */

	public function get_content() {

		return $this->content;
	}

	/**
	 * set synopsis of record
	 *
	 * @access public
	 * @param  string $content synopsis of record
	 * @return \Venus\src\FrontOffice\Entity\record
	 */

	public function set_content($content) {

		$this->content = $content;
		return $this;
	}
}

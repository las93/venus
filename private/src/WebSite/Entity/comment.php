<?php

/**
 * Entity to comment
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
 * Entity to comment
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

class comment extends Entity {

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
	 * id_user
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_user = null;



	/**
	 * content
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $content = null;



	/**
	 * created
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $created = null;



	/**
	 * type
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $type = null;



	/**
	 * id_type
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_type = null;



	/**
	 * get id of comment
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of comment
	 *
	 * @access public
	 * @param  int $id id of comment
	 * @return \Venus\src\FrontOffice\Entity\comment
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get id_user of comment
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_user() {

		return $this->id_user;
	}

	/**
	 * set id_user of comment
	 *
	 * @access public
	 * @param  int $id_user id_user of comment
	 * @return \Venus\src\FrontOffice\Entity\comment
	 */

	public function set_id_user($id_user) {

		$this->id_user = $id_user;
		return $this;
	}

	/**
	 * get content of comment
	 *
	 * @access public
	 * @return string
	 */

	public function get_content() {

		return $this->content;
	}

	/**
	 * set content of comment
	 *
	 * @access public
	 * @param  string $content content of comment
	 * @return \Venus\src\FrontOffice\Entity\comment
	 */

	public function set_content($content) {

		$this->content = $content;
		return $this;
	}

	/**
	 * get created of comment
	 *
	 * @access public
	 * @return string
	 */

	public function get_created() {

		return $this->created;
	}

	/**
	 * set created of comment
	 *
	 * @access public
	 * @param  string $created created of comment
	 * @return \Venus\src\FrontOffice\Entity\comment
	 */

	public function set_created($created) {

		$this->created = $created;
		return $this;
	}

	/**
	 * get type of comment
	 *
	 * @access public
	 * @return string
	 */

	public function get_type() {

		return $this->type;
	}

	/**
	 * set type of comment
	 *
	 * @access public
	 * @param  string $type type of comment
	 * @return \Venus\src\FrontOffice\Entity\comment
	 */

	public function set_type($type) {

		$this->type = $type;
		return $this;
	}

	/**
	 * get id_type of comment
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_type() {

		return $this->id_type;
	}

	/**
	 * set id_type of comment
	 *
	 * @access public
	 * @param  int $id_type id_type of comment
	 * @return \Venus\src\FrontOffice\Entity\comment
	 */

	public function set_id_type($id_type) {

		$this->id_type = $id_type;
		return $this;
	}
}
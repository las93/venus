<?php

/**
 * Entity to article_type
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
 * Entity to article_type
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

class article_type extends Entity {

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
	 * id_article_type
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $id_article_type = null;



	/**
	 * get id of article_type
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of article_type
	 *
	 * @access public
	 * @param  int $id id of article_type
	 * @return \Venus\src\FrontOffice\Entity\article_type
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get name of article_type
	 *
	 * @access public
	 * @return string
	 */

	public function get_name() {

		return $this->name;
	}

	/**
	 * set name of article_type
	 *
	 * @access public
	 * @param  string $name name of article_type
	 * @return \Venus\src\FrontOffice\Entity\article_type
	 */

	public function set_name($name) {

		$this->name = $name;
		return $this;
	}

	/**
	 * get id_article_type of article_type
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_article_type() {

		return $this->id_article_type;
	}

	/**
	 * set id_article_type of article_type
	 *
	 * @access public
	 * @param  int $id_article_type id_article_type of article_type
	 * @return \Venus\src\FrontOffice\Entity\article_type
	 */

	public function set_id_article_type($id_article_type) {

		$this->id_article_type = $id_article_type;
		return $this;
	}
}
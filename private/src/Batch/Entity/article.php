<?php

/**
 * Entity to article
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
 * Entity to article
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

class article extends Entity {

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
	 * id_article_type
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_article_type = null;



	/**
	 * created
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $created = null;



	/**
	 * content
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $content = null;



	/**
	 * id_user
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_user = null;



	/**
	 * visible
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $visible = null;



	/**
	 * theme
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $theme = null;



	/**
	 * get id of article
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of article
	 *
	 * @access public
	 * @param  int $id id of article
	 * @return \Venus\src\Batch\Entity\article
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get title of article
	 *
	 * @access public
	 * @return string
	 */

	public function get_title() {

		return $this->title;
	}

	/**
	 * set title of article
	 *
	 * @access public
	 * @param  string $title title of article
	 * @return \Venus\src\Batch\Entity\article
	 */

	public function set_title($title) {

		$this->title = $title;
		return $this;
	}

	/**
	 * get id_article_type of article
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_article_type() {

		return $this->id_article_type;
	}

	/**
	 * set id_article_type of article
	 *
	 * @access public
	 * @param  int $id_article_type id_article_type of article
	 * @return \Venus\src\Batch\Entity\article
	 */

	public function set_id_article_type($id_article_type) {

		$this->id_article_type = $id_article_type;
		return $this;
	}

	/**
	 * get created of article
	 *
	 * @access public
	 * @return string
	 */

	public function get_created() {

		return $this->created;
	}

	/**
	 * set created of article
	 *
	 * @access public
	 * @param  string $created created of article
	 * @return \Venus\src\Batch\Entity\article
	 */

	public function set_created($created) {

		$this->created = $created;
		return $this;
	}

	/**
	 * get content of article
	 *
	 * @access public
	 * @return string
	 */

	public function get_content() {

		return $this->content;
	}

	/**
	 * set content of article
	 *
	 * @access public
	 * @param  string $content content of article
	 * @return \Venus\src\Batch\Entity\article
	 */

	public function set_content($content) {

		$this->content = $content;
		return $this;
	}

	/**
	 * get id_user of article
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_user() {

		return $this->id_user;
	}

	/**
	 * set id_user of article
	 *
	 * @access public
	 * @param  int $id_user id_user of article
	 * @return \Venus\src\Batch\Entity\article
	 */

	public function set_id_user($id_user) {

		$this->id_user = $id_user;
		return $this;
	}

	/**
	 * get visible of article
	 *
	 * @access public
	 * @return string
	 */

	public function get_visible() {

		return $this->visible;
	}

	/**
	 * set visible of article
	 *
	 * @access public
	 * @param  string $visible visible of article
	 * @return \Venus\src\Batch\Entity\article
	 */

	public function set_visible($visible) {

		$this->visible = $visible;
		return $this;
	}

	/**
	 * get theme of article
	 *
	 * @access public
	 * @return string
	 */

	public function get_theme() {

		return $this->theme;
	}

	/**
	 * set theme of article
	 *
	 * @access public
	 * @param  string $theme theme of article
	 * @return \Venus\src\Batch\Entity\article
	 */

	public function set_theme($theme) {

		$this->theme = $theme;
		return $this;
	}
}
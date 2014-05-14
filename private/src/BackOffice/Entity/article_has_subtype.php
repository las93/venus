<?php

/**
 * Entity to article_has_subtype
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
 * Entity to article_has_subtype
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

class article_has_subtype extends Entity {

	/**
	 * id_article
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $id_article = null;



	/**
	 * id_subtype
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $id_subtype = null;



	/**
	 * get id_article of article_has_subtype
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_article() {

		return $this->id_article;
	}

	/**
	 * set id_article of article_has_subtype
	 *
	 * @access public
	 * @param  int $id_article id_article of article_has_subtype
	 * @return \Venus\src\BackOffice\Entity\article_has_subtype
	 */

	public function set_id_article($id_article) {

		$this->id_article = $id_article;
		return $this;
	}

	/**
	 * get id_subtype of article_has_subtype
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_subtype() {

		return $this->id_subtype;
	}

	/**
	 * set id_subtype of article_has_subtype
	 *
	 * @access public
	 * @param  int $id_subtype id_subtype of article_has_subtype
	 * @return \Venus\src\BackOffice\Entity\article_has_subtype
	 */

	public function set_id_subtype($id_subtype) {

		$this->id_subtype = $id_subtype;
		return $this;
	}
}
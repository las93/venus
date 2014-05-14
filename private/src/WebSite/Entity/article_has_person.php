<?php

/**
 * Entity to article_has_person
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
 * Entity to article_has_person
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

class article_has_person extends Entity {

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
	 * id_person
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $id_person = null;



	/**
	 * get id_article of article_has_person
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_article() {

		return $this->id_article;
	}

	/**
	 * set id_article of article_has_person
	 *
	 * @access public
	 * @param  int $id_article id_article of article_has_person
	 * @return \Venus\src\FrontOffice\Entity\article_has_person
	 */

	public function set_id_article($id_article) {

		$this->id_article = $id_article;
		return $this;
	}

	/**
	 * get id_person of article_has_person
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_person() {

		return $this->id_person;
	}

	/**
	 * set id_person of article_has_person
	 *
	 * @access public
	 * @param  int $id_person id_person of article_has_person
	 * @return \Venus\src\FrontOffice\Entity\article_has_person
	 */

	public function set_id_person($id_person) {

		$this->id_person = $id_person;
		return $this;
	}
}
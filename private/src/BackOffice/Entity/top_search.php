<?php

/**
 * Entity to top_search
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
 * Entity to top_search
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

class top_search extends Entity {

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
	 * word
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $word = null;



	/**
	 * created
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $created = null;



	/**
	 * get id of top_search
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of top_search
	 *
	 * @access public
	 * @param  int $id id of top_search
	 * @return \Venus\src\BackOffice\Entity\top_search
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get word of top_search
	 *
	 * @access public
	 * @return string
	 */

	public function get_word() {

		return $this->word;
	}

	/**
	 * set word of top_search
	 *
	 * @access public
	 * @param  string $word word of top_search
	 * @return \Venus\src\BackOffice\Entity\top_search
	 */

	public function set_word($word) {

		$this->word = $word;
		return $this;
	}

	/**
	 * get created of top_search
	 *
	 * @access public
	 * @return string
	 */

	public function get_created() {

		return $this->created;
	}

	/**
	 * set created of top_search
	 *
	 * @access public
	 * @param  string $created created of top_search
	 * @return \Venus\src\BackOffice\Entity\top_search
	 */

	public function set_created($created) {

		$this->created = $created;
		return $this;
	}
}
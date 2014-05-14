<?php

/**
 * Entity to like_company
 *
 * @category  	src
 * @package   	src\WebSite\Entity
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
 * Entity to like_company
 *
 * @category  	src
 * @package   	src\WebSite\Entity
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class like_company extends Entity {

	/**
	 * id_company
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $id_company = null;



	/**
	 * id_user
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $id_user = null;



	/**
	 * ip
	 *
	 * @access private
	 * @var    string
	 *
	 * @primary_key
	 */

	private $ip = null;



	/**
	 * get id_company of like_program
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_company() {

		return $this->id_company;
	}

	/**
	 * set id_company of like_program
	 *
	 * @access public
	 * @param  int $id_company id_company of like_program
	 * @return \Venus\src\WebSite\Entity\like_program
	 */

	public function set_id_company($id_company) {

		$this->id_company = $id_company;
		return $this;
	}

	/**
	 * get id_user of like_program
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_user() {

		return $this->id_user;
	}

	/**
	 * set id_user of like_program
	 *
	 * @access public
	 * @param  int $id_user id_user of like_program
	 * @return \Venus\src\WebSite\Entity\like_program
	 */

	public function set_id_user($id_user) {

		$this->id_user = $id_user;
		return $this;
	}

	/**
	 * get ip of like_program
	 *
	 * @access public
	 * @return string
	 */

	public function get_ip() {

		return $this->ip;
	}

	/**
	 * set ip of like_program
	 *
	 * @access public
	 * @param  string $ip ip of like_program
	 * @return \Venus\src\WebSite\Entity\like_program
	 */

	public function set_ip($ip) {

		$this->ip = $ip;
		return $this;
	}
}
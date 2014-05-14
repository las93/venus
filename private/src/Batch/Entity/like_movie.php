<?php

/**
 * Entity to like_movie
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
 * Entity to like_movie
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

class like_movie extends Entity {

	/**
	 * id_record
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $id_record = null;



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
	 * get id_record of like_movie
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_record() {

		return $this->id_record;
	}

	/**
	 * set id_record of like_movie
	 *
	 * @access public
	 * @param  int $id_record id_record of like_movie
	 * @return \Venus\src\Batch\Entity\like_movie
	 */

	public function set_id_record($id_record) {

		$this->id_record = $id_record;
		return $this;
	}

	/**
	 * get id_user of like_movie
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_user() {

		return $this->id_user;
	}

	/**
	 * set id_user of like_movie
	 *
	 * @access public
	 * @param  int $id_user id_user of like_movie
	 * @return \Venus\src\Batch\Entity\like_movie
	 */

	public function set_id_user($id_user) {

		$this->id_user = $id_user;
		return $this;
	}

	/**
	 * get ip of like_movie
	 *
	 * @access public
	 * @return string
	 */

	public function get_ip() {

		return $this->ip;
	}

	/**
	 * set ip of like_movie
	 *
	 * @access public
	 * @param  string $ip ip of like_movie
	 * @return \Venus\src\Batch\Entity\like_movie
	 */

	public function set_ip($ip) {

		$this->ip = $ip;
		return $this;
	}
}
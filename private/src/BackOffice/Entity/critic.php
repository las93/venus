<?php

/**
 * Entity to critic
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
 * Entity to critic
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

class critic extends Entity {

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
	 * score
	 *
	 * @access private
	 * @var    float
	 *
	 */

	private $score = null;



	/**
	 * created
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $created = null;



	/**
	 * get id of critic
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of critic
	 *
	 * @access public
	 * @param  int $id id of critic
	 * @return \Venus\src\BackOffice\Entity\critic
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get id_user of critic
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_user() {

		return $this->id_user;
	}

	/**
	 * set id_user of critic
	 *
	 * @access public
	 * @param  int $id_user id_user of critic
	 * @return \Venus\src\BackOffice\Entity\critic
	 */

	public function set_id_user($id_user) {

		$this->id_user = $id_user;
		return $this;
	}

	/**
	 * get id_record of critic
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_record() {

		return $this->id_record;
	}

	/**
	 * set id_record of critic
	 *
	 * @access public
	 * @param  int $id_record id_record of critic
	 * @return \Venus\src\BackOffice\Entity\critic
	 */

	public function set_id_record($id_record) {

		$this->id_record = $id_record;
		return $this;
	}

	/**
	 * get content of critic
	 *
	 * @access public
	 * @return string
	 */

	public function get_content() {

		return $this->content;
	}

	/**
	 * set content of critic
	 *
	 * @access public
	 * @param  string $content content of critic
	 * @return \Venus\src\BackOffice\Entity\critic
	 */

	public function set_content($content) {

		$this->content = $content;
		return $this;
	}

	/**
	 * get score of critic
	 *
	 * @access public
	 * @return float
	 */

	public function get_score() {

		return $this->score;
	}

	/**
	 * set score of critic
	 *
	 * @access public
	 * @param  float $score score of critic
	 * @return \Venus\src\BackOffice\Entity\critic
	 */

	public function set_score($score) {

		$this->score = $score;
		return $this;
	}

	/**
	 * get created of critic
	 *
	 * @access public
	 * @return string
	 */

	public function get_created() {

		return $this->created;
	}

	/**
	 * set created of critic
	 *
	 * @access public
	 * @param  string $created created of critic
	 * @return \Venus\src\BackOffice\Entity\critic
	 */

	public function set_created($created) {

		$this->created = $created;
		return $this;
	}
}
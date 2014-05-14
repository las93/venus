<?php

/**
 * Entity to record_alias
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
 * Entity to record_alias
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

class record_alias extends Entity {

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
	 * alias
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $alias = null;



	/**
	 * id_record
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_record = null;



	/**
	 * get id of record_alias
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of record_alias
	 *
	 * @access public
	 * @param  int $id id of record_alias
	 * @return \Venus\src\FrontOffice\Entity\record_alias
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get alias of record_alias
	 *
	 * @access public
	 * @return string
	 */

	public function get_alias() {

		return $this->alias;
	}

	/**
	 * set alias of record_alias
	 *
	 * @access public
	 * @param  string $alias alias of record_alias
	 * @return \Venus\src\FrontOffice\Entity\record_alias
	 */

	public function set_alias($alias) {

		$this->alias = $alias;
		return $this;
	}

	/**
	 * get id_record of record_alias
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_record() {

		return $this->id_record;
	}

	/**
	 * set id_record of record_alias
	 *
	 * @access public
	 * @param  int $id_record id_record of record_alias
	 * @return \Venus\src\FrontOffice\Entity\record_alias
	 */

	public function set_id_record($id_record) {

		$this->id_record = $id_record;
		return $this;
	}
}
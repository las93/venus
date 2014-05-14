<?php

/**
 * Entity to record_has_creator
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

namespace Venus\src\FrontOffice\Entity;

use \Venus\core\Entity as Entity;
use \Venus\lib\Orm as Orm;

/**
 * Entity to record_has_creator
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

class record_has_creator extends Entity {

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
	 * id_person
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $id_person = null;



	/**
	 * role
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $role = null;



	/**
	 * season
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $season = null;



	/**
	 * get id_record of record_has_creator
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_record() {

		return $this->id_record;
	}

	/**
	 * set id_record of record_has_creator
	 *
	 * @access public
	 * @param  int $id_record id_record of record_has_creator
	 * @return \Venus\src\FrontOffice\Entity\record_has_creator
	 */

	public function set_id_record($id_record) {

		$this->id_record = $id_record;
		return $this;
	}

	/**
	 * get id_person of record_has_creator
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_person() {

		return $this->id_person;
	}

	/**
	 * set id_person of record_has_creator
	 *
	 * @access public
	 * @param  int $id_person id_person of record_has_creator
	 * @return \Venus\src\FrontOffice\Entity\record_has_creator
	 */

	public function set_id_person($id_person) {

		$this->id_person = $id_person;
		return $this;
	}

	/**
	 * get role of record_has_creator
	 *
	 * @access public
	 * @return int
	 */

	public function get_role() {

		return $this->role;
	}

	/**
	 * set role of record_has_creator
	 *
	 * @access public
	 * @param  int $role role of record_has_creator
	 * @return \Venus\src\FrontOffice\Entity\record_has_creator
	 */

	public function set_role($role) {

		$this->role = $role;
		return $this;
	}

	/**
	 * get season of record_has_creator
	 *
	 * @access public
	 * @return int
	 */

	public function get_season() {

		return $this->season;
	}

	/**
	 * set season of record_has_creator
	 *
	 * @access public
	 * @param  int $season season of record_has_creator
	 * @return \Venus\src\FrontOffice\Entity\record_has_creator
	 */

	public function set_season($season) {

		$this->season = $season;
		return $this;
	}
}
<?php

/**
 * Entity to record_episode
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
 * Entity to record_episode
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

class record_episode extends Entity {

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
	 * season
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $season = null;



	/**
	 * episode
	 *
	 * @access private
	 * @var    int
	 *
	 * @primary_key
	 */

	private $episode = null;



	/**
	 * title
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $title = null;



	/**
	 * description
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $description = null;



	/**
	 * get id_record of record_episode
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_record() {

		return $this->id_record;
	}

	/**
	 * set id_record of record_episode
	 *
	 * @access public
	 * @param  int $id_record id_record of record_episode
	 * @return \Venus\src\BackOffice\Entity\record_episode
	 */

	public function set_id_record($id_record) {

		$this->id_record = $id_record;
		return $this;
	}

	/**
	 * get season of record_episode
	 *
	 * @access public
	 * @return int
	 */

	public function get_season() {

		return $this->season;
	}

	/**
	 * set season of record_episode
	 *
	 * @access public
	 * @param  int $season season of record_episode
	 * @return \Venus\src\BackOffice\Entity\record_episode
	 */

	public function set_season($season) {

		$this->season = $season;
		return $this;
	}

	/**
	 * get episode of record_episode
	 *
	 * @access public
	 * @return int
	 */

	public function get_episode() {

		return $this->episode;
	}

	/**
	 * set episode of record_episode
	 *
	 * @access public
	 * @param  int $episode episode of record_episode
	 * @return \Venus\src\BackOffice\Entity\record_episode
	 */

	public function set_episode($episode) {

		$this->episode = $episode;
		return $this;
	}

	/**
	 * get title of record_episode
	 *
	 * @access public
	 * @return int
	 */

	public function get_title() {

		return $this->title;
	}

	/**
	 * set title of record_episode
	 *
	 * @access public
	 * @param  int $title title of record_episode
	 * @return \Venus\src\BackOffice\Entity\record_episode
	 */

	public function set_title($title) {

		$this->title = $title;
		return $this;
	}

	/**
	 * get description of record_episode
	 *
	 * @access public
	 * @return int
	 */

	public function get_description() {

		return $this->description;
	}

	/**
	 * set description of record_episode
	 *
	 * @access public
	 * @param  int $description description of record_episode
	 * @return \Venus\src\BackOffice\Entity\record_episode
	 */

	public function set_description($description) {

		$this->description = $description;
		return $this;
	}
}
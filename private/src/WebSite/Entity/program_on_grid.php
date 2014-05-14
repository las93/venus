<?php

/**
 * Entity to program_on_grid
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
 * Entity to program_on_grid
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

class program_on_grid extends Entity {

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
	 * id_channel
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_channel = null;



	/**
	 * id_record
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_record = null;



	/**
	 * id_program
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_program = null;



	/**
	 * start
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $start = null;



	/**
	 * end
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $end = null;



	/**
	 * season
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $season = null;



	/**
	 * episode
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $episode = null;



	/**
	 * get id of program_on_grid
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of program_on_grid
	 *
	 * @access public
	 * @param  int $id id of program_on_grid
	 * @return \Venus\src\FrontOffice\Entity\program_on_grid
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get id_channel of program_on_grid
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_channel() {

		return $this->id_channel;
	}

	/**
	 * set id_channel of program_on_grid
	 *
	 * @access public
	 * @param  int $id_channel id_channel of program_on_grid
	 * @return \Venus\src\FrontOffice\Entity\program_on_grid
	 */

	public function set_id_channel($id_channel) {

		$this->id_channel = $id_channel;
		return $this;
	}

	/**
	 * get id_record of program_on_grid
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_record() {

		return $this->id_record;
	}

	/**
	 * set id_record of program_on_grid
	 *
	 * @access public
	 * @param  int $id_record id_record of program_on_grid
	 * @return \Venus\src\FrontOffice\Entity\program_on_grid
	 */

	public function set_id_record($id_record) {

		$this->id_record = $id_record;
		return $this;
	}

	/**
	 * get id_program of program_on_grid
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_program() {

		return $this->id_program;
	}

	/**
	 * set id_program of program_on_grid
	 *
	 * @access public
	 * @param  int $id_program id_program of program_on_grid
	 * @return \Venus\src\FrontOffice\Entity\program_on_grid
	 */

	public function set_id_program($id_program) {

		$this->id_program = $id_program;
		return $this;
	}

	/**
	 * get start of program_on_grid
	 *
	 * @access public
	 * @return string
	 */

	public function get_start() {

		return $this->start;
	}

	/**
	 * set start of program_on_grid
	 *
	 * @access public
	 * @param  string $start start of program_on_grid
	 * @return \Venus\src\FrontOffice\Entity\program_on_grid
	 */

	public function set_start($start) {

		$this->start = $start;
		return $this;
	}

	/**
	 * get end of program_on_grid
	 *
	 * @access public
	 * @return string
	 */

	public function get_end() {

		return $this->end;
	}

	/**
	 * set end of program_on_grid
	 *
	 * @access public
	 * @param  string $end end of program_on_grid
	 * @return \Venus\src\FrontOffice\Entity\program_on_grid
	 */

	public function set_end($end) {

		$this->end = $end;
		return $this;
	}

	/**
	 * get season of program_on_grid
	 *
	 * @access public
	 * @return int
	 */

	public function get_season() {

		return $this->season;
	}

	/**
	 * set season of program_on_grid
	 *
	 * @access public
	 * @param  int $season season of program_on_grid
	 * @return \Venus\src\FrontOffice\Entity\program_on_grid
	 */

	public function set_season($season) {

		$this->season = $season;
		return $this;
	}

	/**
	 * get episode of program_on_grid
	 *
	 * @access public
	 * @return int
	 */

	public function get_episode() {

		return $this->episode;
	}

	/**
	 * set episode of program_on_grid
	 *
	 * @access public
	 * @param  int $episode episode of program_on_grid
	 * @return \Venus\src\FrontOffice\Entity\program_on_grid
	 */

	public function set_episode($episode) {

		$this->episode = $episode;
		return $this;
	}
}
<?php

/**
 * Entity to record
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
 * Entity to record
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

class record extends Entity {

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
	 * title
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $title = null;



	/**
	 * id_nationality
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_nationality = null;



	/**
	 * id_distributor
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $id_distributor = null;



	/**
	 * synopsis
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $synopsis = null;



	/**
	 * created
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $created = null;



	/**
	 * production_date
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $production_date = null;



	/**
	 * date_dvd
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $date_dvd = null;



	/**
	 * date_bluray
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $date_bluray = null;



	/**
	 * date_vod
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $date_vod = null;



	/**
	 * visible
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $visible = null;



	/**
	 * date_cinema
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $date_cinema = null;



	/**
	 * type
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $type = null;



	/**
	 * score
	 *
	 * @access private
	 * @var    int
	 *
	 */

	private $score = null;



	/**
	 * review
	 *
	 * @access private
	 * @var    string
	 *
	 */

	private $review = null;



	/**
	 * get id of record
	 *
	 * @access public
	 * @return int
	 */

	public function get_id() {

		return $this->id;
	}

	/**
	 * set id of record
	 *
	 * @access public
	 * @param  int $id id of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_id($id) {

		$this->id = $id;
		return $this;
	}

	/**
	 * get title of record
	 *
	 * @access public
	 * @return string
	 */

	public function get_title() {

		return $this->title;
	}

	/**
	 * set title of record
	 *
	 * @access public
	 * @param  string $title title of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_title($title) {

		$this->title = $title;
		return $this;
	}

	/**
	 * get id_nationality of record
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_nationality() {

		return $this->id_nationality;
	}

	/**
	 * set id_nationality of record
	 *
	 * @access public
	 * @param  int $id_nationality id_nationality of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_id_nationality($id_nationality) {

		$this->id_nationality = $id_nationality;
		return $this;
	}

	/**
	 * get id_distributor of record
	 *
	 * @access public
	 * @return int
	 */

	public function get_id_distributor() {

		return $this->id_distributor;
	}

	/**
	 * set id_distributor of record
	 *
	 * @access public
	 * @param  int $id_distributor id_distributor of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_id_distributor($id_distributor) {

		$this->id_distributor = $id_distributor;
		return $this;
	}

	/**
	 * get synopsis of record
	 *
	 * @access public
	 * @return string
	 */

	public function get_synopsis() {

		return $this->synopsis;
	}

	/**
	 * set synopsis of record
	 *
	 * @access public
	 * @param  string $synopsis synopsis of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_synopsis($synopsis) {

		$this->synopsis = $synopsis;
		return $this;
	}

	/**
	 * get created of record
	 *
	 * @access public
	 * @return string
	 */

	public function get_created() {

		return $this->created;
	}

	/**
	 * set created of record
	 *
	 * @access public
	 * @param  string $created created of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_created($created) {

		$this->created = $created;
		return $this;
	}

	/**
	 * get production_date of record
	 *
	 * @access public
	 * @return int
	 */

	public function get_production_date() {

		return $this->production_date;
	}

	/**
	 * set production_date of record
	 *
	 * @access public
	 * @param  int $production_date production_date of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_production_date($production_date) {

		$this->production_date = $production_date;
		return $this;
	}

	/**
	 * get date_dvd of record
	 *
	 * @access public
	 * @return string
	 */

	public function get_date_dvd() {

		return $this->date_dvd;
	}

	/**
	 * set date_dvd of record
	 *
	 * @access public
	 * @param  string $date_dvd date_dvd of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_date_dvd($date_dvd) {

		$this->date_dvd = $date_dvd;
		return $this;
	}

	/**
	 * get date_bluray of record
	 *
	 * @access public
	 * @return string
	 */

	public function get_date_bluray() {

		return $this->date_bluray;
	}

	/**
	 * set date_bluray of record
	 *
	 * @access public
	 * @param  string $date_bluray date_bluray of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_date_bluray($date_bluray) {

		$this->date_bluray = $date_bluray;
		return $this;
	}

	/**
	 * get date_vod of record
	 *
	 * @access public
	 * @return string
	 */

	public function get_date_vod() {

		return $this->date_vod;
	}

	/**
	 * set date_vod of record
	 *
	 * @access public
	 * @param  string $date_vod date_vod of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_date_vod($date_vod) {

		$this->date_vod = $date_vod;
		return $this;
	}

	/**
	 * get visible of record
	 *
	 * @access public
	 * @return string
	 */

	public function get_visible() {

		return $this->visible;
	}

	/**
	 * set visible of record
	 *
	 * @access public
	 * @param  string $visible visible of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_visible($visible) {

		$this->visible = $visible;
		return $this;
	}

	/**
	 * get date_cinema of record
	 *
	 * @access public
	 * @return string
	 */

	public function get_date_cinema() {

		return $this->date_cinema;
	}

	/**
	 * set date_cinema of record
	 *
	 * @access public
	 * @param  string $date_cinema date_cinema of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_date_cinema($date_cinema) {

		$this->date_cinema = $date_cinema;
		return $this;
	}

	/**
	 * get type of record
	 *
	 * @access public
	 * @return string
	 */

	public function get_type() {

		return $this->type;
	}

	/**
	 * set type of record
	 *
	 * @access public
	 * @param  string $type type of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_type($type) {

		$this->type = $type;
		return $this;
	}

	/**
	 * get score of record
	 *
	 * @access public
	 * @return int
	 */

	public function get_score() {

		return $this->score;
	}

	/**
	 * set score of record
	 *
	 * @access public
	 * @param  int $score score of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_score($score) {

		$this->score = $score;
		return $this;
	}

	/**
	 * get review of record
	 *
	 * @access public
	 * @return string
	 */

	public function get_review() {

		return $this->review;
	}

	/**
	 * set review of record
	 *
	 * @access public
	 * @param  string $review review of record
	 * @return \Venus\src\Batch\Entity\record
	 */

	public function set_review($review) {

		$this->review = $review;
		return $this;
	}
}
<?php

/**
 * Controller to trailer
 *
 * @category  	src
 * @package   	src\BackOffice\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\BackOffice\Controller;

use \Venus\src\BackOffice\common\Controller as Controller;
use \Venus\lib\Upload as Upload;
use \Venus\core\UrlManager as UrlManager;
use \Venus\src\BackOffice\Model\record as modelRecord;
use \Venus\src\BackOffice\Model\trailer as modelTrailer;
use \Venus\src\BackOffice\Entity\trailer as entityTrailer;

/**
 * Controller to trailer
 *
 * @category  	src
 * @package   	src\BackOffice\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class Trailer extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelRecord = function() { return new modelRecord; };
		$this->modelTrailer = function() { return new modelTrailer; };

		parent::__construct();
	}

	/**
	 * the list of record
	 *
	 * @access public
	 * @return void
	 */

	public function all() {

		$this->layout
			 ->display();
	}

	/**
	 * add a record
	 *
	 * @access public
	 * @return void
	 */

	public function add() {

		if (isset($_POST) && count($_POST)) {

			$oTrailer = new entityTrailer;

			$oTrailer->set_title($_POST['title'])
					 ->set_link($_POST['link'])
					 ->set_id_record($_POST['id_record'])
					 ->set_created(date('Y-m-d H:i:s'));

			$iIdTrailer = $this->modelTrailer->insert($oTrailer);

			$oUpload = new Upload;

			$oUpload->setMaxSize(2000000)
					->setAllowExtension(['jpeg', 'jpg'])
					->setExtension('jpg')
					->setWidth(120)
					->setHeight(97)
					->setName('trailer_'.$iIdTrailer)
					->upload('fichier');

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'TrailerAddConfirm.tpl')
				 ->display();
		}
		else {

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'TrailerAdd.tpl')
				 ->display();
		}
	}
}
<?php

/**
 * Controller to nationality
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
use \Venus\src\BackOffice\Model\nationality as modelNationality;
use \Venus\src\BackOffice\Entity\nationality as entityNationality;

/**
 * Controller to nationality
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
 * @property	\src\Front\Model\article $modelArticle
 * @property	\src\Front\Model\record $modelRecord
 */

class Nationality extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelNationality = function() { return new modelNationality; };

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

			$oNationality = new entityNationality;

			$oNationality->set_name($_POST['name']);

			$this->modelNationality->insert($oNationality);

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'NationalityAddConfirm.tpl')
				 ->display();
		}
		else {

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'NationalityAdd.tpl')
				 ->display();
		}
	}
}
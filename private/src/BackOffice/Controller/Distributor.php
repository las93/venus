<?php

/**
 * Controller to distributor
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
use \Venus\src\BackOffice\Model\company as modelCompany;
use \Venus\src\BackOffice\Model\nationality as modelNationality;
use \Venus\src\BackOffice\Entity\company as entityCompany;

/**
 * Controller to distributor
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

class Distributor extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelCompany = function() { return new modelCompany; };
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

			$oDistributor = new entityCompany;

			$oDistributor->set_name($_POST['name'])
						 ->set_id_nationality($_POST['id_nationality']);

			$iIdDistributor = $this->modelCompany->insert($oDistributor);

			$oUpload = new Upload;

			$oUpload->setMaxSize(2000000)
					->setAllowExtension(['jpeg', 'jpg'])
					->setExtension('jpg')
					->setWidth(200)
					->setHeight(200)
					->setName('distributor_'.$iIdDistributor)
					->upload('fichier');

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'DistributorAddConfirm.tpl')
				 ->display();
		}
		else {

			$aNationality = $this->modelNationality->get();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'DistributorAdd.tpl')
				 ->assign('nationality', $aNationality)
				 ->display();
		}
	}
}
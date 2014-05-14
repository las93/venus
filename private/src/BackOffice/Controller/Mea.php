<?php

/**
 * Controller to mea
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
use \Venus\src\BackOffice\Model\mea as modelMea;
use \Venus\src\BackOffice\Model\mea_page as modelMeaPage;
use \Venus\src\BackOffice\Entity\mea as entityMea;

/**
 * Controller to mea
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

class Mea extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelMea = function() { return new modelMea; };
		$this->modelMeaPage = function() { return new modelMeaPage; };

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

		if (isset($_POST) && count($_POST) && isset($_POST['id_mea_page'])) {

			foreach ($_POST['id_mea_page'] as $oOneMeaPageId) {

				$aMea = $this->modelMea->findBy(['id_mea_page' => $oOneMeaPageId]);
				$i = 0;

				foreach (array_reverse($aMea) as $oOne) {

					$i++;

					if ($i > 5) {

						$oMeaToDelete = new entityMea;

						$oMeaToDelete->set_id($oOne->get_id());

						$this->modelMea->delete($oMeaToDelete);

						unlink(
							str_replace('private'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR,
							'data'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR, __DIR__).'mea_'.$oOne->get_id().'.jpg'
						);
					}
				}

				$oMea = new entityMea;

				$oMea->set_title($_POST['title'])
					 ->set_link($_POST['link'])
					 ->set_id_mea_page($oOneMeaPageId)
					 ->set_button($_POST['button']);

				$iIdMea = $this->modelMea->insert($oMea);

				$oUpload = new Upload;

				$oUpload->setMaxSize(2000000)
						->setAllowExtension(['jpeg', 'jpg'])
						->setExtension('jpg')
						->setWidth(630)
						->setHeight(295)
						->setName('mea_'.$iIdMea)
						->upload('fichier');
			}

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'MeaAddConfirm.tpl')
				 ->display();
		}
		else {

			$pages = $this->modelMeaPage->get();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'MeaAdd.tpl')
				 ->assign('pages', $pages)
				 ->display();
		}
	}
}
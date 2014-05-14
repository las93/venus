<?php

/**
 * Controller to Photo
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
use \Venus\src\BackOffice\Model\person as modelPerson;
use \Venus\src\BackOffice\Model\photo as modelPhoto;
use \Venus\src\BackOffice\Entity\photo as entityPhoto;
use \Venus\src\BackOffice\Entity\photo_has_person as entityPhotoHasPerson;
use \Venus\src\BackOffice\Model\record as modelRecord;
use \Venus\src\BackOffice\Model\nationality as modelNationality;
use \Venus\src\BackOffice\Model\photo_has_person as modelPhotoHasPerson;

/**
 * Controller to Photo
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
 * @property	\src\Front\Model\kind $modelKind
 * @property	\src\Front\Model\nationality $modelNationality
 * @property	\src\Front\Model\person $modelPerson
 * @property	\src\Front\Model\Photo $modelPhoto
 * @property	\src\Front\Model\Photo_has_actor $Record
 * @property	\src\Front\Model\Photo_has_kind $modelPhotoHasKind
 * @property	\src\Front\Model\Photo_has_realisator $modelPhotoHasRealisator
 */

class Photo extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelPhoto = function() { return new modelPhoto; };
		$this->modelPerson = function() { return new modelPerson; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelNationality = function() { return new modelNationality; };
		$this->entityPhoto = function() { return new entityPhoto; };
		$this->modelPhotoHasPerson = function() { return new modelPhotoHasPerson; };

		parent::__construct();
	}

	/**
	 * the list of Photo
	 *
	 * @access public
	 * @return void
	 */

	public function all() {

		$aPhotos = $this->modelPhoto->findOrderByidDesc();
		$oUrlManager = new UrlManager;

		foreach ($aPhotos as $iKey => $oPhoto) {

			$aPhotos[$iKey]->url1 = $oUrlManager->getUrl('modifier_fiche', array('id' => $oPhoto->get_id()));
			$aPhotos[$iKey]->url2 = $oUrlManager->getUrl('liste_une_fiche', array('id' => $oPhoto->get_id()));
		}

		$this->layout
			 ->assign('photos', $aPhotos)
			 ->display();
	}

	/**
	 * the list of Photo
	 *
	 * @access public
	 * @param  integer $iId id of Photo
	 * @return void
	 */

	public function one($iId) {

		$oPhoto = $this->modelPhoto->findOneByid($iId);
		$aActors = $this->modelPhotoHasPerson->getPersonsByPhotoId($iId);

		$sActor = '';

		foreach ($aActors as $oActors) {

			$sActor .= ''.$oActors->person->get_name().' '.$oActors->person->get_firstname().'<br/>';
		}

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'PhotoOne.tpl')
			 ->assign('photo', $oPhoto)
			 ->assign('liste_actor', $sActor)
			 ->display();
	}

	/**
	 * add a Photo
	 *
	 * @access public
	 * @return void
	 */

	public function add() {

		if (isset($_POST) && count($_POST)) {

			$oPhoto = new entityPhoto;

			$oPhoto->set_title($_POST['title'])
					->set_type($_POST['type'])
					->set_id_record($_POST['id_record']);

			$iIdPhoto = $this->modelPhoto->insert($oPhoto);

			if (isset($_POST['actors']) && $_POST['actors'] != '') {

				$_POST['actors'] = substr($_POST['actors'], 1);

				foreach (explode(';', $_POST['actors']) as $iId) {

					$oArticleHasActor = new entityPhotoHasPerson;

					$oArticleHasActor->set_id_photo($iIdPhoto)
									 ->set_id_person($iId);

					$this->modelPhotoHasPerson->insert($oArticleHasActor);
				}
			}

			$oUpload = new Upload;

			$oUpload->setMaxSize(2000000)
					->setAllowExtension(['jpeg', 'jpg'])
					->setExtension('jpg')
					//->setWidth(600)
					//->setHeight(600)
					->setName('photo_'.$iIdPhoto)
					->upload('fichier');

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'PhotoAddConfirm.tpl')
				 ->display();
		}
		else {

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'PhotoAdd.tpl')
				 ->display();
		}
	}

	/**
	 * add record
	 *
	 * @access public
	 * @param  integer $iId id of record
	 * @return void
	 */

	public function addPerson($iId) {

		if (isset($_POST) && count($_POST)) {

			$oRecord = $this->modelPhoto->findOneByid($iId);
			$oPhotoHasPerson = new entityRecordHasCreator;

			$oPhotoHasPerson->set_id_photo($iId)
							 ->set_id_person($_POST['id_person']);

			$this->modelRecordHasCreator->insert($oPhotoHasPerson);

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'PhotoAddPersonConfirm.tpl')
				 ->assign('photo', $oPhoto)
				 ->display();
		}
		else {

			$oPhoto = $this->modelPhoto->findOneByid($iId);
			$aPerson = $this->modelPerson->getPersonOrderByName();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'PhotoAddPerson.tpl')
				 ->assign('photo', $oPhoto)
				 ->assign('person', $aPerson)
				 ->display();
		}
	}
}

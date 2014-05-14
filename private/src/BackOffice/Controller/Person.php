<?php

/**
 * Controller to person
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
use \Venus\src\BackOffice\Model\like_person as modelLikePerson;
use \Venus\src\BackOffice\Model\nationality as modelNationality;
use \Venus\src\BackOffice\Model\person as modelPerson;
use \Venus\src\BackOffice\Model\person_alias as modelPersonAlias;
use \Venus\src\BackOffice\Model\photo_has_person as modelPhotoHasPerson;
use \Venus\src\BackOffice\Model\article_has_person as modelArticleHasActor;
use \Venus\src\BackOffice\Model\record_has_actor as modelRecordHasActor;
use \Venus\src\BackOffice\Model\record_has_creator as modelRecordHasCreator;
use \Venus\src\BackOffice\Model\record_has_distributor as modelRecordHasDistributor;
use \Venus\src\BackOffice\Model\record_has_technical_team as modelRecordHasTechnicalTeam;
use \Venus\src\BackOffice\Model\record_has_productor as modelRecordHasProductor;
use \Venus\src\BackOffice\Model\record_has_realisator as modelRecordHasRealisator;
use \Venus\src\BackOffice\Model\record_has_screenwriter as modelRecordHasScreenwriter;
use \Venus\src\BackOffice\Entity\person as entityPerson;
use \Venus\src\BackOffice\Entity\person_alias as entityPersonAlias;

/**
 * Controller to person
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
 * @property	\src\Front\Model\nationality $modelNationality
 * @property	\src\Front\Model\person $modelPerson
 */

class Person extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelNationality = function() { return new modelNationality; };
		$this->modelPerson = function() { return new modelPerson; };
		$this->modelPersonAlias = function() { return new modelPersonAlias; };
		$this->modelArticleHasActor = function() { return new modelArticleHasActor; };
		$this->modelLikePerson = function() { return new modelLikePerson; };
		$this->modelPhotoHasPerson = function() { return new modelPhotoHasPerson; };
		$this->modelRecordHasActor = function() { return new modelRecordHasActor; };
		$this->modelRecordHasCreator = function() { return new modelRecordHasCreator; };
		$this->modelRecordHasDistributor = function() { return new modelRecordHasDistributor; };
		$this->modelRecordHasTechnicalTeam = function() { return new modelRecordHasTechnicalTeam; };
		$this->modelRecordHasProductor = function() { return new modelRecordHasProductor; };
		$this->modelRecordHasRealisator = function() { return new modelRecordHasRealisator; };
		$this->modelRecordHasScreenwriter = function() { return new modelRecordHasScreenwriter; };

		parent::__construct();
	}

	/**
	 * the list of record
	 *
	 * @access public
	 * @return void
	 */

	public function all() {

		$aPerson = $this->modelPerson->getPersonByCompleteName('', 'Bruce');

		$this->layout
			 ->assign('persons', $aPerson)
			 ->display();
	}

	/**
	 * the list of record
	 *
	 * @access public
	 * @param  string $sFirstName
	 * @param  string $sName
	 * @return void
	 */

	public function ajaxList($sFirstName, $sName) {

		$aPerson = $this->modelPerson->getPersonByCompleteName($sName, $sFirstName);

		$this->view
			 ->assign('persons', $aPerson)
			 ->display('src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'PersonAjax.tpl');
	}

	/**
	 * the list of record
	 *
	 * @access public
	 * @param  string $sTotalName
	 * @return void
	 */

	public function ajaxListPersons($sTotalName) {

		$sTotalName = urldecode($sTotalName);

		$sContentToReturn = array();
		$aPerson = $this->modelPerson->getPersonForAutocomplete($sTotalName);
		$i = 0;

		foreach ($aPerson as $iKey => $oPerson) {

			$sContentToReturn[$i] = array();
			$sContentToReturn[$i]['id'] = $oPerson->get_id();
			$sContentToReturn[$i]['name'] = addslashes($oPerson->get_firstname().' '.$oPerson->get_name());
			$i++;
		}

		return json_encode($sContentToReturn);
	}

	/**
	 * add a record
	 *
	 * @access public
	 * @return void
	 */

	public function add() {

		if (isset($_POST) && count($_POST)) {

			if ($_POST['ladate'] == 'o') {

				$sBirthday = $_POST['birthday_a'].'-'.$_POST['birthday_m'].'-'.$_POST['birthday_j'];
			}
			else {

				$sBirthday = '0000-00-00';
			}

			$oPerson = new entityPerson;

			$oPerson->set_name($_POST['name'])
					->set_id_nationality($_POST['id_nationalite'])
					->set_firstname($_POST['firstname'])
					->set_biography($_POST['biography'])
					->set_birthday($_POST['birthday_a'].'-'.$_POST['birthday_m'].'-'.$_POST['birthday_j'])
					->set_visible('y')
					->set_sex($_POST['sex'])
					->set_created(date('Y-m-d H:i:s'));

			$iIdPerson = $this->modelPerson->insert($oPerson);

			$oUpload = new Upload;

			$oUpload->setMaxSize(2000000)
					->setAllowExtension(['jpeg', 'jpg'])
					->setExtension('jpg')
					->setWidth(160)
					->setHeight(240)
					->setName('person_'.$iIdPerson)
					->upload('fichier');

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'PersonAddConfirm.tpl')
				 ->display();
		}
		else {

			$aNationality = $this->modelNationality->get();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'PersonAdd.tpl')
				 ->assign('nationality', $aNationality)
				 ->display();
		}
	}

	/**
	 * add a record
	 *
	 * @access public
	 * @param  integer $iIdToUpdate id of record
	 * @return void
	 */

	public function update($iIdToUpdate) {

		if (isset($_POST) && count($_POST)) {

			if ($_POST['ladate'] == 'o') {

				$sBirthday = $_POST['birthday_a'].'-'.$_POST['birthday_m'].'-'.$_POST['birthday_j'];
			}
			else {

				$sBirthday = '0000-00-00';
			}

			$oPerson = new entityPerson;

			$oPerson->set_name($_POST['name'])
					->set_id_nationality($_POST['id_nationalite'])
					->set_firstname($_POST['firstname'])
					->set_biography($_POST['biography'])
					->set_birthday($_POST['birthday_a'].'-'.$_POST['birthday_m'].'-'.$_POST['birthday_j'])
					->set_visible('y')
					->set_sex($_POST['sex'])
					->set_created(date('Y-m-d H:i:s'))
					->set_id($iIdToUpdate);

			$iIdPerson = $this->modelPerson->update($oPerson);

			if (isset($_FILES['fichier'])) {

				$oUpload = new Upload;

				$oUpload->setMaxSize(2000000)
						->setAllowExtension(['jpeg', 'jpg'])
						->setExtension('jpg')
						->setWidth(160)
						->setHeight(240)
						->setName('person_'.$iIdToUpdate)
						->upload('fichier');
			}

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'PersonAddConfirm.tpl')
				 ->display();
		}
		else {

			$aPerson = $this->modelPerson->findOneByid($iIdToUpdate);
			$aNationality = $this->modelNationality->get();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'PersonAdd.tpl')
				 ->assign('nationality', $aNationality)
				 ->assign('person', $aPerson)
				 ->assign('day', preg_replace('/^[0-9]{4}-[0-9]{2}-([0-9]{2})$/', '$1', $aPerson->get_birthday()))
				 ->assign('month', preg_replace('/^[0-9]{4}-([0-9]{2})-[0-9]{2}$/', '$1', $aPerson->get_birthday()))
				 ->assign('year', preg_replace('/^([0-9]{4})-[0-9]{2}-[0-9]{2}$/', '$1', $aPerson->get_birthday()))
				 ->display();
		}
	}

	/**
	 * auto creation of person
	 *
	 * @access public
	 * @param  string $sUrl url
	 * @param  string $sFirstname firstname
	 * @param  string $sName name
	 * @param  string $sUrlImg image url
	 * @return void
	 */

	public function autoCreation($sUrl, $sFirstname, $sName, $sUrlImg) {

		$sContent = file_get_contents('http://www.allocine.fr'.$sUrl);
		$sContent = str_replace(["\n", "\r", "\t"], ['', '', ''], $sContent);

		$oPerson = new entityPerson;

		$oPerson->set_firstname($sFirstname)
				->set_name($sName)
				->set_created(date('Y-m-d H:s:i'))
				->set_sex('m');

		preg_match('|<span class="star_info lighten fl">Nationalité</span><div class="oflow_a">([^<]+)</div>|msi', $sContent, $aMatchs);

		$aMatchs[1] = preg_replace('/e$/', '', $aMatchs[1]);

		$oNationality = $this->modelNationality->findOneByname(strip_tags($aMatchs[1]));

		if (count($oNationality)) {

			$oPerson->set_id_nationality($oNationality->get_id());
		}
		else {

			$oPerson->set_id_nationality(18);
		}

		preg_match('| content="([^"]+)" itemprop="birthDate">|msi', $sContent, $aMatchs);

		$oPerson->set_birthday($aMatchs[1]);

		if (strstr($sContent, '<span class="inactive">Biographie</span>')) {

			$oPerson->set_visible('y');
			$this->modelPerson->insert($oPerson);
		}
		else {

			$oPerson->set_visible('n');

			$this->modelPerson->insert($oPerson);

			$oPerson = $this->modelPerson->findOneBy(['firstname' => $sFirstname, 'name' => $sName]);

			$sPath = str_replace('private'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'Controller',
					'data'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR, __DIR__);

			if ($sUrlImg == null) {

				preg_match('|<img itemprop="image" src=\'([^\']+)\' alt=|msi', $sContent, $aMatchs);
				$sUrlImg = $aMatchs[1];
			}

			$aImageSizes = getimagesize($sUrlImg);

			$fRatio = min($aImageSizes[0] / 160, $aImageSizes[1] / 240);
			$iHeight =  $aImageSizes[1] / $fRatio;
			$iWidth =  $aImageSizes[0] / $fRatio;
			$fY = ($iHeight - 240) / 2 * $fRatio;
			$fX = ($iWidth - 160) / 2 * $fRatio;

			$rNewImage = imagecreatefromjpeg($sUrlImg);

			$rNewImgTrueColor = imagecreatetruecolor(160 , 240);
			imagecopyresampled($rNewImgTrueColor , $rNewImage, 0, 0, $fX, $fY, 160, 240, $iWidth * $fRatio - $fX * 2, $iHeight * $fRatio - $fY * 2);

			$sName = $sPath.'person_'.$oPerson->get_id().'.jpg';

			imagejpeg($rNewImgTrueColor , $sName, 100);
		}

		return $oPerson;
	}

	/**
	 * add a record
	 *
	 * @access public
	 * @return void
	 */

	public function addAlias() {

		if (isset($_POST) && count($_POST)) {

			$oPersonAlias = new entityPersonAlias;

			$oPersonAlias->set_alias($_POST['alias'])
						 ->set_id_user($_POST['id_person']);

			$iIdPerson = $this->modelPersonAlias->insert($oPersonAlias);

			$aPersons = $this->modelPerson->getPersonByAlias($_POST['alias']);

			if (count($aPersons) > 0) {

				foreach ($aPersons as $oOne) {

					$aToTransform = $this->modelArticleHasActor->findByid_person($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_person($_POST['id_person']);
						$this->modelArticleHasActor->update($aOneTransform);
					}

					$aToTransform = $this->modelLikePerson->findByid_person($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_person($_POST['id_person']);
						$this->modelLikePerson->update($aOneTransform);
					}

					$aToTransform = $this->modelPhotoHasPerson->findByid_person($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_person($_POST['id_person']);
						$this->modelPhotoHasPerson->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasActor->findByid_person($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_person($_POST['id_person']);
						$this->modelRecordHasActor->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasCreator->findByid_person($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_person($_POST['id_person']);
						$this->modelRecordHasCreator->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasDistributor->findByid_person($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_person($_POST['id_person']);
						$this->modelRecordHasDistributor->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasTechnicalTeam->findByid_person($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_person($_POST['id_person']);
						$this->modelRecordHasTechnicalTeam->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasProductor->findByid_person($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_person($_POST['id_person']);
						$this->modelRecordHasProductor->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasRealisator->findByid_person($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_person($_POST['id_person']);
						$this->modelRecordHasRealisator->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasScreenwriter->findByid_person($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_person($_POST['id_person']);
						$this->modelRecordHasScreenwriter->update($aOneTransform);
					}

					$this->modelPerson->delete($oOne);
				}
			}

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'PersonAddConfirm.tpl')
				 ->display();
		}
		else {

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'PersonAliasAdd.tpl')
				 ->display();
		}
	}
}

<?php

/**
 * Controller to record
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
use \Venus\src\BackOffice\Controller\Person as controllerPerson;
use \Venus\src\BackOffice\Model\critic as modelCritic;
use \Venus\src\BackOffice\Model\company as modelCompany;
use \Venus\src\BackOffice\Model\kind as modelKind;
use \Venus\src\BackOffice\Model\nationality as modelNationality;
use \Venus\src\BackOffice\Model\person as modelPerson;
use \Venus\src\BackOffice\Model\record as modelRecord;
use \Venus\src\BackOffice\Model\like_movie as modelLikeMovie;
use \Venus\src\BackOffice\Model\photo as modelPhoto;
use \Venus\src\BackOffice\Model\record_has_record as modelRecordHasRecord;
use \Venus\src\BackOffice\Model\record_has_actor as modelRecordHasActor;
use \Venus\src\BackOffice\Model\record_episode as modelRecordEpisode;
use \Venus\src\BackOffice\Model\record_has_kind as modelRecordHasKind;
use \Venus\src\BackOffice\Model\record_has_realisator as modelRecordHasRealisator;
use \Venus\src\BackOffice\Model\record_has_productor as modelRecordHasProductor;
use \Venus\src\BackOffice\Model\record_has_company as modelRecordHasCompany;
use \Venus\src\BackOffice\Model\record_has_screenwriter as modelRecordHasScreenwriter;
use \Venus\src\BackOffice\Model\record_has_technical_team as modelRecordHasTechnicalTeam;
use \Venus\src\BackOffice\Model\record_has_distributor as modelRecordHasDistributor;
use \Venus\src\BackOffice\Model\record_has_company as modelRecordHasCompany;
use \Venus\src\BackOffice\Model\record_has_creator as modelRecordHasCreator;
use \Venus\src\BackOffice\Model\record_alias as modelRecordAlias;
use \Venus\src\BackOffice\Model\record_story as modelStory;
use \Venus\src\BackOffice\Model\record_trailer as modelTrailer;
use \Venus\src\BackOffice\Model\program_on_grid as modelProgamOnGrid;
use \Venus\src\BackOffice\Entity\company as entityCompany;
use \Venus\src\BackOffice\Entity\record as entityRecord;
use \Venus\src\BackOffice\Entity\person as entityPerson;
use \Venus\src\BackOffice\Entity\record_has_actor as entityRecordHasActor;
use \Venus\src\BackOffice\Entity\record_has_record as entityRecordHasRecord;
use \Venus\src\BackOffice\Entity\record_has_creator as entityRecordHasCreator;
use \Venus\src\BackOffice\Entity\record_episode as entityRecordEpisode;
use \Venus\src\BackOffice\Entity\record_has_kind as entityRecordHasKind;
use \Venus\src\BackOffice\Entity\record_has_realisator as entityRecordHasRealisator;
use \Venus\src\BackOffice\Entity\record_has_productor as entityRecordHasProductor;
use \Venus\src\BackOffice\Entity\record_has_screenwriter as entityRecordHasScreenwriter;
use \Venus\src\BackOffice\Entity\record_has_technical_team as entityRecordHasTechnicalTeam;
use \Venus\src\BackOffice\Entity\record_has_distributor as entityRecordHasDistributor;
use \Venus\src\BackOffice\Entity\record_has_company as entityRecordHasCompany;
use \Venus\src\BackOffice\Entity\record_has_episode as entityRecordHasEpisode;
use \Venus\src\BackOffice\Entity\record_alias as entityRecordAlias;
use \Venus\src\BackOffice\Entity\critic as entityCritic;
use \Venus\src\BackOffice\Entity\photo as entityPhoto;
use \Venus\src\BackOffice\Entity\story as entityStory;
use \Venus\src\BackOffice\Entity\trailer as entityTrailer;
use \Venus\src\BackOffice\Entity\program_on_grid as entityProgramOnGrid;

/**
 * Controller to record
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
 * @property	\src\Front\Model\record $modelRecord
 * @property	\src\Front\Model\record_has_actor $modelRecordHasActor
 * @property	\src\Front\Model\record_has_kind $modelRecordHasKind
 * @property	\src\Front\Model\record_has_realisator $modelRecordHasRealisator
 */

class Record extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->controllerPerson = function() { return new controllerPerson; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelKind = function() { return new modelKind; };
		$this->modelNationality = function() { return new modelNationality; };
		$this->modelCompany = function() { return new modelCompany; };
		$this->modelCritic = function() { return new modelCritic; };
		$this->modelPerson = function() { return new modelPerson; };
		$this->modelRecordHasActor = function() { return new modelRecordHasActor; };
		$this->modelRecordEpisode = function() { return new modelRecordEpisode; };
		$this->modelRecordHasKind = function() { return new modelRecordHasKind; };
		$this->modelRecordHasRealisator = function() { return new modelRecordHasRealisator; };
		$this->modelRecordHasProductor = function() { return new modelRecordHasProductor; };
		$this->modelRecordHasScreenwriter = function() { return new modelRecordHasScreenwriter; };
		$this->modelRecordHasTechnicalTeam = function() { return new modelRecordHasTechnicalTeam; };
		$this->modelRecordHasDistributor = function() { return new modelRecordHasDistributor; };
		$this->modelRecordHasCompany = function() { return new modelRecordHasCompany; };
		$this->modelRecordHasCreator = function() { return new modelRecordHasCreator; };
		$this->modelRecordAlias = function() { return new modelRecordAlias; };
		$this->modelArticleHasRecord = function() { return new modelArticleHasRecord; };
		$this->modelLikeMovie = function() { return new modelLikeMovie; };
		$this->modelPhoto = function() { return new modelPhoto; };
		$this->modelRecordHasCompany = function() { return new modelRecordHasCompany; };
		$this->modelRecordHasEpisode = function() { return new modelRecordHasEpisode; };
		$this->modelStory = function() { return new modelStory; };
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

		$aRecords = $this->modelRecord->getRecordByTitle('Spi');

		foreach ($aRecords as $iKey => $oRecord) {

			$aRecords[$iKey]->url1 = $this->url->getUrl('modifier_fiche', array('id' => $oRecord->get_id()));
			$aRecords[$iKey]->url2 = $this->url->getUrl('liste_une_fiche', array('id' => $oRecord->get_id()));
		}

		$this->layout
			 ->assign('records', $aRecords)
			 ->display();
	}

	/**
	 * the list of record
	 *
	 * @access public
	 * @param  string $sTitle title
	 * @return void
	 */

	public function ajaxList($sTitle) {

		$aRecords = $this->modelRecord->getRecordByTitle($sTitle);

		foreach ($aRecords as $iKey => $oRecord) {

			$aRecords[$iKey]->url1 = $this->url->getUrl('modifier_fiche', array('id' => $oRecord->get_id()));
			$aRecords[$iKey]->url2 = $this->url->getUrl('liste_une_fiche', array('id' => $oRecord->get_id()));
		}

		$this->view
			 ->assign('records', $aRecords)
			 ->display('src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAjax.tpl');
	}

	/**
	 * the list of record
	 *
	 * @access public
	 * @param  integer $iId id of record
	 * @return void
	 */

	public function one($iId) {

		$oUrlManager = new UrlManager();
		$oRecord = $this->modelRecord->findOneByid($iId);
		$aActors = $this->modelRecordHasActor->getActorsByRecordId($iId);
		$aTechnicalTeams = $this->modelRecordHasTechnicalTeam->getTechnicalTeamByRecordId($iId);
		$aProductors = $this->modelRecordHasProductor->getProductorsByRecordId($iId);
		$aRealisator = $this->modelRecordHasRealisator->getRealisatorsByRecordId($iId);
		$aScreenwriter = $this->modelRecordHasScreenwriter->getScreenwritersByRecordId($iId);
		$aDistributor = $this->modelRecordHasDistributor->getDistributorsByRecordId($iId);
		$aCreator = $this->modelRecordHasCreator->getCreatorsByRecordId($iId);
		$aCompany = $this->modelRecordHasCompany->getCompaniesByRecordId($iId);

		$sActor = '';

		foreach ($aActors as $oActors) {

			$sActor .= ''.$oActors->person->get_name().' '.$oActors->person->get_firstname();
			if ($oActors->person->get_visible() != 'y') { $sActor .= ' &nbsp;&nbsp; [ <a href="'.$this->url->getUrl('modifier_personne', ['id' => $oActors->person->get_id()]).'" target="_blank">à finir</a> ]'; }
			$sActor .= '<br/>';
		}

		$sTechnicalTeam = '';

		foreach ($aTechnicalTeams as $oTechnicalTeam) {

			$sTechnicalTeam .= ''.$oTechnicalTeam->person->get_name().' '.$oTechnicalTeam->person->get_firstname();
			if ($oTechnicalTeam->person->get_visible() != 'y') { $sTechnicalTeam .= ' &nbsp;&nbsp; [ <a href="'.$this->url->getUrl('modifier_personne', ['id' => $oTechnicalTeam->person->get_id()]).'" target="_blank">à finir</a> ]'; }
			$sTechnicalTeam .= '<br/>';
		}

		$sProductor = '';

		foreach ($aProductors as $oProductor) {

			$sProductor .= ''.$oProductor->person->get_name().' '.$oProductor->person->get_firstname();
			if ($oProductor->person->get_visible() != 'y') { $sProductor .= ' &nbsp;&nbsp; [ <a href="'.$this->url->getUrl('modifier_personne', ['id' => $oProductor->person->get_id()]).'" target="_blank">à finir</a> ]'; }
			$sProductor .= '<br/>';
		}

		$sRealisator = '';

		foreach ($aRealisator as $oRealisator) {

			$sRealisator .= ''.$oRealisator->person->get_name().' '.$oRealisator->person->get_firstname();
			if ($oRealisator->person->get_visible() != 'y') { $sRealisator .= ' &nbsp;&nbsp; [ <a href="'.$this->url->getUrl('modifier_personne', ['id' => $oRealisator->person->get_id()]).'" target="_blank">à finir</a> ]'; }
			$sRealisator .= '<br/>';
		}

		$sScreenwriter = '';

		foreach ($aScreenwriter as $oScreenwriter) {

			$sScreenwriter .= ''.$oScreenwriter->person->get_name().' '.$oScreenwriter->person->get_firstname();
			if ($oScreenwriter->person->get_visible() != 'y') { $sScreenwriter .= ' &nbsp;&nbsp; [ <a href="'.$this->url->getUrl('modifier_personne', ['id' => $oScreenwriter->person->get_id()]).'" target="_blank">à finir</a> ]'; }
			$sScreenwriter .= '<br/>';
		}

		$sDistributor = '';

		foreach ($aDistributor as $oDistributor) {

			$sDistributor .= ''.$oDistributor->person->get_name().' '.$oDistributor->person->get_firstname();
			if ($oDistributor->person->get_visible() != 'y') { $sDistributor .= ' &nbsp;&nbsp; [ <a href="'.$this->url->getUrl('modifier_personne', ['id' => $oDistributor->person->get_id()]).'" target="_blank">à finir</a> ]'; }
			$sDistributor .= '<br/>';
		}

		$sCreator = '';

		foreach ($aCreator as $oCreator) {

			$sCreator .= ''.$oCreator->person->get_name().' '.$oCreator->person->get_firstname();
			if ($oCreator->person->get_visible() != 'y') { $sCreator .= ' &nbsp;&nbsp; [ <a href="'.$this->url->getUrl('modifier_personne', ['id' => $oCreator->person->get_id()]).'" target="_blank">à finir</a> ]'; }
			$sCreator .= '<br/>';
		}

		$sCompany = '';

		foreach ($aCompany as $oCompany) {

			$sCompany .= ''.$oCompany->company->get_name().'<br/>';
		}

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordOne.tpl')
			 ->assign('record', $oRecord)
			 ->assign('liste_actor', $sActor)
			 ->assign('liste_technicalteam', $sTechnicalTeam)
			 ->assign('liste_productor', $sProductor)
			 ->assign('liste_realisator', $sRealisator)
			 ->assign('liste_screenwriter', $sScreenwriter)
			 ->assign('liste_distributor', $sDistributor)
			 ->assign('liste_creator', $sCreator)
			 ->assign('liste_company', $sCompany)
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

			$oRecord = new entityRecord;

			$oRecord->set_title($_POST['title'])
					->set_id_nationality($_POST['id_nationalite'])
					->set_synopsis($_POST['synopsis'])
					->set_production_date($_POST['production_date'])
					->set_visible('y')
					->set_type($_POST['type'])
					->set_score($_POST['score'])
					->set_review($_POST['review'])
					->set_date_cinema($_POST['date_cinema_a'].'-'.$_POST['date_cinema_m'].'-'.$_POST['date_cinema_j'])
					->set_date_dvd($_POST['date_dvd_a'].'-'.$_POST['date_dvd_m'].'-'.$_POST['date_dvd_j'])
					->set_date_bluray($_POST['date_bluray_a'].'-'.$_POST['date_bluray_m'].'-'.$_POST['date_bluray_j'])
					->set_date_vod($_POST['date_vod_a'].'-'.$_POST['date_vod_m'].'-'.$_POST['date_vod_j'])
					->set_created(date('Y-m-d H:i:s'));

			$iIdRecord = $this->modelRecord->insert($oRecord);

			if (isset($_POST['kinds']) && $_POST['kinds'] != '') {

				$_POST['kinds'] = substr($_POST['kinds'], 1);

				foreach (explode(';', $_POST['kinds']) as $iId) {

					$oRecordHasKind = new entityRecordHasKind;

					$oRecordHasKind->set_id_record($iIdRecord)
								   ->set_id_kind($iId);

					$this->modelRecordHasKind->insert($oRecordHasKind);
				}
			}

			$oUpload = new Upload;

			$oUpload->setMaxSize(2000000)
					->setAllowExtension(['jpeg', 'jpg'])
					->setExtension('jpg')
					->setWidth(160)
					->setHeight(240)
					->setName('record_'.$iIdRecord)
					->upload('fichier');

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddConfirm.tpl')
				 ->display();
		}
		else {

			$aNationality = $this->modelNationality->get();
			//$aPerson = $this->modelPerson->getAllList();
			$aKind = $this->modelKind->get();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAdd.tpl')
				 ->assign('nationality', $aNationality)
				 //->assign('person', $aPerson)
				 ->assign('kind', $aKind)
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

			$oRecord = new entityRecord;

			$oRecord->set_title($_POST['title'])
					->set_id_nationality($_POST['id_nationalite'])
					->set_synopsis($_POST['synopsis'])
					->set_production_date($_POST['production_date'])
					->set_visible('y')
					->set_score($_POST['score'])
					->set_review($_POST['review'])
					->set_date_cinema($_POST['date_cinema_a'].'-'.$_POST['date_cinema_m'].'-'.$_POST['date_cinema_j'])
					->set_date_dvd($_POST['date_dvd_a'].'-'.$_POST['date_dvd_m'].'-'.$_POST['date_dvd_j'])
					->set_date_bluray($_POST['date_bluray_a'].'-'.$_POST['date_bluray_m'].'-'.$_POST['date_bluray_j'])
					->set_date_vod($_POST['date_vod_a'].'-'.$_POST['date_vod_m'].'-'.$_POST['date_vod_j'])
					->set_created(date('Y-m-d H:i:s'))
					->set_id($iIdToUpdate);

			$iIdRecord = $this->modelRecord->update($oRecord);

			if (isset($_POST['kinds']) && $_POST['kinds'] != '') {

				$_POST['kinds'] = substr($_POST['kinds'], 1);

				foreach (explode(';', $_POST['kinds']) as $iId) {

					$oRecordHasKind = new entityRecordHasKind;

					$oRecordHasKind->set_id_record($iIdToUpdate)
								   ->set_id_kind($iId);

					$this->modelRecordHasKind->insert($oRecordHasKind);
				}
			}

			if (isset($_FILES['fichier'])) {

				$oUpload = new Upload;

				$oUpload->setMaxSize(2000000)
						->setAllowExtension(['jpeg', 'jpg'])
						->setExtension('jpg')
						->setWidth(160)
						->setHeight(240)
						->setName('record_'.$iIdToUpdate)
						->upload('fichier');
			}

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddConfirm.tpl')
				 ->display();
		}
		else {

			$oRecord = $this->modelRecord->findOneByid($iIdToUpdate);
			$aNationality = $this->modelNationality->get();
			//$aPerson = $this->modelPerson->getAllList();
			$aKind = $this->modelKind->get();

			$aRecordHasKind = $this->modelRecordHasKind->findByid_record($iIdToUpdate);
			$sRecordHasKindValue = '';
			$sRecordHasKindName = '';

			foreach ($aRecordHasKind as $oRecordHasKind) {

				$sRecordHasKindValue .= ';'.$oRecordHasKind->get_id_kind();
				$oKind = $this->modelKind->findOneByid($oRecordHasKind->get_id_kind());
				$sRecordHasKindName .= '<br/>'.$oKind->get_name();
			}

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAdd.tpl')
				 ->assign('nationality', $aNationality)
				 //->assign('person', $aPerson)
				 ->assign('kind', $aKind)
				 ->assign('record', $oRecord)
				 ->assign('record_has_kind_value', $sRecordHasKindValue)
				 ->assign('record_has_kind_name', $sRecordHasKindName)
				 ->assign('day1', preg_replace('/^[0-9]{4}-[0-9]{2}-([0-9]{2})$/', '$1', $oRecord->get_date_cinema()))
				 ->assign('month1', preg_replace('/^[0-9]{4}-([0-9]{2})-[0-9]{2}$/', '$1', $oRecord->get_date_cinema()))
				 ->assign('year1', preg_replace('/^([0-9]{4})-[0-9]{2}-[0-9]{2}$/', '$1', $oRecord->get_date_cinema()))
				 ->assign('day2', preg_replace('/^[0-9]{4}-[0-9]{2}-([0-9]{2})$/', '$1', $oRecord->get_date_dvd()))
				 ->assign('month2', preg_replace('/^[0-9]{4}-([0-9]{2})-[0-9]{2}$/', '$1', $oRecord->get_date_dvd()))
				 ->assign('year2', preg_replace('/^([0-9]{4})-[0-9]{2}-[0-9]{2}$/', '$1', $oRecord->get_date_dvd()))
				 ->assign('day3', preg_replace('/^[0-9]{4}-[0-9]{2}-([0-9]{2})$/', '$1', $oRecord->get_date_bluray()))
				 ->assign('month3', preg_replace('/^[0-9]{4}-([0-9]{2})-[0-9]{2}$/', '$1', $oRecord->get_date_bluray()))
				 ->assign('year3', preg_replace('/^([0-9]{4})-[0-9]{2}-[0-9]{2}$/', '$1', $oRecord->get_date_bluray()))
				 ->assign('day4', preg_replace('/^[0-9]{4}-[0-9]{2}-([0-9]{2})$/', '$1', $oRecord->get_date_vod()))
				 ->assign('month4', preg_replace('/^[0-9]{4}-([0-9]{2})-[0-9]{2}$/', '$1', $oRecord->get_date_vod()))
				 ->assign('year4', preg_replace('/^([0-9]{4})-[0-9]{2}-[0-9]{2}$/', '$1', $oRecord->get_date_vod()))
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

	public function addActor($iId) {

		if (isset($_POST) && count($_POST)) {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$oRecordHasActor = new entityRecordHasActor;

			$oRecordHasActor->set_id_record($iId)
							->set_id_person($_POST['id_person'])
							->set_role($_POST['role']);

			$this->modelRecordHasActor->insert($oRecordHasActor);

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddActorConfirm.tpl')
				 ->assign('record', $oRecord)
				 ->display();
		}
		else {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$aPerson = $this->modelPerson->getAllList();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddActor.tpl')
				 ->assign('record', $oRecord)
				 ->assign('person', $aPerson)
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

	public function addTechnicalTeam($iId) {

		if (isset($_POST) && count($_POST)) {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$oRecordHasTechnicalTeam = new entityRecordHasTechnicalTeam;

			$oRecordHasTechnicalTeam->set_id_record($iId)
									->set_id_person($_POST['id_person'])
									->set_role($_POST['role']);

			$this->modelRecordHasTechnicalTeam->insert($oRecordHasTechnicalTeam);

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddActorConfirm.tpl')
				 ->assign('record', $oRecord)
				 ->display();
		}
		else {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$aPerson = $this->modelPerson->getAllList();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddTechicalTeam.tpl')
				 ->assign('record', $oRecord)
				 ->assign('person', $aPerson)
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

	public function addProductor($iId) {

		if (isset($_POST) && count($_POST)) {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$oRecordHasProductor = new entityRecordHasProductor;

			$oRecordHasProductor->set_id_record($iId)
								->set_id_person($_POST['id_person'])
								->set_role($_POST['role']);

			$this->modelRecordHasProductor->insert($oRecordHasProductor);

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddActorConfirm.tpl')
				 ->assign('record', $oRecord)
				 ->display();
		}
		else {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$aPerson = $this->modelPerson->getAllList();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddProductor.tpl')
				 ->assign('record', $oRecord)
				 ->assign('person', $aPerson)
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

	public function addRealisator($iId) {

		if (isset($_POST) && count($_POST)) {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$oRecordHasRealisator = new entityRecordHasRealisator;

			$oRecordHasRealisator->set_id_record($iId)
								 ->set_id_person($_POST['id_person'])
								 ->set_role($_POST['role']);

			$this->modelRecordHasRealisator->insert($oRecordHasRealisator);

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddActorConfirm.tpl')
				 ->assign('record', $oRecord)
				 ->display();
		}
		else {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$aPerson = $this->modelPerson->getAllList();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddRealisator.tpl')
				 ->assign('record', $oRecord)
				 ->assign('person', $aPerson)
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

	public function addScreenwriter($iId) {

		if (isset($_POST) && count($_POST)) {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$oRecordHasScreenwriter = new entityRecordHasScreenwriter;

			$oRecordHasScreenwriter->set_id_record($iId)
								   ->set_id_person($_POST['id_person'])
								   ->set_role($_POST['role']);

			$this->modelRecordHasScreenwriter->insert($oRecordHasScreenwriter);

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddActorConfirm.tpl')
				 ->assign('record', $oRecord)
				 ->display();
		}
		else {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$aPerson = $this->modelPerson->getAllList();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddScreenwriter.tpl')
				 ->assign('record', $oRecord)
				 ->assign('person', $aPerson)
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

	public function addDistributor($iId) {

		if (isset($_POST) && count($_POST)) {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$oRecordHasDistributor = new entityRecordHasDistributor;

			$oRecordHasDistributor->set_id_record($iId)
								  ->set_id_person($_POST['id_person'])
								  ->set_role($_POST['role']);

			$this->modelRecordHasDistributor->insert($oRecordHasDistributor);

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddActorConfirm.tpl')
				 ->assign('record', $oRecord)
				 ->display();
		}
		else {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$aPerson = $this->modelPerson->getAllList();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddDistributor.tpl')
				 ->assign('record', $oRecord)
				 ->assign('person', $aPerson)
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

	public function addCompany($iId) {

		if (isset($_POST) && count($_POST)) {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$oRecordHasCompany = new entityRecordHasCompany;

			$oRecordHasCompany->set_id_record($iId)
							  ->set_id_company($_POST['id_person'])
							  ->set_role($_POST['role']);

			$this->modelRecordHasCompany->insert($oRecordHasCompany);

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddActorConfirm.tpl')
				 ->assign('record', $oRecord)
				 ->display();
		}
		else {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$aCompany = $this->modelCompany->get();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddCompany.tpl')
				 ->assign('record', $oRecord)
				 ->assign('company', $aCompany)
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

	public function addCreator($iId) {

		if (isset($_POST) && count($_POST)) {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$oRecordHasCreator = new entityRecordHasCreator;

			$oRecordHasCreator->set_id_record($iId)
							  ->set_id_person($_POST['id_person'])
							  ->set_role($_POST['role']);

			$this->modelRecordHasCreator->insert($oRecordHasCreator);

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddActorConfirm.tpl')
				 ->assign('record', $oRecord)
				 ->display();
		}
		else {

			$oRecord = $this->modelRecord->findOneByid($iId);
			$aPerson = $this->modelPerson->getAllList();

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddCreator.tpl')
				 ->assign('record', $oRecord)
				 ->assign('person', $aPerson)
				 ->display();
		}
	}

	/**
	 * auto creation of record
	 *
	 * @access public
	 * @param  integer $iId id of record
	 * @param  string $sType type
	 * @return void
	 */

	public function autoCreation($iId, $sType) {

		if ($sType == 'film') {

			$sUrl = 'http://www.allocine.fr/film/fichefilm_gen_cfilm='.$iId.'.html';

			$oRecord = new entityRecord;
			$oRecord->set_created(date('Y-m-d H:i:s'));

			$sContent = file_get_contents($sUrl);
			$sContent = str_replace(["\n", "\r"], ['', ''], $sContent);

			preg_match('|<title>(.+?) - ?f?i?l?m? ?([0-9]*) ?-? AlloCiné</title>|msi', $sContent, $aMatchs);
			$sTitle = $aMatchs[1];

			if (!$sTitle) {

				preg_match('|<title>(.+?) - [^\-]+- AlloCiné</title>|msi', $sContent, $aMatchs);
				$sTitle = $aMatchs[1];

				preg_match('|<div>Année de production</div></th><td><span[^>]+>([0-9]+)</span>|msi', $sContent, $aMatchs2);
				$aMatchs[2] = $aMatchs2[1];
			}

			$oRecordResult = $this->modelRecord->findOneBytitle($sTitle);

			if (count($oRecordResult) < 1) {

				$oRecord->set_title($aMatchs[1])
						->set_production_date($aMatchs[2]);

				preg_match('|<span itemprop="datePublished" content="([^"]+)">|msi', $sContent, $aMatchs);

				$oRecord->set_date_cinema($aMatchs[1]);

				preg_match('|<span class="film_info lighten fl">Nationalité</span>(.+)</li></ul><!-- /list_item_p2v -->|msi', $sContent, $aMatchs);

				$oNationality = $this->modelNationality->findOneByname(strip_tags($aMatchs[1]));

				if (count($oNationality) < 1) {

					$oNationality = $this->modelNationality->findOneByname('inconnu');
				}

				$oRecord->set_id_nationality($oNationality->get_id());

				preg_match('|<th><div>Date de sortie DVD</div></th><td>([^<]+)</td>|msi', $sContent, $aMatchs);

				$sDate = trim($aMatchs[1]);
				if ($sDate == '-') { $sDate = '0000-00-00 00:00:00'; }
				$oRecord->set_date_dvd($sDate);

				preg_match('|<th><div>Date de sortie VOD</div></th><td>([^<]+)</td>|msi', $sContent, $aMatchs);

				$sDate = trim($aMatchs[1]);
				if ($sDate == '-') { $sDate = '0000-00-00 00:00:00'; }
				$oRecord->set_date_vod($sDate);

				preg_match('|<th><div>Date de sortie Blu-ray</div></th><td>([^<]+)</td>|msi', $sContent, $aMatchs);

				$sDate = trim($aMatchs[1]);
				if ($sDate == '-') { $sDate = '0000-00-00 00:00:00'; }
				$oRecord->set_date_bluray($sDate);

				$oRecord->set_visible('n')
						->set_type('film');

				$this->modelRecord->insert($oRecord);
				$oRecordResult = $this->modelRecord->findOneBytitle($sTitle);

				preg_match('|<img src=\'([^\']+)\' alt=\'[^\']+\' title=\'[^\']+\' itemprop="image" />|msi', $sContent, $aMatchsImg);

				$sPath = str_replace('private'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'Controller',
						'data'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR, __DIR__);

				$aImageSizes = getimagesize($aMatchsImg[1]);

				$fRatio = min($aImageSizes[0] / 160, $aImageSizes[1] / 240);
				$iHeight =  $aImageSizes[1] / $fRatio;
				$iWidth =  $aImageSizes[0] / $fRatio;
				$fY = ($iHeight - 240) / 2 * $fRatio;
				$fX = ($iWidth - 160) / 2 * $fRatio;

				$rNewImage = imagecreatefromjpeg($aMatchsImg[1]);

				$rNewImgTrueColor = imagecreatetruecolor(160 , 240);
				imagecopyresampled($rNewImgTrueColor , $rNewImage, 0, 0, $fX, $fY, 160, 240, $iWidth * $fRatio - $fX * 2, $iHeight * $fRatio - $fY * 2);

				$sName = $sPath.'record_'.$oRecordResult->get_id().'.jpg';

				imagejpeg($rNewImgTrueColor , $sName, 100);
			}

			$sUrl = 'http://www.allocine.fr/film/fichefilm-'.$iId.'/casting/';

			$sContent = file_get_contents($sUrl);
			$sContent = str_replace(["\n", "\r"], ['', ''], $sContent);

			// Réalisateurs

			preg_match('|<h2 class="tt_r22 d_inline_block">Réalisateurs</h2>(.*?)(<h2)|msi', $sContent, $aMatchs);

			preg_match_all('|<img src=\'([^\']+)\'alt=\'([^\']+)\' title=\'[^\']+\' /></span><p><a itemprop="url" href="([^"]+)"><span itemprop="name">|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

			foreach ($aMatchs2 as $oOne) {

				$oRealisator = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) .+$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ (.+)$/', '$1', $oOne[2])]);

				if ($oRealisator == false) {

					$this->controllerPerson->autoCreation($oOne[3], preg_replace('/^([^ ]+) .+$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ (.+)$/', '$1', $oOne[2]), $oOne[1]);
					$oRealisator = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) .+$/', '$1', $aMatchs2[0][2]), 'name' => preg_replace('/^[^ ]+ (.+)$/', '$1', $aMatchs2[0][2])]);
				}

				$oRecordHasRealisator = new entityRecordHasRealisator;

				$oRecordHasRealisator->set_id_record($oRecordResult->get_id())
									 ->set_id_person($oRealisator->get_id())
									 ->set_role('Réalisateur');

				$this->modelRecordHasRealisator->insert($oRecordHasRealisator);
			}

			// Acteurs (doublage)

			preg_match('|<h2 class="tt_r22 d_inline_block">Acteurs de doublage \(Voix originales\)</h2>(.*?)(<h2)|msi', $sContent, $aMatchs);

			preg_match_all('|<img src=\'([^\']+)\'alt=\'([^\']+)\' title=\'[^\']+\' /></span><p><span class="[^"]+">[^<]+</span><p class="fs11 lighten_hl">Rôle : ([^<]+)</p></p>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

			foreach ($aMatchs2 as $oOne) {

				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

				if ($oActor == false) {

					$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
					$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
					preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

					$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), $oOne[1]);
					$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
				}

				$oRecordHasTechnicalTeam = new entityRecordHasTechnicalTeam;

				$oRecordHasTechnicalTeam->set_id_record($oRecordResult->get_id())
										->set_id_person($oActor->get_id())
										->set_role('Doublage '.$oOne[3]);

				$this->modelRecordHasTechnicalTeam->insert($oRecordHasTechnicalTeam);
			}

			// Acteurs

			preg_match('|<h2 class="tt_r22 d_inline_block">Acteurs et actrices</h2>(.*?)(<h2)|msi', $sContent, $aMatchs);

			preg_match_all('|<img src=\'([^\']+)\'alt=\'([^\']+)\' title=\'[^\']+\' /></span><p><a href="([^"]+)">[^<]+</span></a><p class="fs11 lighten_hl">Rôle : ([^<]+)</p></p>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

			foreach ($aMatchs2 as $oOne) {

				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

				if ($oActor == false) {

					$this->controllerPerson->autoCreation($oOne[3], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), $oOne[1]);
					$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
				}

				$oRecordHasActor = new entityRecordHasActor;

				$oRecordHasActor->set_id_record($oRecordResult->get_id())
								->set_id_person($oActor->get_id())
								->set_role($oOne[4]);

				$this->modelRecordHasActor->insert($oRecordHasActor);
			}

			preg_match_all('|<img src=\'([^\']+)\'alt=\'([^\']+)\' title=\'[^\']+\' /></span><p><a href="([^"]+)">[^<]+</span></a></p></li>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

			foreach ($aMatchs2 as $oOne) {

				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

				if ($oActor == false) {

					$this->controllerPerson->autoCreation($oOne[3], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), $oOne[1]);
					$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
				}

				$oRecordHasActor = new entityRecordHasActor;

				$oRecordHasActor->set_id_record($oRecordResult->get_id())
				->set_id_person($oActor->get_id());

				$this->modelRecordHasActor->insert($oRecordHasActor);
			}

			preg_match_all('|<img src=\'([^\']+)\'alt=\'([^\']+)\' title=\'[^\']+\' /></span><p><span class="[^"]+">([^<]+)</span></p></li>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

			foreach ($aMatchs2 as $oOne) {

				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

				if ($oActor == false) {

					$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
					$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
					preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

					$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), $oOne[1]);
					$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
				}

				$oRecordHasActor = new entityRecordHasActor;

				$oRecordHasActor->set_id_record($oRecordResult->get_id())
				->set_id_person($oActor->get_id());

				$this->modelRecordHasActor->insert($oRecordHasActor);
			}

			preg_match_all('|<tr[^>]*><td>([^<]+)</td><td><div class="tab_tooltip"[^>]*><a href="([^"]+)" itemprop="url"><span itemprop="name">([^<]+)</span></a>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

			foreach ($aMatchs2 as $oOne) {

				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[3]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[3])]);

				if ($oActor == false) {

					$this->controllerPerson->autoCreation($oOne[2], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[3]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[3]), null);
					$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[3]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[3])]);
				}

				$oRecordHasActor = new entityRecordHasActor;

				$oRecordHasActor->set_id_record($oRecordResult->get_id())
								->set_id_person($oActor->get_id())
								->set_role($oOne[1]);

				$this->modelRecordHasActor->insert($oRecordHasActor);
			}

			preg_match_all('|<tr[^<]*><td>([^<]+)</td><td><div class="tab_tooltip"><span class[^>]+>([^<]+)</span>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

			foreach ($aMatchs2 as $oOne) {

				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

				if ($oActor == null || count($oActor) < 1 || ($oActor->get_id() < 1)) {

					$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
					$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
					preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

					$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), null);
					$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
				}

				$oRecordHasActor = new entityRecordHasActor;

				$oRecordHasActor->set_id_record($oRecordResult->get_id())
								->set_id_person($oActor->get_id())
								->set_role($oOne[1]);

				$this->modelRecordHasActor->insert($oRecordHasActor);
			}

			// Producteurs

			preg_match('|<h2 class="tt_r22">Production</h2>(.*?)(<h2)|msi', $sContent, $aMatchs);

			preg_match_all('|<td>([^<]+)</td><td><div class="tab_tooltip"><span class="[^"]+">([^<]+)</span></div>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

			foreach ($aMatchs2 as $oOne) {

				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

				if ($oActor == false) {

					$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
					$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
					preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

					$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), null);
					$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
				}

				$oRecordHasProductor = new entityRecordHasProductor;

				$oRecordHasProductor->set_id_record($oRecordResult->get_id())
									->set_id_person($oActor->get_id())
									->set_role($oOne[1]);

				$this->modelRecordHasProductor->insert($oRecordHasProductor);
			}

			// Scénaristes

			preg_match('|<h2 class="tt_r22">Scénario</h2>(.*?)(<h2)|msi', $sContent, $aMatchs);

			preg_match_all('|<td>([^<]+)</td><td><div class="tab_tooltip"><span class="[^"]+">([^<]+)</span></div>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

			foreach ($aMatchs2 as $oOne) {

				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

				if ($oActor == false) {

					$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
					$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
					preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

					$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), null);
					$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
				}

				$oRecordHasScenariste = new entityRecordHasScreenwriter;

				$oRecordHasScenariste->set_id_record($oRecordResult->get_id())
									 ->set_id_person($oActor->get_id())
									 ->set_role($oOne[1]);

				$this->modelRecordHasScreenwriter->insert($oRecordHasScenariste);
			}

			// Equipe technique

			preg_match('|<h2 class="tt_r22">Equipe technique</h2>(.*?)(<h2)|msi', $sContent, $aMatchs);

			preg_match_all('|<td>([^<]+)</td><td><div class="tab_tooltip"><span class="[^"]+">([^<]+)</span></div>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

			foreach ($aMatchs2 as $oOne) {

				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

				if ($oActor == false) {

					$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
					$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
					preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

					$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), null);
					$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
				}

				if ($oOne[1] == 'Attachée de presse' || $oOne[1] == 'Attaché de presse') {

					$oRecordHasDistributor = new entityRecordHasDistributor;

					$oRecordHasDistributor->set_id_record($oRecordResult->get_id())
										  ->set_id_person($oActor->get_id())
										  ->set_role($oOne[1]);

					$this->modelRecordHasDistributor->insert($oRecordHasDistributor);
				}
				else {

					$oRecordHasTechnicalTeam = new entityRecordHasTechnicalTeam;

					$oRecordHasTechnicalTeam->set_id_record($oRecordResult->get_id())
											->set_id_person($oActor->get_id())
											->set_role($oOne[1]);

					$this->modelRecordHasTechnicalTeam->insert($oRecordHasTechnicalTeam);
				}
			}

			// Société

			preg_match('|<h2 class="tt_r22">Sociétés</h2>(.*?)(</div><!--/col_main-->)|msi', $sContent, $aMatchs);

			preg_match_all('|<td>([^<]+)</td><td><div class="tab_tooltip"><span class="[^"]+">([^<]+)</span></div>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

			foreach ($aMatchs2 as $oOne) {

				$oCompany = $this->modelCompany->findOneByname($oOne[2]);

				if (count($oCompany) < 1) {

					$oCompany = new entityCompany;

					$oCompany->set_name($oOne[2])
							 ->set_id_nationality(2);

					$this->modelCompany->insert($oCompany);

					$oCompany = $this->modelCompany->findOneByname($oOne[2]);
				}

				$oRecordHasCompany = new entityRecordHasCompany;

				$oRecordHasCompany->set_id_record($oRecordResult->get_id())
								  ->set_id_company($oCompany->get_id())
								  ->set_role($oOne[1]);

				$this->modelRecordHasCompany->insert($oRecordHasCompany);
			}

			$oUrlManager = new UrlManager;

			$this->redirect($this->url->getUrl('liste_une_fiche', ['id' => $oRecordResult->get_id()]));
		}
		else {

			$sUrl = 'http://www.allocine.fr/series/ficheserie_gen_cserie='.$iId.'.html';

			$oRecord = new entityRecord;
			$oRecord->set_created(date('Y-m-d H:i:s'));

			$sContent = file_get_contents($sUrl);
			$sContent = str_replace(["\n", "\r"], ['', ''], $sContent);

			preg_match('|<title>(.+) - Série TV ([0-9]+) - AlloCiné</title>|msi', $sContent, $aMatchs);
			$sTitle = $aMatchs[1];

			$oRecordResult = $this->modelRecord->findOneBytitle($sTitle);

			if (count($oRecordResult) < 1) {

				$oRecord->set_title($aMatchs[1])
						->set_production_date($aMatchs[2]);

				preg_match("|<span itemprop=\"datePublished\" content='([^']+)'>|msi", $sContent, $aMatchs);

				$oRecord->set_date_cinema($aMatchs[1]);

				preg_match('|<span class="star_info lighten">Nationalité</span><span class="[^"]+">(.+)</li>|msi', $sContent, $aMatchs);

				if ($aMatchs[1] == 'Américaine') { $aMatchs[1] = 'Américain'; }
				elseif ($aMatchs[1] == 'Française') { $aMatchs[1] = 'Français'; }

				$oNationality = $this->modelNationality->findOneByname(strip_tags($aMatchs[1]));

				if (count($oNationality) < 1) {

					$oNationality = $this->modelNationality->findOneByname('inconnu');
				}

				$oRecord->set_id_nationality($oNationality->get_id())
						->set_date_dvd('0000-00-00 00:00:00')
						->set_date_vod('0000-00-00 00:00:00')
						->set_date_bluray('0000-00-00 00:00:00')
						->set_visible('n')
						->set_type('serie');

				$this->modelRecord->insert($oRecord);
				$oRecordResult = $this->modelRecord->findOneBytitle($sTitle);
			}

			preg_match('|<a href="([^"]+)" id="[^"]+">Casting</a>|', $sContent, $aMatchs);

			$sUrl = 'http://www.allocine.fr'.$aMatchs[1];

			$sContent = file_get_contents($sUrl);
			$sContent = str_replace(["\n", "\r"], ['', ''], $sContent);

			preg_match('|<title>[^:]+: Casting de la saison ([0-9]+) - AlloCiné</title>|msi', $sContent, $aMatchs);
			$iSeason = $aMatchs[1];

			$this->_autoCreationBySeason($sContent, $iSeason, $oRecordResult);

			preg_match_all('|<Li><a href="(/series/ficheserie-[0-9]+/casting/saison-[0-9]+/)">Saison ([0-9]+)|msi', $sContent, $aMatchsSeason, PREG_SET_ORDER);

			foreach ($aMatchsSeason as $aOne) {

				$sContent = file_get_contents('http://www.allocine.fr'.$aOne[1]);
				$sContent = str_replace(["\n", "\r"], ['', ''], $sContent);
				$this->_autoCreationBySeason($sContent, $aOne[2], $oRecordResult);
			}

			$sUrl = 'http://www.allocine.fr/series/ficheserie-'.$iId.'/saisons/';
			$sContent = file_get_contents($sUrl);

			preg_match_all('| href="(/series/ficheserie\-[0-9]+/saison\-[0-9]+/)" |msi', $sContent, $aMatchsSeason, PREG_SET_ORDER);

			foreach ($aMatchsSeason as $aOne) {

				$sUrl = 'http://www.allocine.fr'.$aOne[1];
				$sContent2 = file_get_contents($sUrl);
				$sContent2 = str_replace(["\n", "\r"], ['', ''], $sContent2);

				preg_match_all('|<span itemprop="name">Saison ([0-9]+)</span>|msi', $sContent2, $aMatchsOneSeason, PREG_SET_ORDER);

				preg_match_all('|<strong[^>]*>Ep. ([0-9]+) *:* *</strong><span class="episode-title"[^>]*>([^<]+)</span>|msi', $sContent2, $aMatchsEpisode, PREG_SET_ORDER);

				foreach ($aMatchsEpisode as $aOne2) {

					$oRecordEpisode = new entityRecordEpisode;

					$oRecordEpisode->set_id_record($oRecordResult->get_id())
								   ->set_season($aMatchsOneSeason[0][1])
								   ->set_episode($aOne2[1]);

					if (count($this->modelRecordEpisode->get($oRecordEpisode)) > 0) {

						if ($this->modelRecordEpisode->get($oRecordEpisode)[0]->get_title() == '') {

							$oRecordEpisode->set_title($aOne2[2]);
							$this->modelRecordEpisode->update($oRecordEpisode);
						}
					}
					else {

						$oRecordEpisode->set_title($aOne2[2]);
						$this->modelRecordEpisode->insert($oRecordEpisode);
					}
				}

				preg_match_all('|<strong[^>]*>Ep. ([0-9]+) *:* *</strong><span class="episode-title"[^>]*>([^<]+)</span>|msi', $sContent2, $aMatchsEpisode, PREG_SET_ORDER);

				foreach ($aMatchsEpisode as $aOne2) {

					$oRecordEpisode = new entityRecordEpisode;

					$oRecordEpisode->set_id_record($oRecordResult->get_id())
								   ->set_season($aMatchsOneSeason[0][1])
								   ->set_episode($aOne2[1]);

					if (count($this->modelRecordEpisode->get($oRecordEpisode)) < 1) {

						$this->modelRecordEpisode->insert($oRecordEpisode);
					}
				}
			}

			$this->redirect($this->url->getUrl('liste_une_fiche', ['id' => $oRecordResult->get_id()]));
		}
	}

	/**
	 * auto creation of casting of one saeson
	 *
	 * @access public
	 * @param  string $sContent content
	 * @return void
	 */

	private function _autoCreationBySeason($sContent, $iSeason, $oRecordResult) {

		$oRecordEpisode = new entityRecordEpisode;
		$oRecordEpisode->set_id_record($oRecordResult->get_id())
					   ->set_season($iSeason)
					   ->set_episode(1);

		$this->modelRecordEpisode->insert($oRecordEpisode);

		// Réalisateurs

		preg_match('|<h2 class="tt_r22 Directors">Réalisateurs<span class="fs11 lighten">[^<]+</span></h2>(.*?)(<h2)|msi', $sContent, $aMatchs);

		preg_match_all('|<tr[^>]*><td>[^<]+</td><td></td><td><span class="[^"]+">([^<]+)</span></td><td>Ep.|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oRealisator = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) .+$/', '$1', $oOne[1]), 'name' => preg_replace('/^[^ ]+ (.+)$/', '$1', $oOne[1])]);

			if ($oRealisator == false) {

				$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[1]));
				$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
				preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

				$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) .+$/', '$1', $oOne[1]), preg_replace('/^[^ ]+ (.+)$/', '$1', $oOne[1]), null);
				$oRealisator = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) .+$/', '$1', $oOne[1]), 'name' => preg_replace('/^[^ ]+ (.+)$/', '$1', $oOne[1])]);
			}

			$oRecordHasRealisator = new entityRecordHasRealisator;

			$oRecordHasRealisator->set_id_record($oRecordResult->get_id())
								 ->set_id_person($oRealisator->get_id())
								 ->set_role('Réalisateur')
								 ->set_season($iSeason);

			$this->modelRecordHasRealisator->insert($oRecordHasRealisator);
		}

		// Acteurs

		preg_match('|<h2 class="tt_r22 Actors">Acteurs et actrices<span class="fs11 lighten">[^<]+</span></h2>(.*?)(<h2)|msi', $sContent, $aMatchs);

		preg_match_all('|<img src=\'([^\']+)\'itemprop="image"alt=\'([^\']+)\' title=\'[^\']+\' /></span><p><a href="([^"]+)" itemprop="url"><span itemprop="name">[^<]+</span></a><br/><span class="fs11 lighten">Rôle : ([^<]+)</span></p>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

			if ($oActor == false) {

				$this->controllerPerson->autoCreation($oOne[3], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), $oOne[1]);
				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
			}

			$oRecordHasActor = new entityRecordHasActor;

			$oRecordHasActor->set_id_record($oRecordResult->get_id())
							->set_id_person($oActor->get_id())
							->set_role($oOne[4])
							->set_season($iSeason);

			$this->modelRecordHasActor->insert($oRecordHasActor);
		}

		preg_match_all('|<img src=\'([^\']+)\'alt=\'([^\']+)\' title=\'[^\']+\' /></span><p><span class="[^"]+">[^<]+</span><br/><span class="fs11 lighten">Rôle : ([^<]+)</span></p>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

			if ($oActor === false) {

				$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
				$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
				preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

				$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), $oOne[1]);
				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
			}

			$oRecordHasActor = new entityRecordHasActor;

			$oRecordHasActor->set_id_record($oRecordResult->get_id())
							->set_id_person($oActor->get_id())
							->set_role($oOne[4])
							->set_season($iSeason);

			$this->modelRecordHasActor->insert($oRecordHasActor);
		}

		preg_match_all('|<tr[^>]*><td>([^<]+)</td><td></td><td><div class="tab_tooltip"itemprop="actor" itemscope itemtype="http://schema.org/Person"><a href="(/personne/fichepersonne_gen_cpersonne=[0-9]+.html)" itemprop="url"><span itemprop="name">([^<]+)</span></a>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[3]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[3])]);

			if ($oActor == false) {

				$this->controllerPerson->autoCreation($oOne[2], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[3]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[3]), null);
				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[3]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[3])]);
			}

			$oRecordHasActor = new entityRecordHasActor;

			$oRecordHasActor->set_id_record($oRecordResult->get_id())
							->set_id_person($oActor->get_id())
							->set_role($oOne[1])
							->set_season($iSeason);

			$this->modelRecordHasActor->insert($oRecordHasActor);
		}

		preg_match_all('|<tr[^>]*><td>([^<]+)</td><td></td><td><div class="tab_tooltip"><span class="[^"]+">([^<]+)</span>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

			if ($oActor == false) {

				$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
				$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
				preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

				$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), null);
				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
			}

			$oRecordHasActor = new entityRecordHasActor;

			$oRecordHasActor->set_id_record($oRecordResult->get_id())
							->set_id_person($oActor->get_id())
							->set_role($oOne[1])
							->set_season($iSeason);

			$this->modelRecordHasActor->insert($oRecordHasActor);
		}

		// Producteurs

		preg_match('|<h2 class="tt_r22 Producers">Product[ei][uo][rn]s*<span class="fs11 lighten">[^>]+</span></h2>(.*?)(<h2)|msi', $sContent, $aMatchs);

		preg_match_all('|<td>([^<]+)</td><td></td><td><span class="[^"]+">([^<]+)</span>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

			if ($oActor == false) {

				$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
				$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
				preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

				$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), null);
				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
			}

			$oRecordHasProductor = new entityRecordHasProductor;

			$oRecordHasProductor->set_id_record($oRecordResult->get_id())
								->set_id_person($oActor->get_id())
								->set_role($oOne[1])
								->set_season($iSeason);

			$this->modelRecordHasProductor->insert($oRecordHasProductor);
		}

		preg_match_all('|<td>([^<]+)</td><td class="padding_0"></td><td><div class="tab_tooltip"><span class="[^"]+">([^<]+)</span>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oCompany = $this->modelCompany->findOneByname($oOne[2]);

			if (count($oCompany) < 1) {

				$oCompany = new entityCompany;

				$oCompany->set_name($oOne[2])
						 ->set_id_nationality(2);

				$this->modelCompany->insert($oCompany);

				$oCompany = $this->modelCompany->findOneByname($oOne[2]);
			}

			$oRecordHasCompany = new entityRecordHasCompany;

			$oRecordHasCompany->set_id_record($oRecordResult->get_id())
							  ->set_id_company($oCompany->get_id())
							  ->set_role($oOne[1]);

			$this->modelRecordHasCompany->insert($oRecordHasCompany);
		}

		// Scénaristes

		preg_match('|<h2 class="tt_r22 Screenplay">Scénaristes<span class="fs11 lighten">[^<]+</span></h2>(.*?)(<h2)|msi', $sContent, $aMatchs);

		preg_match_all('|<td>([^<]+)</td><td></td><td><span class="[^"]+">([^<]+)</span></td>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

			if ($oActor == false) {

				$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
				$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
				preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

				$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), null);
				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
			}

			$oRecordHasScenariste = new entityRecordHasScreenwriter;

			$oRecordHasScenariste->set_id_record($oRecordResult->get_id())
								 ->set_id_person($oActor->get_id())
								 ->set_role($oOne[1])
								 ->set_season($iSeason);

			$this->modelRecordHasScreenwriter->insert($oRecordHasScenariste);
		}

		// Equipe technique

		preg_match('|<h2 class="tt_r22 Technical">Equipe technique<span class="fs11 lighten">[^<]+</span></h2>(.*?)(<h2)|msi', $sContent, $aMatchs);

		preg_match_all('|<td>([^<]+)</td><td></td><td><span class="[^"]+">([^<]+)</span></td>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

			if ($oActor == false) {

				$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
				$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
				preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSSearch, $aMatchSearch);

				$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), null);
				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
			}

			if ($oOne[1] == 'Attachée de presse' || $oOne[1] == 'Attaché de presse') {

				$oRecordHasDistributor = new entityRecordHasDistributor;

				$oRecordHasDistributor->set_id_record($oRecordResult->get_id())
									  ->set_id_person($oActor->get_id())
									  ->set_role($oOne[1])
									  ->set_season($iSeason);

				$this->modelRecordHasDistributor->insert($oRecordHasDistributor);
			}
			else {

				$oRecordHasTechnicalTeam = new entityRecordHasTechnicalTeam;

				$oRecordHasTechnicalTeam->set_id_record($oRecordResult->get_id())
									    ->set_id_person($oActor->get_id())
									    ->set_role($oOne[1])
									    ->set_season($iSeason);

				$this->modelRecordHasTechnicalTeam->insert($oRecordHasTechnicalTeam);
			}
		}

		// Autre métier

		preg_match('|<h2 class="tt_r22 Other">Autre métier<span class="fs11 lighten">[^<]+</span></h2>(.*?)(</table)|msi', $sContent, $aMatchs);

		preg_match_all('|<td>([^<]+)</td><td></td><td><span class="[^"]+">([^<]+)</span></td>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

			if ($oActor == false) {

				$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
				$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
				preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

				$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), null);
				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
			}

			if ($oOne[1] == 'Attachée de presse' || $oOne[1] == 'Attaché de presse') {

				$oRecordHasDistributor = new entityRecordHasDistributor;

				$oRecordHasDistributor->set_id_record($oRecordResult->get_id())
									  ->set_id_person($oActor->get_id())
									  ->set_role($oOne[1])
									  ->set_season($iSeason);

				$this->modelRecordHasDistributor->insert($oRecordHasDistributor);
			}
			else {

				$oRecordHasTechnicalTeam = new entityRecordHasTechnicalTeam;

				$oRecordHasTechnicalTeam->set_id_record($oRecordResult->get_id())
									  ->set_id_person($oActor->get_id())
									  ->set_role($oOne[1])
									  ->set_season($iSeason);

				$this->modelRecordHasTechnicalTeam->insert($oRecordHasTechnicalTeam);
			}
		}

		// Créateur & Showrunner

		preg_match('|<h2 class="tt_r22 Creator">Créateur & Showrunner<span class="fs11 lighten">[^<]+</span></h2>(.*?)(<h2)|msi', $sContent, $aMatchs);

		preg_match_all('|<img src=\'([^\']+)\'alt=\'([^\']+)\' title=\'[^\']+\' /></span><p><span class="[^"]+>[^<]+</span><br/><span>([^<]+)</span></p>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

			if ($oActor == false) {

				$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
				$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
				preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

				$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), null);
				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
			}

			$oRecordHasCreator = new entityRecordHasCreator;

			$oRecordHasCreator->set_id_record($oRecordResult->get_id())
							  ->set_id_person($oActor->get_id())
							  ->set_role($oOne[1])
							  ->set_season($iSeason);

			$this->modelRecordHasCreator->insert($oRecordHasCreator);
		}

		preg_match_all('|<img src=\'([^\']+)\'itemprop="image"alt=\'([^\']+)\' title=\'[^\']+\' /></span><p><a href="([^"]+)" itemprop="url"><span itemprop="name">[^<]+</span></a><br/><span>([^<]+)</span></p>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

			if ($oActor == false) {

				$this->controllerPerson->autoCreation($oOne[3], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), $oOne[1]);
				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
			}

			$oRecordHasCreator = new entityRecordHasCreator;

			$oRecordHasCreator->set_id_record($oRecordResult->get_id())
							  ->set_id_person($oActor->get_id())
							  ->set_role($oOne[4])
							  ->set_season($iSeason);

			$this->modelRecordHasCreator->insert($oRecordHasCreator);
		}

		preg_match_all('|<img src=\'([^\']+)\'alt=\'([^\']+)\' title=\'[^\']+\' /></span><p><a href="([^"]+)" itemprop="url"><span itemprop="name">[^<]+</span></a><br/><span>([^<]+)</span></p>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

			if ($oActor === false) {

				$this->controllerPerson->autoCreation($oOne[3], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), $oOne[1]);
				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
			}

			$oRecordHasCreator = new entityRecordHasCreator;

			$oRecordHasCreator->set_id_record($oRecordResult->get_id())
							  ->set_id_person($oActor->get_id())
							  ->set_role($oOne[4])
							  ->set_season($iSeason);

			$this->modelRecordHasCreator->insert($oRecordHasCreator);
		}

		preg_match_all('|<img src=\'([^\']+)\'alt=\'([^\']+)\' title=\'[^\']+\' /></span><p><span class="[^"]+">[^<]+</span><br/><span>([^<]+)</span></p>|', $aMatchs[1], $aMatchs2, PREG_SET_ORDER);

		foreach ($aMatchs2 as $oOne) {

			$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);

			if ($oActor == false) {

				$sContentSearch = file_get_contents('http://www.allocine.fr/recherche/?q='.str_replace(' ','+',$oOne[2]));
				$sContentSearch = str_replace(["\n", "\r"], ['', ''], $sContentSearch);
				preg_match('|(/personne/fichepersonne_gen_cpersonne=[0-9]+\.html)|msi', $sContentSearch, $aMatchSearch);

				$this->controllerPerson->autoCreation($aMatchSearch[1], preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2]), $oOne[1]);
				$oActor = $this->modelPerson->findOneBy(['firstname' => preg_replace('/^([^ ]+) *.*$/', '$1', $oOne[2]), 'name' => preg_replace('/^[^ ]+ *(.*)$/', '$1', $oOne[2])]);
			}

			$oRecordHasCreator = new entityRecordHasCreator;

			$oRecordHasCreator->set_id_record($oRecordResult->get_id())
							  ->set_id_person($oActor->get_id())
							  ->set_role($oOne[4])
							  ->set_season($iSeason);

			$this->modelRecordHasCreator->insert($oRecordHasCreator);
		}
	}

	/**
	 * the list of record
	 *
	 * @access public
	 * @param  string $sTotalName
	 * @return void
	 */

	public function ajaxListFilms($sTotalName) {

		$sTotalName = urldecode($sTotalName);

		$sContentToReturn = array();
		$aRecord = $this->modelRecord->getRecordForAutocomplete($sTotalName);
		$i = 0;

		foreach ($aRecord as $iKey => $oRecord) {

			$sContentToReturn[$i] = array();
			$sContentToReturn[$i]['id'] = $oRecord->get_id();
			$sContentToReturn[$i]['title'] = addslashes($oRecord->get_title());
			$i++;
		}

		return json_encode($sContentToReturn);
	}
	/**
	 * add alias for a record
	 *
	 * @access public
	 * @return void
	 */

	public function addAlias() {

		if (isset($_POST) && count($_POST)) {

			$oRecordAlias = new entityRecordAlias;

			$oRecordAlias->set_alias($_POST['alias'])
						 ->set_id_record($_POST['id_person']);

			$iIdPerson = $this->modelRecordAlias->insert($oRecordAlias);

			$aRecords = $this->modelRecord->getRecordByAlias($_POST['alias']);

			if (count($aRecords) > 0) {

				foreach ($aRecords as $oOne) {

					$aToTransform = $this->modelArticleHasRecord->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelArticleHasRecord->update($aOneTransform);
					}

					$aToTransform = $this->modelCritic->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelCritic->update($aOneTransform);
					}

					$aToTransform = $this->modelPhotoHasPerson->findByid_person($oOne->get_id());


					$aToTransform = $this->modelLikeMovie->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelLikeMovie->update($aOneTransform);
					}

					$aToTransform = $this->modelPhoto->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelPhoto->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasActor->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelRecordHasActor->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasCompany->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelRecordHasCompany->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasCreator->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelRecordHasCreator->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasDistributor->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelRecordHasDistributor->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasTechnicalTeam->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelRecordHasTechnicalTeam->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasKind->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelRecordHasKind->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasProductor->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelRecordHasProductor->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasEpisode->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelRecordHasEpisode->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasRealisator->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelRecordHasRealisator->update($aOneTransform);
					}

					$aToTransform = $this->modelRecordHasScreenwriter->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelRecordHasScreenwriter->update($aOneTransform);
					}

					$aToTransform = $this->modelStory->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelStory->update($aOneTransform);
					}

					$aToTransform = $this->modelTrailer->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelTrailer->update($aOneTransform);
					}

					$aToTransform = $this->modelProgramOnGrid->findByid_record($oOne->get_id());

					foreach ($aToTransform as $aOneTransform) {

						$aOneTransform->set_id_record($_POST['id_record']);
						$this->modelProgramOnGrid->update($aOneTransform);
					}

					$this->modelRecord->delete($oOne);
				}
			}

			$this->layout
			->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAddConfirm.tpl')
			->display();
		}
		else {

			$this->layout
			->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAliasAdd.tpl')
			->display();
		}
	}
}


<?php

/**
 * Controller to Actor
 *
 * @category  	src
 * @package   	src\FrontOffice\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\FrontOffice\Controller;

use \Venus\core\Controller as Controller;
use \Venus\core\UrlManager as UrlManager;
use \Venus\lib\Date as Date;
use \Venus\src\FrontOffice\Entity\like_person as entityLikePerson;
use \Venus\src\FrontOffice\Controller\Article as controllerArticle;
use \Venus\src\FrontOffice\Controller\Record as controllerRecord;
use \Venus\src\FrontOffice\Model\person as modelActor;
use \Venus\src\FrontOffice\Model\like_person as modelLikePerson;
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Model\record_has_realisator as modelRecordHasRealisator;
use \Venus\src\FrontOffice\Model\record_has_actor as modelRecordHasActor;
use \Venus\src\FrontOffice\Model\record_has_productor as modelRecordHasProductor;
use \Venus\src\FrontOffice\Model\record_has_screenwriter as modelRecordHasScreenwriters;
use \Venus\src\FrontOffice\Model\record_has_technical_team as modelRecordHasTechnicalTeam;
use \Venus\src\FrontOffice\Model\record_has_distributor as modelRecordHasDistributors;
use \Venus\src\FrontOffice\Model\record_has_company as modelRecordHasCompanies;
use \Venus\src\FrontOffice\Model\record_has_creator as modelRecordHasCreators;
use \Venus\src\FrontOffice\Model\nationality as modelNationality;
use \Venus\src\FrontOffice\Model\trailer as modelTrailer;
use \Venus\src\FrontOffice\Model\person as modelPerson;
use \Venus\src\FrontOffice\Model\photo as modelPhoto;

/**
 * Controller to Actor
 *
 * @category  	src
 * @package   	src\FrontOffice\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class Actor extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->controllerArticle = function() { return new controllerArticle; };
		$this->modelActor = function() { return new modelActor; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->controllerRecord = function() { return new controllerRecord; };
		$this->modelRecordHasRealisator = function() { return new modelRecordHasRealisator; };
		$this->modelRecordHasActor = function() { return new modelRecordHasActor; };
		$this->modelRecordHasProductor = function() { return new modelRecordHasProductor; };
		$this->modelRecordHasScreenwriters = function() { return new modelRecordHasScreenwriters; };
		$this->modelRecordHasTechnicalTeam = function() { return new modelRecordHasTechnicalTeam; };
		$this->modelRecordHasDistributors = function() { return new modelRecordHasDistributors; };
		$this->modelRecordHasCompanies = function() { return new modelRecordHasCompanies; };
		$this->modelRecordHasCreators = function() { return new modelRecordHasCreators; };
		$this->modelNationality = function() { return new modelNationality; };
		$this->modelTrailer = function() { return new modelTrailer; };
		$this->modelTopSearch = function() { return new modelTopSearch; };
		$this->modelPerson = function() { return new modelPerson; };
		$this->modelLikePerson = function() { return new modelLikePerson; };
		$this->modelPhoto = function() { return new modelPhoto; };

		parent::__construct();

		$aSearch = $this->modelTopSearch->getTop(5);
		$sSearch = '';

		foreach ($aSearch as $oSearch) {

			$sSearch .= ' &nbsp;&nbsp; <a href="'.$this->url->getUrl('recherche', array('word' => $oSearch->get_word())).'" style="color:white">'.$oSearch->get_word().'</a> ';
		}

		$this->layout->assign('word_to_search', $sSearch);
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showOne($iId) {

		if (isset($_POST) && isset($_POST['like'])) {

			if ($this->session->get('userid')) { $sIp = ''; }
			else { $sIp = $_SERVER['REMOTE_ADDR']; }

			$oLikeMovie = new entityLikePerson;

			$oLikeMovie->set_id_person($iId)
					   ->set_id_user($this->session->get('userid'))
					   ->set_ip($sIp);

			$this->modelLikePerson->insert($oLikeMovie);

			file_get_contents('http://www.iscreenway.com/'.$_SERVER['REQUEST_URI'].'?flush=1');
		}

		$oActor = $this->modelActor->findOneByid($iId);
		$aMenus = $this->getActorMenu($iId);
		$aLastMoviesByRecord = $this->modelRecord->getLastMoviesByRecord($iId);
		$aLastMoviesByRecord = $this->controllerRecord->getExtendedInfos($aLastMoviesByRecord);
		$oUrlManager = new UrlManager();

		$oActor->age = Date::getAgeByDate($oActor->get_birthday());

		$oActor->set_birthday(preg_replace('/([0-9]{4})-([0-9]{2})-([0-9]{2})/' , '$3/$2/$1', $oActor->get_birthday()));

		if ($oActor->get_id_nationality() < 1) { $oActor->set_id_nationality(18); }

		$oActor->nationality = $this->modelNationality->findOneByid($oActor->get_id_nationality());

		$aJobs = $this->modelActor->getJobs($iId);
		$sJob = '';

		foreach ($aJobs as $aOne) {

			$sJob .= '<a href="'.$this->url->getUrl('acteur-filmography', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))).'#'.$aOne.'">'.$aOne.'</a>, ';
		}

		if (strlen($sJob) > 1) { $sJob = substr($sJob, 0, -2); }

		$oActor->jobs = $sJob;

		$aNews = $this->controllerArticle->getLastNewsByDayByPerson($iId);

		$aIds = array(0);

		foreach ($aLastMoviesByRecord as $oOne) {

			$aIds[] = $oOne->get_id();
		}

		$aTrailers = $this->modelTrailer->getLastsTrailerByRecordIds(implode(',', $aIds));

		if ($aTrailers[0]->count > 0) {

			foreach ($aTrailers as $iKey => $oTrailer) {

				$oRecord = $this->modelRecord->findOneByid($oTrailer->get_id_record());
				$aTrailers[$iKey]->url = $this->url->getUrl('bande-annonce-detail', array('id' => $oTrailer->get_id(), 'title' => $this->url->encodeToUrl($oTrailer->get_title()), 'id_record' => $oTrailer->get_id_record(), 'title_record' => $this->url->encodeToUrl($oRecord)));
			}
		}
		else {

			$aTrailers = array();
		}

		$iCountLike = count($this->modelLikePerson->findByid_person($oActor->get_id()));

		$this->layout
			 ->assign('tpl_actor_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorMenu.tpl')
			 ->assign('tpl_one_movie2', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie2.tpl')
			 ->assign('tpl_last_trailers', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'TrailersLast.tpl')
			 ->assign('actor_menu', $aMenus)
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorOne.tpl')
			 ->assign('title', ''.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez la biographie de '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->assign('url_img', 'person_'.$oActor->get_id().'.jpg')
			 ->assign('movies', $aLastMoviesByRecord)
			 ->assign('news', $aNews)
			 ->assign('like', $iCountLike)
			 ->assign('last_trailers', $aTrailers)
			 ->assign('menu_select', 1)
			 ->assign('url_star', $this->url->getUrl('acteur-detail', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showBiography($iId) {

		$oActor = $this->modelActor->findOneByid($iId);
		$aMenus = $this->getActorMenu($iId);
		$oUrlManager = new UrlManager();

		if (preg_match('|/acteur/biographie/|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('acteur-biography', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))));
			exit;
		}

		$oActor->age = Date::getAgeByDate($oActor->get_birthday());
		$oActor->set_birthday(preg_replace('/([0-9]{4})-([0-9]{2})-([0-9]{2})/' , '$3/$2/$1', $oActor->get_birthday()));

		if ($oActor->get_id_nationality() < 1) { $oActor->set_id_nationality(18); }

		$oActor->nationality = $this->modelNationality->findOneByid($oActor->get_id_nationality());

		$aJobs = $this->modelActor->getJobs($iId);
		$sJob = '';

		foreach ($aJobs as $aOne) {

			$sJob .= '<a href="'.$this->url->getUrl('acteur-filmography', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))).'#'.$aOne.'">'.$aOne.'</a>, ';
		}

		if (strlen($sJob) > 1) { substr($sJob, 0, -2); }

		$oActor->jobs = $sJob;

		$oActor->nb_actor = count($this->modelRecordHasActor->findOneByid_person($iId));
		$oActor->nb_productor = count($this->modelRecordHasProductor->findOneByid_person($iId)) + count($this->modelRecordHasRealisator->findOneByid_person($iId));

		$this->layout
			 ->assign('tpl_actor_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorMenu.tpl')
			 ->assign('actor_menu', $aMenus)
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorBiography.tpl')
			 ->assign('title', 'Biographie de '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez la biographie de '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->assign('menu_select', 2)
			 ->assign('url_img', 'person_'.$oActor->get_id().'.jpg')
			 ->assign('url_star', $this->url->getUrl('acteur-detail', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->assign('url_biography', $this->url->getUrl('acteur-biography', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showFilmography($iId) {

		$oActor = $this->modelActor->findOneByid($iId);
		$aMenus = $this->getActorMenu($iId);
		$oUrlManager = new UrlManager();

		if (preg_match('|/acteur/filmographie/|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('acteur-filmography', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))));
			exit;
		}

		$aRolesInActors = $this->modelRecordHasActor->getRecordByPersonId($iId);

		foreach ($aRolesInActors as $iKey => $oActor2) {

			if ($oActor2->record->get_type() == 'serie') { $sBase = 'series/liste'; }
			else { $sBase = 'cinema/film'; }

			$aRolesInActors[$iKey]->url = $this->url->getUrl('fiche-detail', array('id' => $oActor2->record->get_id(), 'title' => $this->url->encodeToUrl($oActor2->record->get_title()), 'base' => $sBase));
		}

		$aRolesInCreators = $this->modelRecordHasCreators->getRecordByPersonId($iId);

		foreach ($aRolesInCreators as $iKey => $oActor2) {

			if ($oActor2->record->get_type() == 'serie') { $sBase = 'series/liste'; }
			else { $sBase = 'cinema/film'; }

			$aRolesInCreators[$iKey]->url = $this->url->getUrl('fiche-detail', array('id' => $oActor2->record->get_id(), 'title' => $this->url->encodeToUrl($oActor2->record->get_title()), 'base' => $sBase));
		}

		$aRolesInRealisators = $this->modelRecordHasRealisator->getRecordByPersonId($iId);

		foreach ($aRolesInRealisators as $iKey => $oActor2) {

			if ($oActor2->record->get_type() == 'serie') { $sBase = 'series/liste'; }
			else { $sBase = 'cinema/film'; }

			$aRolesInRealisators[$iKey]->url = $this->url->getUrl('fiche-detail', array('id' => $oActor2->record->get_id(), 'title' => $this->url->encodeToUrl($oActor2->record->get_title()), 'base' => $sBase));
		}

		$aRolesInProductors = $this->modelRecordHasProductor->getRecordByPersonId($iId);

		foreach ($aRolesInProductors as $iKey => $oActor2) {

			if ($oActor2->record->get_type() == 'serie') { $sBase = 'series/liste'; }
			else { $sBase = 'cinema/film'; }

			$aRolesInProductors[$iKey]->url = $this->url->getUrl('fiche-detail', array('id' => $oActor2->record->get_id(), 'title' => $this->url->encodeToUrl($oActor2->record->get_title()), 'base' => $sBase));
		}

		$aRolesInDistributors = $this->modelRecordHasDistributors->getRecordByPersonId($iId);

		foreach ($aRolesInDistributors as $iKey => $oActor2) {

			if ($oActor2->record->get_type() == 'serie') { $sBase = 'series/liste'; }
			else { $sBase = 'cinema/film'; }

			$aRolesInDistributors[$iKey]->url = $this->url->getUrl('fiche-detail', array('id' => $oActor2->record->get_id(), 'title' => $this->url->encodeToUrl($oActor2->record->get_title()), 'base' => $sBase));
		}

		$aRolesInTechnicalTeam = $this->modelRecordHasTechnicalTeam->getRecordByPersonId($iId);

		foreach ($aRolesInTechnicalTeam as $iKey => $oActor2) {

			if ($oActor2->record->get_type() == 'serie') { $sBase = 'series/liste'; }
			else { $sBase = 'cinema/film'; }

			$aRolesInTechnicalTeam[$iKey]->url = $this->url->getUrl('fiche-detail', array('id' => $oActor2->record->get_id(), 'title' => $this->url->encodeToUrl($oActor2->record->get_title()), 'base' => $sBase));
		}


		$this->layout
			 ->assign('tpl_actor_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorMenu.tpl')
			 ->assign('actor_menu', $aMenus)
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorFilmography.tpl')
			 ->assign('title', 'Filmographie de '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez la filmographie de '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actors', $aRolesInActors)
			 ->assign('creators', $aRolesInCreators)
			 ->assign('realisators', $aRolesInRealisators)
			 ->assign('productors', $aRolesInProductors)
			 ->assign('distributors', $aRolesInDistributors)
			 ->assign('technical_team', $aRolesInTechnicalTeam)
			 ->assign('actor', $oActor)
			 ->assign('menu_select', 3)
			 ->assign('url_star', $this->url->getUrl('acteur-detail', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->assign('url_filmography', $this->url->getUrl('acteur-filmography', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showPhoto($iId) {

		$oActor = $this->modelActor->findOneByid($iId);
		$aMenus = $this->getActorMenu($iId);

		if (preg_match('|/acteur/photos/|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('acteur-photos', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))));
			exit;
		}

		$aPhotos = $this->modelPhoto->getPhotoByIdPerson($iId, 1);

		if ($aPhotos[0]->count > 0) {

			foreach ($aPhotos as $iKey => $oPhoto) {

				$aPhotos[$iKey]->url = $this->url->getUrl('une-photos', array('id' => $oPhoto->get_id(), 'title' => $this->url->encodeToUrl($oPhoto->get_title())));
			}
		}

		$this->layout
			 ->assign('tpl_actor_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorMenu.tpl')
			 ->assign('actor_menu', $aMenus)
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorPhotos.tpl')
			 ->assign('title', 'Photos de '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez les photos de '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->assign('menu_select', 4)
			 ->assign('photos', $aPhotos)
			 ->assign('url_star', $this->url->getUrl('acteur-detail', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->assign('url_photo', $this->url->getUrl('acteur-photos', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showReward($iId) {

		$oActor = $this->modelActor->findOneByid($iId);
		$aMenus = $this->getActorMenu($iId);

		if (preg_match('|/acteur/recompenses/|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('acteur-recompenses', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))));
			exit;
		}

		$this->layout
			 ->assign('tpl_actor_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorMenu.tpl')
			 ->assign('actor_menu', $aMenus)
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorReward.tpl')
			 ->assign('title', 'Récompenses de '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez les récompenses obtenues par '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->assign('menu_select', 5)
			 ->assign('url_star', $this->url->getUrl('acteur-detail', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->assign('url_reward', $this->url->getUrl('acteur-recompenses', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showNews($iId) {

		$oActor = $this->modelActor->findOneByid($iId);

		if (count($oActor) < 1) {

			$this->redirect($this->url->getUrl('home', array()));
			exit;
		}

		$aMenus = $this->getActorMenu($iId);

		if (preg_match('|/acteur/actualites/|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('acteur-news', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))));
			exit;
		}

		$aNews = $this->controllerArticle->getLastNewsByDayByPerson($iId, 10);

		$this->layout
			 ->assign('tpl_actor_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorMenu.tpl')
			 ->assign('actor_menu', $aMenus)
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorNews.tpl')
			 ->assign('title', 'Actualités sur '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez les actualités sur '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->assign('news', $aNews)
			 ->assign('menu_select', 6)
			 ->assign('url_star', $this->url->getUrl('acteur-detail', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->assign('url_news', $this->url->getUrl('acteur-news', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showVideos($iId) {

		$oActor = $this->modelActor->findOneByid($iId);
		$aMenus = $this->getActorMenu($iId);
		$aLastMoviesByRecord = $this->modelRecord->getLastMoviesByRecord($iId);
		$oUrlManager = new UrlManager;

		if (preg_match('|/acteur/videos/|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('acteur-videos', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))));
			exit;
		}

		$aIds = array();

		foreach ($aLastMoviesByRecord as $oOne) {

			$aIds[] = $oOne->get_id();
		}

		if (implode(',', $aIds)) {

			$aTrailers = $this->modelTrailer->getLastsTrailerByRecordIds(implode(',', $aIds));
		}
		else {

			$aTrailers = array();
			$aTrailers[0] = new \StdClass;
			$aTrailers[0]->count = 0;
		}

		if ($aTrailers[0]->count > 0) {

			foreach ($aTrailers as $iKey => $oTrailer) {

				$oRecord = $this->modelRecord->findOneByid($oTrailer->get_id_record());
				$aTrailers[$iKey]->url = $this->url->getUrl('bande-annonce-detail', array('id' => $oTrailer->get_id(), 'title' => $this->url->encodeToUrl($oTrailer->get_title()), 'id_record' => $oTrailer->get_id_record(), 'title_record' => $this->url->encodeToUrl($oRecord)));
			}
		}
		else {

			$aTrailers = array();
		}

		$this->layout
			 ->assign('tpl_actor_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorMenu.tpl')
			 ->assign('actor_menu', $aMenus)
			 ->assign('tpl_last_trailers', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'TrailersLast.tpl')
			 ->assign('last_trailers', $aTrailers)
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorVideos.tpl')
			 ->assign('title', 'Vidéos sur '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez les vidéos sur '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->assign('menu_select', 8)
			 ->assign('url_star', $this->url->getUrl('acteur-detail', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->assign('url_video', $this->url->getUrl('acteur-videos', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showDvd($iId) {

		$oActor = $this->modelActor->findOneByid($iId);
		$aMenus = $this->getActorMenu($iId);

		if (preg_match('|/acteur/dvd/|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('acteur-dvd', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))));
			exit;
		}

		$this->layout
			 ->assign('tpl_actor_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorMenu.tpl')
			 ->assign('actor_menu', $aMenus)
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorDvd.tpl')
			 ->assign('title', 'Dvd et Bluray avec '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez les Dvd et Bluray avec '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->assign('menu_select', 9)
			 ->assign('url_star', $this->url->getUrl('acteur-detail', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->assign('url_dvd', $this->url->getUrl('acteur-dvd', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()))))
			 ->display();
	}

	/**
	 * the main page of folders
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function show($iOffset = 0) {

		$aActors = $this->modelPerson->getActorsList(20, $iOffset * 20);

		foreach ($aActors as $iKey => $oActor) {

			$aActors[$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name())));
		}

		if ($iOffset == 0) { $iOffset = ''; }

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Actor.tpl')
			 ->assign('title', 'Tous les acteurs '.$iOffset.' - iScreenway')
			 ->assign('description', 'Découvrez tous les acteurs et stars avec leur fiche complète : biographie, vidéo, actualités '.$iOffset)
			 ->assign('actors', $aActors)
			 ->display();
	}

	/**
	 * the main page of news for one movie
	 *
	 * @access public
	 * @param  int $iId id
	 * @param  string $sTitle title
	 * @return void
	 */

	public function showByRecord($iId, $sTitle) {

		$oRecord = $this->modelRecord->findOneById($iId);

		if ($oRecord->get_type() == 'serie') {

			$this->layout->assign('category', 'series');
			$sBase = 'series/liste';
		}
		else {

			$this->layout->assign('category', 'cinema');
			$sBase = 'cinema/film';
		}

		if ($oRecord->get_type() == 'serie' && preg_match('|cinema/film|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('casting', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste')));
			exit;
		}
		else if (preg_match('|film/acteur|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('casting', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)));
			exit;
		}

		$aRealisators = $this->modelRecordHasRealisator->getRealisatorsByRecordId($iId);
		$aActors = $this->modelRecordHasActor->getActorsByRecordId($iId);
		$aProductors = $this->modelRecordHasProductor->getProductorsByRecordId($iId);
		$aScreenwriters = $this->modelRecordHasScreenwriters->getScreenwritersByRecordId($iId);
		$aTechnicalTeam = $this->modelRecordHasTechnicalTeam->getTechnicalTeamByRecordId($iId);
		$aDistributors = $this->modelRecordHasDistributors->getDistributorsByRecordId($iId);
		$aCompanies = $this->modelRecordHasCompanies->getCompaniesByRecordId($iId);
		$aCreators = $this->modelRecordHasCreators->getCreatorsByRecordId($iId);
		$aMenus = $this->controllerRecord->getRecordMenu($iId);
		$oUrlManager = new UrlManager;

		foreach ($aActors as $iKey => $oActor) {

			$aActors[$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
		}

		foreach ($aRealisators as $iKey => $oActor) {

			$aRealisators[$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
		}

		foreach ($aProductors as $iKey => $oActor) {

			$aProductors[$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
		}

		foreach ($aScreenwriters as $iKey => $oActor) {

			$aScreenwriters[$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
		}

		foreach ($aTechnicalTeam as $iKey => $oActor) {

			$aTechnicalTeam[$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
		}

		foreach ($aDistributors as $iKey => $oActor) {

			$aDistributors[$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
		}

		foreach ($aCompanies as $iKey => $oActor) {

			$aCompanies[$iKey]->url = $this->url->getUrl('distributeur-detail', array('id' => $oActor->company->get_id(), 'title' => $this->url->encodeToUrl($oActor->company->get_name())));
		}

		foreach ($aCreators as $iKey => $oActor) {

			$aCreators[$iKey]->url = $this->url->getUrl('distributeur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_name())));
		}

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ActorByRecord.tpl')
			 ->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordMenu.tpl')
			 ->assign('record_menu', $aMenus)
			 ->assign('title', 'Le casting complet de '.$oRecord->get_title().'  - iScreenway')
			 ->assign('description', 'Découvrez le casting complet de '.$oRecord->get_title().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('record', $oRecord)
			 ->assign('actors', $aActors)
			 ->assign('realisators', $aRealisators)
			 ->assign('productors', $aProductors)
			 ->assign('screenwriters', $aScreenwriters)
			 ->assign('technical_team', $aTechnicalTeam)
			 ->assign('distributors', $aDistributors)
			 ->assign('companies', $aCompanies)
			 ->assign('creators', $aCreators)
			 ->assign('menu_select', 4)
			 ->assign('url_film', $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->assign('url_film_casting', $this->url->getUrl('casting', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->display();
	}

	/**
	 * get menu configuration for one record
	 *
	 * @access public
	 * @param  int $iId id of Record
	 * @return array
	 */

	public function getActorMenu($iId) {

		$aMenus = array();
		$oUrlManager = new UrlManager;

		$oActor = $this->modelActor->findOneByid($iId);



		if (count($oActor) < 1) {

			$this->redirect($this->url->getUrl('home', array()));
			exit;
		}

		$aMenus['fiche'] = $this->url->getUrl('acteur-detail', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name())));
		$aMenus['biography'] = $this->url->getUrl('acteur-biography', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name())));
		$aMenus['filmographie'] = $this->url->getUrl('acteur-filmography', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name())));
		$aMenus['critique'] = '#';
		//$aMenus['critique'] = $this->url->getUrl('critique-film', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name())));

		$aPhotos = $this->modelPhoto->getPhotoByIdPerson($iId, 1);

		if ($aPhotos[0]->count > 0) {

			$aMenus['photos'] = $this->url->getUrl('acteur-photos', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name())));
		}
		else {

			$aMenus['photos'] = '';
		}

		$aMenus['recompenses'] = $this->url->getUrl('acteur-recompenses', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name())));

		$aNews = $this->controllerArticle->getLastNewsByDayByPerson($iId, 1);

		if ($aNews[0]->count > 0) {

			$aMenus['news'] = $this->url->getUrl('acteur-news', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name())));
		}
		else {

			$aMenus['news'] = '';
		}

		$aLastMoviesByRecord = $this->modelRecord->getLastMoviesByRecord($iId);

		if (count($aLastMoviesByRecord) > 0) {

			$aMenus['videos'] = $this->url->getUrl('acteur-videos', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name())));
		}
		else {

			$aMenus['videos'] = '';
		}

		$aMenus['dvd'] = $this->url->getUrl('acteur-dvd', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name())));

		return $aMenus;
	}

}

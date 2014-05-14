<?php

/**
 * Controller to test
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

namespace Venus\src\WebSite\Controller;

use \Venus\core\Controller as Controller;
use \Venus\lib\Date as Date;
use \Venus\src\WebSite\Business\article as businessArticle;
use \Venus\src\WebSite\Business\record as businessRecord;
use \Venus\src\WebSite\Business\trailer as businessTrailer;
use \Venus\src\WebSite\Entity\like_person as entityLikePerson;
use \Venus\src\WebSite\Model\person as modelActor;
use \Venus\src\WebSite\Model\article as modelArticle;
use \Venus\src\WebSite\Model\nationality as modelNationality;
use \Venus\src\WebSite\Model\photo as modelPhoto;
use \Venus\src\WebSite\Model\record as modelRecord;
use \Venus\src\WebSite\Model\trailer as modelTrailer;
use \Venus\src\WebSite\Model\like_person as modelLikePerson;
use \Venus\src\WebSite\Model\record_has_actor as modelRecordHasActor;
use \Venus\src\WebSite\Model\record_has_productor as modelRecordHasProductor;
use \Venus\src\WebSite\Model\record_has_realisator as modelRecordHasRealisator;
use \Venus\src\WebSite\Model\record_has_creator as modelRecordHasCreators;
use \Venus\src\WebSite\Model\record_has_distributor as modelRecordHasDistributors;
use \Venus\src\WebSite\Model\record_has_technical_team as modelRecordHasTechnicalTeam;

/**
 * Controller to test
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

		$this->businessArticle = function() { return new businessArticle; };
		$this->businessRecord = function() { return new businessRecord; };
		$this->businessTrailer = function() { return new businessTrailer; };
		$this->modelActor = function() { return new modelActor; };
		$this->modelArticle = function() { return new modelArticle; };
		$this->modelNationality = function() { return new modelNationality; };
		$this->modelPhoto = function() { return new modelPhoto; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelTrailer = function() { return new modelTrailer; };
		$this->modelLikePerson = function() { return new modelLikePerson; };
		$this->modelRecordHasActor = function() { return new modelRecordHasActor; };
		$this->modelRecordHasProductor = function() { return new modelRecordHasProductor; };
		$this->modelRecordHasRealisator = function() { return new modelRecordHasRealisator; };
		$this->modelRecordHasCreators = function() { return new modelRecordHasCreators; };
		$this->modelRecordHasDistributors = function() { return new modelRecordHasDistributors; };
		$this->modelRecordHasTechnicalTeam = function() { return new modelRecordHasTechnicalTeam; };

		parent::__construct();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iId id
	 * @param  string $sTitle
	 * @param  string $sType
	 * @return void
	 */

	public function show($iId, $sTitle) {

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
		$oActor = $this->_getTotalInfo($oActor);

		$aLastMoviesByRecord = $this->modelRecord->getLastMoviesByActor($iId);

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

		$aNews = $this->businessArticle->getLastNewsByDayByPerson($iId);

		$aIds = array(0);
		$aLastMoviesByRecord = $this->businessRecord->getExtendedInfos($aLastMoviesByRecord);

		foreach ($aLastMoviesByRecord as $iKey => $oOne) {

			$aIds[] = $oOne->get_id();
		}

		$aTrailers = $this->modelTrailer->getLastsTrailerByRecordIds(implode(',', $aIds));

		if ($aTrailers['count'] > 0) {

			foreach ($aTrailers['items'] as $iKey => $oTrailer) {

				$oRecord = $this->modelRecord->findOneByid($oTrailer->get_id_record());
				$oRecord->base = $this->businessRecord->getTypeForUrl($oRecord->get_type());
				$aTrailers['items'][$iKey]->url = $this->url->getUrl('bande-annonce-detail', array('id' => $oTrailer->get_id(), 'title' => $this->url->encodeToUrl($oTrailer->get_title()), 'id_record' => $oTrailer->get_id_record(), 'title_record' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $oRecord->base));
				$aTrailers['items'][$iKey]->record_title_encode = $this->url->encodeToUrl($oRecord->get_title());
				$aTrailers['items'][$iKey]->record_id = $oRecord->get_id();
				$aTrailers['items'][$iKey]->record_base_type = $oRecord->base;
  				$aTrailers['items'][$iKey]->title_encode = $this->url->encodeToUrl($oTrailer->get_title());
			}
		}
		else {

			$aTrailers = array();
			$aTrailers['items'] = array();
		}

		$iCountLike = count($this->modelLikePerson->findByid_person($oActor->get_id()));

		$this->layout
			 ->assign('model', 'Actor.tpl')
			 ->assign('title', ''.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez la biographie de '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->assign('url_img', 'person_'.$oActor->get_id().'.jpg')
			 ->assign('movies', $aLastMoviesByRecord)
			 ->assign('news', $oActor->news)
			 ->assign('like', $iCountLike)
			 ->assign('last_trailers', $aTrailers)
			 ->display();
  	}

  	/**
  	 * get all info of movie/serie or emission
  	 *
  	 * @access private
  	 * @param  object $oActor
  	 * @return object
  	 */

  	private function _getTotalInfo($oActor) {

  		$oActor->title_encode = $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name());
  		$oActor->image = $this->url->getUrl('images-nom', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()), 'type' => 'person'));
  		$aRecords = $this->modelRecord->getLastMoviesByActor($oActor->get_id());

  		$aRecordIds = array();

  		foreach ($aRecords as $oOne) {

  			$aRecordIds[] = $oOne->get_id();
  		}

  		$oActor->trailer = $this->modelTrailer->getByRecordIds($aRecordIds, 4);
  		$oActor->photo = $this->modelPhoto->getPhotoByIdPerson($oActor->get_id(), 4);
  		$oActor->news = $this->businessArticle->getLastNewsByDayByPerson($oActor->get_id(), 2);

  		foreach ($oActor->photo['items'] as $iKey => $oPhoto) {

  			$oActor->photo['items'][$iKey]->title_encode = $this->url->encodeToUrl($oPhoto->get_title());
  		}

  		foreach ($oActor->trailer['items'] as $iKey => $oTrailer) {

  			$oActor->trailer['items'][$iKey]->title_encode = $this->url->encodeToUrl($oTrailer->get_title());
  		}

  		$iCountLike = count($this->modelLikePerson->findByid_person($oActor->get_id()));

  		$this->layout
  			 ->assign('menu', 'home')
  			 ->assign('submenu', 'actors')
  			 ->assign('like', $iCountLike);

  		return $oActor;
  	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showBiography($iId, $sTitle) {

		$oActor = $this->modelActor->findOneByid($iId);
		$oActor = $this->_getTotalInfo($oActor);
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

		$aLastMoviesByRecord = $this->modelRecord->getLastMoviesByActor($iId);
		$aIds = array();

		foreach ($aLastMoviesByRecord as $iKey => $oOne) {

			$aIds[] = $iKey;
		}

		$aMovies = $this->modelRecord->getBestMoviesForRecordIds($aIds);
		$aMovies['items'] = $this->businessRecord->getExtendedInfos($aMovies['items']);

		$aFriends = $this->modelRecord->getMaxActorFriendsForRecordIds($aIds, $oActor->get_id());

		foreach ($aFriends as $iKey => $oOneActor) {

			$aFriends[$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oOneActor->get_id(), 'title' => $this->url->encodeToUrl($oOneActor->get_firstname().' '.$oOneActor->get_name()), 'type' => 'person'));
			$aFriends[$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oOneActor->get_id(), 'title' => $this->url->encodeToUrl($oOneActor->get_firstname().' '.$oOneActor->get_name())));
		}

		$this->layout
			 ->assign('model', 'ActorBiography.tpl')
			 ->assign('title', 'Biographie de '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez la biographie de '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->assign('movies', $aMovies['items'])
			 ->assign('friends', $aFriends)
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showFilmography($iId, $sTitle) {

		$oActor = $this->modelActor->findOneByid($iId);
		$oActor = $this->_getTotalInfo($oActor);

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
			 ->assign('model', 'ActorFilmography.tpl')
			 ->assign('title', 'Filmographie de '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez la filmographie de '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actors', $aRolesInActors)
			 ->assign('creators', $aRolesInCreators)
			 ->assign('realisators', $aRolesInRealisators)
			 ->assign('productors', $aRolesInProductors)
			 ->assign('distributors', $aRolesInDistributors)
			 ->assign('technical_team', $aRolesInTechnicalTeam)
			 ->assign('actor', $oActor)
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showPhoto($iId, $sTitle, $iOffset) {

		$oActor = $this->modelActor->findOneByid($iId);
		$oActor = $this->_getTotalInfo($oActor);

		$aPhotos = $this->modelPhoto->getPhotoByIdPerson($iId, 5);

		if ($aPhotos['count'] > 0) {

			foreach ($aPhotos['items'] as $iKey => $oPhoto) {

				$aPhotos['items'][$iKey]->url = $this->url->getUrl('une-photos', array('id' => $oPhoto->get_id(), 'title' => $this->url->encodeToUrl($oPhoto->get_title())));
			}
		}

		$this->layout
			 ->assign('model', 'ActorPhotos.tpl')
			 ->assign('title', 'Photos de '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez les photos de '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->assign('photos', $aPhotos)
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showReward($iId, $sTitle, $iOffset) {

		$oActor = $this->modelActor->findOneByid($iId);
		$oActor = $this->_getTotalInfo($oActor);

		$this->layout
			 ->assign('model', 'ActorReward.tpl')
			 ->assign('title', 'Récompenses de '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez les récompenses obtenues par '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showNews($iId, $sTitle, $iOffset) {

		$oActor = $this->modelActor->findOneByid($iId);
		$oActor = $this->_getTotalInfo($oActor);

		$aNews = $this->businessArticle->getLastNewsByDayByPerson($iId, 10, $iOffset);

		$this->layout
			 ->assign('model', 'ActorNews.tpl')
			 ->assign('title', 'Actualités sur '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez les actualités sur '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->assign('news', $aNews)
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showVideos($iId, $sTitle, $iOffset = 0) {

		$oActor = $this->modelActor->findOneByid($iId);
		$oActor = $this->_getTotalInfo($oActor);
		$aLastMoviesByRecord = $this->modelRecord->getLastMoviesByActor($iId);

		$aIds = array();

		foreach ($aLastMoviesByRecord as $oOne) {

			$aIds[] = $oOne->get_id();
		}

		if (implode(',', $aIds)) {

			$aTrailers = $this->modelTrailer->getLastsTrailerByRecordIds(implode(',', $aIds), 8, $iOffset);
		}
		else {

			$aTrailers = array();
			$aTrailers['items'] = array();
			$aTrailers['count'] = array();
			$aTrailers['pages'] = array();
		}

		foreach ($aTrailers['items'] as $iKey => $oTrailer) {

			$oRecord = $this->modelRecord->findOneByid($oTrailer->get_id_record());
			$sBase = $this->businessRecord->getTypeForUrl($oRecord->get_type());
			$aTrailers['items'][$iKey]->url = $this->url->getUrl('bande-annonce-detail', array('id' => $oTrailer->get_id(), 'title' => $this->url->encodeToUrl($oTrailer->get_title()), 'id_record' => $oTrailer->get_id_record(), 'title_record' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase));
		}


		$this->layout
			 ->assign('trailers', $aTrailers)
			 ->assign('model', 'ActorVideos.tpl')
			 ->assign('title', 'Vidéos sur '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez les vidéos sur '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId
	 * @return void
	 */

	public function showDvd($iId, $sTitle) {

		$oActor = $this->modelActor->findOneByid($iId);
		$oActor = $this->_getTotalInfo($oActor);

		$aLastMoviesByRecord = $this->modelRecord->getLastMoviesDvdByActor($iId);
		$aLastMoviesByRecord = $this->businessRecord->getExtendedInfos($aLastMoviesByRecord);

		$this->layout
			 ->assign('model', 'ActorDvd.tpl')
			 ->assign('title', 'Dvd et Bluray avec '.$oActor->get_name().' '.$oActor->get_firstname().'  - iScreenway')
			 ->assign('description', 'Découvrez les Dvd et Bluray avec '.$oActor->get_name().' '.$oActor->get_firstname().' ainsi que les bandes-annonces et la fiche complète.')
			 ->assign('actor', $oActor)
			 ->assign('movies', $aLastMoviesByRecord)
			 ->display();
	}
}

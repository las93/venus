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
use \Venus\src\WebSite\Business\article as businessArticle;
use \Venus\src\WebSite\Business\record as businessRecord;
use \Venus\src\WebSite\Business\trailer as businessTrailer;
use \Venus\src\WebSite\Entity\critic as entityCritic;
use \Venus\src\WebSite\Entity\like_movie as entityLikeMovie;
use \Venus\src\WebSite\Model\article as modelArticle;
use \Venus\src\WebSite\Model\photo as modelPhoto;
use \Venus\src\WebSite\Model\record as modelRecord;
use \Venus\src\WebSite\Model\story as modelStory;
use \Venus\src\WebSite\Model\trailer as modelTrailer;
use \Venus\src\WebSite\Model\record_has_actor as modelRecordHasActor;
use \Venus\src\WebSite\Model\record_has_realisator as modelRecordHasRealisator;
use \Venus\src\WebSite\Model\record_has_productor as modelRecordHasProductor;
use \Venus\src\WebSite\Model\record_has_kind as modelRecordHasKind;
use \Venus\src\WebSite\Model\nationality as modelNationality;
use \Venus\src\WebSite\Model\record_has_distributor as modelRecordHasDistributor;
use \Venus\src\WebSite\Model\record_has_screenwriter as modelRecordHasScreenwriters;
use \Venus\src\WebSite\Model\record_has_technical_team as modelRecordHasTechnicalTeam;
use \Venus\src\WebSite\Model\record_has_company as modelRecordHasCompanies;
use \Venus\src\WebSite\Model\record_has_creator as modelRecordHasCreators;
use \Venus\src\WebSite\Model\record_episode as modelRecordEpisode;
use \Venus\src\WebSite\Model\program_on_grid as modelProgramOnGrid;
use \Venus\src\WebSite\Model\channel as modelChannel;
use \Venus\src\WebSite\Model\critic as modelCritic;
use \Venus\src\WebSite\Model\like_movie as modelLikeMovie;

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

class Record extends Controller {

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
		$this->modelArticle = function() { return new modelArticle; };
		$this->modelPhoto = function() { return new modelPhoto; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelStory = function() { return new modelStory; };
		$this->modelTrailer = function() { return new modelTrailer; };
		$this->modelRecordHasActor = function() { return new modelRecordHasActor; };
		$this->modelRecordHasRealisator = function() { return new modelRecordHasRealisator; };
		$this->modelRecordHasKind = function() { return new modelRecordHasKind; };
		$this->modelNationality = function() { return new modelNationality; };
		$this->modelRecordHasDistributor = function() { return new modelRecordHasDistributor; };
		$this->modelRecordHasProductor = function() { return new modelRecordHasProductor; };
		$this->modelRecordHasScreenwriters = function() { return new modelRecordHasScreenwriters; };
		$this->modelRecordHasTechnicalTeam = function() { return new modelRecordHasTechnicalTeam; };
		$this->modelRecordHasCompanies = function() { return new modelRecordHasCompanies; };
		$this->modelRecordHasCreators = function() { return new modelRecordHasCreators; };
		$this->modelRecordEpisode = function() { return new modelRecordEpisode; };
		$this->modelProgramOnGrid = function() { return new modelProgramOnGrid; };
		$this->modelChannel = function() { return new modelChannel; };
		$this->modelCritic = function() { return new modelCritic; };
		$this->modelLikeMovie = function() { return new modelLikeMovie; };

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

	public function show($iId, $sTitle, $sType) {

  		$oRecord = $this->modelRecord->findOneById($iId);
  		$oRecord = $this->businessRecord->getExtendedInfos([$oRecord])[0];
  		$oRecord = $this->_getTotalInfo($oRecord);

  		$aActors = $this->modelRecordHasActor->getActorsByRecordId($iId);
  		$aRealisators = $this->modelRecordHasRealisator->getRealisatorsByRecordId($iId, 3);
  		$aKinds = $this->modelRecordHasKind->getKindsByRecordId($iId);
  		$oNationality = $this->modelNationality->findOneById($oRecord->get_id_nationality());
  		$aDistributors = $this->modelRecordHasDistributor->getDistributorsByRecordId($iId);

  		$sActors = '';

  		foreach ($aActors['items'] as $iKey => $oActor) {

  			if ($iKey < 4) {

  				$aActors['items'][$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
  				$aActors['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name()), 'type' => 'person'));
  				$sActors .= ' - <span itemprop="director" itemscope itemtype="http://schema.org/Person"><a href="'.$this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name()))).'" itemprop="url"><span itemprop="name">'.$oActor->person->get_firstname().' '.$oActor->person->get_name().'</span></a></span>';
  			}
  		}

  		$sActors = substr($sActors, 3);

  		$sRealisators = '';

  		foreach ($aRealisators['items'] as $oRealisator) {

  			$sRealisators .= ' - <span itemprop="actors" itemscope itemtype="http://schema.org/Person"><a href="'.$this->url->getUrl('acteur-detail', array('id' => $oRealisator->person->get_id(), 'title' => $this->url->encodeToUrl($oRealisator->person->get_firstname().' '.$oRealisator->person->get_name()))).'" itemprop="url"><span itemprop="name">'.$oRealisator->person->get_firstname().' '.$oRealisator->person->get_name().'</span></a></span>';
  		}

  		$sRealisators = substr($sRealisators, 3);

  		$sDistributor = '';

  		foreach ($aDistributors['items'] as $oDistributor) {

  			$sDistributor .= ' - <a href="'.$this->url->getUrl('distributeur-detail', array('id' => $oRealisator->person->get_id(), 'title' => $this->url->encodeToUrl($oRealisator->person->get_firstname().' '.$oRealisator->person->get_name()))).'">'.$oRealisator->person->get_firstname().' '.$oRealisator->person->get_name().'</a>';
  		}

  		$sDistributor = substr($sDistributor, 3);

  		$sKinds = '';

  		if (count($aKinds) > 0) {

  			foreach ($aKinds['items'] as $oKind) {

  				$sKinds .= ' - <span itemprop="genre"><a href="'.$this->url->getUrl('genre-detail', array('id' => $oKind->kind->get_id(), 'title' => $this->url->encodeToUrl($oKind->kind->get_name()))).'">'.$oKind->kind->get_name().'</a></span>';
  			}
  		}

  		$sKinds = substr($sKinds, 3);

  		if (!is_object($oNationality)) {

  			$sNationality = 'inconnu';
  		}
  		else {

  			$sNationality = '<a href="'.$this->url->getUrl('nationalite-detail', array('id' => $oNationality->get_id(), 'title' => $this->url->encodeToUrl($oNationality->get_name()))).'">'.$oNationality->get_name().'</a>';
  		}

  		if ($oRecord->get_type() == "serie") {

  			$iMaxSeason = $this->modelRecordEpisode->getMaxSeasonByRecord($iId);
  			$aDiffusions = $this->modelProgramOnGrid->getDiffusionOfRecordId($iId);
  			$aChannels = $this->modelChannel->getChannelDiffusionOfRecordId($iId);

  			$this->layout
  				 ->assign('max_season', $iMaxSeason)
  				 ->assign('diffusions', $aDiffusions)
  				 ->assign('channels', $aChannels);
  		}

    	$this->layout
       		 ->assign('title', $oRecord->get_title().' - iScreenway')
       		 ->assign('description', 'Découvrez la biographie complète de '.$oRecord->get_title().', ses actualités, son casting, ses photos et plein d\'autres choses...')
			 ->assign('actors', $sActors)
			 ->assign('record', $oRecord)
			 ->assign('kinds', $sKinds)
			 ->assign('list_actors', $aActors['items'])
			 ->assign('realisators', $sRealisators)
			 ->assign('nationality', $sNationality)
			 ->assign('distributor', $sDistributor)
       		 ->display();
  	}

  	/**
  	 * get all info of movie/serie or emission
  	 *
  	 * @access private
  	 * @param  object $oRecord
  	 * @return object
  	 */

  	private function _getTotalInfo($oRecord) {

  		if (isset($_POST) && isset($_POST['like'])) {

  			if ($this->session->get('userid')) { $sIp = ''; }
  			else { $sIp = $_SERVER['REMOTE_ADDR']; }

  			$oLikeMovie = new entityLikeMovie;

  			$oLikeMovie->set_id_record($iId)
  			->set_id_user($this->session->get('userid'))
  			->set_ip($sIp);

  			$this->modelLikeMovie->insert($oLikeMovie);

  			file_get_contents('http://www.iscreenway.com/'.$_SERVER['REQUEST_URI'].'?flush=1');
  		}

  		$oRecord->base_type = $this->businessRecord->getTypeForUrl($oRecord->get_type());
  		$oRecord->title_encode = $this->url->encodeToUrl($oRecord->get_title());
  		$oRecord->trailer = $this->modelTrailer->findByid_record($oRecord->get_id());
  		$oRecord->photo = $this->modelPhoto->getPhotosByRecord($oRecord->get_id(), 4, 0);
  		$oRecord->news = $this->businessArticle->getLastNewsByRecord($oRecord->get_id(), 2);
  		$oRecord->story = $this->modelStory->findOneByid_record($oRecord->get_id());

  		foreach ($oRecord->photo['items'] as $iKey => $oPhoto) {

  			$oRecord->photo['items'][$iKey]->title_encode = $this->url->encodeToUrl($oPhoto->get_title());
  		}

  		foreach ($oRecord->trailer as $iKey => $oTrailer) {

  			$oRecord->trailer[$iKey]->title_encode = $this->url->encodeToUrl($oTrailer->get_title());
  		}

  		if ($oRecord->get_type() == 'serie') { $this->layout->assign('menu', 'serie')->assign('submenu', 'list_serie'); }
  		else if ($oRecord->get_type() == 'tele') { $this->layout->assign('menu', 'tele')->assign('submenu', 'all_movies'); }
  		else { $this->layout->assign('menu', 'cinema')->assign('submenu', 'all_movies'); }

  		$iCountLike = count($this->modelLikeMovie->findByid_record($oRecord->get_id()));

  		$this->layout->assign('like', $iCountLike);

  		return $oRecord;
  	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iId id of Record
	 * @param  string $sTitle title
	 * @param  string $sBase base of url
	 * @return void
	 */

	public function showEpisodes($iId, $sTitle, $sBase, $iSeason = 0) {

		if ($iSeason < 1) { $iSeason = 1; }

		$oRecord = $this->modelRecord->findOneById($iId);
		$oRecord = $this->businessRecord->getExtendedInfos([$oRecord])[0];
		$oRecord = $this->_getTotalInfo($oRecord);
		$oRecord->base = $this->businessRecord->getTypeForUrl($oRecord->get_type());

		$iMaxSeason = $this->modelRecordEpisode->getMaxSeasonByRecord($iId);

		$aSeasons = $this->modelRecordEpisode->getAllEpisodesBySeasonByRecord($iId, $iSeason);

		$this->layout
			 ->assign('model', 'RecordEpisodes.tpl')
			 ->assign('record', $oRecord)
			 ->assign('season', $iSeason)
			 ->assign('seasons', $aSeasons)
			 ->assign('title', 'Episodes de la saison '.$iSeason.' de '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Découvrez tous les épisodes de la saison '.$iSeason.' de '.$oRecord->get_title().', ses actualités, son casting, ses photos et plein d\'autres choses...')
			 ->assign('url_film_saisons', $this->url->getUrl('episodes-series', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $oRecord->base)))
			 ->assign('url_film_episodes', $this->url->getUrl('episodes-series', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $oRecord->base, 'season' => 1)))
			 ->assign('max_season', $iMaxSeason)
		 	 ->assign('menu_select', 2)
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

	public function showTrailers($iId, $sTitle, $sBase) {

		$oRecord = $this->modelRecord->findOneById($iId);
		$oRecord = $this->businessRecord->getExtendedInfos([$oRecord])[0];
		$oRecord = $this->_getTotalInfo($oRecord);
		$oRecord->base = $this->businessRecord->getTypeForUrl($oRecord->get_type());

		$oTrailer = $this->modelTrailer->findOneByid_record($iId);
		$aOtherTrailers = $this->businessTrailer->getLastTrailers(8, $oRecord->base, 0, $iId);

		$this->layout
			 ->assign('model', 'RecordTrailers.tpl')
			 ->assign('title', 'bandes-annonces de '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Découvrez les bandes-annonces de '.$oRecord->get_title().' et plein d\'autres bandes annonces sur iScreenway.')
			 ->assign('trailer', $oTrailer)
			 ->assign('trailers', $aOtherTrailers)
			 ->assign('record', $oRecord)
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

	public function showCasting($iId, $sTitle, $sBase) {

		$oRecord = $this->modelRecord->findOneById($iId);
		$oRecord = $this->businessRecord->getExtendedInfos([$oRecord])[0];
		$oRecord = $this->_getTotalInfo($oRecord);
		$oRecord->base = $this->businessRecord->getTypeForUrl($oRecord->get_type());

		$aRealisators = $this->modelRecordHasRealisator->getRealisatorsByRecordId($iId);
		$aActors = $this->modelRecordHasActor->getActorsByRecordId($iId);
		$aProductors = $this->modelRecordHasProductor->getProductorsByRecordId($iId);
		$aScreenwriters = $this->modelRecordHasScreenwriters->getScreenwritersByRecordId($iId);
		$aTechnicalTeam = $this->modelRecordHasTechnicalTeam->getTechnicalTeamByRecordId($iId);
		$aDistributors = $this->modelRecordHasDistributor->getDistributorsByRecordId($iId);
		$aCompanies = $this->modelRecordHasCompanies->getCompaniesByRecordId($iId);
		$aCreators = $this->modelRecordHasCreators->getCreatorsByRecordId($iId);

		foreach ($aActors['items'] as $iKey => $oActor) {

			$aActors['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name()), 'type' => 'person'));
			$aActors['items'][$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
		}

		foreach ($aRealisators['items'] as $iKey => $oActor) {

			$aRealisators['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name()), 'type' => 'person'));
			$aRealisators['items'][$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
		}

		foreach ($aProductors['items'] as $iKey => $oActor) {

			$aProductors['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name()), 'type' => 'person'));
			$aProductors['items'][$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
		}

		foreach ($aScreenwriters['items'] as $iKey => $oActor) {

			$aScreenwriters['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name()), 'type' => 'person'));
			$aScreenwriters['items'][$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
		}

		foreach ($aTechnicalTeam['items'] as $iKey => $oActor) {

			$aTechnicalTeam['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name()), 'type' => 'person'));
			$aTechnicalTeam['items'][$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
		}

		foreach ($aDistributors['items'] as $iKey => $oActor) {

			$aDistributors['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name()), 'type' => 'person'));
			$aDistributors['items'][$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
		}

		foreach ($aCompanies['items'] as $iKey => $oActor) {

			$aCompanies['items'][$iKey]->url = $this->url->getUrl('distributeur-detail', array('id' => $oActor->company->get_id(), 'title' => $this->url->encodeToUrl($oActor->company->get_name())));
		}

		foreach ($aCreators['items'] as $iKey => $oActor) {

			$aCreators['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name()), 'type' => 'person'));
			$aCreators['items'][$iKey]->url = $this->url->getUrl('distributeur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_name())));
		}

		$this->layout
			 ->assign('model', 'RecordCasting.tpl')
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

	public function showCritic($iId, $sTitle) {

		if (isset($_POST) && count($_POST) && $this->session->get('userid')) {

			$oCritic = new entityCritic;

			$oCritic->set_id_user($this->session->get('userid'))
					->set_content($_POST['comment'])
					->set_created(date('Y-m-d H:s:i'))
					->set_score($_POST['score'])
					->set_id_record($iId);

			$this->modelCritic->insert($oCritic);
		}

		$oRecord = $this->modelRecord->findOneById($iId);
		$oRecord = $this->businessRecord->getExtendedInfos([$oRecord])[0];
		$oRecord = $this->_getTotalInfo($oRecord);
		$oRecord->base = $this->businessRecord->getTypeForUrl($oRecord->get_type());

		$aCritics = $this->modelCritic->getCriticByRecord($iId, 20, 0);

		$this->layout
			 ->assign('model', 'RecordCritic.tpl')
			 ->assign('record', $oRecord)
			 ->assign('title', 'Critique du film '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Retrouvez les films au cinéma, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
			 ->assign('critics', $aCritics)
			 ->assign('is_connect', $this->session->get('user'))
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iId id of Record
	 * @param  string $sTitle title
	 * @return void
	 */

	public function showDiffusion($iId, $sTitle, $sBase) {

		$oRecord = $this->modelRecord->findOneById($iId);
		$oRecord = $this->businessRecord->getExtendedInfos([$oRecord])[0];
		$oRecord = $this->_getTotalInfo($oRecord);
		$oRecord->base = $this->businessRecord->getTypeForUrl($oRecord->get_type());

		$aDiffusions = array();
		$aChannels = $this->modelChannel->getChannelDiffusionOfRecordId($iId);

		foreach ($aChannels as $oOneChannel) {

			$aDiffusions[$oOneChannel->get_name()] = $this->modelProgramOnGrid->getDiffusionOfChannelId($oOneChannel->get_id(), $iId);
		}

		$this->layout
			 ->assign('model', 'RecordDiffusion.tpl')
			 ->assign('record', $oRecord)
			 ->assign('diffusions', $aDiffusions)
			 ->assign('title', 'Diffusions de '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Découvrez toutes les diffusions de '.$oRecord->get_title().', ses actualités, son casting, ses photos et plein d\'autres choses...')
			 ->display();
	}

	/**
	 * the photos of one record
	 *
	 * @access public
	 * @param  int $iId id
	 * @param  string $sTitle title
	 * @return void
	 */

	public function showPhotos($iId, $sTitle, $iOffset = 0) {

		$oRecord = $this->modelRecord->findOneById($iId);
		$oRecord = $this->businessRecord->getExtendedInfos([$oRecord])[0];
		$oRecord = $this->_getTotalInfo($oRecord);
		$oRecord->base = $this->businessRecord->getTypeForUrl($oRecord->get_type());

		$aPhotos = $this->modelPhoto->getPhotosByRecord($iId, 20, $iOffset);

		if ($aPhotos['count'] > 0) {

			foreach ($aPhotos['items'] as $iKey => $oPhoto) {

				$aPhotos['items'][$iKey]->url = $this->url->getUrl('une-photos', array('id' => $oPhoto->get_id(), 'title' => $this->url->encodeToUrl($oPhoto->get_title())));
			}
		}

		$this->layout
			 ->assign('model', 'RecordPhoto.tpl')
			 ->assign('record', $oRecord)
			 ->assign('title', 'Photos du film '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Retrouvez les films au cinéma, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
			 ->assign('photos', $aPhotos)
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iId id of Record
	 * @param  string $sTitle title
	 * @return void
	 */

	public function showNews($iId, $sTitle, $iOffset = 0, $sbase = '') {

		$oRecord = $this->modelRecord->findOneById($iId);
		$oRecord = $this->businessRecord->getExtendedInfos([$oRecord])[0];
		$oRecord = $this->_getTotalInfo($oRecord);
		$oRecord->base = $this->businessRecord->getTypeForUrl($oRecord->get_type());

		$aNews = $this->businessArticle->getLastNewsByRecord($oRecord->get_id(), 20, $iOffset);

		foreach ($aNews['items'] as $iKey => $oNews) {

			$aNews['items'][$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
		}

		$this->layout
			 ->assign('model', 'RecordNews.tpl')
			 ->assign('record', $oRecord)
			 ->assign('title', 'Actualités de '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Découvrez le actualités de '.$oRecord->get_title().', ses actualités, son casting, ses photos et plein d\'autres choses...')
			 ->assign('news', $aNews)
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iId id of Record
	 * @param  string $sTitle title
	 * @param  string $sBase base of url
	 * @return void
	 */

	public function showStory($iId, $sTitle, $sBase) {

		$oRecord = $this->modelRecord->findOneById($iId);
		$oRecord = $this->businessRecord->getExtendedInfos([$oRecord])[0];
		$oRecord = $this->_getTotalInfo($oRecord);
		$oRecord->base = $this->businessRecord->getTypeForUrl($oRecord->get_type());

		$this->layout
			 ->assign('model', 'RecordStory.tpl')
			 ->assign('record', $oRecord)
			 ->assign('title', 'Anecdotes et secrets de tournage de '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Découvrez Toutes les anecdotes et secrets de tournage de  de '.$oRecord->get_title().'.')
			 ->assign('stories', $aStories)
			 ->display();
	}
}

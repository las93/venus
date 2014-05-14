<?php

/**
 * Controller to record
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
use \Venus\src\FrontOffice\Entity\like_movie as entityLikeMovie;
use \Venus\src\FrontOffice\Model\record_has_distributor as modelRecordHasDistributor;
use \Venus\src\FrontOffice\Model\nationality as modelNationality;
use \Venus\src\FrontOffice\Model\article as modelArticle;
use \Venus\src\FrontOffice\Model\like_movie as modelLikeMovie;
use \Venus\src\FrontOffice\Model\program_on_grid as modelProgramOnGrid;
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Model\record_episode as modelRecordEpisode;
use \Venus\src\FrontOffice\Model\record_has_actor as modelRecordHasActor;
use \Venus\src\FrontOffice\Model\record_has_kind as modelRecordHasKind;
use \Venus\src\FrontOffice\Model\record_has_realisator as modelRecordHasRealisator;
use \Venus\src\FrontOffice\Model\trailer as modelTrailer;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;
use \Venus\src\FrontOffice\Model\photo as modelPhoto;
use \Venus\src\FrontOffice\Model\channel as modelChannel;
use \Venus\src\FrontOffice\Model\story as modelStory;

/**
 * Controller to record
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

		$this->modelRecordHasDistributor = function() { return new modelRecordHasDistributor; };
		$this->modelNationality = function() { return new modelNationality; };
		$this->modelArticle = function() { return new modelArticle; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelTrailer = function() { return new modelTrailer; };
		$this->modelRecordHasActor = function() { return new modelRecordHasActor; };
		$this->modelRecordEpisode = function() { return new modelRecordEpisode; };
		$this->modelRecordHasKind = function() { return new modelRecordHasKind; };
		$this->modelRecordHasRealisator = function() { return new modelRecordHasRealisator; };
		$this->modelTopSearch = function() { return new modelTopSearch; };
		$this->modelProgramOnGrid = function() { return new modelProgramOnGrid; };
		$this->modelPhoto = function() { return new modelPhoto; };
		$this->modelChannel = function() { return new modelChannel; };
		$this->modelLikeMovie = function() { return new modelLikeMovie; };
		$this->modelStory = function() { return new modelStory; };

		parent::__construct();

		$aSearch = $this->modelTopSearch->getTop(5);
		$sSearch = '';

		foreach ($aSearch as $oSearch) {

			$sSearch .= ' &nbsp;&nbsp; <a href="'.$this->url->getUrl('recherche', array('word' => $oSearch->get_word())).'" style="color:white">'.$oSearch->get_word().'</a> ';
		}

		$this->layout->assign('word_to_search', $sSearch);
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @return void
	 */

	public function show() {

		$this->layout
			 ->assign('title', 'Toutes les fiches de films avec leurs bandes-annonces et actualités - iScreenway')
			 ->assign('description', 'Découvrez Toutes les bandes annonces de films au cinéma, des DVD sortis et des meilleures séries TV.')
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iId id of Record
	 * @param  string $sTitle title
	 * @param  string $sBase base of url (cinema/film) or (series/liste)
	 * @return void
	 */

	public function showOne($iId, $sTitle, $sBase = '') {

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

		$oRecord = $this->modelRecord->findOneById($iId);

		if ($oRecord->get_type() == 'serie') { $sBase = 'series/liste'; }
		else { $sBase = 'cinema/film'; }

		if (preg_match('|/films/|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)));
			exit;
		}
		else if ($oRecord->get_type() == 'serie' && preg_match('|cinema/film|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste')));
			exit;
		}

		$aMenus = $this->getRecordMenu($iId);
		$aActors = $this->modelRecordHasActor->getActorsByRecordId($iId);
		$aRealisators = $this->modelRecordHasRealisator->getRealisatorsByRecordId($iId, 3);
		$aKinds = $this->modelRecordHasKind->getKindsByRecordId($iId);
		$oNationality = $this->modelNationality->findOneById($oRecord->get_id_nationality());
		$aDistributors = $this->modelRecordHasDistributor->getDistributorsByRecordId($iId);
		$oReview = $this->getReviewForOneRecord($iId);

		$sActors = '';

		foreach ($aActors as $iKey => $oActor) {

			if ($iKey < 4) {

				$aActors[$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name())));
				$sActors .= ' - <span itemprop="director" itemscope itemtype="http://schema.org/Person"><a href="'.$this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name()))).'" itemprop="url"><span itemprop="name">'.$oActor->person->get_firstname().' '.$oActor->person->get_name().'</span></a></span>';
			}
		}

		$sActors = substr($sActors, 3);

		$sRealisators = '';

		foreach ($aRealisators as $oRealisator) {

			$sRealisators .= ' - <span itemprop="actors" itemscope itemtype="http://schema.org/Person"><a href="'.$this->url->getUrl('acteur-detail', array('id' => $oRealisator->person->get_id(), 'title' => $this->url->encodeToUrl($oRealisator->person->get_firstname().' '.$oRealisator->person->get_name()))).'" itemprop="url"><span itemprop="name">'.$oRealisator->person->get_firstname().' '.$oRealisator->person->get_name().'</span></a></span>';
		}

		$sRealisators = substr($sRealisators, 3);

		$sDistributor = '';

		foreach ($aDistributors as $oDistributor) {

			$sDistributor .= ' - <a href="'.$this->url->getUrl('distributeur-detail', array('id' => $oRealisator->person->get_id(), 'title' => $this->url->encodeToUrl($oRealisator->person->get_firstname().' '.$oRealisator->person->get_name()))).'">'.$oRealisator->person->get_firstname().' '.$oRealisator->person->get_name().'</a>';
		}

		$sDistributor = substr($sDistributor, 3);

		$sKinds = '';

		if (count($aKinds) > 0) {

			foreach ($aKinds as $oKind) {

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

		$aTrailerTmp = $this->modelTrailer->findByid_record($iId);

		$aTrailer = array();
		$i = 1;

		foreach ($aTrailerTmp as $iKey => $oTrailer) {

			if ($i <= 8) {

				$aTrailer[$iKey] = $oTrailer;
				$oRecord = $this->modelRecord->findOneByid($oTrailer->get_id_record());
				$aTrailers[$iKey]->url = $this->url->getUrl('bande-annonce-detail', array('id' => $oTrailer->get_id(), 'title' => $this->url->encodeToUrl($oTrailer->get_title()), 'id_record' => $oTrailer->get_id_record(), 'title_record' => $this->url->encodeToUrl($oRecord)));
				$i++;
			}
		}

		$aPhotos = $this->modelPhoto->getPhotosByRecord($iId, 6, 0);

		if ($aPhotos[0]->count > 0) {

			foreach ($aPhotos as $iKey => $oPhoto) {

				$aPhotos[$iKey]->url = $this->url->getUrl('une-photos', array('id' => $oPhoto->get_id(), 'title' => $this->url->encodeToUrl($oPhoto->get_title())));
			}
		}
		else {

			$aPhotos = [];
		}

		$aNews = $this->modelArticle->getLastNewsByRecord($iId , 2);

		if ($aNews[0]->count > 0) {

			foreach ($aNews as $iKey => $oNews) {

				$aNews[$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
			}
		}

		$iCountLike = count($this->modelLikeMovie->findByid_record($oRecord->get_id()));

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordOne.tpl')
			 ->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordMenu.tpl')
			 ->assign('record_menu', $aMenus)
			 ->assign('title', $oRecord->get_title().' - iScreenway')
			 ->assign('record', $oRecord)
			 ->assign('url_img', 'record_'.$oRecord->get_id().'.jpg')
			 ->assign('description', 'Découvrez la biographie complète de '.$oRecord->get_title().', ses actualités, son casting, ses photos et plein d\'autres choses...')
			 ->assign('actors', $sActors)
			 ->assign('list_actors', $aActors)
			 ->assign('like', $iCountLike)
			 ->assign('kinds', $sKinds)
			 ->assign('realisators', $sRealisators)
			 ->assign('nationality', $sNationality)
			 ->assign('distributor', $sDistributor)
			 ->assign('trailers' , $aTrailer)
			 ->assign('review', $oReview)
			 ->assign('photos', $aPhotos)
			 ->assign('news', $aNews)
			 ->assign('menu_select', 1)
			 ->assign('url_film', $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)));

		if ($oRecord->get_type() == "serie") {

			$iMaxSeason = $this->modelRecordEpisode->getMaxSeasonByRecord($iId);
			$aDiffusions = $this->modelProgramOnGrid->getDiffusionOfRecordId($iId);
			$aChannels = $this->modelChannel->getChannelDiffusionOfRecordId($iId);

			$this->layout
				 ->assign('sub_menu2', true)
			 	 ->assign('category', 'series')
				 ->assign('type', 'serie')
				 ->assign('max_season', $iMaxSeason)
				 ->assign('diffusions', $aDiffusions)
				 ->assign('channels', $aChannels);
		}
		else {

			$this->layout
				 ->assign('sub_menu', true)
			 	 ->assign('category', 'cinema')
			 	 ->assign('url_enfant', $this->url->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
				 ->assign('type', 'cinema');
		}

		$this->layout->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iId id of Record
	 * @param  string $sTitle title
	 * @return void
	 */

	public function showExOne($iId, $sTitle) {

		$oRecord = $this->modelRecord->findOneById($iId);

		if ($oRecord->get_type() == 'serie') { $sBase = 'series/liste'; }
		else { $sBase = 'cinema/film'; }

		$this->redirect($this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)));
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iId id of Record
	 * @param  string $sTitle title
	 * @return void
	 */

	public function showNews($iId, $sTitle) {

		$aMenus = $this->getRecordMenu($iId);
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

			$this->redirect($this->url->getUrl('film-news', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste')));
			exit;
		}
		else if (preg_match('|/film/actualites/|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('film-news', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)));
			exit;
		}

		$aNews = $this->modelArticle->getLastNewsByRecord($iId , 0);

		if ($aNews[0]->count > 0) {

			foreach ($aNews as $iKey => $oNews) {

				$aNews[$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
			}
		}

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordNews.tpl')
			 ->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordMenu.tpl')
			 ->assign('record_menu', $aMenus)
			 ->assign('record', $oRecord)
			 ->assign('title', 'Actualités de '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Découvrez le actualités de '.$oRecord->get_title().', ses actualités, son casting, ses photos et plein d\'autres choses...')
			 ->assign('url_film', $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->assign('url_film_casting', $this->url->getUrl('film-news', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->assign('sub_menu', true)
			 ->assign('menu_select', 8)
			 ->assign('url_enfant', $this->url->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->assign('news', $aNews)
			 ->display();
	}

	/**
	 * get menu configuration for one record
	 *
	 * @access public
	 * @param  int $iId id of Record
	 * @return array
	 */

	public function getRecordMenu($iId) {

		$aMenus = array();
		$oRecord = $this->modelRecord->findOneByid($iId);

		if (count($oRecord) < 1) {

			$this->redirect($this->url->getUrl('home', array()));
			exit;
		}

		if ($oRecord->get_type() != 'serie') {

			$oTrailer = $this->modelTrailer->findOneByid_record($iId);

			$aMenus['record'] = $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'cinema/film'));

			if (count($oTrailer)) {

				$aMenus['trailer'] = $this->url->getUrl('bande-annonce-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'cinema/film'));
			}
			else {

				$aMenus['trailer'] = '';
			}

			$aMenus['casting'] = $this->url->getUrl('casting', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'cinema/film'));
			$aMenus['critique'] = $this->url->getUrl('critique-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'cinema/film'));

			$aPhoto = $this->modelPhoto->findOneByid_record($iId);

			if (count($aPhoto)) {

				$aMenus['photo'] = $this->url->getUrl('photo-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'cinema/film'));
			}
			else {

				$aMenus['photo'] = '';
			}

			$aNews = $this->modelArticle->getLastNewsByRecord($iId , 1);

			if ($aNews[0]->count > 0) {

				$aMenus['news'] = $this->url->getUrl('film-news', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'cinema/film'));
			}
			else {

				$aMenus['news'] = '';
			}

			$aStory = $this->modelStory->findOneByid_record($iId);

			if (count($aStory) > 0) {

				$aMenus['story'] = $this->url->getUrl('anecdotes', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'cinema/film'));
			}
			else {

				$aMenus['story'] = '';
			}
		}
		else {

			$aMenus['record'] = $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste'));
			$aMenus['episodes'] = $this->url->getUrl('episodes-series', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste'));
			$aMenus['casting'] = $this->url->getUrl('casting', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste'));
			$aMenus['diffusiontv'] = $this->url->getUrl('diffusion-tv', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste'));

			$oTrailer = $this->modelTrailer->findOneByid_record($iId);

			if (count($oTrailer)) {

				$aMenus['trailer'] = $this->url->getUrl('bande-annonce-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste'));
			}
			else {

				$aMenus['trailer'] = '';
			}

			$aMenus['audience'] = $this->url->getUrl('audience', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste'));

			$aNews = $this->modelArticle->getLastNewsByRecord($iId , 1);

			if ($aNews[0]->count > 0) {

				$aMenus['news'] = $this->url->getUrl('film-news', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste'));
			}
			else {

				$aMenus['news'] = '';
			}

			$aMenus['critique'] = $this->url->getUrl('critique-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste'));

			$aPhoto = $this->modelPhoto->findOneByid_record($iId);

			if (count($aPhoto)) {

				$aMenus['photo'] = $this->url->getUrl('photo-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste'));
			}
			else {

				$aMenus['photo'] = '';
			}
		}

		return $aMenus;
	}

	/**
	 * get menu configuration for one record
	 *
	 * @access public
	 * @param  int $iId id of Record
	 * @return array
	 */

	public function getReviewForOneRecord($iId) {

		return;
	}

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @return array
	 */

	public function getExtendedInfos($aRecords) {

		foreach ($aRecords as $iKey => $oRecord) {

			if (!$oRecord instanceof \stdClass) {

				$aRecords[$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'type' => 'affiche'));
				$aActors = $this->modelRecordHasActor->getActorsByRecordId($oRecord->get_id());
				$aRealisators = $this->modelRecordHasRealisator->getRealisatorsByRecordId($oRecord->get_id());
				$aKinds = $this->modelRecordHasKind->getKindsByRecordId($oRecord->get_id());
				$oTrailer = $this->modelTrailer->findOneByid_record($oRecord->get_id());

				if ($oRecord->get_type() == 'serie') { $sBase = 'series/liste'; }
				else { $sBase = 'cinema/film'; }

				$aRecords[$iKey]->url = $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase));

				$sActors = '';
				$i = 0;

				foreach ($aActors as $iKey2 => $oActor) {

					if ($i < 3) {

						$sActors .= ' - <a href="'.$this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name()))).'"><span itemprop="name">'.$oActor->person->get_firstname().' '.$oActor->person->get_name().'</span></a>';
					}

					$i++;
				}

				$aRecords[$iKey]->actors = substr($sActors.'    ', 3);

				$sRealisators = '';
				$i = 0;

				foreach ($aRealisators as $iKey2 => $oRealisator) {

					if ($i < 1) {

						$sRealisators .= ' - <a href="'.$this->url->getUrl('acteur-detail', array('id' => $oRealisator->person->get_id(), 'title' => $this->url->encodeToUrl($oRealisator->person->get_firstname().' '.$oRealisator->person->get_name()))).'"><span itemprop="name">'.$oRealisator->person->get_firstname().' '.$oRealisator->person->get_name().'</span></a>';
					}

					$i++;
				}

				$aRecords[$iKey]->realisator = substr($sRealisators.'    ', 3);

				$sKinds = '';
				$i = 0;

				if (count($aKinds) < 1) {

					foreach ($aKinds as $iKey2 => $oKind) {

						$sKinds .= ' - <a href="'.$this->url->getUrl('genre-detail', array('id' => $oKind->kind->get_id(), 'title' => $this->url->encodeToUrl($oKind->kind->get_name()))).'">'.$oKind->kind->get_name().'</a>';
					}
				}

				$aRecords[$iKey]->kinds = substr($sKinds, 3);

				if (count($oTrailer) > 0) {

					$oRecord = $this->modelRecord->findOneByid($oTrailer->get_id_record());
					$aRecords[$iKey]->trailer_url = $this->url->getUrl('bande-annonce-detail', array('id' => $oTrailer->get_id(), 'title' => $this->url->encodeToUrl($oTrailer->get_title()), 'id_record' => $oTrailer->get_id_record(), 'title_record' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase));
				}
				else {

					$aRecords[$iKey]->trailer_url = '';
				}
			}
		}

		return $aRecords;
	}

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @return array
	 */

	public function getExtendedInfosOne($oRecord) {

		if (!$oRecord instanceof \stdClass) {

			$aActors = $this->modelRecordHasActor->getActorsByRecordId($oRecord->get_id());
			$aRealisators = $this->modelRecordHasRealisator->getRealisatorsByRecordId($oRecord->get_id());
			$aKinds = $this->modelRecordHasKind->getKindsByRecordId($oRecord->get_id());
			$oTrailer = $this->modelTrailer->findOneByid_record($oRecord->get_id());

			if ($oRecord->get_type() == 'serie') {
				$sBase = 'series/liste';
			}
			else { $sBase = 'cinema/film';
			}

			$oRecord->image = $this->url->getUrl('images-nom', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'type' => 'affiche'));
			$oRecord->url = $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase));

			$sActors = '';
			$i = 0;

			foreach ($aActors as $iKey2 => $oActor) {

				if ($i < 3) {

					$sActors .= ' - <a href="'.$this->url->getUrl('acteur-detail', array('id' => $oActor->person->get_id(), 'title' => $this->url->encodeToUrl($oActor->person->get_firstname().' '.$oActor->person->get_name()))).'">'.$oActor->person->get_firstname().' '.$oActor->person->get_name().'</a>';
				}

				$i++;
			}

			$oRecord->actors = substr($sActors.'    ', 3);

			$sRealisators = '';
			$i = 0;

			foreach ($aRealisators as $iKey2 => $oRealisator) {

				if ($i < 1) {

					$sRealisators .= ' - <a href="'.$this->url->getUrl('acteur-detail', array('id' => $oRealisator->person->get_id(), 'title' => $this->url->encodeToUrl($oRealisator->person->get_firstname().' '.$oRealisator->person->get_name()))).'">'.$oRealisator->person->get_firstname().' '.$oRealisator->person->get_name().'</a>';
				}

				$i++;
			}

			$oRecord->realisator = substr($sRealisators.'    ', 3);

			$sKinds = '';
			$i = 0;

			if (count($aKinds) < 1) {

				foreach ($aKinds as $iKey2 => $oKind) {

					$sKinds .= ' - <a href="'.$this->url->getUrl('genre-detail', array('id' => $oKind->kind->get_id(), 'title' => $this->url->encodeToUrl($oKind->kind->get_name()))).'">'.$oKind->kind->get_name().'</a>';
				}
			}

			$oRecord->kinds = substr($sKinds, 3);

			if (count($oTrailer) > 0) {

				$oRecord->trailer_url = $this->url->getUrl('bande-annonce-detail', array('id' => $oTrailer->get_id(), 'title' => $this->url->encodeToUrl($oTrailer->get_title()), 'id_record' => $oTrailer->get_id_record(), 'title_record' => $this->url->encodeToUrl($oRecord)));
			}
			else {

				$oRecord->trailer_url = '';
			}
		}

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

		$aMenus = $this->getRecordMenu($iId);
		$oRecord = $this->modelRecord->findOneById($iId);

		if ($oRecord->get_type() == 'serie') { $sBase = 'series/liste'; }
		else { $sBase = 'cinema/film'; }

		$iMaxSeason = $this->modelRecordEpisode->getMaxSeasonByRecord($iId);

		if ($iSeason > 0) {

			$aSeasons = $this->modelRecordEpisode->getAllEpisodesBySeasonByRecord($iId, $iSeason);

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordEpisodes.tpl')
				 ->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordMenu.tpl')
				 ->assign('record_menu', $aMenus)
				 ->assign('record', $oRecord)
				 ->assign('season', $iSeason)
				 ->assign('seasons', $aSeasons)
				 ->assign('title', 'Episodes de la saison '.$iSeason.' de '.$oRecord->get_title().' - iScreenway')
				 ->assign('description', 'Découvrez tous les épisodes de la saison '.$iSeason.' de '.$oRecord->get_title().', ses actualités, son casting, ses photos et plein d\'autres choses...')
				 ->assign('url_film', $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
				 ->assign('url_film_saisons', $this->url->getUrl('episodes-series', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
				 ->assign('url_film_episodes', $this->url->getUrl('episodes-series', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase, 'season' => 1)))
				 ->assign('sub_menu', true)
				 ->assign('max_season', $iMaxSeason)
			 	 ->assign('menu_select', 2)
				 ->assign('url_enfant', $this->url->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
				 ->display();
		}
		else {

			$aSeasons = array();

			for ($i = 1 ; $i <= $iMaxSeason ; $i++) {

				$aSeasons[$i] = $this->modelRecordEpisode->getEpisodeBySeasonByRecord($iId, $i);
			}

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordSeasons.tpl')
				 ->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordMenu.tpl')
				 ->assign('record_menu', $aMenus)
				 ->assign('record', $oRecord)
				 ->assign('seasons', $aSeasons)
				 ->assign('title', 'Toutes les saisons de '.$oRecord->get_title().' - iScreenway')
				 ->assign('description', 'Découvrez toutes les saisons de '.$oRecord->get_title().', ses actualités, son casting, ses photos et plein d\'autres choses...')
				 ->assign('url_film', $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
				 ->assign('url_film_episodes', $this->url->getUrl('episodes-series', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
				 ->assign('sub_menu', true)
			 	 ->assign('menu_select', 2)
				 ->assign('max_season', $iMaxSeason)
				 ->assign('url_enfant', $this->url->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
				 ->display();
		}
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

		$aMenus = $this->getRecordMenu($iId);
		$oRecord = $this->modelRecord->findOneById($iId);

		if ($oRecord->get_type() == 'serie') { $sBase = 'series/liste'; }
		else { $sBase = 'cinema/film'; }

		$aDiffusions = array();
		$aChannels = $this->modelChannel->getChannelDiffusionOfRecordId($iId);

		foreach ($aChannels as $oOneChannel) {

			$aDiffusions[$oOneChannel->get_name()] = $this->modelProgramOnGrid->getDiffusionOfChannelId($oOneChannel->get_id(), $iId);
		}

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordDiffusion.tpl')
			 ->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordMenu.tpl')
			 ->assign('record_menu', $aMenus)
			 ->assign('record', $oRecord)
			 ->assign('diffusions', $aDiffusions)
			 ->assign('title', 'Diffusions de '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Découvrez toutes les diffusions de '.$oRecord->get_title().', ses actualités, son casting, ses photos et plein d\'autres choses...')
			 ->assign('url_film', $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->assign('url_film_episodes', $this->url->getUrl('diffusion-tv', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->assign('sub_menu', true)
			 ->assign('menu_select', 5)
			 ->assign('url_enfant', $this->url->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
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

	public function showAudience($iId, $sTitle, $sBase) {

		$aMenus = $this->getRecordMenu($iId);
		$oRecord = $this->modelRecord->findOneById($iId);

		if ($oRecord->get_type() == 'serie') { $sBase = 'series/liste'; }
		else { $sBase = 'cinema/film'; }

		$this->layout
		->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordAudience.tpl')
		->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordMenu.tpl')
		->assign('record_menu', $aMenus)
		->assign('record', $oRecord)
		->assign('title', 'Audiences de '.$oRecord->get_title().' - iScreenway')
		->assign('description', 'Découvrez toutes les audiences de '.$oRecord->get_title().', ses actualités, son casting, ses photos et plein d\'autres choses...')
		->assign('url_film', $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
		->assign('url_film_episodes', $this->url->getUrl('audience', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
		->assign('sub_menu', true)
		->assign('url_enfant', $this->url->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
		->display();
	}
}
<?php

/**
 * Controller to cinema
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
use \Venus\src\FrontOffice\Controller\Article as controllerArticle;
use \Venus\src\FrontOffice\Controller\Record as controllerRecord;
use \Venus\src\FrontOffice\Controller\Trailer as controllerTrailer;
use \Venus\src\FrontOffice\Model\article as modelArticle;
use \Venus\src\FrontOffice\Model\kind as modelKind;
use \Venus\src\FrontOffice\Model\like_movie as modelLikeMovie;
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Model\trailer as modelTrailer;
use \Venus\src\FrontOffice\Model\mea as modelMea;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

/**
 * Controller to cinema
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

class Cinema extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->controllerArticle = function() { return new controllerArticle; };
		$this->controllerRecord = function() { return new controllerRecord; };
		$this->controllerTrailer = function() { return new controllerTrailer; };
		$this->modelArticle = function() { return new modelArticle; };
		$this->modelLikeMovie = function() { return new modelLikeMovie; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelTrailer = function() { return new modelTrailer; };
		$this->modelKind = function() { return new modelKind; };
		$this->modelMea = function() { return new modelMea; };
		$this->modelTopSearch = function() { return new modelTopSearch; };

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

		$aTrailer = $this->controllerTrailer->getLastTrailers(12, 'film');
		$aMea = $this->modelMea->findBy(['id_mea_page' => 2]);
		$aKinds = $this->modelKind->get();
		$aBestMovies = $this->modelRecord->getBestMovies();
		$aBestMovies = $this->controllerRecord->getExtendedInfos($aBestMovies);
		$aWantedMovies = $this->modelRecord->getWantedMovies();

		if ($aWantedMovies[0]->get_id()) { $aWantedMovies = $this->controllerRecord->getExtendedInfos($aWantedMovies);}
		else { $aWantedMovies = $aBestMovies; }

		$aMoviesOfWeek = $this->modelRecord->getMoviesOfWeek('film', 4, 0);

		if ($aMoviesOfWeek[0]->count > 0 && $aMoviesOfWeek[0]->get_id()) { $aMoviesOfWeek = $this->controllerRecord->getExtendedInfos($aMoviesOfWeek); }
		else { $aMoviesOfWeek = $aBestMovies; }

		$aMoviesOf4Week = $this->modelRecord->getMoviesOf4Week();

		if ($aMoviesOf4Week[0]->get_id()) { $aMoviesOf4Week = $this->controllerRecord->getExtendedInfos($aMoviesOf4Week); }
		else { $aMoviesOf4Week = $aBestMovies; }

		$aNews = $this->controllerArticle->getLastNewsByDay(4, 'cinema');

		foreach ($aKinds as $iKey => $oKind) {

			$aKinds[$iKey]->url = $this->url->getUrl('genre-detail', array('id' => $oKind->get_id(), 'title' => $this->url->encodeToUrl($oKind->get_name())));
		}

		$this->layout
			 ->assign('tpl_record_actual', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordActual.tpl')
			 ->assign('tpl_one_movie', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie.tpl')
			 ->assign('tpl_one_movie2', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie2.tpl')
			 ->assign('tpl_last_trailers', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'TrailersLast.tpl')
			 ->assign('type', 'cinéma')
			 ->assign('url_type', $this->url->getUrl('bande-annonce-cinema', array()))
			 ->assign('last_trailers', $aTrailer)
			 ->assign('kinds', $aKinds)
			 ->assign('title', 'Cinéma - iScreenway')
			 ->assign('best_movies', $aBestMovies)
			 ->assign('wanted_movies', $aWantedMovies)
			 ->assign('movies_week', $aMoviesOfWeek)
			 ->assign('movies_4week', $aMoviesOf4Week)
			 ->assign('news', $aNews)
			 ->assign('meas', $aMea)
			 ->assign('sub_menu', true)
			 ->assign('category', 'cinema')
			 ->assign('url_enfant', $this->url->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->assign('description', 'Retrouvez les films au cinéma, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showMovieOfWeek($iOffset = 0) {

		if ($iOffset < 1) { $iOffset = 0; }

		$aMoviesOfWeek = $this->modelRecord->getMoviesOfWeek('film', 10, $iOffset * 10);
		$aMoviesOfWeek = $this->controllerRecord->getExtendedInfos($aMoviesOfWeek);
		$oUrlManager = new UrlManager;

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'MovieOfWeek.tpl')
			 ->assign('tpl_one_movie', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie.tpl')
			 ->assign('title', 'Les films de la semaine au cinéma - iScreenway')
			 ->assign('description', 'Retrouvez tous les films de la semaine au cinéma, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
			 ->assign('movies_week', $aMoviesOfWeek)
			 ->assign('sub_menu', true)
			 ->assign('category', 'cinema')
			 ->assign('url', $oUrlManager->getUrl('film-de-la-semaine', array()))
			 ->assign('url_enfant', $oUrlManager->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showMovieOf4Week($iOffset = 0) {

		if ($iOffset < 1) { $iOffset = 0; }

		$aMoviesOfWeek = $this->modelRecord->getMoviesOf4Week('film', 10, $iOffset * 10);
		$aMoviesOfWeek = $this->controllerRecord->getExtendedInfos($aMoviesOfWeek);
		$oUrlManager = new UrlManager;

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'MovieOf4Week.tpl')
			 ->assign('tpl_one_movie', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie.tpl')
			 ->assign('title', 'Les films du moment au cinéma - iScreenway '.$iOffset)
			 ->assign('description', 'Retrouvez tous les films du moment au cinéma, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office... '.$iOffset)
			 ->assign('movies_week', $aMoviesOfWeek)
			 ->assign('sub_menu', true)
			 ->assign('category', 'cinema')
			 ->assign('url', $oUrlManager->getUrl('film-a-affiche', array()))
			 ->assign('url_enfant', $oUrlManager->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showBestMovies($iOffset = 0) {

		if ($iOffset < 1) { $iOffset = 0; }

		$aMoviesOfWeek = $this->modelRecord->getBestMovies('film', 10, $iOffset);
		$aMoviesOfWeek = $this->controllerRecord->getExtendedInfos($aMoviesOfWeek);
		$oUrlManager = new UrlManager;

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'BestMovie.tpl')
			 ->assign('tpl_one_movie', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie.tpl')
			 ->assign('title', 'Les meilleurs films du cinéma - iScreenway '.$iOffset)
			 ->assign('description', 'Retrouvez tous les meilleurs films du cinéma, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office... '.$iOffset)
			 ->assign('movies_week', $aMoviesOfWeek)
			 ->assign('url', $oUrlManager->getUrl('meilleurs-films', array(0)))
			 ->assign('offset', $iOffset)
			 ->assign('sub_menu', true)
			 ->assign('category', 'cinema')
			 ->assign('url_enfant', $oUrlManager->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showWantedMovies($iOffset = 0) {


		$aMoviesOfWeek = $this->modelRecord->getWantedMovies('film', 10, $iOffset * 10);
		$aMoviesOfWeek = $this->controllerRecord->getExtendedInfos($aMoviesOfWeek);
		$oUrlManager = new UrlManager;

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'WantedMovie.tpl')
			 ->assign('tpl_one_movie', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie.tpl')
			 ->assign('title', 'Les films les plus attendus - iScreenway')
			 ->assign('description', 'Retrouvez tous les films les plus attendus, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
			 ->assign('movies_week', $aMoviesOfWeek)
			 ->assign('category', 'cinema')
			 ->assign('url', $oUrlManager->getUrl('films-attendus', array(0)))
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showBoxOffice($iOffset = 0) {

		$oUrlManager = new UrlManager;

		if ($iOffset < 1) { $iOffset = 0; }

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'BoxOffice.tpl')
			 ->assign('title', 'Le box-office du cinéma - iScreenway')
			 ->assign('description', 'Retrouvez le box-office complet du cinéma avec tous les chiffres désirés...')
			 ->assign('sub_menu', true)
			 ->assign('category', 'cinema')
			 ->assign('url_enfant', $oUrlManager->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showSchedule() {

		$oUrlManager = new UrlManager;

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'CinemaSchedule.tpl')
			 ->assign('title', 'L\'agenda des films - iScreenway')
			 ->assign('description', 'Retrouvez l\'agenda complet des films, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
			 ->assign('sub_menu', true)
			 ->assign('category', 'cinema')
			 ->assign('url_enfant', $oUrlManager->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->display();
	}


	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showLittleMovieList() {

		$oUrlManager = new UrlManager;

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'LittleMovieList.tpl')
			 ->assign('title', 'Les court-métrages - iScreenway')
			 ->assign('description', 'Retrouvez tous les court-métrages du monde cinématographique ainsi que tous les films d\'auteurs...')
			 ->assign('sub_menu', true)
			 ->assign('category', 'cinema')
			 ->assign('url_enfant', $oUrlManager->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  integer $iIdKind id_kind
	 * @param  string $sTitle title
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showOneForMovie($iIdKind, $sTitle, $iOffset = 0) {

		if ($iOffset < 1) { $iOffset = 0; }

		$aMoviesByKind = $this->modelRecord->getMoviesByKind('film', 10, $iOffset, $iIdKind);
		$aMoviesByKind = $this->controllerRecord->getExtendedInfos($aMoviesByKind);
		$oUrlManager = new UrlManager;

		$oKind = $this->modelKind->findOneById($iIdKind);

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneKindForMovie.tpl')
			 ->assign('tpl_one_movie', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie.tpl')
			 ->assign('title', 'Tous les films '.$oKind->get_name().' '.$iOffset.' - iScreenway')
			 ->assign('description', 'Retrouvez tous les les films '.$oKind->get_name().', les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office... '.$iOffset.'')
			 ->assign('movies_by_kind', $aMoviesByKind)
			 ->assign('sub_menu', true)
			 ->assign('kind', $oKind)
			 ->assign('category', 'cinema')
			 ->assign('url_enfant', $oUrlManager->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->assign('url', $oUrlManager->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->assign('actual_url', $oUrlManager->getUrl('genre-film-detail', array('id' => $iIdKind, 'title' => $sTitle)))
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showMovieList($iOffset = 0) {

		if ($iOffset < 1) { $iOffset = 0; }

		$aMovies = $this->modelRecord->getMovies('film', 10, $iOffset);
		$aMovies = $this->controllerRecord->getExtendedInfos($aMovies);
		$oUrlManager = new UrlManager;

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'MovieList.tpl')
			 ->assign('tpl_one_movie', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie.tpl')
			 ->assign('title', 'Les meilleurs films du cinéma '.$iOffset.' - iScreenway')
			 ->assign('description', 'Retrouvez tous les meilleurs films du cinéma, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office... '.$iOffset.' ')
			 ->assign('movies_week', $aMovies)
			 ->assign('url', $oUrlManager->getUrl('meilleurs-films', array(0)))
			 ->assign('offset', $iOffset)
			 ->assign('sub_menu', true)
			 ->assign('category', 'cinema')
			 ->assign('url_enfant', $oUrlManager->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->display();
	}
}

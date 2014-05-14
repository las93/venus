<?php

/**
 * Controller to serie
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
use \Venus\src\FrontOffice\Model\kind as modelKind;
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Model\mea as modelMea;
use \Venus\src\FrontOffice\Model\program_on_grid as modelProgramOnGrid;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

/**
 * Controller to serie
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

class Serie extends Controller {

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
		$this->modelKind = function() { return new modelKind; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelMea = function() { return new modelMea; };
		$this->modelProgramOnGrid = function() { return new modelProgramOnGrid; };
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

		$aTrailer = $this->controllerTrailer->getLastTrailers(4, 'serie');
		$aMea = $this->modelMea->findBy(['id_mea_page' => 3]);
		$aKinds = $this->modelKind->get();
		$aBestMovies = $this->modelRecord->getBestMovies('serie');
		$aBestMovies = $this->controllerRecord->getExtendedInfos($aBestMovies);
		$aWantedMovies = $this->modelRecord->getWantedMovies('serie');
		$aSerieEtTv = array();

		if (count($aWantedMovies) && $aWantedMovies[0]->get_id()) { $aWantedMovies = $this->controllerRecord->getExtendedInfos($aWantedMovies);}
		else { $aWantedMovies = $aBestMovies; }

		$aNews = $this->controllerArticle->getLastNewsByDay(3, 'serie');

		foreach ($aKinds as $iKey => $oKind) {

			$aKinds[$iKey]->url = $this->url->getUrl('genre-detail', array('id' => $oKind->get_id(), 'title' => $this->url->encodeToUrl($oKind->get_name())));
		}

		$aSeriesThisDay = $this->modelProgramOnGrid->getSeriesThisDay();

		foreach ($aSeriesThisDay as $iKey => $oSerie) {

			$aSeries = $this->controllerRecord->getExtendedInfos([$oSerie->record]);
			$aSeriesThisDay[$iKey]->record = $aSeries[0];
		}

		$this->layout
			 ->assign('tpl_record_actual', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordActual.tpl')
			 ->assign('tpl_one_movie', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie.tpl')
			 ->assign('tpl_one_movie2', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie2.tpl')
			 ->assign('tpl_last_trailers', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'TrailersLast.tpl')
			 ->assign('type', 'série')
			 ->assign('url_type', $this->url->getUrl('bande-annonce-serie', array()))
			 ->assign('last_trailers', $aTrailer)
			 ->assign('kinds', $aKinds)
			 ->assign('title', 'Séries TV - Actualités, Communautés de fans, diffusion - iScreenway')
			 ->assign('best_movies', $aBestMovies)
			 ->assign('wanted_movies', $aWantedMovies)
			 ->assign('news', $aNews)
			 ->assign('serie_at_tv', $aSerieEtTv)
			 ->assign('meas', $aMea)
			 ->assign('serie_tv', $aSeriesThisDay)
			 ->assign('sub_menu2', true)
			 ->assign('category', 'series')
			 ->assign('description', 'Découvrez Tout sur les séries TV : fiches, les résumés d\'épisode, classement des meilleures séries, news, programmes TV, vidéos, photos.')
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @return void
	 */

	public function showMostViews() {


		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'SeriesMostView.tpl')
			 ->assign('title', 'Les séries les plus vues - iScreenway')
			 ->assign('description', 'Découvrez Toutes les séries les plus vues : fiches, les résumés d\'épisode, classement des meilleures séries, news, programmes TV, vidéos, photos.')
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showBest($iOffset = 0) {

		$aMoviesOfWeek = $this->modelRecord->getBestMovies('serie', 10, $iOffset * 10);
		$aMoviesOfWeek = $this->controllerRecord->getExtendedInfos($aMoviesOfWeek);

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'SeriesBest.tpl')
			 ->assign('tpl_one_movie', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie.tpl')
			 ->assign('title', 'Les meilleures séries - iScreenway')
			 ->assign('description', 'Découvrez Toutes les meilleures séries : fiches, les résumés d\'épisode, classement des meilleures séries, news, programmes TV, vidéos, photos.')
			 ->assign('sub_menu2', true)
			 ->assign('movies_week', $aMoviesOfWeek)
			 ->assign('category', 'series')
			 ->assign('url', $this->url->getUrl('meilleures-series', array()))
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showWanted($iOffset = 0) {

		if ($iOffset < 1) { $iOffset = 0; }
		else { $iOffset = ($iOffset - 1) * 10; }

		$aMoviesOfWeek = $this->modelRecord->getWantedMovies('serie', 10, $iOffset * 10);
		$aMoviesOfWeek = $this->controllerRecord->getExtendedInfos($aMoviesOfWeek);

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'SeriesWanted.tpl')
			 ->assign('tpl_one_movie', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie.tpl')
			 ->assign('title', 'Les meilleures séries - iScreenway')
			 ->assign('description', 'Découvrez Toutes les meilleures séries : fiches, les résumés d\'épisode, classement des meilleures séries, news, programmes TV, vidéos, photos.')
			 ->assign('sub_menu2', true)
			 ->assign('category', 'series')
			 ->assign('movies_week', $aMoviesOfWeek)
			 ->assign('url', $this->url->getUrl('meilleures-series', array()))
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

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'SerieSchedule.tpl')
			 ->assign('title', 'L\'agenda des séries TV - iScreenway')
			 ->assign('description', 'Retrouvez l\'agenda complet des séries TV...')
			 ->assign('sub_menu2', true)
			 ->assign('category', 'series')
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showSerieList($iOffset = 0) {

		if ($iOffset < 1) { $iOffset = 0; }

		$aMovies = $this->modelRecord->getMovies('serie', 10, $iOffset);
		$aMovies = $this->controllerRecord->getExtendedInfos($aMovies);

		if ($iOffset < 1) { $iOffset = ''; }

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'SerieList.tpl')
			 ->assign('tpl_one_movie', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie.tpl')
			 ->assign('title', 'Toutes les séries '.$iOffset.' - iScreenway')
			 ->assign('description', 'Retrouvez tous les meilleurs films du cinéma, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office... '.$iOffset.' ')
			 ->assign('movies_week', $aMovies)
			 ->assign('url', $this->url->getUrl('meilleurs-films', array(0)))
			 ->assign('offset', $iOffset)
			 ->assign('sub_menu2', true)
			 ->assign('category', 'series')
			 ->display();
	}
}
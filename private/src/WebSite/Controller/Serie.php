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
use \Venus\src\WebSite\Business\Article as businessArticle;
use \Venus\src\WebSite\Business\Record as businessRecord;
use \Venus\src\WebSite\Business\Trailer as businessTrailer;
use \Venus\src\WebSite\Model\mea as modelMea;

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

class Serie extends Controller {

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
		$this->modelMea = function() { return new modelMea; };

		parent::__construct();

		$this->layout->assign('menu', 'serie');
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @return void
	 */

	public function show() {

		$aNewsMea = $this->businessArticle->getLastNewsByDay(4, 'serie', 0);
		$aNews = $this->businessArticle->getLastNewsByDay(10, 'serie', 4);
    	$aMea = $this->modelMea->getLastMea(3);
		$aTrailers = $this->businessTrailer->getLastTrailers(4, 'serie');
		$aBestMovies = $this->businessRecord->getBestMovies('serie', 9);

		$this->layout
			 ->assign('title', 'iScreenway : Cinéma, Séries TV, Stars, Vidéos et DVD')
			 ->assign('description', 'iScreenway, le site du cinéma et des séries tv ! Découvrez le programme tv de vos séries préférées, l&#39;actualité cinéma et séries, les dernières bandes-annonces, et plus encore.')
			 ->assign('news_mea', $aNewsMea)
			 ->assign('news', $aNews)
			 ->assign('meas', $aMea)
			 ->assign('trailers', $aTrailers)
			 ->assign('top_series', $aBestMovies)
			 ->display();
	}

  	/**
  	 * the main page of news
  	 *
  	 * @access public
  	 * @param  int $iOffSet
  	 * @return void
  	 */

  	public function showNews($iOffSet = 0) {

    	$aNews = $this->businessArticle->getLastNewsByDay(10, 'serie', $iOffSet * 10);

   		$this->layout
       		 ->assign('model', 'News.tpl')
       		 ->assign('title', 'Les actualités cinéma - iScreenway '.$iOffSet)
       		 ->assign('description', 'Retrouvez toutes les actualités des séries TV, le guide des séries à voir, news, communautés de fans, audiences... '.$iOffSet)
       		 ->assign('submenu', 'news')
       		 ->assign('news', $aNews)
       		 ->assign('h1_news', 'Actualités Séries')
       		 ->display();
  	}

	/**
  	 * the main page of news
  	 *
  	 * @access public
  	 * @param  int $iOffSet
   	 * @return void
  	 */

  	public function showTrailers($iOffSet = 0) {

    	$aTrailers = $this->businessTrailer->getLastTrailers(21, 'serie', $iOffSet * 21);

    	$this->layout
       		 ->assign('model', 'Trailers.tpl')
       		 ->assign('title', 'Bandes annonces de séries TV - iScreenway '.$iOffSet)
       		 ->assign('description', 'Découvrez Toutes les bandes annonces de séries TV actuellement nos écrans ou en préparation. '.$iOffSet)
       		 ->assign('submenu', 'trailers')
       		 ->assign('trailers', $aTrailers)
       		 ->assign('alias', 'bande-annonce-serie')
       		 ->assign('h1_trailers', 'bandes-annonces de séries TV')
       		 ->display();
  	}

	/**
  	 * the main page of news
  	 *
  	 * @access public
  	 * @param  int $iOffSet
   	 * @return void
  	 */

  	public function showBest($iOffSet = 0) {

    	$aBestMovies = $this->businessRecord->getBestMovies('serie', 21, $iOffSet * 21);

    	$this->layout
       		 ->assign('model', 'Records.tpl')
       		 ->assign('title', 'Les meilleures séries TV - iScreenway '.$iOffSet)
       		 ->assign('description', 'Découvrez Toutes les meilleures séries : fiches, les résumés d\'épisode, classement des meilleures séries, news, programmes TV, vidéos, photos. '.$iOffSet)
       		 ->assign('submenu', 'best_series')
       		 ->assign('h1_records', 'Les meilleures séries TV')
       		 ->assign('alias', 'meilleures-series')
			 ->assign('records', $aBestMovies)
       		 ->display();
  	}

	/**
  	 * the main page of news
  	 *
  	 * @access public
  	 * @param  int $iOffSet
   	 * @return void
  	 */

  	public function showWanted($iOffSet = 0) {

    	$aBestMovies = $this->businessRecord->getWantedMovies('serie', 21, $iOffSet * 21);

    	$this->layout
       		 ->assign('model', 'Records.tpl')
       		 ->assign('title', 'Les séries TV les plus attendues - iScreenway '.$iOffSet)
       		 ->assign('description', 'Découvrez Toutes les séries TV les plus attendues : fiches, les résumés d\'épisode, classement des meilleures séries, news, programmes TV, vidéos, photos. '.$iOffSet)
       		 ->assign('submenu', 'wanted_series')
       		 ->assign('h1_records', 'Les séries TV les plus attendues')
       		 ->assign('alias', 'series-attendues')
			 ->assign('records', $aBestMovies)
       		 ->display();
  	}

	/**
  	 * the main page of news
  	 *
  	 * @access public
  	 * @param  int $iOffSet
   	 * @return void
  	 */

  	public function showSchedule() {

    	$this->layout
       		 ->assign('model', 'Schedule.tpl')
       		 ->assign('title', 'L\'agenda des séries TV - iScreenway')
       		 ->assign('description', 'Retrouvez l\'agenda complet des séries TV, les fiches, les résumés d\'épisode, classement des meilleures séries, news, programmes TV, vidéos, photos.')
       		 ->assign('submenu', 'schedule_serie')
       		 ->display();
  	}

	/**
  	 * the main page of news
  	 *
  	 * @access public
  	 * @param  int $iOffSet
  	 * @param  string $sLetter
   	 * @return void
  	 */

  	public function showSerieList($iOffSet = 0, $sLetter = null) {

  		$aSeries = $this->businessRecord->getMovies('serie', 21, $iOffSet * 21, $sLetter);

  		if (strlen($sLetter) > 0) {

  			$sTheFirstLetter = substr($sLetter, 0, 1);
  			$sH1Record = 'Toutes les séries TV commençant par '.$sLetter.'';
  		}
  		else {

  			$sTheFirstLetter = '';
  			$sH1Record = 'Toutes les séries TV';
  		}

    	$this->layout
       		 ->assign('model', 'ListSeries.tpl')
       		 ->assign('title', $sH1Record.' - iScreenway')
       		 ->assign('description', 'Retrouvez '.strtolower($sH1Record).', les fiches, les résumés d\'épisode, classement des meilleures séries, news, programmes TV, vidéos, photos.')
       		 ->assign('submenu', 'list_serie')
       		 ->assign('first_letter', $sTheFirstLetter)
       		 ->assign('records', $aSeries)
  			 ->assign('h1_records', $sH1Record)
       		 ->assign('alias', 'liste-series')
       		 ->display();
  	}
}

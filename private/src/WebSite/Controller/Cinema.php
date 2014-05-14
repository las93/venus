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
use \Venus\src\WebSite\Model\kind as modelKind;

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

class Cinema extends Controller {

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
		$this->modelKind = function() { return new modelKind; };

		parent::__construct();

		$this->layout->assign('menu', 'cinema');
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @return void
	 */

	public function show() {

		$aNewsMea = $this->businessArticle->getLastNewsByDay(4, 'cinema', 0);
		$aNews = $this->businessArticle->getLastNewsByDay(10, 'cinema', 4);
    	$aMea = $this->modelMea->getLastMea(2);
		$aTrailers = $this->businessTrailer->getLastTrailers(4, 'film');
		$aMoviesOfWeek = $this->businessRecord->getMoviesOfWeek('film', 9);

		$this->layout
			 ->assign('title', 'iScreenway : Cinéma, Séries TV, Stars, Vidéos et DVD')
			 ->assign('description', 'iScreenway, le site du cinéma et des séries tv ! Découvrez le programme tv de vos séries préférées, l&#39;actualité cinéma et séries, les dernières bandes-annonces, et plus encore.')
			 ->assign('news_mea', $aNewsMea)
			 ->assign('news', $aNews)
			 ->assign('meas', $aMea)
			 ->assign('trailers', $aTrailers)
			 ->assign('movies_week', $aMoviesOfWeek)
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

    	$aNews = $this->businessArticle->getLastNewsByDay(10, 'cinema', $iOffSet * 10);

   		$this->layout
       		 ->assign('model', 'News.tpl')
       		 ->assign('title', 'Les actualités cinéma - iScreenway '.$iOffSet)
       		 ->assign('description', 'Retrouvez toutes les actualités du cinéma, le guide des films à voir, news, communautés de fans, box-office... '.$iOffSet)
       		 ->assign('submenu', 'news')
       		 ->assign('news', $aNews)
       		 ->assign('h1_news', 'Actualités cinéma')
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

    	$aTrailers = $this->businessTrailer->getLastTrailers(21, 'film', $iOffSet * 21);

    	$this->layout
       		 ->assign('model', 'Trailers.tpl')
       		 ->assign('title', 'Bandes annonces de films - iScreenway '.$iOffSet)
       		 ->assign('description', 'Découvrez Toutes les bandes annonces de films au cinéma actuellement en salle ou en préparation. '.$iOffSet)
       		 ->assign('submenu', 'trailers')
       		 ->assign('trailers', $aTrailers)
       		 ->assign('h1_trailers', 'bandes-annonces de films')
       		 ->assign('alias', 'bande-annonce-cinema')
       		 ->display();
  	}

	/**
  	 * the main page of news
  	 *
  	 * @access public
  	 * @param  int $iOffSet
   	 * @return void
  	 */

  	public function showBestMovies($iOffSet = 0) {

    	$aBestMovies = $this->businessRecord->getBestMovies('film', 21, $iOffSet * 21);

    	$this->layout
       		 ->assign('model', 'Records.tpl')
       		 ->assign('title', 'Les meilleurs films du cinéma - iScreenway '.$iOffSet)
       		 ->assign('description', 'Retrouvez tous les meilleurs films du cinéma, le guide des films à voir, news, communautés de fans, box-office... '.$iOffSet)
       		 ->assign('submenu', 'best_movies')
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

  	public function showMoviesOfWeek($iOffSet = 0) {

    	$aBestMovies = $this->businessRecord->getMoviesOfWeek('film', 21, $iOffSet * 21);

    	$this->layout
       		 ->assign('model', 'Records.tpl')
       		 ->assign('title', 'Les films de la semaine au cinéma - iScreenway'.$iOffSet)
       		 ->assign('description', 'Retrouvez tous les films de la semaine au cinéma, le guide des films à voir, news, communautés de fans, box-office... '.$iOffSet)
       		 ->assign('submenu', 'week_movies')
       		 ->assign('h1_records', 'Films de la semaine')
       		 ->assign('alias', 'film-de-la-semaine')
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

  	public function showMoviesOf4Week($iOffSet = 0) {

    	$aBestMovies = $this->businessRecord->getMoviesOfWeek('film', 21, $iOffSet * 21, 4);

    	$this->layout
       		 ->assign('model', 'Records.tpl')
       		 ->assign('title', 'Les films du moment au cinéma - iScreenway'.$iOffSet)
       		 ->assign('description', 'Retrouvez tous les films du moment au cinéma, le guide des films à voir, news, communautés de fans, box-office... '.$iOffSet)
       		 ->assign('submenu', 'week4_movies')
       		 ->assign('h1_records', 'Films du moment')
       		 ->assign('alias', 'film-a-affiche')
			 ->assign('records', $aBestMovies)
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

  	public function showAllMovies($iOffSet = 0, $sLetter = null) {

    	$aBestMovies = $this->businessRecord->getMovies('film', 21, $iOffSet * 21, $sLetter);

  		if (strlen($sLetter) > 0) {

  			$sTheFirstLetter = substr($sLetter, 0, 1);
  			$sH1Record = 'Liste des films du cinéma commençant par '.$sLetter.'';
  		}
  		else {

  			$sTheFirstLetter = '';
  			$sH1Record = 'Liste des films du cinéma';
  		}

    	$this->layout
       		 ->assign('model', 'Records.tpl')
       		 ->assign('title', $sH1Record.' - iScreenway '.$iOffSet)
       		 ->assign('description', 'Retrouvez tous la '.strtolower($sH1Record).', le guide des films à voir, news, communautés de fans, box-office... '.$iOffSet)
       		 ->assign('submenu', 'all_movies')
       		 ->assign('h1_records', $sH1Record)
       		 ->assign('alias', 'liste-film')
			 ->assign('records', $aBestMovies)
       		 ->assign('first_letter', $sTheFirstLetter)
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
       		 ->assign('title', 'L\'agenda des films - iScreenway')
       		 ->assign('description', 'Retrouvez l\'agenda complet des films, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
       		 ->assign('submenu', 'schedule_movies')
       		 ->display();
  	}

	/**
  	 * the main page of news
  	 *
  	 * @access public
  	 * @param  int $iOffSet
   	 * @return void
  	 */

  	public function showBoxOffice() {

  		$aMoviesOfWeek = $this->businessRecord->getMoviesOfWeek('film', 9);
		$aNews = $this->businessArticle->getLastNewsByDay(4, 'cinema', 0);

    	$this->layout
       		 ->assign('model', 'BoxOffice.tpl')
       		 ->assign('title', 'Le box-office du cinéma - iScreenway')
       		 ->assign('description', 'Retrouvez le box-office complet du cinéma avec tous les chiffres désirés...')
       		 ->assign('submenu', 'boxoffice_movies')
			 ->assign('movies_week', $aMoviesOfWeek)
			 ->assign('news', $aNews)
       		 ->display();
  	}

	/**
  	 * the main page of news
  	 *
  	 * @access public
  	 * @param  int $iOffSet
   	 * @return void
  	 */

  	public function showLittleMovieList() {

    	$this->layout
       		 ->assign('model', 'LittleMovieList.tpl')
       		 ->assign('title', 'Les court-métrages - iScreenway')
       		 ->assign('description', 'Retrouvez tous les court-métrages du monde cinématographique ainsi que tous les films d\'auteurs...')
       		 ->assign('submenu', 'little_movies')
       		 ->display();
  	}


  	/**
  	 * the main page of news
  	 *
  	 * @access public
  	 * @param  int $iId
  	 * @param  string $sTitle
  	 * @param  int $iOffSet
  	 * @param  string $sLetter
  	 * @return void
  	 */

  	public function showOneKindForMovie($iId, $sTitle, $iOffSet = 0, $sLetter = null) {

  		$aBestMovies = $this->businessRecord->getMovies('film', 21, $iOffSet * 21, $sLetter, $iId);
		$oKind = $this->modelKind->findOneById($iId);

		if (strlen($sLetter) > 0) {

			$sTheFirstLetter = substr($sLetter, 0, 1);
			$sH1Record = 'Tous les films '.$oKind->get_name().' commençant par '.$sLetter.'';
		}
		else {

			$sTheFirstLetter = '';
			$sH1Record = 'Tous les films '.$oKind->get_name();
		}

  		$this->layout
  			 ->assign('model', 'RecordsByKind.tpl')
  			 ->assign('title', $sH1Record.' - iScreenway '.$iOffSet)
  			 ->assign('description', 'Retrouvez '.strtolower($sH1Record).', le guide des films à voir, news, communautés de fans, box-office... '.$iOffSet)
  			 ->assign('submenu', 'animation_movies')
  			 ->assign('h1_records', $sH1Record)
  			 ->assign('records', $aBestMovies)
       		 ->assign('first_letter', $sTheFirstLetter)
  			 ->display();
  	}
}

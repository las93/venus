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
use \Venus\src\WebSite\Business\Actor as businessActor;
use \Venus\src\WebSite\Business\Article as businessArticle;
use \Venus\src\WebSite\Business\Record as businessRecord;
use \Venus\src\WebSite\Business\Trailer as businessTrailer;
use \Venus\src\WebSite\Model\mea as modelMea;
use \Venus\src\WebSite\Model\person as modelPerson;

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

class Home extends Controller {

  /**
   * Constructor
   *
   * @access public
   * @return object
   */

  public function __construct() {

    $this->businessActor = function() { return new businessActor; };
    $this->businessArticle = function() { return new businessArticle; };
    $this->businessRecord = function() { return new businessRecord; };
    $this->businessTrailer = function() { return new businessTrailer; };
    $this->modelMea = function() { return new modelMea; };
    $this->modelPerson = function() { return new modelPerson; };

    parent::__construct();

    $this->layout->assign('menu', 'home');
  }

  /**
   * the main page
   *
   * @access public
   * @return void
   */

  public function show() {

    $aNewsMea = $this->businessArticle->getLastNewsByDay(4, 'all', 0);
    $aNews = $this->businessArticle->getLastNewsByDay(10, 'all', 4);
    $aMea = $this->modelMea->getLastMea(1);
    $aTrailers = $this->businessTrailer->getLastTrailers();
    $aMoviesOfWeek = $this->businessRecord->getMoviesOfWeek('film', 9);
    $aBestMovies = $this->businessRecord->getBestMovies('serie', 9);

    $this->layout
       ->assign('title', 'iScreenway : Cinéma, Séries TV, Stars, Vidéos et DVD')
       ->assign('description', 'iScreenway, le site du cinéma et des séries tv ! Découvrez le programme tv de vos séries préférées, l&#39;actualité cinéma et séries, les dernières bandes-annonces, et plus encore.')
       ->assign('news_mea', $aNewsMea)
       ->assign('news', $aNews)
       ->assign('meas', $aMea)
       ->assign('trailers', $aTrailers)
       ->assign('movies_week', $aMoviesOfWeek)
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

    $aNews = $this->businessArticle->getLastNewsByDay(10, 'all', $iOffSet * 10);

    $this->layout
       ->assign('model', 'News.tpl')
       ->assign('title', 'Actualité films, DVD et cinéma - iScreenway '.$iOffSet)
       ->assign('description', 'Découvrez toutes les actualités du cinéma, des stars, des séries TV sur iSreenway '.$iOffSet)
       ->assign('submenu', 'news')
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

  public function showFolders($iOffSet = 0) {

    $aNews = $this->businessArticle->getLastNewsByDay(10, 'folder', $iOffSet * 10);

    $this->layout
       ->assign('model', 'Folders.tpl')
       ->assign('title', 'Dossiers de films, DVD et cinéma - iScreenway '.$iOffSet)
       ->assign('description', 'Découvrez tous les meilleurs dossiers cinémas et séries TV sur iSreenway'.$iOffSet)
       ->assign('submenu', 'folders')
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

  public function showTrailers($iOffSet = 0) {

    $aTrailers = $this->businessTrailer->getLastTrailers(21, null, $iOffSet * 21);

    $this->layout
       ->assign('model', 'Trailers.tpl')
       ->assign('title', 'Bandes annonces de films, DVD et Série TV - iScreenway '.$iOffSet)
       ->assign('description', 'Découvrez toutes les bandes annonces de films au cinéma, des DVD sortis et des meilleures séries TV. '.$iOffSet)
       ->assign('submenu', 'trailers')
       ->assign('trailers', $aTrailers)
       ->display();
  }

  /**
   * the main page of news
   *
   * @access public
   * @param  int $iOffSet
   * @param  string $sFirstLetter
   * @return void
   */

  public function showActors($iOffSet = 0, $sFirstLetter = null) {

    $aPersons = $this->businessActor->getActorsList(21, $iOffSet * 21, $sFirstLetter);

    if ($sFirstLetter !== null) { $sTitleSup = ' commençant par '.$sFirstLetter.' '; }
    else { $sTitleSup = ''; }

    if (strlen($sFirstLetter) > 0) {

    	$sTheFirstLetter = substr($sFirstLetter, 0, 1);
    	$sH1Actors = 'Stars commençant par '.$sFirstLetter.'';
    }
    else {

    	$sTheFirstLetter = '';
    	$sH1Actors = 'Stars commençant par '.$sFirstLetter.'';
    }

    $this->layout
       ->assign('model', 'Actors.tpl')
       ->assign('title', 'Toutes les stars '.$sTitleSup.' - iScreenway '.$iOffSet)
       ->assign('description', 'Découvrez toutes les stars '.$sTitleSup.' avec leur fiche complète : biographie, vidéo, actualités '.$iOffSet)
       ->assign('submenu', 'actors')
       ->assign('actors', $aPersons)
       ->assign('first_letter', $sTheFirstLetter)
       ->assign('title_sup', $sTitleSup)
       ->assign('h1_actors', $sH1Actors)
       ->display();
  }
}

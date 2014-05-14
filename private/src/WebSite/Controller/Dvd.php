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

class Dvd extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->businessArticle = function() { return new businessArticle; };
		$this->businessRecord = function() { return new businessRecord; };

		parent::__construct();

		$this->layout->assign('menu', 'dvd');
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @return void
	 */

	public function show($iOffSet = 0) {

		$aDvds = $this->businessRecord->getDvdOrBlurayByDate('all', 21, $iOffSet * 21);
		$aNews = $this->businessArticle->getLastDvdNews(21, $iOffSet * 21);

		$this->layout
			 ->assign('title', 'Les DVD/Blu-ray - news, critiques, disponibilité - iScreenway '.$iOffSet)
			 ->assign('description', 'Découvrez Tout sur les DVD et Bluray : fiches, les résumés, classement des meilleures DVD/Bluray, news, vidéos, photos. '.$iOffSet)
			 ->assign('records', $aDvds)
			 ->assign('h1_records', 'les DVD/Bluray du moment')
			 ->assign('news', $aNews)
			 ->assign('alias_global', 'news-dvd')
			 ->assign('title_global', 'Toutes les actualités DVD/Blu-ray')
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

    	$aNews = $this->businessArticle->getLastDvdNews(10, $iOffSet * 10);

   		$this->layout
       		 ->assign('model', 'News.tpl')
       		 ->assign('title', 'Les actualités DVD/Blu-ray - iScreenway '.$iOffSet)
       		 ->assign('description', 'Retrouvez toutes les actualités des DVD/Blu-ray, sur leurs bonus et making of inclus... '.$iOffSet)
       		 ->assign('submenu', 'dvd_news')
       		 ->assign('news', $aNews)
       		 ->assign('h1_news', 'Actualités DVD/BluRay')
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

  		$aDvds = $this->businessRecord->getBestDvdOrBluray('all', 21, $iOffSet * 21);

   		$this->layout
       		 ->assign('model', 'Records.tpl')
       		 ->assign('title', 'Les actualités DVD/Blu-ray - iScreenway '.$iOffSet)
       		 ->assign('description', 'Retrouvez toutes les actualités des DVD/Blu-ray, sur leurs bonus et making of inclus... '.$iOffSet)
       		 ->assign('submenu', 'best_dvd')
			 ->assign('records', $aDvds)
			 ->assign('h1_records', 'les DVD/Bluray du moment')
			 ->assign('alias', 'meilleurs-dvd')
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

  		$aDvds = $this->businessRecord->getWantedDvdOrBluray('all', 21, $iOffSet * 21);

   		$this->layout
       		 ->assign('model', 'Records.tpl')
       		 ->assign('title', 'Les DVD/Blu-ray les plus attendus - iScreenway '.$iOffSet)
       		 ->assign('description', 'Retrouvez tous les DVD/Blu-ray les plus attendus, sur leurs bonus et making of inclus... '.$iOffSet)
       		 ->assign('submenu', 'wanted_dvd')
			 ->assign('records', $aDvds)
			 ->assign('h1_records', 'les DVD/Blu-ray les plus attendus')
			 ->assign('alias', 'dvd-attendus')
       		 ->display();
  	}

  	/**
  	 * the main page of news
  	 *
  	 * @access public
  	 * @param  int $iOffSet
  	 * @return void
  	 */

  	public function showList($iOffSet = 0) {

  		$aDvds = $this->businessRecord->getDvdOrBluray('all', 21, $iOffSet * 21);

   		$this->layout
       		 ->assign('model', 'Records.tpl')
       		 ->assign('title', 'Tous les DVD/Blu-ray - iScreenway '.$iOffSet)
       		 ->assign('description', 'Retrouvez tous les DVD/Blu-ray du commerce, sur leurs bonus et making of inclus... '.$iOffSet)
       		 ->assign('submenu', 'list_dvd')
			 ->assign('records', $aDvds)
			 ->assign('h1_records', 'Tous les DVD/Blu-ray')
			 ->assign('alias', 'liste-dvd')
       		 ->display();
  	}
}

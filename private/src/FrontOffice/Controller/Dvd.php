<?php

/**
 * Controller to dvd
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
use \Venus\src\FrontOffice\Controller\Record as controllerRecord;
use \Venus\src\FrontOffice\Model\kind as modelKind;
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

/**
 * Controller to dvd
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

		$this->modelRecord = function() { return new modelRecord; };
		$this->modelKind = function() { return new modelKind; };
		$this->controllerRecord = function() { return new controllerRecord; };
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
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function show($iOffset = 0) {

		$aBestDvd = $this->modelRecord->getDvdOrBlurayByDate($sType = 'all', $iOffset);
		$aBestDvd = $this->controllerRecord->getExtendedInfos($aBestDvd);
		$aKinds = $this->modelKind->get();

		$this->layout
			 ->assign('tpl_dvd_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'DvdSubMenu.tpl')
			 ->assign('tpl_one_dvd', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneDvd.tpl')
			 ->assign('title', 'Les DVD/Blu-ray - news, critiques, disponibilité - iScreenway')
			 ->assign('description', 'Découvrez Tout sur les DVD et Bluray : fiches, les résumés, classement des meilleures DVD/Bluray, news, vidéos, photos.')
			 ->assign('best_dvd', $aBestDvd)
			 ->assign('kinds', $aKinds)
			 ->assign('sub_menu4', true)
			 ->assign('type', 'normal')
			 ->assign('category', 'dvd') 
			 ->assign('url', $this->url->getUrl('dvd', array()))
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

		$aBestDvd = $this->modelRecord->getBestDvdOrBluray($sType = 'all', $iOffset);
		$aBestDvd = $this->controllerRecord->getExtendedInfos($aBestDvd);
		$aKinds = $this->modelKind->get();

		$this->layout
			  ->assign('tpl_dvd_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'DvdSubMenu.tpl')
			  ->assign('tpl_one_dvd', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneDvd.tpl')
			  ->assign('title', 'Les meilleurs DVD/Blu-ray - iScreenway')
			  ->assign('description', 'Découvrez tous les meilleurs DVD et Bluray du moment : fiches, les résumés, classement des meilleures DVD/Bluray, news, vidéos, photos.')
			  ->assign('best_dvd', $aBestDvd)
			  ->assign('kinds', $aKinds)
			  ->assign('sub_menu4', true)
			  ->assign('type', 'best')
			 ->assign('category', 'dvd')
			  ->assign('url', $this->url->getUrl('meilleurs-dvd', array()))
			  ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showBestForUs($iOffset = 0) {

		$aBestDvd = $this->modelRecord->getBestDvdOrBlurayForUs($sType = 'all', $iOffset);
		$aBestDvd = $this->controllerRecord->getExtendedInfos($aBestDvd);
		$aKinds = $this->modelKind->get();

		$this->layout
			  ->assign('tpl_dvd_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'DvdSubMenu.tpl')
			  ->assign('tpl_one_dvd', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneDvd.tpl')
			  ->assign('title', 'Notre sélection DVD/Blu-ray - iScreenway')
			  ->assign('description', 'Découvrez notre sélection de DVD et Bluray du moment : fiches, les résumés, classement des meilleures DVD/Bluray, news, vidéos, photos.')
			  ->assign('best_dvd', $aBestDvd)
			  ->assign('kinds', $aKinds)
			  ->assign('sub_menu4', true)
			  ->assign('type', 'bestforus')
			 ->assign('url', $this->url->getUrl('notre-selection-dvd', array()))
			  ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @return void
	 */

	public function showSchedule($iOffset = 0) {

		$aBestDvd = $this->modelRecord->getBestDvdOrBlurayForUs($sType = 'all', $iOffset);
		$aBestDvd = $this->controllerRecord->getExtendedInfos($aBestDvd);
		$aKinds = $this->modelKind->get();

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'DvdSchedule.tpl')
			  ->assign('tpl_dvd_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'DvdSubMenu.tpl')
			 ->assign('title', 'Les meilleurs DVD/Blu-ray - iScreenway')
			 ->assign('description', 'Découvrez Tous les meilleurs DVD et Bluray du moment : fiches, les résumés, classement des meilleures DVD/Bluray, news, vidéos, photos.')
			 ->assign('sub_menu4', true)
			 ->display();
	}
}
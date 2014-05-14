<?php

/**
 * Controller to trailer
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
use \Venus\src\FrontOffice\Model\trailer as modelTrailer;
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

/**
 * Controller to trailer
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

class Trailer extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->controllerRecord = function() { return new controllerRecord; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelTrailer = function() { return new modelTrailer; };
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

	public function show($iOffset = 0) {

		$aTrailer = $this->getLastTrailers(20, null, $iOffset * 20);

		if ($iOffset == 0) { $iOffset = ''; }

		$this->layout
			 ->assign('title', 'Bandes annonces de films, DVD et Série TV - iScreenway '.$iOffset)
			 ->assign('description', 'Découvrez Toutes les bandes annonces de films au cinéma, des DVD sortis et des meilleures séries TV. '.$iOffset)
			 ->assign('last_trailers', $aTrailer)
			 ->assign('type', 'all')
			 ->assign('url', $this->url->getUrl('bande-annonce', array()))
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @return void
	 */

	public function showCinema($iOffset = 0) {

		$aTrailer = $this->getLastTrailers(20, 'film', $iOffset * 20);

		if ($iOffset == 0) { $iOffset = ''; }

		$this->layout
			 ->assign('title', 'Bandes annonces de films - iScreenway '.$iOffset)
			 ->assign('description', 'Découvrez Toutes les bandes annonces de films au cinéma actuellement en salle ou en préparation. '.$iOffset)
			 ->assign('last_trailers', $aTrailer)
			 ->assign('sub_menu', true)
			 ->assign('category', 'cinema')
			 ->assign('url_enfant', $this->url->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->assign('type', 'cinema')
			 ->assign('url', $this->url->getUrl('bande-annonce-cinema', array()))
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @return void
	 */

	public function showSerie($iOffset = 0) {

		$aTrailer = $this->getLastTrailers(20, 'serie', $iOffset * 20);

		if ($iOffset == 0) { $iOffset = ''; }

		$this->layout
			 ->assign('title', 'Bandes-annonces de séries TV - iScreenway '.$iOffset)
			 ->assign('description', 'Découvrez Toutes les bandes annonces de séries TV actuellement nos écrans ou en préparation. '.$iOffset)
			 ->assign('last_trailers', $aTrailer)
			 ->assign('sub_menu2', true)
			 ->assign('type', 'serie')
			 ->assign('category', 'series')
			 ->assign('url', $this->url->getUrl('bande-annonce-serie', array()))
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iId id of trailer
	 * @param  string $sTitle title
	 * @return void
	 */

	public function showOne($iId, $sTitle, $iIdRecord = null, $sTitleRecord = null, $sBase = null) {

		$oTrailer = $this->modelTrailer->findOneByid($iId);
		$oRecord = $this->modelRecord->findOneByid($oTrailer->get_id_record());

		if ($oRecord->get_type() == 'serie') { $sBase = 'series/liste'; }
		else { $sBase = 'cinema/film'; }

		$aOtherTrailers = $this->getLastTrailers();
		$aMenus = $this->controllerRecord->getRecordMenu($oTrailer->get_id_record());

		if ($oRecord->get_type() == 'serie') {

			$this->layout->assign('category', 'series');
			$sBase = 'series/liste';
		}
		else {

			$this->layout->assign('category', 'cinema');
			$sBase = 'cinema/film';
		}

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'TrailerOne.tpl')
			 ->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordMenu.tpl')
			 ->assign('record_menu', $aMenus)
			 ->assign('tpl_last_trailers', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'TrailersLast.tpl')
			 ->assign('title', $oTrailer->get_title().' - iScreenway')
			 ->assign('trailer', $oTrailer)
			 ->assign('record', $oRecord)
			 ->assign('menu_select', 3)
			 ->assign('last_trailers', $aOtherTrailers)
			 ->assign('description', 'Découvrez la '.$oTrailer->get_title().' et plein d\'autres bandes annonces sur iScreenway.')
			 ->assign('url_film', $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->assign('url_film_ba', $this->url->getUrl('bande-annonce-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
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

	public function showByRecord($iId, $sTitle, $sBase) {

		$oRecord = $this->modelRecord->findOneByid($iId);

		if (preg_match('|/film/bande_annonce/|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)));
			exit;
		}
		else if ($oRecord->get_type() == 'serie' && preg_match('|cinema/film|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('bande-annonce-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste')));
			exit;
		}

		if ($oRecord->get_type() == 'serie') {

			$this->layout->assign('category', 'series');
			$sBase = 'series/liste';
		}
		else {

			$this->layout->assign('category', 'cinema');
			$sBase = 'cinema/film';
		}

		$oTrailer = $this->modelTrailer->findOneByid_record($iId);
		$aMenus = $this->controllerRecord->getRecordMenu($iId);
		$aOtherTrailers = $this->getLastTrailersByRecord($iId);

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'TrailerByRecord.tpl')
			 ->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordMenu.tpl')
			 ->assign('record_menu', $aMenus)
			 ->assign('title', 'bandes-annonces de '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Découvrez les bandes-annonces de '.$oRecord->get_title().' et plein d\'autres bandes annonces sur iScreenway.')
			 ->assign('trailer', $oTrailer)
			 ->assign('title', $oRecord->get_title())
			 ->assign('last_trailers', $aOtherTrailers)
			 ->assign('record', $oRecord)
			 ->assign('menu_select', 3)
			 ->assign('trailer_record', true)
			 ->assign('url_trailer_record', $this->url->getUrl('bande-annonce-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->assign('tpl_last_trailers', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'TrailersLast.tpl')
			 ->assign('url_film', $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->assign('url_film_ba', $this->url->getUrl('bande-annonce-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
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

	public function showExByRecord($iId, $sTitle) {

		$oRecord = $this->modelRecord->findOneByid($iId);

		if ($oRecord->get_type() == 'serie') { $sBase = 'series/liste'; }
		else { $sBase = 'cinema/film'; }

		$this->redirect($this->url->getUrl('bande-annonce-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)));
		exit;
	}

	/**
	 * get last trailers
	 *
	 * @access public
	 * @param  int $iLimit limit
	 * @param  string $sType type of trailers
	 * @param  int $iOffset offset
	 * @return array
	 */

	public function getLastTrailers($iLimit = 4, $sType = null, $iOffset = 0) {

		$aTrailer = $this->modelTrailer->getLastRows($iLimit, $sType, null, $iOffset);

		if (is_array($aTrailer) && $aTrailer[0]->count > 0) {

			foreach ($aTrailer as $iKey => $oTrailer) {
	
				$oRecord = $this->modelRecord->findOneByid($oTrailer->get_id_record());
	
				if ($oRecord->get_type() == 'serie') { $sBase = 'series/liste'; }
				else { $sBase = 'cinema/film'; }
	
				$aTrailer[$iKey]->url = $this->url->getUrl('bande-annonce-detail', array('id' => $oTrailer->get_id(), 'title' => $this->url->encodeToUrl($oTrailer->get_title()), 'id_record' => $oRecord->get_id(), 'base' => $sBase, 'title_record' => $this->url->encodeToUrl($oRecord->get_title())));
				//$aTrailer[$iKey]->url = '';
			}
		}

		return $aTrailer;
	}

	/**
	 * get last trailers
	 *
	 * @access public
	 * @param  int $iRecordId id_record
	 * @param  int $iLimit limit
	 * @param  string $sType type of trailers
	 * @return array
	 */

	public function getLastTrailersByRecord($iRecordId, $iLimit = 4, $sType = null) {

		$aTrailer = $this->modelTrailer->getLastRows($iLimit = 4, $sType, $iRecordId);

		if (is_array($aTrailer) && $aTrailer[0]->count > 0) {
			
			foreach ($aTrailer as $iKey => $oTrailer) {
	
				$oRecord = $this->modelRecord->findOneByid($oTrailer->get_id_record());
	
				if ($oRecord->get_type() == 'serie') { $sBase = 'series/liste'; }
				else { $sBase = 'cinema/film'; }
	
				$aTrailer[$iKey]->url = $this->url->getUrl('bande-annonce-detail', array('id' => $oTrailer->get_id(), 'title' => $this->url->encodeToUrl($oTrailer->get_title())));
				//$aTrailer[$iKey]->url = '';
			}
		}

		return $aTrailer;
	}

}
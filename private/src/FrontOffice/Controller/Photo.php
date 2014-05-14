<?php

/**
 * Controller to Photo
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
use \Venus\src\FrontOffice\Model\photo as modelPhoto;
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Controller\Record as controllerRecord;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

/**
 * Controller to Photo
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

class Photo extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelPhoto = function() { return new modelPhoto; };
		$this->modelRecord = function() { return new modelRecord; };
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
	 * the main page of folders
	 *
	 * @access public
	 * @param  int $iId id
	 * @param  string $sTitle title
	 * @return void
	 */

	public function show($iId, $sTitle) {

		$oPhoto = $this->modelPhoto->findOneById($iId);

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'PhotoOne.tpl')
			 ->assign('photo', $oPhoto)
			 ->assign('title', 'Photo de '.$oPhoto->get_title().' - iScreenway')
			 ->assign('description', 'Retrouvez la photo '.$oPhoto->get_title().' ainsi que des milliers d\'autres photos de cinémas, de stars et de séries...')
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

	public function showByRecord($iId, $sTitle, $iOffset = 0) {

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

			$this->redirect($this->url->getUrl('photo-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste')));
			exit;
		}
		else if (preg_match('|/film/photos/|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('photo-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste')));
			exit;
		}

		$aMenus = $this->controllerRecord->getRecordMenu($iId);

		$aPhotos = $this->modelPhoto->getPhotosByRecord($iId, 20, $iOffset);

		if ($aPhotos[0]->count > 0) {
		
			foreach ($aPhotos as $iKey => $oPhoto) {

				$aPhotos[$iKey]->url = $this->url->getUrl('une-photos', array('id' => $oPhoto->get_id(), 'title' => $this->url->encodeToUrl($oPhoto->get_title())));
			}
		}

		$this->layout
			 ->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordMenu.tpl')
			 ->assign('record_menu', $aMenus)
			 ->assign('record', $oRecord)
			 ->assign('title', 'Photos du film '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Retrouvez les films au cinéma, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
			 ->assign('url_film', $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->assign('url_film_photo', $this->url->getUrl('photo-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->assign('sub_menu', true)
			 ->assign('menu_select', 7)
			 ->assign('url_enfant', $this->url->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->assign('photos', $aPhotos)
			 ->display();
	}
}

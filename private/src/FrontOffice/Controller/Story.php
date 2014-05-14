<?php

/**
 * Controller to Story
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
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Model\story as modelStory;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

/**
 * Controller to Story
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

class Story extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->controllerRecord = function() { return new controllerRecord; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelStory = function() { return new modelStory; };
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
	 * @param  int $iId id of Record
	 * @param  string $sTitle title
	 * @param  string $sBase base of url
	 * @return void
	 */

	public function showByRecord($iId, $sTitle, $sBase) {


		$aMenus = $this->controllerRecord->getRecordMenu($iId);
		$oRecord = $this->modelRecord->findOneByid($iId);
		$aStories = $this->modelStory->findByid_record($iId);

		if ($oRecord->get_type() == 'serie') { $sBase = 'series/liste'; }
		else { $sBase = 'cinema/film'; }

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordStory.tpl')
			 ->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordMenu.tpl')
			 ->assign('record_menu', $aMenus)
			 ->assign('record', $oRecord)
			 ->assign('title', 'Anecdotes et secrets de tournage de '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Découvrez Toutes les anecdotes et secrets de tournage de  de '.$oRecord->get_title().'.')
			 ->assign('stories', $aStories)
			 ->assign('menu_select', 9)
			 ->assign('url_story', $this->url->getUrl('anecdotes', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->assign('url_film', $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->display();
	}
}
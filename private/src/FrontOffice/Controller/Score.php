<?php

/**
 * Controller to Score
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
use \Venus\src\FrontOffice\Model\Score as modelScore;
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Controller\Record as controllerRecord;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;
use \Venus\src\FrontOffice\Model\critic as modelCritic;
use \Venus\src\FrontOffice\Entity\critic as entityCritic;

/**
 * Controller to Score
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

class Score extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelScore = function() { return new modelScore; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->controllerRecord = function() { return new controllerRecord; };
		$this->modelTopSearch = function() { return new modelTopSearch; };
		$this->modelCritic = function() { return new modelCritic; };

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
	 * @return void
	 */

	public function show() {


	}

	/**
	 * the main page of news for one movie
	 *
	 * @access public
	 * @param  int $iId id
	 * @param  string $sTitle title
	 * @return void
	 */

	public function showByRecord($iId, $sTitle) {

		if (isset($_POST) && count($_POST) && $this->session->get('userid')) {

			$oCritic = new entityCritic;
			$oCritic->set_id_user($this->session->get('userid'))
					->set_content($_POST['comment'])
					->set_created(date('Y-m-d H:s:i'))
					->set_score($_POST['score'])
					->set_id_record($iId);

			$this->modelCritic->insert($oCritic);
		}

		$oRecord = $this->modelRecord->findOneById($iId);
		$aCritics = $this->modelCritic->getCriticByRecord($iId, 20, 0);

		if ($oRecord->get_type() == 'serie') {
				
			$this->layout->assign('category', 'series');
			$sBase = 'series/liste';
		}
		else {
				
			$this->layout->assign('category', 'cinema');
			$sBase = 'cinema/film';
		}

		if ($oRecord->get_type() == 'serie' && preg_match('|cinema/film|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('critique-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => 'series/liste')));
			exit;
		}
		else if (preg_match('|/film/critiques/|', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('critique-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)));
			exit;
		}

		$aMenus = $this->controllerRecord->getRecordMenu($iId);

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ScoreOne.tpl')
			 ->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordMenu.tpl')
			 ->assign('record_menu', $aMenus)
			 ->assign('record', $oRecord)
			 ->assign('title', 'Critique du film '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Retrouvez les films au cinéma, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
			 ->assign('url_film', $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->assign('url_film_casting', $this->url->getUrl('critique-film', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase)))
			 ->assign('sub_menu', true)
			 ->assign('url_enfant', $this->url->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->assign('critics', $aCritics)
			 ->assign('menu_select', 6)
			 ->assign('is_connect', $this->session->get('user'))
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

	public function showMovie($iId, $sTitle) {

		$oRecord = $this->modelRecord->findOneById($iId);
		$aMenus = $this->controllerRecord->getRecordMenu($iId);

		$this->layout
			 ->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'MoviesByScore.tpl')
			 ->assign('record_menu', $aMenus)
			 ->assign('record', $oRecord)
			 ->assign('title', 'Les meilleurs film selon les spectateurs - iScreenway')
			 ->assign('description', 'Retrouvez les meilleurs film selon les spectateurs, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
			 ->display();
	}
}

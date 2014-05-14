<?php

/**
 * Controller to Search
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
use \Venus\lib\Date as Date;
use \Venus\core\UrlManager as UrlManager;
use \Venus\src\FrontOffice\Controller\Record as controllerRecord;
use \Venus\src\FrontOffice\Entity\top_search as entityTopSearch;
use \Venus\src\FrontOffice\Model\article as modelArticle;
use \Venus\src\FrontOffice\Model\person as modelPerson;
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

/**
 * Controller to Search
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

class Search extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->controllerRecord = function() { return new controllerRecord; };
		$this->modelPerson = function() { return new modelPerson; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelArticle = function() { return new modelArticle; };
		$this->modelTopSearch = function() { return new modelTopSearch; };

		parent::__construct();

		$aSearch = $this->modelTopSearch->getTop(5);
		$oUrlManager = new UrlManager;
		$sSearch = '';

		foreach ($aSearch as $oSearch) {

			$sSearch .= ' &nbsp;&nbsp; <a href="'.$oUrlManager->getUrl('recherche', array('word' => $oSearch->get_word())).'" style="color:white;">'.$oSearch->get_word().'</a> ';
		}

		$this->layout->assign('word_to_search', $sSearch);
	}

	/**
	 * the main page of folders
	 *
	 * @access public
	 * @param  string $sWord word to search
	 * @return void
	 */

	public function show($sWord) {

		if (!$sWord && isset($_POST['word'])) { $sWord = $_POST['word']; }

		$sWord = urldecode($sWord);

		if ($sWord) {

			$sWord = urldecode($sWord);

			$oTopSearch = new entityTopSearch;
			$oTopSearch->set_word($sWord)
					   ->set_created(date('Y-m-d H:s:i'));

			$this->modelTopSearch->insert($oTopSearch);

			//$aRecords = $this->modelRecord->getLikeWord(preg_replace('([^a-zA-Z0-9])', '.*', $sWord));
			//$aRecords = $this->controllerRecord->getExtendedInfos($aRecords);
			//$aPersons = $this->modelPerson->getLikeWord(preg_replace('([^a-zA-Z0-9])', '.*', $sWord));
			//$aNews = $this->modelArticle->getLikeWord(preg_replace('([^a-zA-Z0-9])', '.*', $sWord));

			$aRecords = $this->modelRecord->getLikeWord($sWord);
			$aRecords = $this->controllerRecord->getExtendedInfos($aRecords);
			$aPersons = $this->modelPerson->getLikeWord($sWord);
			$aNews = $this->modelArticle->getLikeWord($sWord);

			foreach ($aNews as $iKey => $oNews) {

				if ($aNews[0]->count > 0) {

					$aNews[$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
					preg_match('/^(?P<year>[0-9]{4})-(?P<month>[0-9]{2})-(?P<day>[0-9]{2}) .*$/', $oNews->get_created(), $aCreated);
					$aNews[$iKey]->date = Date::getDayInWord(date('w', strtotime($aCreated['year'].'-'.$aCreated['month'].'-'.$aCreated['day']))).' '.(int)$aCreated['day'].' '.Date::getMonthInWord($aCreated['month']).' '.(int)$aCreated['year'];
					$aNews[$iKey]->date2 = $aCreated['day'].'/'.$aCreated['month'].'/'.$aCreated['year'];
				}
			}

			$oUrlManager = new UrlManager;

			if ($aPersons[0]->count > 0) {

				foreach ($aPersons as $iKey => $oActor) {

					$aPersons[$iKey]->url = $oUrlManager->getUrl('acteur-detail', array('id' => $oActor->get_id(), 'title' => $oUrlManager->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name())));
				}
			}
			else {

				$aPersons = [];
			}

			if ($aRecords[0]->count < 1) {

				$aRecords = [];
			}
		}
		else {

			$aRecords = array();
			$aPersons = array();
			$aNews = array();
		}

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Search.tpl')
			 ->assign('title', 'Recherchez '.$sWord.'  - iScreenway')
			 ->assign('description', 'Découvrez tout ce qui concerne '.$sWord.'sur iScreenway.')
			 ->assign('movies_week', $aRecords)
			 ->assign('persons', $aPersons)
			 ->assign('news', $aNews)
			 ->display();
	}
}

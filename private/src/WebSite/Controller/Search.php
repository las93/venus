<?php

/**
 * Controller to test
 *
 * @category  	src
 * @package   	src\WebSite\Controller
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
use \Venus\lib\Date as Date;
use \Venus\core\UrlManager as UrlManager;
use \Venus\src\WebSite\Business\Record as businessRecord;
use \Venus\src\WebSite\Entity\top_search as entityTopSearch;
use \Venus\src\WebSite\Model\article as modelArticle;
use \Venus\src\WebSite\Model\person as modelPerson;
use \Venus\src\WebSite\Model\record as modelRecord;
use \Venus\src\WebSite\Model\top_search as modelTopSearch;

/**
 * Controller to test
 *
 * @category  	src
 * @package   	src\WebSite\Controller
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

		$this->businessRecord = function() { return new businessRecord; };
		$this->modelPerson = function() { return new modelPerson; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelArticle = function() { return new modelArticle; };
		$this->modelTopSearch = function() { return new modelTopSearch; };

		parent::__construct();

		$this->layout->assign('menu', 'home');
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

			$aRecords = $this->modelRecord->getLikeWord($sWord);
			$aRecords['items'] = $this->businessRecord->getExtendedInfos($aRecords['items']);
			$aPersons = $this->modelPerson->getLikeWord($sWord);
			$aNews = $this->modelArticle->getLikeWord($sWord);

			foreach ($aNews['items'] as $iKey => $oNews) {

				$aNews['items'][$iKey]->date_ago = Date::GetTimeAgoInString($oNews->get_created());
				$aNews['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => 'article'));
				$aNews['items'][$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
			}

			foreach ($aPersons['items'] as $iKey => $oActor) {

				$aPersons['items'][$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name())));
			}
		}
		else {

			$aRecords = array();
			$aPersons = array();
			$aNews = array();
		}

		$this->layout
			 ->assign('title', 'Recherchez '.$sWord.'  - iScreenway')
			 ->assign('description', 'Découvrez tout ce qui concerne '.$sWord.'sur iScreenway.')
			 ->assign('movies', $aRecords)
			 ->assign('persons', $aPersons)
			 ->assign('news', $aNews)
			 ->display();
	}
}

<?php

/**
 * Controller to Article
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

namespace Venus\src\WebSite\Business;

use \Venus\core\Business as Business;
use \Venus\lib\Date as Date;
use \Venus\src\WebSite\Model\article as modelArticle;

/**
 * Controller to Article
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

class Article extends Business {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelArticle = function() { return new modelArticle; };

		parent::__construct();
	}

	/**
	 * the main page of news for one movie
	 *
	 * @access public
	 * @param  int $iLimit limit
	 * @return void
	 */

	public function getLastNewsByDay($iLimit = 4, $sType = 'cinema', $iOffset = 0) {

		$aNews = $this->modelArticle->getLastNews($iLimit, $iOffset, $sType);

		//==============================================================================================================================
		// refonte des actualités pour les grouper par jour - début
		//==============================================================================================================================

		foreach ($aNews['items'] as $iKey => $oNews) {

			$aNews['items'][$iKey]->date_ago = Date::GetTimeAgoInString($oNews->get_created());
			$aNews['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => 'article'));
			$aNews['items'][$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
		}

		return $aNews;
	}

	/**
	 * the main page of news for one movie
	 *
	 * @access public
	 * @param  int $iLimit limit
	 * @return void
	 */

	public function getLastDvdNews($iLimit = 4, $iOffset = 0) {

		$aNews = $this->modelArticle->getLastDvdNews($iLimit, $iOffset);

		//==============================================================================================================================
		// refonte des actualités pour les grouper par jour - début
		//==============================================================================================================================

		foreach ($aNews['items'] as $iKey => $oNews) {

			$aNews['items'][$iKey]->date_ago = Date::GetTimeAgoInString($oNews->get_created());
			$aNews['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => 'article'));
			$aNews['items'][$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
		}

		return $aNews;
	}

	/**
	 * the main page of news for one movie
	 *
	 * @access public
	 * @param  int $iLimit limit
	 * @return void
	 */

	public function getLastNewsByRecord($iRecordId, $iLimit = 4, $iOffset = 0) {

		$aNews = $this->modelArticle->getLastNewsByRecord($iRecordId, $iLimit, $iOffset);

		//==============================================================================================================================
		// refonte des actualités pour les grouper par jour - début
		//==============================================================================================================================

		foreach ($aNews['items'] as $iKey => $oNews) {

			$aNews['items'][$iKey]->date_ago = Date::GetTimeAgoInString($oNews->get_created());
			$aNews['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => 'article'));
			$aNews['items'][$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
		}

		return $aNews;
	}

	/**
	 * the main page of news for one movie
	 *
	 * @access public
	 * @param  int $iLimit limit
	 * @return void
	 */

	public function getLastNewsByDayByPerson($iIdPerson, $iLimit = 4, $iOffset = 0) {

		$aNews = $this->modelArticle->getLastNewsByPerson($iIdPerson, $iLimit, $iOffset);

		//==============================================================================================================================
		// refonte des actualités pour les grouper par jour - début
		//==============================================================================================================================

		foreach ($aNews['items'] as $iKey => $oNews) {

			$aNews['items'][$iKey]->date_ago = Date::GetTimeAgoInString($oNews->get_created());
			$aNews['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => 'article'));
			$aNews['items'][$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
		}

		return $aNews;
	}
}

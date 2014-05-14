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
use \Venus\lib\Date as Date;
use \Venus\src\WebSite\Business\Article as businessArticle;
use \Venus\src\WebSite\Model\article as modelArticle;
use \Venus\src\WebSite\Model\article_has_record as modelArticleHasRecord;
use \Venus\src\WebSite\Model\comment as modelComment;
use \Venus\src\WebSite\Model\user as modelUser;

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

class Article extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->businessArticle = function() { return new businessArticle; };
		$this->modelArticle = function() { return new modelArticle; };
		$this->modelArticleHasRecord = function() { return new modelArticleHasRecord; };
		$this->modelComment = function() { return new modelComment; };
		$this->modelUser = function() { return new modelUser; };

		parent::__construct();

		$this->layout->assign('menu', 'Article');
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iId id
	 * @param  string $sTitle
	 * @param  string $sType
	 * @return void
	 */

	public function show($iId, $sTitle, $sType) {

		if (isset($_POST) && count($_POST) && $this->session->get('userid')) {

			$oComment = new entityComment;
			$oComment->set_id_user($this->session->get('userid'))
					 ->set_content($_POST['comment'])
					 ->set_created(date('Y-m-d H:s:i'))
					 ->set_type('article')
					 ->set_id_type($iId);

			$this->modelComment->insert($oComment);
		}

		$oNews = $this->modelArticle->findOneByid($iId);
		$oNews->image = $this->url->getUrl('images-nom', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => 'article'));
		preg_match('/^(?P<year>[0-9]{4})-(?P<month>[0-9]{2})-(?P<day>[0-9]{2}) .*$/', $oNews->get_created(), $aCreated);
		$oNews->date = Date::getDayInWord(date('w', strtotime($aCreated['year'].'-'.$aCreated['month'].'-'.$aCreated['day']))).' '.(int)$aCreated['day'].' '.Date::getMonthInWord($aCreated['month']).' '.(int)$aCreated['year'];

		$oUser = $this->modelUser->findOneByid($oNews->get_id_user());

		$aRecordAssociated = $this->modelArticleHasRecord->getRecordByArticleId($iId);

		for ($i = 0 ; $i < count($aRecordAssociated) ; $i++) {

			for ($j = $i + 1 ; $j < count($aRecordAssociated) ; $j++) {

				if (strlen($aRecordAssociated[$i]->record->get_title()) < strlen($aRecordAssociated[$j]->record->get_title())) {

					$oTmp = $aRecordAssociated[$j];
					$aRecordAssociated[$j] = $aRecordAssociated[$i];
					$aRecordAssociated[$i] = $oTmp;
				}
			}
		}

		foreach ($aRecordAssociated as $oOne) {

			if ($oOne->record->get_type() == 'serie') { $sBase = 'series/liste'; }
			else { $sBase = 'cinema/film'; }

			$oNews->set_content(preg_replace("#([ .,\?\!:;\(\n\r\t])".preg_quote($oOne->record->get_title())."([ .,\?\!:;\)\n\r]?)#", '$1<a href="'.$this->url->getUrl('fiche-detail', array('id' => $oOne->record->get_id(), 'title' => $this->url->encodeToUrl($oOne->record->get_title()), 'base' => $sBase)).'" title="'.addslashes($oOne->record->get_title()).'" alt="'.addslashes($oOne->record->get_title()).'">'.$oOne->record->get_title().'</a>$2', ' '.$oNews->get_content()));
		}

		$oNews->set_content(preg_replace('#(<a .+?)<a[^>]+>(.+?)</a>(.+?</a>)#', '$1$2$3', $oNews->get_content()));

		if ($oNews->get_id_article_type() == 4) {

			$sTitleNews = 'Actualités Séries';
			$this->layout->assign('menu', 'serie');
			$aNews = $this->businessArticle->getLastNewsByDay(4, 'series');
		}
		else if ($oNews->get_id_article_type() == 20) {

			$sTitleNews = 'Actualités Télé';
			$this->layout->assign('menu', 'tele');
			$aNews = $this->businessArticle->getLastNewsByDay(4, 'tele');
		}
		else {

			$sTitleNews = 'Actualités Cinéma';
			$this->layout->assign('menu', 'cinema');
			$aNews = $this->businessArticle->getLastNewsByDay(4, 'cinema');
		}

		$aComments = $this->modelComment->getCommentByArticle($iId);

		$oMobileDetect = new \Mobile_Detect;

		if ($oMobileDetect->isMobile()) {

			$oNews->set_content(str_replace("width='600'", "width='290'", $oNews->get_content()));
			$oNews->set_content(str_replace('width="600"', 'width="290"', $oNews->get_content()));
			$oNews->set_content(str_replace("width='480'", "width='290'", $oNews->get_content()));
			$oNews->set_content(str_replace('width="480"', 'width="290"', $oNews->get_content()));
		}

		$this->layout
			 ->assign('title', $oNews->get_title().' - iScreenway')
			 ->assign('title_actu', $sTitleNews)
			 ->assign('description', 'Découvrez l\'actualité '.$oNews->get_title().' ainsi que toutes les autres actualités de films et de séries.')
			 ->assign('one_news', $oNews)
			 ->assign('og_img', $oNews->image)
			 ->assign('news', $aNews)
			 ->assign('user', $oUser)
			 ->assign('comments', $aComments)
			 ->assign('is_connect', $this->session->get('user'))
			 ->assign('submenu', 'news')
			 ->display();
	}
}

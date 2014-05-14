<?php

/**
 * Controller to article
 *
 * @category  	src
 * @package   	src\BackOffice\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\BackOffice\Controller;

use \Venus\src\BackOffice\common\Controller as Controller;
use \Venus\lib\Upload as Upload;
use \Venus\core\UrlManager as UrlManager;
use \Venus\src\FrontOffice\Model\article as modelArticleFront;
use \Venus\src\BackOffice\Model\article as modelArticle;
use \Venus\src\BackOffice\Model\trailer as modelTrailer;
use \Venus\src\BackOffice\Model\article_type as modelArticleType;
use \Venus\src\BackOffice\Model\article_has_subtype as modelArticleHasSubType;
use \Venus\src\BackOffice\Model\article_has_record as modelArticleHasRecord;
use \Venus\src\BackOffice\Model\article_has_person as modelArticleHasActor;
use \Venus\src\BackOffice\Model\photo as modelPhoto;
use \Venus\src\BackOffice\Model\record as modelRecord;
use \Venus\src\BackOffice\Entity\article as entityArticle;
use \Venus\src\BackOffice\Entity\article_has_record as entityArticleHasRecord;
use \Venus\src\BackOffice\Entity\article_has_person as entityArticleHasActor;
use \Venus\src\BackOffice\Entity\article_has_subtype as entityArticleHasSubType;
use \Venus\src\BackOffice\Model\person as modelActor;
use \Venus\lib\Facebook as Facebook;

/**
 * Controller to article
 *
 * @category  	src
 * @package   	src\BackOffice\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 * @property	\src\Front\Model\article $modelArticle
 * @property	\src\Front\Model\record $modelRecord
 */

class Article extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelArticleFront = function() { return new modelArticleFront; };
		$this->modelArticle = function() { return new modelArticle; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelPhoto = function() { return new modelPhoto; };
		$this->modelArticleType = function() { return new modelArticleType; };
		$this->modelArticleHasSubType = function() { return new modelArticleHasSubType; };
		$this->modelArticleHasRecord = function() { return new modelArticleHasRecord; };
		$this->modelArticleHasActor = function() { return new modelArticleHasActor; };
		$this->modelActor = function() { return new modelActor; };
		$this->modelTrailer = function() { return new modelTrailer; };

		parent::__construct();
	}

	/**
	 * the list of record
	 *
	 * @access public
	 * @return void
	 */

	public function all() {

		$aArticles = $this->modelArticle->findOrderByidDesc();

		foreach ($aArticles as $iKey => $oRecord) {

			$aArticles[$iKey]->url1 = $this->url->getUrl('modifier_article', array('id' => $oRecord->get_id()));
		}

		$this->layout
			 ->assign('articles', $aArticles)
			 ->display();
	}

	/**
	 * add a record
	 *
	 * @access public
	 * @return void
	 */

	public function add() {

		if (isset($_POST) && count($_POST)) {

			$oArticle = new entityArticle;

			$oArticle->set_title($_POST['title'])
					 ->set_id_article_type($_POST['id_article_type'])
					 ->set_content($_POST['content'])
					 ->set_id_user($this->session->get('user')->get_id())
					 ->set_visible('n')
					 ->set_created(date('Y-m-d H:i:s'));

			$iIdArticle = $this->modelArticle->insert($oArticle);

			if (isset($_POST['records']) && $_POST['records'] != '') {

				$_POST['records'] = substr($_POST['records'], 1);

				foreach (explode(';', $_POST['records']) as $iId) {

					$oArticleHasRecord = new entityArticleHasRecord;

					$oArticleHasRecord->set_id_article($iIdArticle)
									  ->set_id_record($iId);

					$this->modelArticleHasRecord->insert($oArticleHasRecord);
				}
			}

			if (isset($_POST['actors']) && $_POST['actors'] != '') {

				$_POST['actors'] = substr($_POST['actors'], 1);

				foreach (explode(';', $_POST['actors']) as $iId) {

					$oArticleHasActor = new entityArticleHasActor;

					$oArticleHasActor->set_id_article($iIdArticle)
									 ->set_id_person($iId);

					$this->modelArticleHasActor->insert($oArticleHasActor);
				}
			}

			if (isset($_POST['subtype']) && count($_POST['subtype']) > 0) {

				foreach ($_POST['subtype'] as $iSubtypeId) {

					$oArticleHasSubType = new entityArticleHasSubType;

					$oArticleHasSubType->set_id_article($iIdArticle)
									   ->set_id_subtype($iSubtypeId);

					$this->modelArticleHasSubType->insert($oArticleHasSubType);
				}
			}

			$oUpload = new Upload;

			$oUpload->setMaxSize(2000000)
					->setAllowExtension(['jpeg', 'jpg'])
					->setExtension('jpg')
					->setName('article_'.$iIdArticle)
					->setWidth(600)
					->setHeight(239)
					->upload('fichier');

			/*
			$oFacebook = new Facebook;
			$oFacebook->publishMyWallPost('428562177241090', $_POST['content'], $sLink,
						'/images/article_'.$iIdArticle.'.jpg', $_POST['title']);
			*/

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ArticleAddConfirm.tpl')
				 ->display();
		}
		else {

			$aType = $this->modelArticleType->findByid_article_type(0);
			$aSubTypesCinema = $this->modelArticleType->findByid_article_type(1);
			$aSubTypesFolder = $this->modelArticleType->findByid_article_type(3);
			$aSubTypesSerie = $this->modelArticleType->findByid_article_type(4);
			$aPhoto = $this->modelPhoto->findOrderByTitle();

			foreach ($aPhoto as $iKey => $oPhoto) {

				$aPhoto[$iKey]->url = $this->url->getUrl('images-nom', array('id' => $oPhoto->get_id(), 'title' => $this->url->encodeToUrl($oPhoto->get_title()), 'type' => 'photo'));
			}

			$aTrailer = $this->modelTrailer->findOrderByTitle();

			$aNews = $this->modelArticleFront->getLastNews(500, 0, 'news');

			foreach ($aNews as $iKey => $oNews) {

				$aNews[$iKey]->url = 'http://www.iscreenway.com'.$this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
				$aNews[$iKey]->urlImg = preg_replace('|^http://www.iscreenway.com/[^/]+/[^/]+(/[0-9]+/)(.+)$|', 'http://www.iscreenway.com/images$1article/$2'.'.jpg', $aNews[$iKey]->url);
			}

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ArticleAdd.tpl')
				 ->assign('type', $aType)
				 ->assign('articles', $aNews)
				 ->assign('subtype_cinema', $aSubTypesCinema)
				 ->assign('subtype_serie', $aSubTypesSerie)
				 ->assign('subtype_folder', $aSubTypesFolder)
				 ->assign('photo', $aPhoto)
				 ->assign('trailer', $aTrailer)
				 ->display();
		}
	}

	/**
	 * add a record
	 *
	 * @access public
	 * @param  integer $iIdToUpdate id of article
	 * @return void
	 */

	public function update($iIdToUpdate) {

		if (isset($_POST) && count($_POST)) {

			$oArticle = new entityArticle;

			$oArticle->set_title($_POST['title'])
					 ->set_id_article_type($_POST['id_article_type'])
					 ->set_content($_POST['content'])
					 ->set_id_user($this->session->get('user')->get_id())
					 ->set_visible('n')
					 ->set_created(date('Y-m-d H:i:s'))
					 ->set_id($iIdToUpdate);

			$iIdArticle = $this->modelArticle->update($oArticle);

			if (isset($_POST['records']) && $_POST['records'] != '') {

				$_POST['records'] = substr($_POST['records'], 1);

				foreach (explode(';', $_POST['records']) as $iId) {

					var_dump($iId);

					$oArticleHasRecord = new entityArticleHasRecord;

					$oArticleHasRecord->set_id_article($iIdToUpdate)
									  ->set_id_record($iId);

					$this->modelArticleHasRecord->insert($oArticleHasRecord);
				}
			}

			if (isset($_POST['actors']) && $_POST['actors'] != '') {

				$_POST['actors'] = substr($_POST['actors'], 1);

				foreach (explode(';', $_POST['actors']) as $iId) {

					$oArticleHasActor = new entityArticleHasActor;

					$oArticleHasActor->set_id_article($iIdToUpdate)
									 ->set_id_person($iId);

					$this->modelArticleHasActor->insert($oArticleHasActor);
				}
			}

			$oUpload = new Upload;

			$oUpload->setMaxSize(2000000)
					->setAllowExtension(['jpeg', 'jpg'])
					->setExtension('jpg')
					->setName('article_'.$iIdToUpdate)
					->setWidth(600)
					->setHeight(239)
					->upload('fichier');

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ArticleAddConfirm.tpl')
				 ->display();
		}
		else {

			$oArticle = $this->modelArticle->findOneByid($iIdToUpdate);
			$aRecord = $this->modelRecord->findOrderBytitle($iIdToUpdate);
			$aActor = $this->modelActor->getAllList();
			$aType = $this->modelArticleType->get();
			$aPhoto = $this->modelPhoto->findOrderByTitle();
			$aTrailer = $this->modelTrailer->findOrderByTitle();

			foreach ($aPhoto as $iKey => $oPhoto) {

				$aPhoto[$iKey]->url = $this->url->getUrl('images-nom', array('id' => $oPhoto->get_id(), 'title' => $this->url->encodeToUrl($oPhoto->get_title()), 'type' => 'photo'));
			}

			$aArticleHasRecord = $this->modelArticleHasRecord->findByid_article($iIdToUpdate);
			$sArticleHasRecordValue = '';
			$sArticleHasRecordName = '';

			foreach ($aArticleHasRecord as $oArticleHasRecord) {

				$sArticleHasRecordValue .= ';'.$oArticleHasRecord->get_id_record();
				$oRecord = $this->modelRecord->findOneByid($oArticleHasRecord->get_id_record());
				$sArticleHasRecordName .= '<br/>'.$oRecord->get_title();
			}

			$aArticleHasPerson = $this->modelArticleHasActor->findByid_article($iIdToUpdate);
			$sArticleHasPersonValue = '';
			$sArticleHasPersonName = '';

			foreach ($aArticleHasPerson as $oArticleHasPerson) {

				$sArticleHasPersonValue .= ';'.$oArticleHasPerson->get_id_person();
				$oPerson = $this->modelActor->findOneByid($oArticleHasPerson->get_id_person());
				$sArticleHasPersonName .= '<br/>'.$oPerson->get_firstname().' '.$oPerson->get_name();
			}

			$aNews = $this->modelArticleFront->getLastNews(500, 0, 'news');

			foreach ($aNews as $iKey => $oNews) {

				$aNews[$iKey]->url = 'http://www.iscreenway.com'.$this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
				$aNews[$iKey]->urlImg = preg_replace('|^http://www.iscreenway.com/[^/]+/[^/]+(/[0-9]+/)(.+)$|', 'http://www.iscreenway.com/images$1article/$2'.'.jpg', $aNews[$iKey]->url);
			}

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ArticleAdd.tpl')
				 ->assign('record', $aRecord)
				 ->assign('actor', $aActor)
				 ->assign('type', $aType)
				 ->assign('photo', $aPhoto)
				 ->assign('trailer', $aTrailer)
				 ->assign('article', $oArticle)
				 ->assign('articles', $aNews)
				 ->assign('article_has_record_value', $sArticleHasRecordValue)
				 ->assign('article_has_record_name', $sArticleHasRecordName)
				 ->assign('article_has_person_value', $sArticleHasPersonValue)
				 ->assign('article_has_person_name', $sArticleHasPersonName)
				 ->display();
		}
	}
}
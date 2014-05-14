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

namespace Venus\src\FrontOffice\Controller;

use \Venus\core\Controller as Controller;
use \Venus\lib\Date as Date;
use \Venus\core\UrlManager as UrlManager;
use \Venus\src\FrontOffice\Entity\comment as entityComment;
use \Venus\src\FrontOffice\Model\article as modelArticle;
use \Venus\src\FrontOffice\Model\comment as modelComment;
use \Venus\src\FrontOffice\Model\article_type as modelArticleType;
use \Venus\src\FrontOffice\Model\article_has_person as modelArticleHasPerson;
use \Venus\src\FrontOffice\Model\article_has_record as modelArticleHasRecord;
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Model\trailer as modelTrailer;
use \Venus\src\FrontOffice\Model\photo as modelPhoto;
use \Venus\src\FrontOffice\Model\user as modelUser;
use \Venus\src\FrontOffice\Controller\Record as controllerRecord;
use \Venus\src\FrontOffice\Controller\Article as controllerArticle;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

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

class Article extends Controller {

	/**
	 * array of Article Type
	 *
	 * @access private
	 * @var	   array
	 */

	private $_aArticleTypes = [];

	/**
	 * array of Article Type
	 *
	 * @access private
	 * @var	   array
	 */

	private $_aArticleTypesByUrl = [];

	/**
	 * array of Ids of Article Type
	 *
	 * @access private
	 * @var	   array
	 */

	private $_aIdsArticlesTypes = [
		'tournage' => 6,
		'vu_sur_le_web' => 2,
		'interview' => 8,
		'box_office' => 9,
		'festival' => 10,
		'star' => 11,
		'insolite' => 12,
		'faits_divers' => 13
	];

	/**
	 * array of Ids of Article Type
	 *
	 * @access private
	 * @var	   array
	 */

	private $_aIdsArticlesTypesSerie = [
		'tournage' => 14,
		'audience' => 15,
		'interview' => 16,
		'chaine' => 17,
		'star' => 18,
		'faits_divers' => 19
	];

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelArticle = function() { return new modelArticle; };
		$this->modelArticleType = function() { return new modelArticleType; };
		$this->modelPhoto = function() { return new modelPhoto; };
		$this->modelComment = function() { return new modelComment; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelTrailer = function() { return new modelTrailer; };
		$this->modelUser = function() { return new modelUser; };
		$this->controllerRecord = function() { return new controllerRecord; };
		$this->controllerArticle = function() { return new controllerArticle; };
		$this->modelArticleHasPerson = function() { return new modelArticleHasPerson; };
		$this->modelArticleHasRecord = function() { return new modelArticleHasRecord; };
		$this->modelTopSearch = function() { return new modelTopSearch; };

		parent::__construct();

		$aSearch = $this->modelTopSearch->getTop(5);
		$sSearch = '';

		foreach ($aSearch as $oSearch) {

			$sSearch .= ' &nbsp;&nbsp; <a href="'.$this->url->getUrl('recherche', array('word' => $oSearch->get_word())).'" style="color:white">'.$oSearch->get_word().'</a> ';
		}

		$this->layout->assign('word_to_search', $sSearch);

		$this->_aArticleTypes = [
			'cinema' => [
				'tournage' => $this->url->getUrl('actu-film', array('type' => 'tournage')),
				'vu sur le web' => $this->url->getUrl('actu-film', array('type' => 'vu_sur_le_web')),
				'interview' => $this->url->getUrl('actu-film', array('type' => 'interview')),
				'box-office' => $this->url->getUrl('actu-film', array('type' => 'box_office')),
				'festival' => $this->url->getUrl('actu-film', array('type' => 'festival')),
				'star' => $this->url->getUrl('actu-film', array('type' => 'star')),
				'insolite' => $this->url->getUrl('actu-film', array('type' => 'insolite')),
				'faits-divers' => $this->url->getUrl('actu-film', array('type' => 'faits_divers'))
			],
			'serie' => [
				'tournage' => $this->url->getUrl('actu-series', array('type' => 'tournage')),
				'audience' => $this->url->getUrl('actu-series', array('type' => 'audience')),
				'chaine' => $this->url->getUrl('actu-series', array('type' => 'chaine')),
				'interview' => $this->url->getUrl('actu-series', array('type' => 'interview')),
				'star' => $this->url->getUrl('actu-series', array('type' => 'star')),
				'faits-divers' => $this->url->getUrl('actu-series', array('type' => 'faits_divers'))
			]
		];

		$this->_aArticleTypesByUrl = [
			'cinema' => [
				'tournage' => $this->url->getUrl('actu-film', array('type' => 'tournage')),
				'vu_sur_le_web' => $this->url->getUrl('actu-film', array('type' => 'vu_sur_le_web')),
				'interview' => $this->url->getUrl('actu-film', array('type' => 'interview')),
				'box_office' => $this->url->getUrl('actu-film', array('type' => 'box_office')),
				'festival' => $this->url->getUrl('actu-film', array('type' => 'festival')),
				'star' => $this->url->getUrl('actu-film', array('type' => 'star')),
				'insolite' => $this->url->getUrl('actu-film', array('type' => 'insolite')),
				'faits_divers' => $this->url->getUrl('actu-film', array('type' => 'faits_divers'))
			],
			'serie' => [
				'tournage' => $this->url->getUrl('actu-film', array('type' => 'tournage')),
				'audience' => $this->url->getUrl('actu-film', array('type' => 'audience')),
				'chaine' => $this->url->getUrl('actu-film', array('type' => 'chaine')),
				'interview' => $this->url->getUrl('actu-film', array('type' => 'interview')),
				'star' => $this->url->getUrl('actu-film', array('type' => 'star')),
				'faits_divers' => $this->url->getUrl('actu-film', array('type' => 'faits_divers'))
			]
		];
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iOffSet
	 * @return void
	 */

	public function showNews($iOffSet) {

		$aNews = $this->modelArticle->getLastNews(20, $iOffSet * 20, 'news');

		foreach ($aNews as $iKey => $oNews) {

			$aNews[$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
			preg_match('/^(?P<year>[0-9]{4})-(?P<month>[0-9]{2})-(?P<day>[0-9]{2}) .*$/', $oNews->get_created(), $aCreated);
			$aNews[$iKey]->date = Date::getDayInWord(date('w', strtotime($aCreated['year'].'-'.$aCreated['month'].'-'.$aCreated['day']))).' '.(int)$aCreated['day'].' '.Date::getMonthInWord($aCreated['month']).' '.(int)$aCreated['year'];
			$aNews[$iKey]->date2 = $aCreated['day'].'/'.$aCreated['month'].'/'.$aCreated['year'];
		}

		$aFolders = $this->modelArticle->getLastFolders();

		foreach ($aFolders as $iKey => $oNews) {

			$aFolders[$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
			preg_match('/^(?P<year>[0-9]{4})-(?P<month>[0-9]{2})-(?P<day>[0-9]{2}) .*$/', $oNews->get_created(), $aCreated);
			$aFolders[$iKey]->date = Date::getDayInWord(date('w', strtotime($aCreated['year'].'-'.$aCreated['month'].'-'.$aCreated['day']))).' '.(int)$aCreated['day'].' '.Date::getMonthInWord($aCreated['month']).' '.(int)$aCreated['year'];
			$aFolders[$iKey]->date2 = $aCreated['day'].'/'.$aCreated['month'].'/'.$aCreated['year'];
		}


		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'News.tpl')
			 ->assign('title', 'Actualité films, DVD et cinéma - iScreenway '.$iOffSet)
			 ->assign('description', 'Découvrez toutes les actualités du cinéma, des stars, des séries TV sur iSreenway'.$iOffSet)
			 ->assign('news', $aNews)
			 ->assign('folders', $aFolders)
			 ->assign('url', $this->url->getUrl('actu', array()))
			 ->assign('type', $this->_aArticleTypes)
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId id
	 * @param  string $sTitle
	 * @param  string $sType
	 * @return void
	 */

	public function redirectOne($iId, $sTitle) {

		$oNews = $this->modelArticle->findOneByid($iId);

		if (count($oNews) < 1) {

			$this->redirect($this->url->getUrl('home', array()));
			exit;
		}

		$oNews->type = $this->modelArticleType->findOneByid($oNews->get_id_article_type());

		$this->redirect($this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->type->get_name())));
		exit;
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  int $iId id
	 * @param  string $sTitle
	 * @param  string $sType
	 * @return void
	 */

	public function showOne($iId, $sTitle, $sType) {

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

		$oPersonAssociated = $this->modelArticleHasPerson->getPersonByArticleId($iId);

		foreach ($oPersonAssociated as $oOne) {

			$oNews->set_content(str_ireplace($oOne->person->get_firstname().' '.$oOne->person->get_name(), '<a href="'.$this->url->getUrl('acteur-detail', array('id' => $oOne->person->get_id(), 'title' => $this->url->encodeToUrl($oOne->person->get_firstname().' '.$oOne->person->get_name()))).'">'.$oOne->person->get_firstname().' '.$oOne->person->get_name().'</a>', $oNews->get_content()));
		}

		if ($oNews->get_id_article_type() == 4) {

			$aTrailers = $this->modelTrailer->getBestTrailers('serie', 6);
			$sTitleNews = 'Actualités Films';
			$aNews2 = $this->modelArticle->getLastCinemaNews(4, 0);
			$aNews = $this->controllerArticle->getLastNewsByDay(4, 'serie');
			$sType = 'cinema';
			$sType2 = 'series';

			$aWantedMovies = $this->modelRecord->getWantedMovies('serie');
			$aWantedMovies = $this->controllerRecord->getExtendedInfos($aWantedMovies);
			$sTitleWanted = 'Séries les plus attendues';
			$sTitleWantedAll = 'Toutes les séries les plus attendues';
			$sUrlWantedAll = $this->url->getUrl('films-attendus', array());
			$this->layout->assign('category', 'series');

		}
		else {

			$aTrailers = $this->modelTrailer->getBestTrailers('film', 6);
			$sTitleNews = 'Actualités Séries';
			$aNews2 = $this->modelArticle->getLastSerieNews(4, 0);
			$aNews = $this->controllerArticle->getLastNewsByDay(4, 'cinema');
			$sType = 'series';
			$sType2 = 'cinema';

			$aWantedMovies = $this->modelRecord->getWantedMovies();
			$aWantedMovies = $this->controllerRecord->getExtendedInfos($aWantedMovies);
			$sTitleWanted = 'Films les plus attendus';
			$sTitleWantedAll = 'Tous les films les plus attendus';
			$sUrlWantedAll = $this->url->getUrl('series-attendues', array());
			$this->layout->assign('category', 'cinema');
		}

		foreach ($aTrailers as $iKey => $oTrailer) {

			$oRecord = $this->modelRecord->findOneByid($oTrailer->get_id_record());
			$aTrailers[$iKey]->url = $this->url->getUrl('bande-annonce-detail', array('id' => $oTrailer->get_id(), 'title' => $this->url->encodeToUrl($oTrailer->get_title()), 'id_record' => $oTrailer->get_id_record(), 'title_record' => $this->url->encodeToUrl($oRecord)));
		}

		foreach ($aNews['news'] as $iKey2 => $oNews3) {

			foreach ($oNews3 as $iKey => $oNews2) {

				$aNews['news'][$iKey2][$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews2->get_id(), 'title' => $this->url->encodeToUrl($oNews2->get_title()), 'type' => $sType2));
				$aNews['news'][$iKey2][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oNews2->get_id(), 'title' => $this->url->encodeToUrl($oNews2->get_title()), 'type' => 'article'));
				preg_match('/^(?P<year>[0-9]{4})-(?P<month>[0-9]{2})-(?P<day>[0-9]{2}) .*$/', $oNews2->get_created(), $aCreated);
				$aNews['news'][$iKey2][$iKey]->date = Date::getDayInWord(date('w', strtotime($aCreated['year'].'-'.$aCreated['month'].'-'.$aCreated['day']))).' '.(int)$aCreated['day'].' '.Date::getMonthInWord($aCreated['month']).' '.(int)$aCreated['year'];
				$aNews['news'][$iKey2][$iKey]->date2 = $aCreated['day'].'/'.$aCreated['month'].'/'.$aCreated['year'];
			}
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
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneNews.tpl')
			 ->assign('title', $oNews->get_title().' - iScreenway')
			 ->assign('description', 'Découvrez l\'actualité '.$oNews->get_title().' ainsi que toutes les autres actualités de films et de séries.')
			 ->assign('news', $oNews)
			 ->assign('og_img', $oNews->image)
			 ->assign('list_news', $aNews)
			 ->assign('user', $oUser)
			 ->assign('title_actu', $sTitleNews)
			 ->assign('trailers', $aTrailers)
			 ->assign('list_news2', $aNews2)
			 ->assign('wanted_movies', $aWantedMovies)
			 ->assign('wanted_title', $sTitleWanted)
			 ->assign('wanted_all', $sTitleWantedAll)
			 ->assign('wanted_url', $sUrlWantedAll)
			 ->assign('comments', $aComments)
			 ->assign('is_connect', $this->session->get('user'))
			 ->assign('tpl_one_movie', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie.tpl')
			 ->display();
	}

	/**
	 * the main page of folders
	 *
	 * @access public
	 * @return void
	 */

	public function showFolder() {

		if ($_SERVER['REQUEST_URI'] == '/dossier/') {

			$this->redirect($this->url->getUrl('dossier', array()));
			exit;
		}

		$aNews = $this->modelArticle->getLastFolders(20);

		foreach ($aNews as $iKey => $oNews) {

			$aNews[$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
			preg_match('/^(?P<year>[0-9]{4})-(?P<month>[0-9]{2})-(?P<day>[0-9]{2}) .*$/', $oNews->get_created(), $aCreated);
			$aNews[$iKey]->date = Date::getDayInWord(date('w', strtotime($aCreated['year'].'-'.$aCreated['month'].'-'.$aCreated['day']))).' '.(int)$aCreated['day'].' '.Date::getMonthInWord($aCreated['month']).' '.(int)$aCreated['year'];
			$aNews[$iKey]->date2 = $aCreated['day'].'/'.$aCreated['month'].'/'.$aCreated['year'];
		}

		$aLastNews = $this->modelArticle->getLastNews(3, 0, 'news');

		foreach ($aLastNews as $iKey => $oNews) {

			$aLastNews[$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
			preg_match('/^(?P<year>[0-9]{4})-(?P<month>[0-9]{2})-(?P<day>[0-9]{2}) .*$/', $oNews->get_created(), $aCreated);
			$aLastNews[$iKey]->date = Date::getDayInWord(date('w', strtotime($aCreated['year'].'-'.$aCreated['month'].'-'.$aCreated['day']))).' '.(int)$aCreated['day'].' '.Date::getMonthInWord($aCreated['month']).' '.(int)$aCreated['year'];
			$aLastNews[$iKey]->date2 = $aCreated['day'].'/'.$aCreated['month'].'/'.$aCreated['year'];
		}

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Folders.tpl')
			 ->assign('title', 'Dossiers de films, DVD et cinéma - iScreenway')
			 ->assign('description', 'Découvrez tous les meilleurs dossiers cinémas et séries TV sur iSreenway')
			 ->assign('url', $this->url->getUrl('actu', array()))
			 ->assign('news', $aNews)
			 ->assign('last_news', $aLastNews)
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

	public function showNewsByRecord($iId, $sTitle) {

		$oRecord = $this->modelRecord->findOneById($iId);
		$aMenus = $this->controllerRecord->getRecordMenu($iId);

		$this->layout
			 ->assign('tpl_record_menu', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordMenu.tpl')
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'NewsByRecord.tpl')
			 ->assign('record_menu', $aMenus)
			 ->assign('record', $oRecord)
			 ->assign('menu_select', 8)
			 ->assign('title', 'Actualités du film '.$oRecord->get_title().' - iScreenway')
			 ->assign('description', 'Retrouvez les films au cinéma, les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
			 ->display();
	}


	/**
	 * the main page of news for one movie
	 *
	 * @access public
	 * @param  int $iIdPerson id_person
	 * @param  int $iLimit limit
	 * @return void
	 */

	public function showNewsByTheme($sTheme) {

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'NewsByTheme.tpl')
			 ->assign('title', 'Les actualités '.$sTheme.' - iScreenway')
			 ->assign('description', 'Retrouvez toutes les actualités '.$sTheme.', les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
			 ->assign('theme', $sTheme)
			 ->display();
	}

	/**
	 * the main page of news for one movie
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @param  string $sType subtype
	 * @return void
	 */

	public function showFilmNews($iOffset, $sType = null) {

		if (preg_match('#/film/actualites/#', $_SERVER['REQUEST_URI'])) {

			$this->redirect($this->url->getUrl('actu-film', array()));
			exit;
		}

		if ($sType) {

			$this->layout
			 	 ->assign('type_select', $sType)
			 	 ->assign('type_select_url', $this->_aArticleTypesByUrl['cinema'][$sType]);

			$sType = $this->_aIdsArticlesTypes[$sType];
		}
		else {

			$sType = null;
		}

		$aNews = $this->modelArticle->getLastCinemaNews(20, $iOffset * 20, $sType);

		if ($aNews[0]->count > 0) {

			foreach ($aNews as $iKey => $oNews) {

				$aNews[$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => 'article'));
				$aNews[$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => 'cinema'));
				preg_match('/^(?P<year>[0-9]{4})-(?P<month>[0-9]{2})-(?P<day>[0-9]{2}) .*$/', $oNews->get_created(), $aCreated);
				$aNews[$iKey]->date = Date::getDayInWord(date('w', strtotime($aCreated['year'].'-'.$aCreated['month'].'-'.$aCreated['day']))).' '.(int)$aCreated['day'].' '.Date::getMonthInWord($aCreated['month']).' '.(int)$aCreated['year'];
				$aNews[$iKey]->date2 = $aCreated['day'].'/'.$aCreated['month'].'/'.$aCreated['year'];
			}
		}

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'FilmNews.tpl')
			 ->assign('title', 'Les actualités cinémas '.$sType.' - iScreenway '.$iOffset)
			 ->assign('description', 'Retrouvez toutes les actualités du cinéma '.$sType.', les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office... '.$iOffset)
			 ->assign('news', $aNews)
			 ->assign('sub_menu', true)
			 ->assign('category', 'cinema')
			 ->assign('url_enfant', $this->url->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->assign('url', $this->url->getUrl('actu-film', array()))
			 ->assign('type', $this->_aArticleTypes)
			 ->display();
	}

	/**
	 * the main page of news for one movie
	 *
	 * @access public
	 * @param  int $iOffset offset
	 * @param  string $sType
	 * @return void
	 */

	public function showSerieNews($iOffset, $sType = null) {

		if ($sType) {

			$this->layout
				 ->assign('type_select', $sType)
				 ->assign('type_select_url', $this->_aArticleTypesByUrl['serie'][$sType]);

			$sType = $this->_aIdsArticlesTypesSerie[$sType];
		}
		else {

			$sType = null;
		}

		$aNews = $this->modelArticle->getLastSerieNews(20, $iOffset, $sType);

		if ($aNews[0]->count > 0) {

			foreach ($aNews as $iKey => $oNews) {

				$aNews[$iKey]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => 'series'));
				$aNews[$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => 'article'));
				preg_match('/^(?P<year>[0-9]{4})-(?P<month>[0-9]{2})-(?P<day>[0-9]{2}) .*$/', $oNews->get_created(), $aCreated);
				$aNews[$iKey]->date = Date::getDayInWord(date('w', strtotime($aCreated['year'].'-'.$aCreated['month'].'-'.$aCreated['day']))).' '.(int)$aCreated['day'].' '.Date::getMonthInWord($aCreated['month']).' '.(int)$aCreated['year'];
				$aNews[$iKey]->date2 = $aCreated['day'].'/'.$aCreated['month'].'/'.$aCreated['year'];
			}
		}

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'SerieNews.tpl')
			 ->assign('title', 'Les actualités séries TV '.$sType.' - iScreenway')
			 ->assign('description', 'Retrouvez toutes les actualités des séries TV  '.$sType.', le guide des séries TV à ne pas louper, news, communautés de fans, interviews...')
			 ->assign('news', $aNews)
			 ->assign('sub_menu2', true)
			 ->assign('category', 'series')
			 ->assign('url', $this->url->getUrl('actu-film', array()))
			 ->assign('type', $this->_aArticleTypes)
			 ->display();
	}

	/**
	 * the main page of news for one movie
	 *
	 * @access public
	 * @param  int $iLimit limit
	 * @return void
	 */

	public function getLastNewsByDay($iLimit = 4, $sType = 'cinema') {

		if ($sType === 'serie') { $aNews = $this->modelArticle->getLastSerieNews($iLimit); }
		else if ($sType === 'all') { $aNews = $this->modelArticle->getLastNews($iLimit); }
		else { $aNews = $this->modelArticle->getLastCinemaNews($iLimit); }

		$aNewsByDay = array();

		//==============================================================================================================================
		// refonte des actualités pour les grouper par jour - début
		//==============================================================================================================================

		$aNewsByDay = array();
		$aNewsByDay['day_title'] = array();
		$aNewsByDay['news'] = array();

		foreach ($aNews as $iKey => $oNews) {

			$sYear = preg_replace('/^([0-9]{4})-([0-9]{2})-([0-9]{2}) .+$/', '$1', $oNews->get_created());
			$sMonth = preg_replace('/^([0-9]{4})-([0-9]{2})-([0-9]{2}) .+$/', '$2', $oNews->get_created());
			$sDay = preg_replace('/^([0-9]{4})-([0-9]{2})-([0-9]{2}) .+$/', '$3', $oNews->get_created());
			$sCreatedDate = $sDay.'/'.$sMonth.'/'.$sYear;

			if (!isset($aNewsByDay['news'][$sCreatedDate])) { $aNewsByDay['news'][$sCreatedDate] = array(); }
			if (!isset($aNewsByDay['day_title'][$sCreatedDate])) { $aNewsByDay['day_title'][$sCreatedDate] = 'A la une du '.Date::getDayInWord(date('l')).' '.$sDay.' '.Date::getMonthInWord($sMonth).' '.$sYear; }

			$iIndex = count($aNewsByDay['news'][$sCreatedDate]);
			$aNewsByDay['news'][$sCreatedDate][$iIndex] = $oNews;
			$aNewsByDay['news'][$sCreatedDate][$iIndex]->image = $this->url->getUrl('images-nom', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => 'article'));
			$aNewsByDay['news'][$sCreatedDate][$iIndex]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
		}

		return $aNewsByDay;
	}

	/**
	 * the main page of news for one movie
	 *
	 * @access public
	 * @param  int $iIdPerson id_person
	 * @param  int $iLimit limit
	 * @return void
	 */

	public function getLastNewsByDayByPerson($iIdPerson, $iLimit = 4) {

		$aNews = $this->modelArticle->getLastNewsByPerson($iIdPerson, $iLimit);
		$aNewsByDay = array();

		//==============================================================================================================================
		// refonte des actualités pour les grouper par jour - début
		//==============================================================================================================================

		$aNewsByDay = array();
		$aNewsByDay['day_title'] = array();
		$aNewsByDay['news'] = array();

		foreach ($aNews as $iKey => $oNews) {

			$sYear = preg_replace('/^([0-9]{4})-([0-9]{2})-([0-9]{2}) .+$/', '$1/', $oNews->get_created());
			$sMonth = preg_replace('/^([0-9]{4})-([0-9]{2})-([0-9]{2}) .+$/', '$2/', $oNews->get_created());
			$sDay = preg_replace('/^([0-9]{4})-([0-9]{2})-([0-9]{2}) .+$/', '$3/', $oNews->get_created());
			$sCreatedDate = $sDay.'/'.$sMonth.'/'.$sYear;

			if (!isset($aNewsByDay['news'][$sCreatedDate])) { $aNewsByDay['news'][$sCreatedDate] = array(); }
			if (!isset($aNewsByDay['day_title'][$sCreatedDate])) { $aNewsByDay['day_title'][$sCreatedDate] = 'A la une du '.Date::getDayInWord(date('l')).' '.$sDay.' '.Date::getMonthInWord($sMonth).' '.$sYear; }

			$iIndex = count($aNewsByDay['news'][$sCreatedDate]);
			$aNewsByDay['news'][$sCreatedDate][$iIndex] = $oNews;
			$aNewsByDay['news'][$sCreatedDate][$iIndex]->image = $this->url->getUrl('images-nom', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => 'article'));
			$aNewsByDay['news'][$sCreatedDate][$iIndex]->url = $this->url->getUrl('actu-detail', array('id' => $oNews->get_id(), 'title' => $this->url->encodeToUrl($oNews->get_title()), 'type' => $oNews->get_article_type()->get_name()));
		}

		return $aNewsByDay;
	}

}

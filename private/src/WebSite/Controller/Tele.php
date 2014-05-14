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
use \Venus\src\WebSite\Business\Article as businessArticle;
use \Venus\src\WebSite\Business\Record as businessRecord;
use \Venus\src\WebSite\Business\Trailer as businessTrailer;
use \Venus\src\WebSite\Business\Program as businessProgram;
use \Venus\src\WebSite\Model\mea as modelMea;
use \Venus\src\WebSite\Model\channel as modelChannel;
use \Venus\src\WebSite\Model\program_on_grid as modelProgramOnGrid;
use \Venus\src\WebSite\Model\record as modelRecord;

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

class Tele extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->businessArticle = function() { return new businessArticle; };
		$this->businessRecord = function() { return new businessRecord; };
		$this->businessTrailer = function() { return new businessTrailer; };
		$this->businessProgram = function() { return new businessProgram; };
		$this->modelMea = function() { return new modelMea; };
	    $this->modelChannel = function() { return new modelChannel; };
	    $this->modelProgramOnGrid = function() { return new modelProgramOnGrid; };
		$this->modelRecord = function() { return new modelRecord; };

		parent::__construct();

		$this->layout->assign('menu', 'tele');
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @return void
	 */

	public function show() {

		$aNewsMea = $this->businessArticle->getLastNewsByDay(4, 'tele', 0);
		$aNews = $this->businessArticle->getLastNewsByDay(10, 'tele', 4);
    	$aMea = $this->modelMea->getLastMea(1);
		$aPrograms = $this->businessProgram->getTopProgram(10, 0);

		$this->layout
			 ->assign('title', 'Programmes télé - iScreenway')
			 ->assign('description', 'Découvrez le programme tv de vos séries préférées, l&#39;actualité cinéma et séries, les dernières bandes-annonces, et plus encore.')
			 ->assign('news_mea', $aNewsMea)
			 ->assign('news', $aNews)
			 ->assign('meas', $aMea)
			 ->assign('top_program', $aPrograms)
			 ->display();
	}

  	/**
  	 * the main page of news
  	 *
  	 * @access public
  	 * @param  int $iOffSet
  	 * @return void
  	 */

  	public function showNews($iOffSet = 0) {

    	$aNews = $this->businessArticle->getLastNewsByDay(10, 'tele', $iOffSet * 10);

   		$this->layout
       		 ->assign('model', 'News.tpl')
       		 ->assign('title', 'Les actualités télé - iScreenway '.$iOffSet)
       		 ->assign('description', 'Retrouvez toutes les actualités télé, le guide des films à voir, news, communautés de fans, box-office... '.$iOffSet)
       		 ->assign('submenu', 'news_tele')
       		 ->assign('news', $aNews)
       		 ->assign('h1_news', 'Actualités télévision')
       		 ->display();
  	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  string $sChannelsType type of channel
   	 * @param  string $sMomentInDay argument to define the moment we want show
	 * @return void
	 */

	public function showProgramTv($sChannelsType = 'classique', $sMomentInDay = 'night') {

		if ($sChannelsType === 'tnt') {

			$sTitle = 'Programme TV de la TNT';
			$sDescription = 'Découvrez le programme TV #MOMENT# complet de la TNT et tous les articles, critiques, photos liées aux programmes désirés.';

			$this->layout
       			 ->assign('submenu', 'program_tele2');
		}
		else if ($sChannelsType === 'cable') {

			$sTitle = 'Programme TV du cable';
			$sDescription = 'Découvrez le programme TV #MOMENT# complet du cable et tous les articles, critiques, photos liées aux programmes désirés.';

			$this->layout
       			 ->assign('submenu', 'program_tele3');
		}
		else {

			$sTitle = 'Programme TV';
			$sDescription = 'Découvrez le programme TV #MOMENT# et tous les articles, critiques, photos liées aux programmes désirés.';

			$this->layout
       			 ->assign('submenu', 'program_tele');
		}

		if ($sMomentInDay === 'now') {

			$sDateStartProgram = date('Y-m-d H:i:s');
			$sDateStartProgram = date('2013-12-01 09:18:00');
			$sTitle .= ' de maintenant';
			$sDescription = str_replace('#MOMENT#', 'de maintenant', $sDescription);
			$iMinMinutes = 60;
		}
		else {

			$sDateStartProgram = date('Y-m-d 20:29:00');
			$sDateStartProgram = date('2013-12-01 20:29:00');
			$sDescription .= ' du soir';
			$sDescription = str_replace('#MOMENT#', 'du soir', $sDescription);
			$iMinMinutes = 600;
		}

		$aAllPrograms = array();
		$aAllPrograms['items'] = array();
		$aChannels = $this->modelChannel->getChannelByGroup($sChannelsType);
		$i = 0;

		foreach ($aChannels['items'] as $iKey => $oOneChannel) {

			$aAllPrograms['items'][$i] = $oOneChannel;
			$aAllPrograms['items'][$i]->url = $this->url->getUrl('programme-une-chaine', array('id' => $oOneChannel->get_id(), 'title' => $this->url->encodeToUrl($oOneChannel->get_name())));
			$aAllPrograms['items'][$i]->program = $this->modelProgramOnGrid->getProgramAfterTime($sDateStartProgram, $oOneChannel->get_id(), $iMinMinutes);

			foreach ($aAllPrograms['items'][$i]->program as $iKey2 => $oProgram) {

				if ($oProgram->get_id_record() > 0) {

					$aAllPrograms['items'][$i]->program[$iKey2] = $this->modelRecord->findOneByid($oProgram->get_id_record());
					$aRecords = $this->businessRecord->getExtendedInfos(array($aAllPrograms['items'][$i]->program[$iKey2]));
					$aAllPrograms['items'][$i]->program[$iKey2] = $aRecords[0];
					$aAllPrograms['items'][$i]->program[$iKey2]->title_program = $aAllPrograms['items'][$i]->program[$iKey2]->get_title();
				}
				else {

					$aAllPrograms['items'][$i]->program[$iKey2]->title_program = $oProgram->program->get_name();
					$aAllPrograms['items'][$i]->program[$iKey2]->url = $this->url->getUrl('programme-detail', array('id' => $oProgram->program->get_id(), 'title' => $this->url->encodeToUrl($oProgram->program->get_name())));
				}
			}

			$i++;
		}

		$this->layout
       		 ->assign('model', 'ProgramTv.tpl')
       	 	 ->assign('title', $sTitle.' - iScreenway')
       	 	 ->assign('description', $sDescription)
       	 	 ->assign('program', $aAllPrograms)
			 ->display();
	}

  	/**
   	 * program of tnt
   	 *
   	 * @access public
   	 * @return void
	 */

	public function showTnt() {

		$this->showProgramTv('tnt', 'now');
	}

	/**
	 * program of cable
	 *
	 * @access public
	 * @return void
	 */

	public function showCable() {

		$this->showProgramTv('cable', 'now');
	}
}

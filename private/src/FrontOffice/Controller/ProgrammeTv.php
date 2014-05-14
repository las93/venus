<?php

/**
 * Controller to ProgrammeTv
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
use \Venus\src\FrontOffice\Model\channel as modelChannel;
use \Venus\src\FrontOffice\Model\program_on_grid as modelProgramOnGrid;
use \Venus\src\FrontOffice\Model\program as modelProgram;
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Controller\Record as controllerRecord;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

/**
 * Controller to ProgrammeTv
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

class ProgrammeTv extends Controller {

  	/**
   	 * Constructor
   	 *
   	 * @access public
   	 * @return object
   	 */

  	public function __construct() {

	    $this->modelChannel = function() { return new modelChannel; };
	    $this->modelProgramOnGrid = function() { return new modelProgramOnGrid; };
	    $this->modelProgram = function() { return new modelProgram; };
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
   	 * the main page
  	 *
   	 * @access public
   	 * @param  string $sMomentInDay argument to define the moment we want show
   	 * @return void
   	 */

  	public function show($sChannelsType = 'classique', $sMomentInDay = 'night') {

  		if ($sChannelsType === 'tnt') {

  			$sTitle = 'Programme TV de la TNT';
  			$sDescription = 'Découvrez le programme TV #MOMENT# complet de la TNT et tous les articles, critiques, photos liées aux programmes désirés.';
  		}
  		else {

  			$sTitle = 'Programme TV';
  			$sDescription = 'Découvrez le programme TV #MOMENT# et tous les articles, critiques, photos liées aux programmes désirés.';
  		}

  		if ($sMomentInDay === 'now') {

  			$sDateStartProgram = date('Y-m-d H:i:s');
  			$sTitle .= ' de maintenant';
  			$sDescription = str_replace('#MOMENT#', 'de maintenant', $sDescription);
  			$iMinMinutes = 60;
  		}
  		else {

  			$sDateStartProgram = date('Y-m-d 20:29:00');
  			$sDescription .= ' du soir';
  			$sDescription = str_replace('#MOMENT#', 'du soir', $sDescription);
  			$iMinMinutes = 600;
  		}

    	$aAllPrograms = array();
    	$aChannels = $this->modelChannel->getChannelByGroup($sChannelsType);
    	$i = 0;

    	foreach ($aChannels as $iKey => $oOneChannel) {

	    	$aAllPrograms[$i] = $oOneChannel;
	      	$aAllPrograms[$i]->url = $this->url->getUrl('programme-une-chaine', array('id' => $oOneChannel->get_id(), 'title' => $this->url->encodeToUrl($oOneChannel->get_name())));
	      	$aAllPrograms[$i]->program = $this->modelProgramOnGrid->getProgramAfterTime($sDateStartProgram, $oOneChannel->get_id(), $iMinMinutes);

      		foreach ($aAllPrograms[$i]->program as $iKey2 => $oProgram) {

        		if ($oProgram->get_id_record() > 0) {

          			$aAllPrograms[$i]->program[$iKey2]->record = $this->modelRecord->findOneByid($oProgram->get_id_record());
          			$aAllPrograms[$i]->program[$iKey2]->record = $this->controllerRecord->getExtendedInfosOne($aAllPrograms[$i]->program[$iKey2]->record);
        		}
        		else {

          			$aAllPrograms[$i]->program[$iKey2]->url = $this->url->getUrl('programme-detail', array('id' => $oProgram->program->get_id(), 'title' => $this->url->encodeToUrl($oProgram->program->get_name())));
        		}
      		}

      		$i++;
    	}

    	$this->layout
       	 	 ->assign('title', $sTitle.' - iScreenway')
       	 	 ->assign('h1_programtv', $sTitle)
       	 	 ->assign('description', $sDescription)
       	 	 ->assign('program', $aAllPrograms)
       	 	 ->assign('sub_menu3', true)
       	 	 ->assign('category', 'tv')
       	 	 ->display();
  	}

  	/**
   	 * the main page
  	 *
   	 * @access public
   	 * @return void
   	 */

	public function showOne($iId, $sTitle) {

    	$oProgram = $this->modelProgram->findOneByid($iId);

    	$this->layout
       	 	 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneProgram.tpl')
       		 ->assign('title', 'Programme TV - iScreenway')
       		 ->assign('description', 'Découvrez le programme TV et tous les articles, critiques, photos liées aux programmes désirés.')
       		 ->assign('program', $oProgram)
       		 ->assign('category', 'tv')
       		 ->display();
  	}

  	/**
   	 * program of tnt
   	 *
   	 * @access public
   	 * @return void
	 */

	public function showTnt() {

		$this->show('tnt', 'now');
	}

	/**
	 * program of cable
	 *
	 * @access public
	 * @return void
	 */

	public function showCable() {

		$this->show('cable', 'now');
	}

	/**
   	 * the main page
   	 *
   	 * @access public
   	 * @param  int $sId id channel
   	 * @param  string $sTitle title
   	 * @return void
   	 */

  	public function showOneChannel($sId, $sTitle) {

    	$oChannel = $this->modelChannel->findOneByid($sId);

	    $this->layout
	       	 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneTvProgram.tpl')
	       	 ->assign('title', 'Programme TV de '.$oChannel->get_name().' - iScreenway')
	       	 ->assign('description', 'Découvrez le programme TV  de '.$oChannel->get_name().' et tous les articles, critiques, photos liées aux programmes désirés.')
	       	 ->assign('sub_menu3', true)
	       	 ->assign('channel', $oChannel)
	       	 ->assign('category', 'tv')
	       	 ->assign('url_tv', $this->url->getUrl('programme-une-chaine', array('id' => $oChannel->get_id(), 'title' => $this->url->encodeToUrl($oChannel->get_name()))))
	       	 ->display();
	}

	/**
   	 * the main page
   	 *
   	 * @access public
   	 * @param  int $sId id channel
   	 * @param  string $sTitle title
   	 * @return void
   	 */

	public function showBest() {

		$aAllPrograms = array();
		$aChannels = $this->modelChannel->getChannelByGroup('classique');
		$i = 0;

		foreach ($aChannels as $iKey => $oOneChannel) {

			$aAllPrograms[$i] = $oOneChannel;
		 	$aAllPrograms[$i]->url = $this->url->getUrl('programme-une-chaine', array('id' => $oOneChannel->get_id(), 'title' => $this->url->encodeToUrl($oOneChannel->get_name())));
		  	$aAllPrograms[$i]->program = $this->modelProgramOnGrid->getProgramAfterTime(date('Y-m-d 20:29:00'), $oOneChannel->get_id());

		    	foreach ($aAllPrograms[$i]->program as $iKey2 => $oProgram) {

		        	if ($oProgram->get_id_record() > 0) {

		          		$aAllPrograms[$i]->program[$iKey2]->record = $this->modelRecord->findOneByid($oProgram->get_id_record());
		          		$aAllPrograms[$i]->program[$iKey2]->record = $this->controllerRecord->getExtendedInfosOne($aAllPrograms[$i]->program[$iKey2]->record);
		        	}
		        	else {

		          		$aAllPrograms[$i]->program[$iKey2]->url = $this->url->getUrl('programme-detail', array('id' => $oProgram->program->get_id(), 'title' => $this->url->encodeToUrl($oProgram->program->get_name())));
		        	}
		      	}

			$i++;
	    }

		$this->layout
			 ->assign('title', 'Programme TV - iScreenway')
	    	 ->assign('description', 'Découvrez le programme TV et tous les articles, critiques, photos liées aux programmes désirés.')
	       	 ->assign('program', $aAllPrograms)
	       	 ->assign('sub_menu3', true)
	       	 ->assign('category', 'tv')
	       	 ->display();
	}

	/**
   	 * the main page
   	 *
   	 * @access public
   	 * @return void
	 */

	public function showNow() {

		$this->show('classique', 'now');
	}
}

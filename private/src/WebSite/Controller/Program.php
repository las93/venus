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
use \Venus\src\WebSite\Entity\like_program as entityLikeProgram;
use \Venus\src\WebSite\Model\program as modelProgram;
use \Venus\src\WebSite\Model\channel as modelChannel;
use \Venus\src\WebSite\Model\program_on_grid as modelProgramOnGrid;
use \Venus\src\WebSite\Model\like_program as modelLikeProgram;

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

class Program extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelProgram = function() { return new modelProgram; };
		$this->modelChannel = function() { return new modelChannel; };
		$this->modelProgramOnGrid = function() { return new modelProgramOnGrid; };
		$this->modelLikeProgram = function() { return new modelLikeProgram; };

		parent::__construct();

		$this->layout->assign('menu', 'tele');
	}

	/**
	 * program of cable
	 *
	 * @access public
	 * @return void
	 */

	public function show($iId, $sTitle) {

		$oProgram = $this->modelProgram->findOneById($iId);
  		$oProgram = $this->_getTotalInfo($oProgram);

		$this->layout
			 ->assign('model', 'Program.tpl')
			 ->assign('title', $oProgram->get_name().' - iScreenway')
			 ->assign('description', 'Découvrez la fiche complète de '.$oProgram->get_name().', ses actualités et plein d\'autres choses...')
			 ->assign('program', $oProgram)
			 ->assign('like', 0)
			 ->display();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iId id of Record
	 * @param  string $sTitle title
	 * @return void
	 */

	public function showDiffusion($iId, $sTitle) {

		$oProgram = $this->modelProgram->findOneById($iId);
  		$oProgram = $this->_getTotalInfo($oProgram);

		$aDiffusions = array();
		$aChannels = $this->modelChannel->getChannelDiffusionOfProgramId($iId);

		foreach ($aChannels as $oOneChannel) {

			$aDiffusions[$oOneChannel->get_name()] = $this->modelProgramOnGrid->getDiffusionOfChannelIdForProgramId($oOneChannel->get_id(), $iId);
		}

		$this->layout
			 ->assign('model', 'ProgramDiffusion.tpl')
			 ->assign('program', $oProgram)
			 ->assign('diffusions', $aDiffusions)
			 ->assign('title', 'Diffusions de '.$oProgram->get_name().' - iScreenway')
			 ->assign('description', 'Découvrez toutes les diffusions de '.$oProgram->get_name().', ses actualités, son casting, ses photos et plein d\'autres choses...')
			 ->display();
	}

  	/**
  	 * get all info of movie/serie or emission
  	 *
  	 * @access private
  	 * @param  object $oRecord
  	 * @return object
  	 */

  	private function _getTotalInfo($oProgram) {

  		if (isset($_POST) && isset($_POST['like'])) {

  			if ($this->session->get('userid')) { $sIp = ''; }
  			else { $sIp = $_SERVER['REMOTE_ADDR']; }

  			$oLikeMovie = new entityLikeProgram;

  			$oLikeMovie->set_id_program($iId)
  					   ->set_id_user($this->session->get('userid'))
  					   ->set_ip($sIp);

  			$this->modelLikeProgram->insert($oLikeMovie);

  			file_get_contents('http://www.iscreenway.com/'.$_SERVER['REQUEST_URI'].'?flush=1');
  		}

  		$iCountLike = count($this->modelLikeProgram->findByid_program($oProgram->get_id()));

  		$this->layout->assign('like', $iCountLike);

  		$oProgram->title_encode = $this->url->encodeToUrl($oProgram->get_name());
  		$oProgram->image = '/images/programme_'.$oProgram->get_id().'.jpg';

  		return $oProgram;
  	}
}

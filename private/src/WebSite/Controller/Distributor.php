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
use \Venus\src\WebSite\Entity\like_company as entityLikeCompany;
use \Venus\src\WebSite\Model\company as modelCompany;
use \Venus\src\WebSite\Model\like_company as modelLikeCompany;

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

class Distributor extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelCompany = function() { return new modelCompany; };
		$this->modelLikeCompany = function() { return new modelLikeCompany; };

		parent::__construct();

		$this->layout->assign('menu', 'home');
	}

	/**
	 * Distributor of cable
	 *
	 * @access public
	 * @param  int $iId id
	 * @param  string $sTitle title
	 * @return void
	 */

	public function show($iId, $sTitle) {

		$oCompany = $this->modelCompany->findOneById($iId);
  		$oCompany = $this->_getTotalInfo($oCompany);

		$this->layout
			 ->assign('model', 'Company.tpl')
			 ->assign('title', 'Distributeur '.$oCompany->get_name().' - iScreenway')
			 ->assign('description', 'Retrouvez la biographie du distributeur '.$oCompany->get_name().' ainsi que la description complète de tous les distributeurs du cinéa et des séries TV...')
			 ->assign('company', $oCompany)
			 ->display();
	}

  	/**
  	 * get all info of movie/serie or emission
  	 *
  	 * @access private
  	 * @param  object $oCompany
  	 * @return object
  	 */

  	private function _getTotalInfo($oCompany) {

  		if (isset($_POST) && isset($_POST['like'])) {

  			if ($this->session->get('userid')) { $sIp = ''; }
  			else { $sIp = $_SERVER['REMOTE_ADDR']; }

  			$oLikeMovie = new entityLikeCompany;

  			$oLikeMovie->set_id_company($iId)
  					   ->set_id_user($this->session->get('userid'))
  					   ->set_ip($sIp);

  			$this->modelLikeCompany->insert($oLikeMovie);

  			file_get_contents('http://www.iscreenway.com/'.$_SERVER['REQUEST_URI'].'?flush=1');
  		}

  		$iCountLike = count($this->modelLikeCompany->findByid_company($oCompany->get_id()));

  		$this->layout->assign('like', $iCountLike);

  		$oCompany->title_encode = $this->url->encodeToUrl($oCompany->get_name());
  		$oCompany->image = '/images/company_'.$oCompany->get_id().'.jpg';

  		return $oCompany;
  	}
}

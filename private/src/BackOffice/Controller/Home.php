<?php

/**
 * Controller to test
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
use \Venus\lib\Session as Session;
use \Venus\src\BackOffice\Model\user as modelUser;
use \Venus\src\BackOffice\Entity\user as entityUser;

/**
 * Controller to test
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
 * @property	\src\Front\Model\user $modelUser
 */

class Home extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelUser = function() { return new modelUser; };

		parent::__construct();
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @return void
	 */

	public function show() {

		$bConnected = false;

		$this->session->start();
		$oUser = $this->session->get('user');

		if ($oUser) { $bConnected = true; }

		if (isset($_GET['deconnexion'])) {

			$this->session->destroy();
			$bConnected = false;
		}
		else if (isset($_POST) && count($_POST) > 0) {

			$oUser = new entityUser;

			$oUser->set_login($_POST['login'])
				  ->set_password(md5($_POST['password']));

			$oUserConnected = $this->modelUser->get($oUser);

			if (isset($oUserConnected) && count($oUserConnected) > 0) {

				$this->session->set('user', $oUserConnected[0]);
				$bConnected = true;
			}
		}

		if ($bConnected === false) {

			$this->layout
				 ->display();
		}
		else {

			$this->layout
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'BackOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'HomeConnected.tpl')
				 ->display();
		}

	}
}
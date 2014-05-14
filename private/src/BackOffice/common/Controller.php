<?php

/**
 * Controller Manager
 *
 * @category  	src\BackOffice
 * @package   	src\BackOffice\common
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit rÃ©servÃ© Ã  http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\BackOffice\common;

use \Venus\core\Controller as CoreController;
use \Venus\Venus\core\UrlManager as UrlManager;

/**
 * Controller Manager
 *
 * @category  	src\BackOffice
 * @package   	src\BackOffice\common
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit rÃ©servÃ© Ã  http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

abstract class Controller extends CoreController {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		parent::__construct();

		$this->session->start();
		$oUser = $this->session->get('user');

		if (!$oUser && get_called_class() !== 'src\BackOffice\Controller\Home') {

			$oUrlManager = new UrlManager;
			$sUrl = $oUrlManager->getUrl('home', array());
			$this->redirect($sUrl);
		}
	}
}

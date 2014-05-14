<?php

/**
 * Controller Manager
 *
 * @category  	core
 * @package   	core\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit rÃ©servÃ© Ã  http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\core;

use \Venus\core\Router as Router;
use \Venus\core\Security as Security;
use \Venus\core\Translator as Translator;
use \Venus\lib\Template as Template;
use \Venus\lib\Form as Form;
use \Venus\lib\Mail as Mail;
use \Venus\lib\Session as Session;
use \Venus\lib\Cookie as Cookie;
use \Venus\core\UrlManager as UrlManager;

/**
 * Controller Manager
 *
 * @category  	core
 * @package   	core\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit rÃ©servÃ© Ã  http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

abstract class Controller extends Mother {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$aClass = explode('\\', get_called_class());
		$sClassName = $aClass[count($aClass) - 1];
		$sNamespaceName = str_replace('\\'.$aClass[count($aClass) - 1], '', get_called_class());

		if (isset($sClassName)) {

			$sNamespaceBaseName = str_replace('\Controller', '', $sNamespaceName);
			$defaultModel = $sNamespaceBaseName.'\Model\\'.$sClassName;
			$defaultBusiness = $sNamespaceBaseName.'\Business\\'.$sClassName;
			$defaultView = $sClassName.'.tpl';
			$defaultLayout = str_replace('\\', DIRECTORY_SEPARATOR, str_replace('Venus\\', '\\', $sNamespaceBaseName)).DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Layout.tpl';

			$this->model = function() use ($defaultModel) { return new $defaultModel; };

			$this->business = function() use ($defaultBusiness) { return new $defaultBusiness; };

			$this->view = function() use ($defaultView) { return new Template($defaultView); };

			$this->layout = function() use ($defaultLayout) { return new Template($defaultLayout); };

			$this->layout->assign('model', $defaultView);
		}

		$this->form = function() { return new Form(); };
		$this->security = function() { return new Security(); };
		$this->router = function() { return new Router; };
		$this->mail = function() { return new Mail; };
		$this->session = function() { return new Session; };
		$this->translator = function() { return new Translator; };
		$this->url = function() { return new UrlManager; };
		$this->cookie = function() { return new Cookie; };
	}

	/**
	 * redirection HTTP
	 *
	 * @access public
	 * @param  string $sUrl url for the redirection
	 * @return void
	 */

	public function redirect($sUrl) {

		header('Status: 301 Moved Permanently', false, 301);
		header('Location: '.$sUrl);
		exit;
	}

	/**
	 * call an other action as you call action with URL/Cli
	 *
	 * @access public
	 * @param  string $sUri uri for the redirection
	 * @param  array $aParams parameters
	 * @return void
	 */

	public function forward($sUri, $aParams = array()) {

		$this->router->runByFoward($sUri, $aParams);
	}

	/**
	 * call the 404 Not Found page
	 *
	 * @access public
	 * @return void
	 */

	public function NotFound() {

		$$this->router->runHttpErrorPage(404);
	}

	/**
	 * call the 403 Forbidden page
	 *
	 * @access public
	 * @return void
	 */

	public function Forbidden() {

		$$this->router->runHttpErrorPage(403);
	}
}

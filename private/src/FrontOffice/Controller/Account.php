<?php

/**
 * Controller to Account
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
use \Venus\core\UrlManager as UrlManager;
use \Venus\src\FrontOffice\Entity\user as entityAccount;
use \Venus\src\FrontOffice\Model\user as modelAccount;
use \Venus\lib\Facebook as Facebook;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

/**
 * Controller to Account
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

class Account extends Controller {

	/**
	 * private key
	 * @var string
	 */

	private $_sPrivateKey = 'mytoken!:;,';

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelAccount = function() { return new modelAccount; };
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
	 * the main page of news
	 *
	 * @access public
	 * @return void
	 */

	public function create() {

		$bValidation = false;
		$aErrors = [];

		if (isset($_POST) && count($_POST) > 0) {

			$bValidation = true;

			$oUserCheck = $this->modelAccount->findOneBylogin($_POST['login']);

			if (count($oUserCheck) > 0) {

				$aErrors[] = '* le pseudo existe déjà, veuillez en choisir un autre.';
				$bValidation = false;
			}

			if (isset($_POST['login']) && !preg_match('/^[a-zA-Z_0-9.]+$/', $_POST['login'])) {

				$aErrors[] = '* le pseudo doit contenir des lettres, des chiffres, des . ou des _ uniquement.';
				$bValidation = false;
			}
			else if (isset($_POST['login']) && strlen($_POST['login']) < 3 || strlen($_POST['login']) > 14) {

				$aErrors[] = '* le pseudo doit faire entre 4 et 14 caractères.';
				$bValidation = false;
			}

			if (isset($_POST['pswd']) && strlen($_POST['pswd']) > 15) {

				$aErrors[] = '* le mot de passe doit faire entre 4 et 14 caractères.';
				$bValidation = false;
			}

			if (isset($_POST['mail']) && !preg_match('/^([a-zA-Z0-9]+(([\.\-\_]?[a-zA-Z0-9]+)+)?)\@(([a-zA-Z0-9]+[\.\-\_])+[a-zA-Z]{2,4})$/', $_POST['mail'])) {

				$aErrors[] = '* l\'email indiqué n\'est pas valide. Veuillez vérifier son exactitude.';
				$bValidation = false;
			}

			if (isset($_POST['cgu']) && $_POST['cgu'] != 1) {

				$aErrors[] = '* la confirmation des CGU est obligatoire.';
				$bValidation = false;
			}

			if ($bValidation == true) {

				$oUser = new entityAccount;
				$oUser->set_login($_POST['login'])
					  ->set_password(md5($_POST['pswd']))
					  ->set_type('user')
					  ->set_email($_POST['mail'])
					  ->set_validation('n')
					  ->set_cgu(1);

				$iUserId = $this->modelAccount->insert($oUser);

				copy(
					str_replace('private'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.PORTAIL.DIRECTORY_SEPARATOR.'Controller', 'public'.DIRECTORY_SEPARATOR.PORTAIL.DIRECTORY_SEPARATOR.'img', __DIR__).DIRECTORY_SEPARATOR.'avatar.jpg',
					str_replace('private'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.PORTAIL.DIRECTORY_SEPARATOR.'Controller', 'data/upload', __DIR__).DIRECTORY_SEPARATOR.'avatar_'.$iUserId.'.jpg'
				);
			}
		}
		else if (strstr($_SERVER['REQUEST_URI'], '/fb')) {

			$oFacebook = new Facebook;
			$aUser = $oFacebook->getUserInfo();

			$_POST['login'] = $aUser['name'];
			$_POST['pswd'] = md5($aUser['id']);
			$_POST['mail'] = $aUser['email'];
			$_POST['cgu'] = 1;

			$bValidation = true;

			$oUserCheck = $this->modelAccount->findOneBylogin($_POST['login']);

			if (count($oUserCheck) > 0) {

				$aErrors[] = '* le pseudo existe déjà, veuillez en choisir un autre.';
				$bValidation = false;
			}

			if (isset($_POST['cgu']) && $_POST['cgu'] != 1) {

				$aErrors[] = '* la confirmation des CGU est obligatoire.';
				$bValidation = false;
			}

			if ($bValidation == true) {

				$oUser = new entityAccount;

				$oUser->set_login($_POST['login'])
					  ->set_password(md5($_POST['pswd']))
					  ->set_type('user')
					  ->set_email($_POST['mail'])
					  ->set_validation('n')
					  ->set_cgu(1);

				$iUserId = $this->modelAccount->insert($oUser);

				copy(
					$oFacebook->getPicture(50, 50),
					str_replace('private'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.PORTAIL.DIRECTORY_SEPARATOR.'Controller', 'data/upload', __DIR__).DIRECTORY_SEPARATOR.'avatar_'.$iUserId.'.jpg'
				);
			}
		}

		if ($bValidation == true) {

			$oUserCheck = $this->modelAccount->findOneBy(['login' => $_POST['login'], 'password' => md5($_POST['pswd'])]);

			$this->session
				 ->set('user', $oUserCheck->get_login())
				 ->set('userid', $oUserCheck->get_id())
				 ->set('usertoken', md5($oUserCheck->get_login().$oUserCheck->get_password().$this->_sPrivateKey));

			$this->cookie
				 ->set('user', $oUserCheck->get_login(), 9000, '/', 'www.iscreenway.com')
				 ->set('usertoken', md5($oUserCheck->get_login().$oUserCheck->get_password().$this->_sPrivateKey), 9000, '/', 'www.iscreenway.com');

			$this->layout
				 ->assign('title', 'Inscription validée  - iScreenway')
			 	 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'AccountOk.tpl')
				 ->assign('description', 'Inscription terminée sur le plus grand site de cinéma iScreenway sur lequel vous trouverez toutes les bande-annonces, biographies et films.')
				 ->display();
		}
		else {

			$oFacebook = new Facebook;

			if ($oFacebook->getUser()) {

				$oUserCheck = $this->modelAccount->findOneBy(['login' => $_POST['login'], 'password' => md5($_POST['pswd'])]);

				$this->session
					 ->set('user', $oUserCheck->get_login())
				 	 ->set('userid', $oUserCheck->get_id())
					 ->set('usertoken', md5($oUserCheck->get_login().$oUserCheck->get_password().$this->_sPrivateKey));

				$this->cookie
					 ->set('user', $oUserCheck->get_login(), 9000, '/', 'www.iscreenway.com')
					 ->set('usertoken', md5($oUserCheck->get_login().$oUserCheck->get_password().$this->_sPrivateKey), 9000, '/', 'www.iscreenway.com');

				$this->layout
					 ->assign('title', 'Connecté  - iScreenway')
					 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ConnectionOk.tpl')
					 ->assign('description', 'Vous êtes connecté sur le plus grand site de cinéma iScreenway sur lequel vous trouverez toutes les bande-annonces, biographies et films.')
					 ->display();

				exit;
			}

			$this->layout
				 ->assign('title', 'Inscription  - iScreenway')
				 ->assign('description', 'Inscrivez-vous sur le plus grand site de cinéma iScreenway sur lequel vous trouverez toutes les bande-annonces, biographies et films.')
				 ->assign('error', $aErrors)
				 ->assign('login', $oFacebook->getButton('<img src="/img/facebook.jpg" border="0"/> Créer mon compte à partir de mon Facebook.'))
				 ->assign('is_connect', $oFacebook->getUser())
				 ->display();
		}
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @return void
	 */

	public function deconnect() {

		$this->session
			 ->destroy();

		$this->cookie
			 ->set('user', '', time() - 42000, '/', 'www.iscreenway.com')
			 ->set('usertoken', '', time() - 42000, '/', 'www.iscreenway.com');

		$this->redirect('/');
		exit;
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @return void
	 */

	public function connect() {

		$bValidation = false;
		$sErrors = '';

		if (isset($_POST) && count($_POST) > 0) {

			$oUserCheck = $this->modelAccount->findOneBy(['login' => $_POST['login'], 'password' => md5($_POST['pswd'])]);

			if ($oUserCheck != false) {

				$this->session
					 ->set('user', $oUserCheck->get_login())
				 	 ->set('userid', $oUserCheck->get_id())
					 ->set('usertoken', md5($oUserCheck->get_login().$oUserCheck->get_password().$this->_sPrivateKey));

				$this->cookie
					 ->set('user', $oUserCheck->get_login(), 9000, '/', 'www.iscreenway.com')
					 ->set('usertoken', md5($oUserCheck->get_login().$oUserCheck->get_password().$this->_sPrivateKey), 9000, '/', 'www.iscreenway.com');

				$bValidation = true;
			}
			else {

				$sErrors = '* pseudo ou mot de passe erroné.<br/>';
			}
		}
		else {

		}

		if ($bValidation == true) {

			$this->layout
				 ->assign('title', 'Connecté  - iScreenway')
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ConnectionOk.tpl')
				 ->assign('description', 'Vous êtes connecté sur le plus grand site de cinéma iScreenway sur lequel vous trouverez toutes les bande-annonces, biographies et films.')
				 ->display();
		}
		else {

			$oFacebook = new Facebook;

			$this->layout
				 ->assign('title', 'Connexion  - iScreenway')
				 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Connection.tpl')
				 ->assign('description', 'Connectez-vous sur le plus grand site de cinéma iScreenway sur lequel vous trouverez toutes les bande-annonces, biographies et films.')
				 ->assign('error', $sErrors)
				 ->assign('login', $oFacebook->getButton('<img src="/img/facebook.jpg" border="0"/> Me connecter à partir de mon Facebook.'))
				 ->assign('is_connect', $oFacebook->getUser())
				 ->display();
		}
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @return void
	 */

	public function showAccount() {

		$sLogin = $this->session->get('user');

		if ($sLogin) {

			$sUserToken = $this->session->get('usertoken');
			$oUserCheck = $this->modelAccount->findOneBylogin($sLogin);

			if ($sUserToken == md5($sLogin.$oUserCheck->get_password().$this->_sPrivateKey)) {

				$this->layout
					 ->assign('title', 'Connecté  - iScreenway')
					 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'ConnectionOk.tpl')
					 ->assign('description', 'Vous êtes connecté sur le plus grand site de cinéma iScreenway sur lequel vous trouverez toutes les bande-annonces, biographies et films.')
					 ->display();

				return;
			}
		}

		$this->redirect('/');
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  string $sLogin login
	 * @return void
	 */

	public function showProfil($sLogin) {

		$oUserCheck = $this->modelAccount->findOneBylogin($sLogin);

 		$this->layout
			 ->assign('title', 'Profil de '.$sLogin.'  - iScreenway')
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Profil.tpl')
			 ->assign('description', 'Découvrez le profil de '.$sLogin.' sur le plus grand site de cinéma iScreenway sur lequel vous trouverez toutes les bande-annonces, biographies et films.')
			 ->assign('login', $sLogin)
			 ->display();

		$this->redirect('/');
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @param  string $sLogin login
	 * @return void
	 */

	public function showUsers() {

		$this->layout
			 ->assign('title', 'Liste des utilisateurs  - iScreenway')
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Users.tpl')
			 ->assign('description', 'Découvrez tous les utilisateurs sur le plus grand site de cinéma iScreenway sur lequel vous trouverez toutes les bande-annonces, biographies et films.')
			 ->display();
	}
}

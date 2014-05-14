<?php

/**
 * Controller to Contact
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
use \Venus\lib\Mail as Mail;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

/**
 * Controller to Contact
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

class Contact extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

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

	public function show() {

		if (isset($_POST) && count($_POST) > 0) {

			$oMail = new Mail;
			$oMail->addRecipient('las92i@hotmail.fr')
				  ->setSubject('demande iScreenway')
				  ->setMessage(
				  	'demande: '.$_POST['content']."\n".
				  	'email: '.$_POST['email']."\n".
				  	$_POST['content']
				  )
				  ->send();

			$sMessage = '<script>alert("Votre Message a été envoyé à iScreenway !");</script>';

		}
		else {

			$sMessage = '';
		}

		$this->layout
			 ->assign('title', 'Contactez iScreenway')
			 ->assign('description', 'Contactez l\'équipe d\'iSreenway pour toute question ou demande. Nosu serons ravis de pouvoir répondre à totues vos questions.')
			 ->assign('message', $sMessage)
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @return void
	 */

	public function showAbout() {

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'About.tpl')
			 ->assign('title', 'A propos d\'iScreenway')
			 ->assign('description', 'Qui est iSreenway ? Découvrez notre historique, nos ambitions et totu ce qui concerne iScreenway.')
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @return void
	 */

	public function showWebsiteNews() {

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'WebsiteNews.tpl')
			 ->assign('title', 'Actualités iScreenway')
			 ->assign('description', 'Découvrez vite les actualités d\'iScreenway pour tout savoir su ce site ambitieux et complet.')
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @return void
	 */

	public function showService() {

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Service.tpl')
			 ->assign('title', 'Services iScreenway')
			 ->assign('description', 'Découvrez vite les différents services proposés par iScreenway pour tout savoir sur ce site ambitieux et complet.')
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @return void
	 */

	public function showJobs() {

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Job.tpl')
			 ->assign('title', 'Services iScreenway')
			 ->assign('description', 'Découvrez toutes les offres de recrutement d\'iScreenway qui pourrait potentiellement vous intéresser.')
			 ->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @return void
	 */

	public function showAds() {

		$this->layout
		->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Ads.tpl')
		->assign('title', 'Publicité / annonceurs')
		->assign('description', 'Si vous désirez devenir annonceur sur iScreenway, cette page vous donnera tous les renseignements nécessaires.')
		->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @return void
	 */

	public function showCgu() {

		$this->layout
		->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Cgu.tpl')
		->assign('title', 'Conditions générales d\'utilisation')
		->assign('description', 'Découvrez les Conditions générales d\'utilisation d\'iScreenway.')
		->display();
	}

	/**
	 * the main page of news
	 *
	 * @access public
	 * @return void
	 */

	public function showCharte() {

		$this->layout
		->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Charte.tpl')
		->assign('title', 'Charte de confidentialité')
		->assign('description', 'Découvrez la charte de confidentialité d\'iScreenway.')
		->display();
	}
}

<?php

/**
 * Controller to Distributor
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
use \Venus\src\FrontOffice\Model\company as modelCompany;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

/**
 * Controller to Distributor
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

class Distributor extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelCompany = function() { return new modelCompany; };
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
	 * the main page of folders
	 *
	 * @access public
	 * @return void
	 */

	public function show() {

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'Distributor.tpl')
			 ->assign('title', 'Tous les distributeurs de films et séries TV - iScreenway')
			 ->assign('description', 'Retrouvez tous les distributeurs de films et de séries TV...')
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

	public function showOne($iId, $sTitle) {

		$oCompany = $this->modelCompany->findOneByid($iId);

		if (count($oCompany) < 1) { $this->redirect('/'); }

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneDistributor.tpl')
			 ->assign('title', 'Distributeur '.$oCompany->get_name().' - iScreenway')
			 ->assign('description', 'Retrouvez la biographie du distributeur '.$oCompany->get_name().' ainsi que la description complète de tous les distributeurs du cinéa et des séries TV...')
			 ->assign('company', $oCompany)
			 ->display();
	}
}

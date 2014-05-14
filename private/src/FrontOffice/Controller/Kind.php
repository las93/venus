<?php

/**
 * Controller to Kind
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
use \Venus\src\FrontOffice\Model\kind as modelKind;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

/**
 * Controller to Kind
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

class Kind extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelKind = function() { return new modelKind; };
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

		$oKind = $this->modelKind->findOneById($iId);

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneKind.tpl')
			 ->assign('title', 'Tous les films, séries TV '.$oKind->get_name().' - iScreenway')
			 ->assign('description', 'Retrouvez tous les les films, série TV '.$oKind->get_name().', les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
			 ->assign('kind', $oKind)
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

	public function showOneForMovie($iId, $sTitle) {

		$oKind = $this->modelKind->findOneById($iId);

		$this->layout
			 ->assign('model', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneKindForMovie.tpl')
			 ->assign('title', 'Tous les films '.$oKind->get_name().' - iScreenway')
			 ->assign('description', 'Retrouvez tous les les films '.$oKind->get_name().', les séances dans toute la France, le guide des films à voir, news, communautés de fans, box-office...')
			 ->assing('kind', $oKind)
			 ->display();
	}
}

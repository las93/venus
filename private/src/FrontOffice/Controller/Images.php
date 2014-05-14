<?php

/**
 * Controller to images
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
use \Venus\src\FrontOffice\Model\photo as modelPhoto;
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Model\article as modelArticle; 

/**
 * Controller to images
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

class Images extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {
		
		$this->modelPhoto = function() { return new modelPhoto; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelArticle = function() { return new modelArticle; };
		
		parent::__construct();
	}

	/**
	 * the list of record
	 *
	 * @access public
	 * @param  string $sFileName file name to show
	 * @return void
	 */

	public function show($sFileName, $sTitle = null, $sType = null) {

		if ($sTitle === null && preg_match('/photo/', $sFileName)) { 
 
			$oPhoto = $this->modelPhoto->findOneByid(preg_replace('/photo_([0-9]+)\.jpg/', '$1', $sFileName));
			$this->redirect($this->url->getUrl('images-nom', array('id' => $oPhoto->get_id(), 'title' => $this->url->encodeToUrl($oPhoto->get_title()), 'type' => 'photo')));
			exit;
		}
		elseif ($sTitle === null && preg_match('/record/', $sFileName)) { 
 
			$oRecord = $this->modelRecord->findOneByid(preg_replace('/record_([0-9]+)\.jpg/', '$1', $sFileName));
			$this->redirect($this->url->getUrl('images-nom', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'type' => 'record')));
			exit;
		}
		elseif ($sTitle === null && preg_match('/article/', $sFileName)) { 
 
			$oRecord = $this->modelArticle->findOneByid(preg_replace('/article_([0-9]+)\.jpg/', '$1', $sFileName));
			$this->redirect($this->url->getUrl('images-nom', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'type' => 'article')));
			exit;
		}
		elseif ($sTitle !== null && $sType !== null) {

			if ($sType == 'affiche') { $sType = 'record'; } 
			
			header('Content-Type: image/jpeg');
			$sName = $sType.'_'.$sFileName.'.jpg';
			
			if (file_exists(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.$sName)) {
			
				echo file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.$sName);
			}
			else {
					
				echo file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'default.jpg');
			}
			 
			exit;
		}
		
		header('Content-Type: image/jpeg');
		
		if (file_exists(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.$sFileName)) {
		
			echo file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.$sFileName);
		}
		else {
			
			echo file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'default.jpg');
		}
		exit;
	}
}

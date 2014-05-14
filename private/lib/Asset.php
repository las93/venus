<?php

/**
 * Manage Asset
 *
 * @category  	lib
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\lib;

/**
 * This class manage the Asset
 *
 * @category  	lib
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 *
 * @tutorial	$oAsset = new \Venus\lib\Asset;
 * 				echo $oAsset->getUrl('css/style.css');
 */

class Asset {

	/**
	 * content asset
	 *
	 * @access private
	 * @var    string
	 */

	private $_sContent = '';

	/**
	 * assign a variable for the Asset
	 *
	 * @access public
	 * @param  string $sUrl url to get
	 * @return \Venus\lib\Asset
	 */

	public function getUrl($sUrl) {

		$this->_sContent = file_get_contents(str_replace('private'.DIRECTORY_SEPARATOR.'lib', '', __DIR__).'public'.DIRECTORY_SEPARATOR.PORTAIL.DIRECTORY_SEPARATOR.$sUrl);
		return $this;
	}

	/**
	 * when you echo the object, we return the content of asset
	 *
	 * @access public
	 * @return string
	 */

	public function __toString() {

		return $this->_sContent;
	}
}

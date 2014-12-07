<?php

/**
 * Manage Form
 *
 * @category  	lib
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

namespace Venus\lib;

use \Venus\lib\Response\Json as Json;
use \Venus\lib\Response\Mock as Mock;
use \Venus\lib\Response\Yaml as Yaml;

/**
 * This class manage the Form
 *
 * @category  	lib
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

class Response {

	/**
	 * the translation language
	 * @var string
	 */
	
	private $_sKinbfOfReturn = 'json';
	
	/**
	 * set the language if you don't want take the default language of the configuration file
	 *
	 * @access public
	 * @param  string $sKinbfOfReturn
	 * @return \Venus\lib\I18n
	 */
	
	public function setKinbfOfReturn($sKinbfOfReturn) {
	
		$this->_sKinbfOfReturn = $sKinbfOfReturn;
		return $this;
	}
	
	/**
	 * translate the content
	 *
	 * @access public
	 * @param  mixed $mContent content to translate
	 * @return mixed
	 */

	public static function translate($mContent) {
	    
		if ($this->_sKinbfOfReturn === 'yaml') { return Yaml::translate($mContent); }
		else if ($this->_sKinbfOfReturn === 'mock') { return Mock::translate($mContent); }
		else { return Json::translate($mContent); }  
	}
}

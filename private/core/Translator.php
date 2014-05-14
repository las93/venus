<?php

/**
 * Translator
 *
 * @category  	core
 * @package   	core\
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

namespace Venus\core;

use \Venus\core\Config as Config;

/**
 * Translator
 *
 * @category  	core
 * @package   	core\
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

class Translator extends Mother {

	/**
	 * language to translate
	 *
	 * @access public
	 * @var    string
	 */

	private static $_sLanguage = 'en';

	/**
	 * object of translation
	 *
	 * @access public
	 * @var    object
	 */

	private static $_oTranslate = array();

	/**
	 * set the language
	 *
	 * @access public
	 * @param  string $sLanguage language for translation
	 * @return void
	 */

	public static function setLanguage($sLanguage) {

		self::$_sLanguage = $sLanguage;
	}

	/**
	 * set the language
	 *
	 * @access public
	 * @return string
	 */

	public static function getLanguage() {

		return self::$_sLanguage;
	}

	/**
	 * create an URL
	 *
	 * @access public
	 * @param  string $sCode code of the url between "routes" and "route" in Route.conf
	 * @param  array $aTranslate parameters to create transformation.
	 * @return void
	 */

	public function trans($sCode, array $aTranslate = array()) {

		if (self::$_oTranslate === null) { self::$_oTranslate = Config::get('i18n/'.self::$_sLanguage); }

		$sContentToReturn = self::$_oTranslate->$sCode;

		foreach ($aTranslate as $sKey => $sValue) {

			$sContentToReturn = str_replace($sKey, $sValue, $sContentToReturn);
		}

		return $sContentToReturn;
	}
}

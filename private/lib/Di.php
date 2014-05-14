<?php

/**
 * Dependency Injection Manager
 *
 * @category  	core
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
 * Dependency Injection Manager
 *
 * @category  	core
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class Di {

	/**
	 * contener of depency injector
	 *
	 * @access private
	 * @var    array
	 */

	private static $_aDependencyInjectorContener = null;

	/**
	 * import   librairy of vendors
	 *
	 * @access public
	 * @param  string $sClass class of vendors/ to import
	 * @param  string $sFolder folder to import (all files will be imported automaticaly)
	 * @param  string $sNameOfDi name to create your import
	 * @return boolean
	 *
	 * @exemple  	new \Venus\core\Di::import('smarty', 'smarty', 'TplManager');
	 * 				$oDi = new \Venus\core\Di;
	 * 				$oSmarty = $oDi->get('TplManager');
	 *
	 * 				please set smarty in vendors/smarty/*
	 */

	public static function import($sClass, $sFolder, $sNameOfDi) {

		$sDirectory = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendors'.DIRECTORY_SEPARATOR.$sFolder;
		$aFiles = scandir($sDirectory);

		foreach ($aFiles as $sOneFile) {

			if (preg_match('/\.php/', $sOneFile)) {

				include_once($sDirectory.DIRECTORY_SEPARATOR.$sOneFile);
			}
		}

		if (class_exists($sClass)) {

			self::$_aDependencyInjectorContener[md5($sNameOfDi)] = new $sClass;
			self::get($sNameOfDi);
		}
		else {

			throw new Exception("The class ".$sClass." not found!");
		}
	}

	/**
	 * get the injection (no replace it if it exists)
	 *
	 * @access public
	 * @param  string $sNameOfDi name of injection
	 * @param  array $aParameters parameters of the constructor
	 * @return object
	 */

	public function get($sNameOfDi, array $aParameters = array()) {

		if (!isset(self::$_aDependencyInjectorContener[md5($sNameOfDi)])) {

			if (count($aParameters) > 0) {

				$oReflectionClass  = new \ReflectionClass($sNameOfDi);
				self::$_aDependencyInjectorContener[md5($sNameOfDi)] = $oReflectionClass->newInstanceArgs($aParameters);
			}
			else {

				self::$_aDependencyInjectorContener[md5($sNameOfDi)] = new $sNameOfDi;
			}
		}

		return self::$_aDependencyInjectorContener[md5($sNameOfDi)];
	}


	/**
	 * get the injection (replace it if it exists)
	 *
	 * @access public
	 * @param  string $sNameOfDi name of injection
	 * @param  array $aParameters parameters of the constructor
	 * @return object
	 */

	public function newInstance($sNameOfDi, array $aParameters = array()) {

		if (count($aParameters) > 0) {

			$oReflectionClass  = new \ReflectionClass($sNameOfDi);
			self::$_aDependencyInjectorContener[md5($sNameOfDi)] = $oReflectionClass->newInstanceArgs($aParameters);
		}
		else {

			self::$_aDependencyInjectorContener[md5($sNameOfDi)] = new $sNameOfDi;
		}

		return self::$_aDependencyInjectorContener[md5($sNameOfDi)];
	}

	/**
	 * set a property
	 *
	 * @access public
	 * @param  string $sNameOfDi name of di
	 * @param  string $sParameter name of field to set
	 * @param  mixed $mValue value to set
	 * @return \Venus\core\Di
	 */

	public function setProperty($sNameOfDi, $sParameter, $mValue) {

		self::$_aDependencyInjectorContener[md5($sNameOfDi)]->$sParameter = $mValue;
		return $this;
	}
}

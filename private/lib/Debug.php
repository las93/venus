<?php

/**
 * Manage debug
 *
 * @category  	lib
 * @package   	lib\Entity
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

namespace Venus\lib;

use \Venus\lib\Bash as Bash;

/**
 * This class manage the debug
 *
 * @category  	lib
 * @package   	lib\Entity
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

class Debug {

	/**
  	 * variable to activate or not the debug
  	 * @var boolean
  	 */

  	private static $_bActivateDebug = false;

  	/**
   	 * variable to activate or not the error
  	 * @var boolean
  	 */

  	private static $_bActivateError = false;

  	/**
  	 * variable to activate or not the exception
  	 * @var boolean
  	 */

  	private static $_bActivateException = false;

  	/**
  	 * variable to activate or not the debug
  	 * @var boolean
  	 */

  	private static $_sFileLog = null;

  	/**
  	 * first or not activation
  	 * @var boolean
  	 */

  	private static $_bFirstActivation = true;

  	/**
  	 * activate debug
  	 *
  	 * @access public
  	 * @return void
   	 */

	public static function activateDebug() {

		if (self::$_bFirstActivation === true) {

			self::_setFileNameInErrorFile();
			self::$_bFirstActivation = false;
    	}

    	self::_initLogFile();
    	self::$_bActivateDebug = true;
    	self::activateError(E_ALL);
    	self::activateException(E_ALL);
	}

  	/**
  	 * activate debug
  	 *
  	 * @access public
  	 * @return void
  	 */

  	public static function deactivateDebug() {

    	self::$_bActivateDebug = false;
  	}

  	/**
  	 * check if debug is activate or not
  	 *
  	 * @access public
  	 * @return boolean
	 */

  	public static function isDebug() {

		return self::$_bActivateDebug;
  	}

  	/**
  	 * check if debug is activate or not
  	 *
  	 * @access public
  	 * @param  string $sLog content to log
  	 * @param  string $sErrFile file
  	 * @param  int $iErrLine line
  	 * @param  int $iErrNo number of error
  	 * @param  string $sClassName class name
  	 * @param  string $sFunction name of function
  	 * @return void
  	 */

	public static function log($sLog, $sErrFile = null, $iErrLine = null, $iErrNo = null, $sClassName = null, $sFunction = null) {

    	if ($sErrFile === null) { $sErrFile = __FILE__; }
    	if ($iErrLine === null) { $iErrLine = __LINE__; }
    	if ($iErrNo === null) { $iErrNo = 'N.C.'; }

    	if (self::isDebug() === true) {

			if ($sClassName === null || $sFunction === null) {

				error_log($sErrFile.'> (l.'.$iErrLine.') '.$sLog);
			}
			else {

				error_log($sErrFile.'>'.$sClassName.'::'.$sFunction.' (l.'.$iErrLine.') '.$sLog);
			}
    	}
	}

	/**
  	 * activate error reporting
  	 *
  	 * @access public
  	 * @param  int $iLevel level of error
  	 * @return void
  	 */

  	public static function activateError($iLevel) {

    	if (self::$_bFirstActivation === true) {

      		self::_setFileNameInErrorFile();
      		self::$_bFirstActivation = false;
    	}

    	self::_initLogFile();
    	self::$_bActivateError = true;

    	error_reporting($iLevel);

    	set_error_handler(function ($iErrNo, $sErrStr, $sErrFile, $iErrLine) {

      		Debug::log($sErrStr, $sErrFile, $iErrLine, $iErrNo);
      		return true;
		}, $iLevel);

    	register_shutdown_function(function () {

			if (null !== ($aLastError = error_get_last())) {

    			Debug::log($aLastError['message'], $aLastError['file'], $aLastError['line'], $aLastError['type']);
    		}
    	});
  	}

  	/**
  	 * activate error reporting
  	 *
  	 * @access public
  	 * @return void
   	*/

  	public static function deactivateError() {

    	self::$_bActivateError = false;
  	}

  	/**
  	 * check if error reporting is activate or not
  	 *
  	 * @access public
  	 * @return boolean
  	 */

  	public static function isError() {

    	return self::$_bActivateError;
  	}


  	/**
  	 * activate Exception
  	 *
  	 * @access public
  	 * @param  int $iLevel level of error
  	 * @return void
  	 */

  	public static function activateException($iLevel) {

  		if (self::$_bFirstActivation === true) {

  			self::_setFileNameInErrorFile();
  			self::$_bFirstActivation = false;
  		}

  		self::_initLogFile();
  		self::$_bActivateException = true;

  		set_exception_handler(function ($oException) {

			Debug::log($oException->getMessage(), $oException->getFile(), $oException->getLine(), 0);
		});
  	}

  	/**
  	 * activate Exception
  	 *
  	 * @access public
  	 * @return void
  	 */

  	public static function deactivateException() {

  		self::$_bActivateException = false;
  	}

  	/**
  	 * check if Exception is activate or not
  	 *
  	 * @access public
  	 * @return boolean
  	 */

  	public static function isException() {

  		return self::$_bActivateException;
  	}

  	/**
  	 * set the name of the called
  	 *
  	 * @access public
  	 * @return void
   	*/

  	private static function _setFileNameInErrorFile() {

    	/**
    	 * We see if it's a cli call or a web call
    	 */

    	if (defined('BASH_CALLED')) {

      		error_log(Bash::setColor('############### '.BASH_CALLED.' ###############', 'cyan'));
    	}
    	else {

      		error_log(Bash::setColor('############### '.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].' ###############', 'cyan'));
    	}
  	}

  	/**
   	 * init the log file (error_log)
  	 *
   	 * @access private
  	 * @return void
   	 */

  	private static function _initLogFile() {

    	self::$_sFileLog = str_replace(DIRECTORY_SEPARATOR.'private'.DIRECTORY_SEPARATOR.'lib', '', __DIR__).DIRECTORY_SEPARATOR.
      		"data".DIRECTORY_SEPARATOR."log".DIRECTORY_SEPARATOR."php-error.log";

    	ini_set("log_errors", 1);
    	ini_set("error_log", self::$_sFileLog);


    	if (file_exists(self::$_sFileLog) === false) { file_put_contents(self::$_sFileLog, ''); }
  	}
}
<?php

/**
 * Manage Sessions
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
 * This class manage the Sessions
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

class Session {
	
	/**
	 * constructor
	 *
	 * @access public
	 * @return \Venus\lib\Session
	 */
	
	public function __construct() {
	
		$this->start();
	}
	
  	/**
  	 * set a value
  	 *
  	 * @access public
  	 * @param  string $sName name of the session
  	 * @param  mixed $mValue value of this sesion var
  	 * @return \Venus\lib\Session
  	 */

  	public function set($sName, $mValue) {

    	$_SESSION[$sName] = $mValue;
    	return $this;
  	}

  	/**
  	 * set a value
  	 *
  	 * @access public
  	 * @param  string $sName name of the session
  	 * @return mixed
  	 */

  	public function get($sName) {

  		if (isset($_SESSION[$sName])) { return $_SESSION[$sName]; }
  		else { return false; }
  	}

  	/**
  	 * start the session
  	 *
  	 * @access public
  	 * @return mixed
  	 */

  	public function start() {

		if (!session_id()) { session_start(); }
  	}

  	/**
  	 * set a flashbag value
  	 *
  	 * @access public
  	 * @param  string $sName name of the session
  	 * @param  string $sValue value of this sesion var
  	 * @return \Venus\lib\Session
	 */

 	 public function setFlashBag($sName, $sValue) {

  		if (!isset($_SESSION['flashbag'])) { $_SESSION['flashbag'] = array(); }

  		$_SESSION['flashbag'][$sName] = $sValue;
  		return $this;
	}
	
	/**
	 * destroy the session
	 *
	 * @access public
	 * @return mixed
	 */
	
	public function destroy() {
	
		session_start();

		$_SESSION = array();
		
		if (ini_get("session.use_cookies")) {
		    
			$aParams = session_get_cookie_params();
		    
		    setcookie(session_name(), '', time() - 42000,
		        $aParams["path"], $aParams["domain"],
		        $aParams["secure"], $aParams["httponly"]
		    );
		}

		session_destroy();
	}
}

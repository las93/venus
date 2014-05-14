<?php

/**
 * Manage Cookies
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
 * This class manage the Cookies
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

class Cookie {

  	/**
  	 * set a value
  	 *
  	 * @access public
  	 * @param  string $sName name of the Cookie
  	 * @param  mixed $mValue value of this sesion var
  	 * @return \Venus\lib\Cookie
  	 */

  	public function set($sName, $mValue, $iExpire = 0, $sPath = '', $sDomain = '', $iSecure = false) {

  		$iExpire = time() + $iExpire;
    	setcookie($sName, $mValue, $iExpire, $sPath, $sDomain, $iSecure);
    	return $this;
  	}

  	/**
  	 * set a value
  	 *
  	 * @access public
  	 * @param  string $sName name of the Cookie
  	 * @return mixed
  	 */

  	public function get($sName) {

    	return $_COOKIE[$sName];
  	}
}

<?php

/**
 * Manage Cache
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

use \Venus\lib\Cache\File as CacheFile;
use \Venus\lib\Cache\Memcache as CacheMemcache;

/**
 * This class manage the Cache
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

class Cache {

	/**
	 * type of cache (memcache/file)
	 *
	 * @access private
	 * @var    string
	 */

	private static $_sTypeOfCache = 'file';

	/**
	 * type of cache (memcache/file)
	 *
	 * @access private
	 * @var    array
	 */

	private static $_aCache = array();

	/**
	 * set the cache that we would use
	 *
	 * @access private
	 * @param  string $sCacheName name of cache
	 * @return object
	 */

	public static function setCacheType($sCacheName) {

		if ($sCacheName === 'file') { $this->_sTypeOfCache = 'file'; }
		else if ($sCacheName === 'memcache') { $this->_sTypeOfCache = 'memcache'; }
	}

	/**
	 * set a value
	 *
	 * @access public
	 * @param  string $sName name of the session
	 * @param  mixed $mValue value of this sesion var
	 * @param  int $iTimeout expiration of cache
	 * @return void
	 */

	public static function set($sName, $mValue, $iTimeout = 0) {

		if (self::$_sTypeOfCache === 'file') {

			return self::_getCacheObject()->set($sName, $mValue);
		}
		else if (self::$_sTypeOfCache === 'memcache') {

			return self::_getCacheObject()->set($sName, $mValue, 0, $iTimeout);
		}
	}

	/**
	 * set a value
	 *
	 * @access public
	 * @param  string $sName name of the session
	 * @param  int $iTimeout expiration of cache
	 * @return void
	 */

	public static function get($sName, $iTimeout = 0) {

		if (self::$_sTypeOfCache === 'file') {

			return self::_getCacheObject()->get($sName, $iTimeout);
		}
		else if (self::$_sTypeOfCache === 'memcache') {

			return self::_getCacheObject()->get($sName);
		}
	}

	/**
	 * delete a value
	 *
	 * @access public
	 * @param  string $sName name of the session
	 * @return boolean
	 */

	public static function delete($sName) {

		return self::_getCacheObject()->delete($sName);
	}

	/**
	 * initialize the cache class and get the good object
	 *
	 * @access private
	 * @return object
	 */

	private static function _getCacheObject() {

		if (self::$_sTypeOfCache === 'file') {

			if (!isset(self::$_aCache['file'])) { self::$_aCache['file'] = new CacheFile; }

			return self::$_aCache['file'];
		}
		else if (self::$_sTypeOfCache === 'memcache') {

			if (!isset(self::$_aCache['memcache'])) { self::$_aCache['memcache'] = new CacheMemcache; }

			return self::$_aCache['memcache'];
		}
	}
}

<?php

/**
 * Manage Cache by Memcache
 *
 * @category  	lib
 * @package		lib\Cache
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

namespace Venus\lib\Cache;

use \Memcache as RealMemcache;

/**
 * This class manage the Cache by Memcache
 *
 * @category  	lib
 * @package		lib\Cache
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

class Apc {

	/**
	 * set a value
	 *
	 * @access public
	 * @param  string $sName name of the session
	 * @param  mixed $mValue value of this sesion var
	 * @return \Venus\lib\Cache\File
	 */

	public function set($sName, $mValue) {

		apc_add($sName, $mValue);
		return $this;
	}

	/**
	 * get a value
	 *
	 * @access public
	 * @param  string $sName name of the session
	 * @param  int $iTimeout expiration of cache
	 * @return mixed
	 */

	public function get($sName, $iTimeout = 0) {

		return apc_fetch($sName);
	}

	/**
	 * delete a value
	 *
	 * @access public
	 * @param  string $sName name of the session
	 * @return mixed
	 */

	public function delete($sName) {

		return apc_delete($sName);
	}

	/**
	 * flush the cache
	 *
	 * @access public
	 * @return mixed
	 */

	public function flush() {

		return flush();
	}
}

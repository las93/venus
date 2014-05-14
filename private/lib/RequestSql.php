<?php

/**
 * RequestSql Manager (Orm use it)
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

use \Venus\lib\Db as Db;

/**
 * RequestSql Manager (Orm use it)
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

class RequestSql {

	/**
	 * magic method to create dynamically each methods
	 *
	 * @access public
	 * @param  string $sName
	 * @param  array $aArguments
	 * @return mixed
	 */

	public function __call($sName, $aArguments) {

		/**
		 * We accepted just some methods
		 */

		if ($sName === 'query' || $sName === 'beginTransaction' || $sName === 'commit' || $sName === 'errorCode' || $sName === 'errorInfo'
			|| $sName === 'exec' || $sName === 'getAttribute' || $sName === 'getAvailableDrivers' || $sName === 'inTransaction'
			|| $sName === 'lastInsertId' || $sName === 'prepare' || $sName === 'quote' || $sName === 'rollBack'
			|| $sName === 'setAttribute') {

			$oPdo = Db::connect(self::DB_CONF);
			return call_user_func_array(array($oPdo, $sName), $aArguments);
		}
	}
}

<?php

/**
 * Db Manager
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

use \Venus\core\Config as Config;
use \Venus\lib\Db as Db;
use \Venus\lib\Entity as Entity;

/**
 * Db Manager
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

class Db {

	/**
	 * object Db
	 *
	 * @access private
	 * @var    array
	 */

	private static $_oPdo = null;

	/**
	 * get instance of Pdo
	 *
	 * @access public
	 * @param  string sName name of the configuration
	 * @return void
	 */

	public static function connect($sName) {

		if (!isset(self::$_oPdo[$sName])) {

			$oDbConf = Config::get('Db')->configuration;

			if ($oDbConf->{$sName}->type == 'mysql') {

				try {

					self::$_oPdo[$sName] = new \PDO('mysql:host='.$oDbConf->{$sName}->host.';dbname='.$oDbConf->{$sName}->db, $oDbConf->{$sName}->user, $oDbConf->{$sName}->password, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
					self::$_oPdo[$sName]->setAttribute(\PDO::ATTR_FETCH_TABLE_NAMES, 1);
					self::$_oPdo[$sName]->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
				}
				catch (Exception $oException) {

					echo $e->getMessage();
				}
			}
			else if ($oDbConf->{$sName}->type == 'mssql') {

				self::$_oPdo[$sName] = new \PDO('mssql:host='.$oDbConf->{$sName}->host.';dbname='.$oDbConf->{$sName}->db, $oDbConf->{$sName}->user, $oDbConf->{$sName}->password);
				self::$_oPdo[$sName]->setAttribute(\PDO::ATTR_FETCH_TABLE_NAMES, 1);
				self::$_oPdo[$sName]->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
			}
			else if ($oDbConf->{$sName}->type == 'sqlite') {

				self::$_oPdo[$sName] = new \PDO('sqlite:'.$oDbConf->{$sName}->path);
				self::$_oPdo[$sName]->setAttribute(\PDO::ATTR_FETCH_TABLE_NAMES, 1);
				self::$_oPdo[$sName]->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
			}
		}

		return self::$_oPdo[$sName];
	}
}

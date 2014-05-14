<?php

/**
 * Manage Benchmark
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

use \Venus\lib\Debug as Debug;

/**
 * This class manage the Benchmark
 *
 * @category  	lib
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 *
 * @tutorial	$oBenchmark = new \Venus\lib\Benchmark;
 * 				echo $oBenchmark->getUrl('css/style.css');
 */

class Benchmark {

	/**
	 * start Benchmark
	 *
	 * @access private
	 * @var    flaot
	 */

	private static $_fStart = 0;

	/**
	 * assign a variable for the Benchmark
	 *
	 * @access public
	 * @param  string $sUrl url to get
	 * @return \Venus\lib\Benchmark
	 */

	public static function start() {

		self::$_fStart = microtime(true);
	}

	/**
	 * assign a variable for the Benchmark
	 *
	 * @access public
	 * @param  string $sUrl url to get
	 * @return \Venus\lib\Benchmark
	 */

	public static function getPoint() {

		return microtime(true) - self::$_fStart;
	}

	/**
	 * assign a variable for the Benchmark
	 *
	 * @access public
	 * @param  string $sName name of point
	 * @return \Venus\lib\Benchmark
	 */

	public static function setPointInLog($sName = 'default') {

		Debug::log('BENCHMARK: Time at this point '.(microtime(true) - self::$_fStart).' - '.$sName, '', 0, '');
	}
}

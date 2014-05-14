<?php

/**
 * Exception Manager
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

namespace Venus\core;

/**
 * Exception Manager
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

class Exception {

	/**
	 * conf in a cache array
	 *
	 * @access private
	 * @var    array
	 */

	private static $_aConfCache = array();

	/**
	 * get a configuration
	 *
	 * @access public
	 * @param  string sName name of the configuration
	 * @return void
	 */

	public function __construct($message, $code = 0, Exception $previous = null) {

    	;

		parent::__construct($message, $code, $previous);
	}

	/**
	 * rewrite the string when we use the Excetion in echo
	 *
	 * @access public
	 * @return string
	 */

	public function __toString() {

		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}
}

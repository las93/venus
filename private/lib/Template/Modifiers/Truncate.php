<?php

/**
 * Manage Template
 *
 * @category  	lib
 * @package		lib\Template
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\lib\Template\Modifiers;

/**
 * This class manage the Template
 *
 * @category  	lib
 * @package		lib\Template
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class Truncate {

	/**
	 * run before
	 *
	 * @access public
	 * @param  array $aParams parameters
	 * @return \Venus\lib\Template\Mailto
	 */

	public function run($aParams = array()) {

		;
	}

	/**
	 * run before
	 * replace {$foo |date_format:"%Y/%m/%d" by {date("%Y/%m/%d", $foo)
	 *
	 *
	 * @access public
	 * @param  string $sParams parameters
	 * @return \Venus\lib\Template\Mailto
	 */

	public function replaceBy($sParams, $sTruncateNumber = 30) {

		return '{strip_tags(substr('.$sParams.', 0, '.$sTruncateNumber.'))."..."}';
	}
}

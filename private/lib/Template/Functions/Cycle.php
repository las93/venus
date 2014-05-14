<?php

/**
 * Manage Template
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

namespace Venus\lib\Template\Functions;

/**
 * This class manage the Template
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

class Cycle {

	/**
	 * run before
	 *
	 * @access public
	 * @param  array $aParams parameters
	 * @return \Venus\lib\Template\Cycle
	 */

	public function run($aParams = array()) {

		;
	}

	/**
	 * run before
	 *
	 * @access public
	 * @param  array $aParams parameters
	 * @return \Venus\lib\Template\Cycle
	 */

	public function replaceBy($aParams = array()) {

		$sValues = '';

		if (isset($aParams['values'])) { $sValues = $aParams['values']; }
		else { new Exception('Cycle: values obligatory');}

		$sCycle = '';
		$i = 0;

		$iCountCycle = count(explode(',', $aParams['values']));

		foreach (explode(',', $aParams['values']) as $sValue) {

			$sCycle .= '<? php if ($_aProtectedVar[\'i\']/'.$i.' == round($_aProtectedVar[\'i\']/'.$i.')) { ?>'.$sValue.'<?php } ?>';
			$i++;
		}

		return $sCycle;
	}
}

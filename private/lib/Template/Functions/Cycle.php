<?php

/**
 * Manage Template
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

namespace Venus\lib\Template\Functions;

/**
 * This class manage the Template
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
		else { new \Exception('Cycle: values obligatory');}

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

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

class Append {

	/**
	 * run before
	 *
	 * @access public
	 * @param  array $aParams parameters
	 * @return \Venus\lib\Template\Url
	 */

	public function run($aParams = array()) {

		;
	}

	/**
	 * run before
	 *
	 * @access public
	 * @param  array $aParams parameters
	 * @return \Venus\lib\Template\Url
	 */

	public function replaceBy($aParams = array()) {

		if (isset($aParams['var'])) { $sVar = $aParams['var']; }
		else { new Exception('Append: var obligatory');}

		if (isset($aParams['value'])) { $sValue = $aParams['value']; }
		else { new Exception('Append: value obligatory');}

		if (isset($aParams['index'])) { $sIndex = $aParams['index']; }
		else { $sIndex = null; }

		if (isset($aParams['scope'])) { $sScope = $aParams['scope']; }
		else { $sScope = 'local'; }

		if (isset($sIndex)) {

			return '<?php if (!isset('.$sVar.')) { '.$sVar.' = array(); } '.$sVar.'['.$sIndex.'] = '.$sValue.'; ?>';
		}
		else {

			return '<?php if (!isset('.$sVar.')) { '.$sVar.' = array(); } '.$sVar.'[] = '.$sValue.'; ?>';
		}
	}
}

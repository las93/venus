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

class Url {

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

		if (isset($aParams['alias'])) {

			$sAlias = $aParams['alias'];
			unset($aParams['alias']);

			$sArrayConstruct = 'array( ';

			foreach ($aParams as $sKey => $oOne) {

				$sArrayConstruct .= "'$sKey' => $oOne,";
			}

			$sArrayConstruct = substr($sArrayConstruct, 0, -1);
			$sArrayConstruct .= ')';

			return '<?php $oUrlManager = new \Venus\core\UrlManager; echo $oUrlManager->getUrl('.$sAlias.', '.$sArrayConstruct.'); ?>';
		}
	}
}

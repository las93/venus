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

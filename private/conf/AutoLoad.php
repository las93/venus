<?php

/**
 * autoload of the framework
 * use the PSR-0
 *
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 *
 * new version with SPL to have the capacity to add external autoload
 */

spl_autoload_register(function ($sClassName) {

    $sClassName = ltrim($sClassName, '\\');
    $sFileName  = '';
    $sNamespace = '';

    if ($iLastNsPos = strrpos($sClassName, '\\')) {

        $sNamespace = substr($sClassName, 0, $iLastNsPos);
        $sClassName = substr($sClassName, $iLastNsPos + 1);
		$sFileName  = str_replace('\\', DIRECTORY_SEPARATOR, $sNamespace).DIRECTORY_SEPARATOR;
    }

    //$sFileName = str_replace('Venus\\', '', $sFileName);
    $sFileName .= $sClassName.'.php';

    if (strstr($sFileName, 'Venus\\') && file_exists(str_replace('conf', DIRECTORY_SEPARATOR, __DIR__).str_replace('Venus\\', '', $sFileName))) {

    	require str_replace('conf', DIRECTORY_SEPARATOR, __DIR__).str_replace('Venus\\', '', $sFileName);
    }
    else if (file_exists(str_replace('conf', DIRECTORY_SEPARATOR, __DIR__).$sFileName)) {

    	require str_replace('conf', DIRECTORY_SEPARATOR, __DIR__).$sFileName;
    }
    else {

    	require_once str_replace('conf', 'core', __DIR__).DIRECTORY_SEPARATOR.'Config.php';
    	$oDbConf = \Venus\core\Config::get('Const')->autoload->class;

    	if (isset($oDbConf->$sClassName)) {

    		require str_replace('private'.DIRECTORY_SEPARATOR.'conf', '', __DIR__).$oDbConf->$sClassName;
    	}
    }
});

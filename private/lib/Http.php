<?php

/**
 * Http Manager
 *
 * @category  	core
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0.1
 */
namespace Venus\lib;

/**
 * Http Manager
 *
 * @category  	core
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0.1
 */
class Http
{
    /**
     * All method whom start by HTTP_ to exclude them of the PUT parameter
     * @var unknown
     */
    private static $_aHttpClassicParameter = array('HTTP_HOST', 'HTTP_CONNECTION', 'HTTP_ORIGIN', 'HTTP_USER_AGENT', 'HTTP_ACCEPT', 
        'HTTP_ACCEPT_ENCODING', 'HTTP_ACCEPT_LANGUAGE');

	/**
	 * import   librairy of vendors
	 *
	 * @access public
	 * @return array
	 */
	public static function getPut() 
	{	    
	    $aPut = array();
	    
	    $rPutResource = fopen("php://input", "r");
	    
	    while ($sData = fread($rPutResource, 1024)) {

	        $aSeparatePut = explode('&', $sData);
	        
	        foreach($aSeparatePut as $sOne) {
	            
	            $aOnePut = explode('=', $sOne);
	            $aPut[$aOnePut[0]] = $aOnePut[1];
	        }
	    }
	    
	    return $aPut;
	}
}

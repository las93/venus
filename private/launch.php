<?php

/**
 * bootstrap of the framework for the script CLI
 *
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

error_reporting(E_ALL);
ini_set('display_error', 1);

set_include_path(get_include_path().PATH_SEPARATOR.__DIR__);

require 'conf/AutoLoad.php';

$oRouter = new \Venus\core\Router();
$oRouter->run();

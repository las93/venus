<?php

/**
 * Controller to test
 *
 * @category  	src
 * @package   	src\WebSite\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\WebSite\Controller;

use \Venus\core\Controller as Controller;
use \Venus\src\WebSite\Model\photo as modelPhoto;

/**
 * Controller to test
 *
 * @category  	src
 * @package   	src\WebSite\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class Photo extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelPhoto = function() { return new modelPhoto; };

		parent::__construct();

    	$this->layout->assign('menu', 'home');
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @param  int $iId id
	 * @param  string $sTitle
	 * @param  string $sType
	 * @return void
	 */

	public function show($iId, $sTitle) {

		$oPhoto = $this->modelPhoto->findOneById($iId);

		$this->layout
			 ->assign('photo', $oPhoto)
			 ->assign('title', 'Photo de '.$oPhoto->get_title().' - iScreenway')
			 ->assign('description', 'Retrouvez la photo '.$oPhoto->get_title().' ainsi que des milliers d\'autres photos de cinémas, de stars et de séries...')
			 ->display();
  	}
}

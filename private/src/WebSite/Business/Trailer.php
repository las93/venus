<?php

/**
 * Controller to Trailer
 *
 * @category  	src
 * @package   	src\FrontOffice\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\WebSite\Business;

use \Venus\core\Business as Business;
use \Venus\lib\Date as Date;
use \Venus\src\WebSite\Business\Record as businessRecord;
use \Venus\src\WebSite\Model\record as modelRecord;
use \Venus\src\WebSite\Model\trailer as modelTrailer;

/**
 * Controller to Trailer
 *
 * @category  	src
 * @package   	src\FrontOffice\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class Trailer extends Business {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->businessRecord = function() { return new businessRecord; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->modelTrailer = function() { return new modelTrailer; };

		parent::__construct();
	}

	/**
	 * get last trailers
	 *
	 * @access public
	 * @param  int $iLimit limit
	 * @param  string $sType type of trailers
	 * @param  int $iOffset offset
	 * @return array
	 */

	public function getLastTrailers($iLimit = 4, $sType = null, $iOffset = 0, $iIdRecord = null) {

		$aTrailer = $this->modelTrailer->getLastRows($iLimit, $sType, $iIdRecord, $iOffset);

		foreach ($aTrailer['items'] as $iKey => $oTrailer) {

			$oRecord = $this->modelRecord->findOneByid($oTrailer->get_id_record());
			$sBase = $this->businessRecord->getTypeForUrl($oRecord->get_type());
			$aTrailer['items'][$iKey]->url = $this->url->getUrl('bande-annonce-detail', array('id' => $oTrailer->get_id(), 'title' => $this->url->encodeToUrl($oTrailer->get_title()), 'id_record' => $oRecord->get_id(), 'base' => $sBase, 'title_record' => $this->url->encodeToUrl($oRecord->get_title())));
		}

		return $aTrailer;
	}
}

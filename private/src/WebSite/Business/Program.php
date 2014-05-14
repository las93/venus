<?php

/**
 * Controller to Record
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

namespace Venus\src\WebSite\Business;

use \Venus\core\Business as Business;
use \Venus\src\WebSite\Model\program as modelProgram;

/**
 * Controller to Record
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

class Program extends Business {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelProgram = function() { return new modelProgram; };

		parent::__construct();
	}

	/**
	 * the main page of news for one movie
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getTopProgram($iLimit = 10, $iOffset = 0) {

		$aRecords = $this->modelProgram->getTopProgram($iLimit, $iOffset);
		$aRecords['items'] = $this->getExtendedInfos($aRecords['items']);
		return $aRecords;
	}

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @param  array $aRecords records
	 * @return array
	 */

	public function getExtendedInfos($aRecords) {

		foreach ($aRecords as $iKey => $oRecord) {

			if ($oRecord->get_name() == '') { $oRecord->set_name('N.C.'); }

			$aRecords[$iKey]->url = $this->url->getUrl('programme-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_name())));
		}

		return $aRecords;
	}
}

<?php

/**
 * Controller to Record
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
use \Venus\src\WebSite\Model\record as modelRecord;

/**
 * Controller to Record
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

class Record extends Business {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelRecord = function() { return new modelRecord; };

		parent::__construct();
	}

	/**
	 * the main page of news for one movie
	 *
	 * @access public
	 * @param  int $iLimit limit
	 * @return void
	 */

	public function getTypeForUrl($sType) {

		if ($sType == 'serie') { return 'series/liste'; }
		else if ($sType == 'tv') { return 'programme-tv/emission'; }
		else { return 'cinema/film'; }
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

	public function getMoviesOfWeek($sType = 'film', $iLimit = 10, $iOffset = 0, $iIntNumberWeeks = 1) {

		$aRecords = $this->modelRecord->getMoviesOfWeek($sType, $iLimit, $iOffset, $iIntNumberWeeks);
		$aRecords['items'] = $this->getExtendedInfos($aRecords['items']);
		return $aRecords;
	}

	/**
	 * Get the best movie/serie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getBestMovies($sType = 'film', $iLimit = 10, $iOffset = 0) {

		$aRecords = $this->modelRecord->getBestMovies($sType, $iLimit, $iOffset);
		$aRecords['items'] = $this->getExtendedInfos($aRecords['items']);
		return $aRecords;
	}

	/**
	 * Get the best movie/serie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getMovies($sType = 'film', $iLimit = 10, $iOffset = 0, $sFirstLetter = null, $iKind = 0) {

		$aRecords = $this->modelRecord->getMovies($sType, $iLimit, $iOffset, $sFirstLetter, $iKind);
		$aRecords['items'] = $this->getExtendedInfos($aRecords['items']);
		return $aRecords;
	}

	/**
	 * Get the wanted movie/serie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getWantedMovies($sType = 'film', $iLimit = 10, $iOffset = 0) {

		$aRecords = $this->modelRecord->getWantedMovies($sType, $iLimit, $iOffset);
		$aRecords['items'] = $this->getExtendedInfos($aRecords['items']);
		return $aRecords;
	}

	/**
	 * Get the dvd movie/serie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getDvdOrBlurayByDate($sType = 'all', $iLimit = 10, $iOffset = 0) {

		$aRecords = $this->modelRecord->getDvdOrBlurayByDate($sType, $iLimit, $iOffset);
		$aRecords['items'] = $this->getExtendedInfos($aRecords['items']);
		return $aRecords;
	}

	/**
	 * Get the dvd movie/serie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getBestDvdOrBluray($sType = 'all', $iLimit = 10, $iOffset = 0) {

		$aRecords = $this->modelRecord->getBestDvdOrBluray($sType, $iLimit, $iOffset);
		$aRecords['items'] = $this->getExtendedInfos($aRecords['items']);
		return $aRecords;
	}

	/**
	 * Get the dvd movie/serie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getWantedDvdOrBluray($sType = 'all', $iLimit = 10, $iOffset = 0) {

		$aRecords = $this->modelRecord->getWantedDvdOrBluray($sType, $iLimit, $iOffset);
		$aRecords['items'] = $this->getExtendedInfos($aRecords['items']);
		return $aRecords;
	}

	/**
	 * Get the dvd movie/serie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getDvdOrBluray($sType = 'all', $iLimit = 10, $iOffset = 0) {

		$aRecords = $this->modelRecord->getDvdOrBluray($sType, $iLimit, $iOffset);
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

			if ($oRecord->get_title() == '') { $oRecord->set_title('N.C.'); }

			$sBase = $this->getTypeForUrl($oRecord->get_type());
			$aRecords[$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'type' => 'affiche'));
			$aRecords[$iKey]->url = $this->url->getUrl('fiche-detail', array('id' => $oRecord->get_id(), 'title' => $this->url->encodeToUrl($oRecord->get_title()), 'base' => $sBase));
		}

		return $aRecords;
	}
}

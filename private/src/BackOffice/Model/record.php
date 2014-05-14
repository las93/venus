<?php

/**
 * Model to record
 *
 * @category  	src
 * @package   	src\BackOffice\Model
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\BackOffice\Model;

use \Venus\core\Model as Model;

/**
 * Model to record
 *
 * @category  	src
 * @package   	src\BackOffice\Model
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class record extends Model {

	/**
	 * Get actors for a record
	 *
	 * @access public
	 * @param  string $sTitle title
	 * @return array
	 */

	public function isRecordByTitleExists($sTitle) {

		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName)
					   ->where(['title' => $sTitle])
					   ->limit(1)
					   ->load();

		if (isset($result[0])) { return $result[0]; }
		else { return false; }
	}

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @param  string $sTitle title
	 * @return array
	 */

	public function getRecordByTitle($sTitle) {

		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName)
					   ->where(
					   			$this->where->whereLike('title', '%'.$sTitle.'%')
					   )
					   ->orderBy(['title'])
					   ->limit(1000)
					   ->load();

		return $result;
	}

	/**
	 * return list of persons
	 *
	 * @access public
	 * @param  string $sSearch
	 * @return object
	 */

	public function getRecordForAutocomplete($sSearch) {

		$aResults = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName)
					   ->where(
					   		$this->where->whereLike('title', $sSearch)
					   )
					   ->orderBy(['title'])
					   ->load();

		return $aResults;
	}

	/**
	 * Get record who alias is ok
	 *
	 * @access public
	 * @param  string $sAlias alias
	 * @return array
	 */

	public function getRecordByAlias($sAlias) {

		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName)
					   ->where(
							$this->where->whereEqual("title", $sAlias)
					   )
					   ->orderBy(['title'])
					   ->limit(1000)
					   ->load();

		return $result;
	}
}

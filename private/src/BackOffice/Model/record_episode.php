<?php

/**
 * Model to record_episode
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
use \Venus\lib\Orm\Where as Where;

/**
 * Model to record_episode
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

class record_episode extends Model {

	/**
	 * Get realisators for a record
	 *
	 * @access public
	 * @param  int $iIdPerson id_person
	 * @param  int $iIdRecord id_record
	 * @return array
	 */
	
	public function isRecordEpisodeExists($iIdRecord, $iSeason, $iEpisode) {
	
		$oWhere = new Where;
	
		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName)
					   ->where(
							   $oWhere->whereEqual('id_record', $iIdRecord)
							   		  ->andWhereEqual('season', $iSeason)
							   		  ->andWhereEqual('episode', $iEpisode)
					   )
					   ->limit(1)
					   ->load();
	
		if (isset($result[0])) { return $result[0]; }
		else { return false; }
	}
}

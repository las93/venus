<?php

/**
 * Model to record_episode
 *
 * @category  	src
 * @package   	src\FrontOffice\Model
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\FrontOffice\Model;

use \Venus\core\Model as Model;

/**
 * Model to record_episode
 *
 * @category  	src
 * @package   	src\FrontOffice\Model
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
	 * Get critics
	 *
	 * @access public
	 * @param  integer $iIdRecord id type
	 * @return array
	 */

	public function getMaxSeasonByRecord($iIdRecord) {

		$aResultForMax = $this->orm
					   		  ->select(array('season'))
					   		  ->from($this->_sTableName)
					   		  ->where($this->where->whereEqual('id_record', $iIdRecord))
					   		  ->orderBy(array('season DESC'))
					   		  ->limit(1)
					   		  ->load();

		return $aResultForMax[0]->get_season();
	}
	
	/**
	 * Get critics
	 *
	 * @access public
	 * @param  integer $iIdRecord id type
	 * @param  integer $iSeason season
	 * @return array
	 */
	
	public function getEpisodeBySeasonByRecord($iIdRecord, $iSeason) {
	
		$this->where->flush();
		  
		$aResultForMax = $this->orm
							  ->select(array('id_record'))
							  ->from($this->_sTableName)
							  ->where(
									$this->where
										 ->whereEqual('id_record', $iIdRecord)
										 ->whereEqual('season', $iSeason)
							  )
							  ->load();

		return count($aResultForMax);
	}
	
	/**
	 * Get critics
	 *
	 * @access public
	 * @param  integer $iIdRecord id type
	 * @param  integer $iSeason season
	 * @return array
	 */
	
	public function getAllEpisodesBySeasonByRecord($iIdRecord, $iSeason) {

		$aResultForMax = $this->orm
							  ->select(array('*'))
							  ->from($this->_sTableName)
							  ->where(
									   $this->where
											->whereEqual('id_record', $iIdRecord)
											->whereEqual('season', $iSeason)
							  )
							  ->orderBy(['episode'])
							  ->load();

		return $aResultForMax;
	}
}

<?php

/**
 * Model to person
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

namespace Venus\src\WebSite\Model;

use \Venus\core\Model as Model;
use \Venus\lib\Orm\Where as Where;

/**
 * Model to person
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

class person extends Model {

	/**
	 * Get the record by Word
	 *
	 * @access public
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @param  string $sFirstLetter
	 * @return array
	 */

  	public function getActorsList($iLimit = 10, $iOffset = 0, $sFirstLetter = null) {

	    $oWhere = new Where;
	    $result = array();

	    $result['items'] = $this->orm
	                   			->select(array('SQL_CALC_FOUND_ROWS', '*'))
	                   			->from($this->_sTableName);

	    if ($sFirstLetter !== null) {  $this->orm->where($this->where->whereLikeStartBy('firstname', $sFirstLetter)); }

	    $result['items'] = $this->orm
	    						->orderBy(['firstname', 'name'])
	                   			->limit($iLimit, $iOffset)
	                   			->load();

	    $result['count'] = $this->orm
	                 ->select(array('FOUND_ROWS()'))
	                ->load();

	    $result['pages'] = floor($result['count'] / $iLimit);

	    if (isset($result)) { return $result; }
	    else { return array(); }
  	}

	/**
	 * Get actors for a record
	 *
	 * @access public
	 * @param  integer $iIdPerson id_person
	 * @return array
	 */

	public function getJobs($iIdPerson) {

		$aJoin = [
					[
						'type' => 'left',
						'table' => 'record_has_actor',
						'as' => 'rha',
						'left_field' => 'p.id',
						'right_field' => 'rha.id_person'
					],
					[
						'type' => 'left',
						'table' => 'record_has_creator',
						'as' => 'rhc',
						'left_field' => 'p.id',
						'right_field' => 'rhc.id_person'
					],
					[
						'type' => 'left',
						'table' => 'record_has_distributor',
						'as' => 'rhd',
						'left_field' => 'p.id',
						'right_field' => 'rhd.id_person'
					],
					[
						'type' => 'left',
						'table' => 'record_has_productor',
						'as' => 'rhp',
						'left_field' => 'p.id',
						'right_field' => 'rhp.id_person'
					],
					[
						'type' => 'left',
						'table' => 'record_has_realisator',
						'as' => 'rhr',
						'left_field' => 'p.id',
						'right_field' => 'rhr.id_person'
					],
					[
						'type' => 'left',
						'table' => 'record_has_screenwriter',
						'as' => 'rhs',
						'left_field' => 'p.id',
						'right_field' => 'rhs.id_person'
					],
					[
						'type' => 'left',
						'table' => 'record_has_technical_team',
						'as' => 'rhtt',
						'left_field' => 'p.id',
						'right_field' => 'rhtt.id_person'
					]
		];

		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName, 'p')
					   ->join($aJoin)
					   ->where(['p.id' => $iIdPerson])
					   ->load();

		$aJobs = array();

		if ($result[0]->record_has_actor->get_id_record()) { $aJobs[] = 'actor'; }
		if ($result[0]->record_has_creator->get_id_record()) { $aJobs[] = 'creator'; }
		if ($result[0]->record_has_distributor->get_id_record()) { $aJobs[] = 'distributor'; }
		if ($result[0]->record_has_productor->get_id_record()) { $aJobs[] = 'productor'; }
		if ($result[0]->record_has_realisator->get_id_record()) { $aJobs[] = 'realisator'; }
		if ($result[0]->record_has_screenwriter->get_id_record()) { $aJobs[] = 'screenwriter'; }
		if ($result[0]->record_has_technical_team->get_id_record()) { $aJobs[] = 'technical_team'; }

		return $aJobs;
	}

	/**
	 * Get the record by Word
	 *
	 * @access public
	 * @param  string $sWord word
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getLikeWord($sWord, $iLimit = 10, $iOffset = 0) {

		$result = array();

		$result['items'] = $this->orm
					   			->select(array('SQL_CALC_FOUND_ROWS', 'r.*'))
					   			->from($this->_sTableName, 'r')
					   			->where($this->where->whereSoundex('CONCAT(firstname, \' \', name)', $sWord))
					   			->limit($iLimit, $iOffset)
					   			->load();

		$result['count'] = $this->orm
				  				->select(array('FOUND_ROWS()'))
				  				->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}
}

<?php

/**
 * Model to channel
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
 * Model to channel
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

class channel extends Model {

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getChannelByGroup($sType = 'tnt') {

		$result = array();

		if ($sType === 'classique') { $oConstraint = $this->where->whereInf('id', 7); }
		else if ($sType === 'tnt') { $oConstraint = $this->where->whereInf('id', 6000); }
		else { $oConstraint = $this->where->whereSup('id', 6000); }

		$result['items'] = $this->orm
					   			->select(array('*'))
					   			->from($this->_sTableName, 'r')
					   			->where($oConstraint)
					  			 ->load();

		$result['count'] = $this->orm
								->select(array('FOUND_ROWS()'))
								->load();

		$result['pages'] = floor($result['count'] / 10);

		return $result;
	}

	/**
	 * Get program on grid by channel
	 *
	 * @access public
	 * @param  integer $iIdRecord id_record
	 * @return array
	 */

	public function getChannelDiffusionOfRecordId($iIdRecord) {

		$aJoin = [
					[
						'type' => 'right',
						'table' => 'program_on_grid',
						'as' => 'pog',
						'left_field' => 'pog.id_channel',
						'right_field' => 'c.id'
					],
		];

		$oWhere = new Where;

		$aResult = $this->orm
						->select(array('c.*'))
						->from($this->_sTableName, 'c')
						->join($aJoin)
						->where(
							$oWhere->whereEqual('id_record', $iIdRecord)
								   ->andWhereSup('start', 'NOW()')
						)
						->groupBy(['id_channel ASC'])
						->orderBy(['start ASC'])
						->load();

		return $aResult;
	}

	/**
	 * Get program on grid by channel
	 *
	 * @access public
	 * @param  integer $iIdProgram id_program
	 * @return array
	 */

	public function getChannelDiffusionOfProgramId($iIdProgram) {

		$aJoin = [
					[
						'type' => 'right',
						'table' => 'program_on_grid',
						'as' => 'pog',
						'left_field' => 'pog.id_channel',
						'right_field' => 'c.id'
					],
		];

		$oWhere = new Where;

		$aResult = $this->orm
						->select(array('c.*'))
						->from($this->_sTableName, 'c')
						->join($aJoin)
						->where(
							$oWhere->whereEqual('id_program', $iIdProgram)
								   ->andWhereSup('start', 'NOW()')
						)
						->groupBy(['id_channel ASC'])
						->orderBy(['start ASC'])
						->load();

		return $aResult;
	}
}

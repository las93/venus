<?php

/**
 * Model to program_on_grid
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
 * Model to program_on_grid
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

class program_on_grid extends Model {

	/**
	 * Get program on grid by channel
	 *
	 * @access public
	 * @param  integer $iIdPerson id_person
	 * @param  int $iMinMinutes minimum in minutes of program's time
	 * @return array
	 */

	public function getProgramAfterTime($sDateMin, $iIdChannel, $iMinMinutes = 600) {

		$aJoin = [
					[
						'type' => 'right',
						'table' => 'program',
						'as' => 'p',
						'left_field' => 'pog.id_program',
						'right_field' => 'p.id'
					]
		];

		$oWhere = new Where;

		$aResult = $this->orm
					    ->select(array('*'))
					    ->from($this->_sTableName, 'pog')
					    ->join($aJoin)
					    ->where(
					    	$oWhere->whereSup('start', $sDateMin)
					   			   ->andWhereEqual('id_channel', $iIdChannel)
					    		   ->andWhereSup('TIMESTAMPDIFF(SECOND, start, end)', $iMinMinutes)
					    )
					    ->orderBy(['start ASC'])
					    ->limit(2)
					    ->load();

		return $aResult;
	}

	/**
	 * Get program on grid by channel
	 *
	 * @access public
	 * @param  integer $iIdPerson id_person
	 * @return array
	 */

	public function getSeriesThisDay($sType = 'serie') {

		$aJoin = [
					[
						'type' => 'right',
						'table' => 'record',
						'as' => 'r',
						'left_field' => 'pog.id_record',
						'right_field' => 'r.id'
					],
					[
						'type' => 'right',
						'table' => 'channel',
						'as' => 'c',
						'left_field' => 'pog.id_channel',
						'right_field' => 'c.id'
					],
		];

		$oWhere = new Where;

		$aResult = $this->orm
						->select(array('*'))
						->from($this->_sTableName, 'pog')
						->join($aJoin)
						->where(
								$oWhere->whereSup('end', 'NOW()')
									   ->andWhereSup('start', 'NOW()')
									   ->andWhereEqual('type', $sType)
						)
						->orderBy(['start ASC'])
						->limit(10)
						->load();

		return $aResult;
	}

	/**
	 * Get program on grid by channel
	 *
	 * @access public
	 * @param  integer $iIdRecord id_record
	 * @return array
	 */

	public function getDiffusionOfRecordId($iIdRecord, $iLimit = 2) {

		$aJoin = [
					[
						'type' => 'right',
						'table' => 'channel',
						'as' => 'c',
						'left_field' => 'pog.id_channel',
						'right_field' => 'c.id'
					],
		];

		$oWhere = new Where;

		$aResult = $this->orm
						->select(array('*'))
						->from($this->_sTableName, 'pog')
						->join($aJoin)
						->where(
							$oWhere->whereEqual('id_record', $iIdRecord)
								   ->andWhereSup('start', 'NOW()')
						)
						->orderBy(['start ASC'])
						->limit($iLimit)
						->load();

		return $aResult;
	}

	/**
	 * Get program on grid by channel
	 *
	 * @access public
	 * @param  integer $iIdChannel id_channel
	 * @param  integer $iIdRecord id_record
	 * @return array
	 */

	public function getDiffusionOfChannelId($iIdChannel, $iIdRecord) {

		$aJoin = [
					[
						'type' => 'right',
						'table' => 'channel',
						'as' => 'c',
						'left_field' => 'pog.id_channel',
						'right_field' => 'c.id'
					],
		];

		$oWhere = new Where;

		$aResult = $this->orm
						->select(array('*'))
						->from($this->_sTableName, 'pog')
						->join($aJoin)
						->where(
								$oWhere->whereEqual('id_channel', $iIdChannel)
									   ->andWhereSup('start', 'NOW()')
									   ->andWhereEqual('id_record', $iIdRecord)
						)
						->orderBy(['start ASC'])
						->groupBy(['pog.id'])
						->load();

		return $aResult;
	}

	/**
	 * Get program on grid by channel
	 *
	 * @access public
	 * @param  integer $iIdChannel id_channel
	 * @param  integer $iIdProgram id_program
	 * @return array
	 */

	public function getDiffusionOfChannelIdForProgramId($iIdChannel, $iIdProgram) {

		$aJoin = [
					[
						'type' => 'right',
						'table' => 'channel',
						'as' => 'c',
						'left_field' => 'pog.id_channel',
						'right_field' => 'c.id'
					],
		];

		$oWhere = new Where;

		$aResult = $this->orm
						->select(array('*'))
						->from($this->_sTableName, 'pog')
						->join($aJoin)
						->where(
								$oWhere->whereEqual('id_channel', $iIdChannel)
									   ->andWhereSup('start', 'NOW()')
									   ->andWhereEqual('id_program', $iIdProgram)
						)
						->orderBy(['start ASC'])
						->groupBy(['pog.id'])
						->load();

		return $aResult;
	}
}

<?php

/**
 * Model to program
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
 * Model to program
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

class program extends Model {

	/**
	 * Get the best movie/serie record
	 *
	 * @access public
	 * @param  string $sType type
	 * @param  integer $iLimit limit
	 * @param  integer $iOffset offset
	 * @return array
	 */

	public function getTopProgram($iLimit = 10, $iOffset = 0) {

		$result = array();

		$aJoin = [
			[
				'type' => 'right',
				'table' => 'program_on_grid',
				'as' => 'pog',
				'left_field' => 'pog.id_program',
				'right_field' => 'p.id'
			]
		];

		$oWhere = new Where;

		$result['items'] = $this->orm
								->select(array('SQL_CALC_FOUND_ROWS', 'p.*', 'IF(pog.id_program IS NULL, 0, count(*)) AS num'))
								->from($this->_sTableName, 'p')
								->where(
									$this->where
										 ->whereInf('id_channel', 13)
										 ->andWhereEqual('id_record', 0)
								)
								->join($aJoin)
								->groupBy(['p.id'])
								->orderBy(['num DESC'])
								->limit($iLimit, $iOffset)
								->load();

		$result['count'] = $this->orm
								->select(array('FOUND_ROWS()'))
								->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}
}

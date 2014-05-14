<?php

/**
 * Model to comment
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

use \Venus\lib\Entity as LibEntity;
use \Venus\core\Model as Model;

/**
 * Model to comment
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

class comment extends Model {

	/**
	 * Get Lasts news
	 *
	 * @access public
	 * @param  integer $iIdType id type
	 * @param  string $sType type of comment
	 * @param  integer $iLimit limit
	 * @param  integer $iOffSet offset
	 * @return array
	 */

	public function getCommentByArticle($iIdType, $sType = 'article', $iLimit = 20, $iOffSet = 0) {

		$aJoin = [
					[
						'type' => 'rigth',
						'table' => 'user',
						'as' => 'u',
						'left_field' => 'u.id',
						'right_field' => 'c.id_user'
					]
		];

		$result = $this->orm
					  ->select(array('SQL_CALC_FOUND_ROWS', '*'))
					  ->from($this->_sTableName, 'c')
					  ->join($aJoin)
					  ->where(
					  		$this->where->whereEqual('c.type', $sType)
					  			   ->andWhereEqual('c.id_type', $iIdType)
					  )
					  ->orderBy(array('c.'.LibEntity::getPrimaryKeyName($this->entity).' DESC'))
					  ->limit($iLimit, $iOffSet)
					  ->load();

		if (!isset($result[0])) { $result[0] = new \stdClass(); }

		$result[0]->count = $this->orm
				  ->select(array('FOUND_ROWS()'))
				  ->load();

		$result[0]->pages = floor($result[0]->count / $iLimit);

		if (isset($result)) { return $result; }
		else { return array(); }
	}

}

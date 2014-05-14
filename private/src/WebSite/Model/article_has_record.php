<?php

/**
 * Model to article_has_record
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

/**
 * Model to article_has_record
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

class article_has_record extends Model {

	/**
	 * Get actors for a record
	 *
	 * @access public
	 * @param  integer $iIdArticle id_record
	 * @return array
	 */
	
	public function getRecordByArticleId($iIdArticle) {
	
		$aJoin = [
					[
						'type' => 'rigth',
						'table' => 'record',
						'as' => 'r',
						'left_field' => 'r.id',
						'right_field' => 'ahr.id_record'
					]
		];
	
		$result = $this->orm
					   ->select(array('r.*'))
					   ->from($this->_sTableName, 'ahr')
					   ->join($aJoin)
					   ->where(['id_article' => $iIdArticle])
					   ->load();
	
		return $result;
	}
}

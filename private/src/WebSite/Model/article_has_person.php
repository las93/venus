<?php

/**
 * Model to article_has_person
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
 * Model to article_has_person
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

class article_has_person extends Model {

	/**
	 * Get actors for a record
	 *
	 * @access public
	 * @param  integer $iIdArticle id_record
	 * @return array
	 */
	
	public function getPersonByArticleId($iIdArticle) {
	
		$aJoin = [
					[
						'type' => 'rigth',
						'table' => 'person',
						'as' => 'p',
						'left_field' => 'p.id',
						'right_field' => 'ahp.id_person'
					]
		];
	
		$result = $this->orm
					   ->select(array('p.*'))
					   ->from($this->_sTableName, 'ahp')
					   ->join($aJoin)
					   ->where(['id_article' => $iIdArticle])
					   ->load();
	
		return $result;
	}
}

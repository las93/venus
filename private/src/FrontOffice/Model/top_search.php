<?php

/**
 * Model to top_search
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
 * Model to top_search
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

class top_search extends Model {

  /**
   * Get the best movie top_search
   *
   * @access public
   * @param  integer $iLimit limit
   * @param  integer $iOffset offset
   * @return array
   */

  public function getTop($iLimit = 5, $iOffset = 0) {

    $result = $this->orm
             ->select(array('SQL_CALC_FOUND_ROWS', 'r.*', 'count(*) AS num'))
             ->from($this->_sTableName, 'r')
             ->groupBy(['word'])
             ->orderBy(['num DESC'])
             ->limit($iLimit, $iOffset)
             ->load();

    return $result;
  }
}

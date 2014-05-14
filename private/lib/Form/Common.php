<?php

/**
 * The common part of each element in a form
 *
 * @category  	lib
 * @package		lib\Form
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\lib\Form;

/**
 * The common part of each element in a form
 *
 * @category  	lib
 * @package		lib\Form
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

abstract class Common {

	/**
	 * the name of element
	 *
	 * @access private
	 * @var    string
	 */

	private $_sName = null;

	/**
	 * get the name
	 *
	 * @access public
	 * @return string
	 */

	public function getName() {

		return $this->_sName;
	}

	/**
	 * get the name
	 *
	 * @access public
	 * @param  string $sName name;
	 * @return object
	 */

	public function setName($sName) {

		$this->_sName = $sName;
		return $this;
	}

	/**
	 * get the <html>
	 *
	 * @access public
	 * @return string
	 */

	abstract public function fetch();
}

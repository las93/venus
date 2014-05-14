<?php

/**
 * Manage Form
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
 * This class manage the Form
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

class Select extends Common {

	/**
	 * the name of element
	 *
	 * @access private
	 * @var    string
	 */

	private $_aOptions = null;

	/**
	 * constructor that it increment (static) for all use
	 *
	 * @access public
	 * @param  string $sName name
	 * @param  array $aOptions options
	 * @return \Venus\lib\Form\Input
	 */

	public function __construct($sName, $aOptions) {

		$this->setName($sName);
		$this->setOptions($aOptions);
	}

	/**
	 * get the Options
	 *
	 * @access public
	 * @return array
	 */

	public function getOptions() {

		return $this->_aOptions;
	}

	/**
	 * set the Options
	 *
	 * @access public
	 * @param  array $aOptions Options of input;
	 * @return object
	 */

	public function setOptions(array $aOptions) {

		$this->_aOptions = $aOptions;
		return $this;
	}


	/**
	 * get the <html>
	 *
	 * @access public
	 * @return string
	 */

	public function fetch() {

		$sContent = '<select name="'.$this->getName().'">';

		foreach ($this->getOptions() as $sKey => $sValue) {

			$sContent .= '<option value="'.$sKey.'">'.$sValue.'</option>';
		}

		$sContent .= '</select> ';

		return $sContent;
	}
}

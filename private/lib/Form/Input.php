<?php

/**
 * Manage Form
 *
 * @category  	lib
 * @package		lib\Form
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

namespace Venus\lib\Form;

/**
 * This class manage the Form
 *
 * @category  	lib
 * @package		lib\Form
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

class Input extends Common {

	/**
	 * the name of element
	 *
	 * @access private
	 * @var    string
	 */

	private $_sType = null;

	/**
	 * constructor that it increment (static) for all use
	 *
	 * @access public
	 * @param  string $sName name
	 * @param  string $sType type of input
	 * @return \Venus\lib\Form\Input
	 */

	public function __construct($sName, $sType) {

		$this->setName($sName);
		$this->setType($sType);
	}

	/**
	 * get the type
	 *
	 * @access public
	 * @return string
	 */

	public function getType() {

		return $this->_sType;
	}

	/**
	 * set the type
	 *
	 * @access public
	 * @param  string $sType type of input;
	 * @return object
	 */

	public function setType($sType) {

		$this->_sType = $sType;
		return $this;
	}

	/**
	 * if the button is clicked
	 *
	 * @access public
	 * @param  string $sType type of input;
	 * @return object
	 */

	public function isClicked($sType) {

		if ($this->getType() === 'submit' || $this->getType() === 'button') {

			if (isset($_POST[$this->getName()])) { return true; }
		}

		return false;
	}

	/**
	 * get the <html>
	 *
	 * @access public
	 * @return string
	 */

	public function fetch() {

		$sContent = '';

		if ($this->getType() === 'text' || $this->getType() === 'password') {

			$sContent .= $this->getName().' ';
		}

		$sContent .= '<input type="'.$this->getType().'" name="'.$this->getName().'"/>';

		return $sContent;
	}
}

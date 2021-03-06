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

class Select extends Common {

	/**
	 * the name of element
	 *
	 * @access private
	 * @var    string
	 */

	private $_aOptions = null;

	/**
	 * the label of element
	 *
	 * @access private
	 * @var    string
	 */
	
	private $_sLabel = null;
	
	/**
	 * the value of element
	 *
	 * @access private
	 * @var    string
	 */
	
	private $_sValue = null;
	
	/**
	 * constructor that it increment (static) for all use
	 *
	 * @access public
	 * @param  string $sName name
	 * @param  array $aOptions options
	 * @param  string $sLabel label of input
	 * @param  string $sValue value of input
	 * @return \Venus\lib\Form\Input
	 */

	public function __construct($sName, $aOptions, $sLabel = null, $sValue = null) {

		$this->setName($sName);
		$this->setOptions($aOptions);
		$this->setValue($sValue);
		$this->setLabel($sLabel); 
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
	 * get the Value
	 *
	 * @access public
	 * @return string
	 */
	
	public function getValue() {
	
		return $this->_sValue;
	}
	
	/**
	 * set the Value
	 *
	 * @access public
	 * @param  string $sValue Value of input;
	 * @return \Venus\lib\Form\Input
	 */
	
	public function setValue($sValue) {
	
		$this->_sValue = $sValue;
		return $this;
	}
	
	/**
	 * get the Label
	 *
	 * @access public
	 * @return string
	 */
	
	public function getLabel() {
	
		return $this->_sLabel;
	}
	
	/**
	 * set the Label
	 *
	 * @access public
	 * @param  string $sLabel Label of input;
	 * @return \Venus\lib\Form\Input
	 */
	
	public function setLabel($sLabel) {
	
		$this->_sLabel = $sLabel;
		return $this;
	}

	/**
	 * get the <html>
	 *
	 * @access public
	 * @return string
	 */

	public function fetch() {

		$sContent = '';
		
		if ($this->getLabel() !== null) { $sContent .= '<label>'.$this->getLabel().'</label> '; }
		
		$sContent .= '<select name="'.$this->getName().'">';

		foreach ($this->getOptions() as $sKey => $sValue) {

			$sContent .= '<option value="'.$sKey.'"';
			
			if ($this->getValue() == $sKey) { $sContent .= ' selected="selected"'; }
			
			$sContent .= '>'.$sValue.'</option>';
		}

		$sContent .= '</select> ';

		return $sContent;
	}
}

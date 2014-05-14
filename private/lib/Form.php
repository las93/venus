<?php

/**
 * Manage Form
 *
 * @category  	lib
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 *
 * @tutorial    == in the controller:
 *
 * 				$this->form
 * 					 ->add('task', 'text')
 *					 ->add('dueDate', 'date')
 *					 ->add('save', 'submit');
 *
 *				$this->view
 *					 ->assign('form', $this->form->getForm())
 *					 ->display();
 *
 *				in the template:
 *
 *				{$form}
 *
 *				== if you want test if the form is validated, you could do that:
 *
 *				if ($this->form->isValid()) { ... } // after the form definition
 *
 *				== check if the button is clicked:
 *
 *				if ($this->form->get('save')->isClicked()) { ... }
 */

namespace Venus\lib;

use \Venus\lib\Form\Input as Input;
use \Venus\lib\Form\Select as Select;

/**
 * This class manage the Form
 *
 * @category  	lib
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class Form {

	/**
	 * Elements of the form
	 *
	 *  @access private
	 *  @var    array
	 */

	private $_aElement = array();

	/**
	 * Increment for form
	 *
	 *  @access private
	 *  @var    int
	 */

	private static $_iFormIncrement = 0;

	/**
	 * number of form
	 *
	 *  @access private
	 *  @var    int
	 */

	private $_iFormNumber = 0;

	/**
	 * constructor that it increment (static) for all use
	 *
	 * @access public
	 * @return \Venus\lib\Form
	 */

	public function __construct() {

		self::$_iFormIncrement++;
		$this->_iFormNumber = self::$_iFormIncrement;
	}

	/**
	 * add an element in the form
	 *
	 * @access public
	 * @param  string $sName name
	 * @param  string $sType type of form
	 * @return \Venus\lib\Form
	 */

	public function add($sName, $sType) {

		if ($sType === 'text' || $sType === 'submit' || $sType === 'password') {

			$this->_aElement[$sName] = new Input($sName, $sType);
		}
		else if ($sType === 'date') {

			$aDay = array();

			for ($i = 1 ; $i <= 31 ; $i++) {

				if ($i < 10) { $aDay['0'.$i] = '0'.$i; }
				else { $aDay[$i] = $i; }
			}

			$this->_aElement[$sName.'_day'] = new Select($sName, $aDay);

			$aMonth = array(
				'01' => 'Jan',
				'02' => 'Feb',
				'03' => 'Mar',
				'04' => 'Apr',
				'05' => 'May',
				'06' => 'Jun',
				'07' => 'Jui',
				'08' => 'Aug',
				'09' => 'Sep',
				'10' => 'Oct',
				'11' => 'Nov',
				'12' => 'Dec',
			);

			$this->_aElement[$sName.'_month'] = new Select($sName, $aMonth);

			$aYear = array();

			for ($i = 1900 ; $i <= 2013 ; $i++) {

				$aYear[$i] = $i;
			}

			$this->_aElement[$sName.'_year'] = new Select($sName, $aMonth);
		}

		return $this;
	}

	/**
	 * get global form
	 *
	 * @access public
	 * @return string
	 */

	public function getForm() {

		$sFormContent = '<form name="form'.$this->_iFormNumber.'" method="post"><input type="hidden" value="1" name="validform'.$this->_iFormNumber.'">';

		foreach ($this->_aElement as $sKey => $sValue) {

			$sFormContent .= $sValue->fetch();
		}

		$sFormContent .= '</form>';

		return $sFormContent;
	}

	/**
	 * if this form is validate or not
	 *
	 * @access public
	 * @return boolean
	 */

	public function isValid() {

		if (isset($_POST['validform'.$this->_iFormNumber]) && $_POST['validform'.$this->_iFormNumber] == 1) { return true; }
		else { return false; }
	}

	/**
	 * get an element of formular
	 *
	 * @access public
	 * @param  string $sName name
	 * @return object
	 */

	public function get($sName) {

		return $this->_aElement[$sName];
	}
}

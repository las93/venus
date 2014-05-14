<?php

/**
 * Manage Form
 *
 * @category  	lib
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

namespace Venus\lib;

/**
 * This class manage the Form
 *
 * @category  	lib
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

class Mail {

	/**
	 * the recipient of mail
	 * @access private
	 * @var    array
	 */

	private $_aRecipient = array();

	/**
	 * the from of mail
	 * @access private
	 * @var    string
	*/

	private $_sFrom = "no-reply@iscreenway.com";

	/**
	 * the subject of mail
	 * @access private
	 * @var    string
	 */

	private $_sSubject = "nosubject";

	/**
	 * the content of mail
	 * @access private
	 * @var    string
	 */

	private $_sMessage = "";

	/**
	 * the format of mail
	 * @access private
	 * @var    string
	 */

	private $_sFormat = "TXT"; // valeur : TXT ou HTML;

	/**
	 * add a recipient of mail
	 *
	 * @access public private
	 * @param  string $sRecipient
	 */

	public function addRecipient($sRecipient) {

		$this->_aRecipient[] = $sRecipient;
		return $this;
	}

	/**
	 * set the from of mail
	 *
	 * @access public private
	 * @param  string $sFrom
	 */

	public function setFrom($sFrom) {

		$this->_sFrom = $sFrom;
		return $this;
	}

	/**
	 * set the subjet of mail
	 *
	 * @access public private
	 * @param  string $sSubject
	 */

	public function setSubject($sSubject) {

		$this->_sSubject = $sSubject;
		return $this;
	}

	/**
	 * set the message of mail
	 *
	 * @access public private
	 * @param  string $sMessage
	 */

	public function setMessage($sMessage) {

		$this->_sMessage = $sMessage;
		return $this;
	}

	/**
	 * set the format HTML of mail
	 *
	 * @access public private
	 */

	public function setFormatHtml() {

		$this->_sFormat = "HTML";
		return $this;
	}

	/**
	 * set the format HTML of mail
	 *
	 * @access public private
	 */

	public function setFormatText() {

		$this->_sFormat = "TXT";
		return $this;
	}

	/**
	 * send the mail
	 *
	 * @access public private
	 */

	public function send() {

		$sHeaders = 'From: ' . $this->_sFrom . "\r\n";

		if ( $this->_sFormat == "HTML") {

			$sHeaders .= 'MIME-Version: 1.0' . "\r\n";
			$sHeaders .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		}
		return mail(implode(',' , $this->_aRecipient), $this->_sSubject , $this->_sMessage , $sHeaders);
	}
}

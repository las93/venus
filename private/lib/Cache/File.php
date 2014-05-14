<?php

/**
 * Manage Cache by file
 *
 * @category  	lib
 * @package		lib\Cache
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\lib\Cache;

/**
 * This class manage the Cache by file
 *
 * @category  	lib
 * @package		lib\Cache
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class File {

	/**
	 * var containe this folder of cache
	 *
	 * @access private
	 * @var    string
	 */

	private $_sFolder = '';

	/**
	 * constructor
	 *
	 * @access public
	 * @return \Venus\lib\Cache\File
	 */

	public function __construct() {

		//$this->_sFolder = str_replace(DIRECTORY_SEPARATOR.'private'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'Cache', '', __DIR__).DIRECTORY_SEPARATOR.
		//	"data".DIRECTORY_SEPARATOR."cache".DIRECTORY_SEPARATOR;
		$this->_sFolder = DIRECTORY_SEPARATOR.'var'.DIRECTORY_SEPARATOR.'www'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.PORTAIL.DIRECTORY_SEPARATOR;
	}

	/**
	 * set a value
	 *
	 * @access public
	 * @param  string $sName name of the session
	 * @param  mixed $mValue value of this sesion var
	 * @return \Venus\lib\Cache\File
	 */

	public function set($sName, $mValue) {

		file_put_contents($this->_sFolder.$this->_getSubDirectory($sName).md5($sName).'.fil.cac', serialize($mValue));
		return $this;
	}

	/**
	 * get a value
	 *
	 * @access public
	 * @param  string $sName name of the session
	 * @param  int $iTimeout expiration of cache
	 * @return mixed
	 */

	public function get($sName, $iTimeout = 0) {

		if ($iTimeout > 0 && file_exists($this->_sFolder.$this->_getSubDirectory($sName).md5($sName).'.fil.cac')
			&& time() - filemtime($this->_sFolder.$this->_getSubDirectory($sName).md5($sName).'.fil.cac') > $iTimeout) {

			unlink($this->_sFolder.$this->_getSubDirectory($sName).md5($sName).'.fil.cac');
		}

		if (file_exists($this->_sFolder.$this->_getSubDirectory($sName).md5($sName).'.fil.cac')) {

			return unserialize(file_get_contents($this->_sFolder.$this->_getSubDirectory($sName).md5($sName).'.fil.cac'));
		}
		else {

			return false;
		}
	}

	/**
	 * delete a value
	 *
	 * @access public
	 * @param  string $sName name of the session
	 * @return mixed
	 */

	public function delete($sName) {

		return unlink($this->_sFolder.$this->_getSubDirectory($sName).md5($sName).'.fil.cac');
	}

	/**
	 *
	 *
	 * @access public
	 * @param  string $sName name of the session
	 * @return mixed
	 */

	private function _getSubDirectory($sName) {

		if (!file_exists($this->_sFolder.substr(md5($sName), 0, 2).DIRECTORY_SEPARATOR.substr(md5($sName), 2, 2))) {

			mkdir($this->_sFolder.substr(md5($sName), 0, 2).DIRECTORY_SEPARATOR.substr(md5($sName), 2, 2), 0777, true);
		}

		return substr(md5($sName), 0, 2).DIRECTORY_SEPARATOR.substr(md5($sName), 2, 2).DIRECTORY_SEPARATOR;
	}
}

<?php

/**
 * Entity Manager
 *
 * @category  	core
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

namespace Venus\core;

use \Venus\lib\Entity as LibEntity;

/**
 * Entity Manager
 *
 * @category  	core
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

abstract class Entity {

	/**
	 * name(s) of primary key
	 *
	 * @access private
	 * @var    mixed
	 */

	private $_mPrimaryKeyName;

	/**
	 * name(s) of primary key without mapping
	 *
	 * @access private
	 * @var    mixed
	 */

	private $_mPrimaryKeyNameWithoutMapping;

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->_loadPrimaryKeyName(LibEntity::getPrimaryKeyName($this));
		$this->_loadPrimaryKeyNameWithoutMapping(LibEntity::getPrimaryKeyNameWithoutMapping($this));
	}

	/**
	 * load primary key in the entity
	 *
	 * @access private
	 * @param  mixed $mName name of primary key (array if it's a multiple key)
	 * @return object
	 */

	private function _loadPrimaryKeyName($mName) {

	 	$this->_mPrimaryKeyName = $mName;
	 	return $this;
	}

	/**
	 * load primary key in the entity (without mapping name)
	 *
	 * @access private
	 * @param  mixed $mName name of primary key (array if it's a multiple key)
	 * @return object
	 */

	private function _loadPrimaryKeyNameWithoutMapping($mName) {

	 	$this->_mPrimaryKeyNameWithoutMapping = $mName;
	 	return $this;
	}

	/**
	 * save the entity
	 *
	 * @access public
	 * @return object
	 */

	public function save() {

		$mPrimaryKeyName = $this->_mPrimaryKeyName;

		if ($mPrimaryKeyName === false) {

			throw new Exception('['.__FILE__.' (l.'.__LINE__.'] no primary key on this table!');
		}
		else if (is_string($mPrimaryKeyName)) {

			$sMethodPrimaryKey = 'get_'.$this->$mPrimaryKeyNameWithoutMapping;
			$aPrimaryKey = array($mPrimaryKeyName => $this->$sMethodPrimaryKey());
		}
		else {

			$aPrimaryKey = array();

			foreach($mPrimaryKeyName as $sKey => $sPrimaryKey) {

				$sMethodPrimaryKey = 'get_'.$this->$mPrimaryKeyNameWithoutMapping[$sKey];
				$aPrimaryKey[$sPrimaryKey] = $this->$sMethodPrimaryKey();
			}
		}

		$iResults = $this->orm
			 			 ->update(get_called_class($this))
			 			 ->set($aEntity)
			 			 ->where($aPrimaryKey)
						 ->save();

		return $iResults;
	}

	/**
	 * You could remove this entity
	 *
	 * @access public
	 * @return object
	 */

	public function remove() {

		$aEntityTmp = get_object_vars(LibEntity::getRealEntity($this));
		$aEntity = array();

		foreach ($aEntityTmp as $sKey => $mField) {

			if ($mField !== null) {

				$aEntity[$sKey] = $mField;
			}
		}

		$this->orm->delete(get_called_class($this))
				  ->set($aEntity)
				  ->where($aPrimaryKey)
				  ->save();

		return $this;
	}

	/**
	 * magic method to create dynamically the link in the Entity
	 *
	 * @access public
	 * @param  string $sName
	 * @param  array $aArguments
	 * @return mixed
	 */

	public function __call($sName, $aArguments) {

		if (preg_match('/^get_/', $sName) && property_exists($this, preg_replace('/^get_/', '', $sName))) {

			$sPropertyName = preg_replace('/^get_/', '', $sName);
			return $this->$sPropertyName;
		}
		else if (preg_match('/^set_/', $sName) && property_exists($this, preg_replace('/^set_/', '', $sName))) {

			$sPropertyName = preg_replace('/^set_/', '', $sName);
			return $this->$sPropertyName = $aArguments[0];
		}
	}
}

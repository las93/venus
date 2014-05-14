<?php

/**
 * Manage entities
 *
 * @category  	lib
 * @package   	lib\Entity
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\lib;

/**
 * This class manage the entities
 *
 * @category  	lib
 * @package   	lib\Entity
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class Entity {

	/**
	 * Namespace of your domain
	 *
	 * @var string
	 */

	public static $sEntityNamespace;

	/**
	 * add the namespace
	 *
	 * @access public
	 * @return void
	 */

	public static function setEntityNamespace() {

		self::$sEntityNamespace = '\Venus\\src\\'.PORTAIL.'\Entity\\';
	}

	/**
	 * auto load the domain by a sql return
	 *
	 * exemple :
	 *  	autoLoadDomain('GenericUpdate', array('Generic_Message' => 'OK', 'Generic_Result' => 1), 'Generic');
	 *
	 *  A domain is an container of properties, getters and setters without crud methods (just a container)
	 *
	 *  You could give an object in entry!!!
	 *
	 * @access public
	 * @param  string $sEntity domain that we want load
	 * @param  array $aSql results in array by the sql array('id' => 1, 'title' => 'super');
	 * @param  string $sPrefix prefixe for the sql returns
	 * @return bool
	 *
	 * @deprecated not use actually
	 */

	public static function isEntity($sEntity) {

		self::setEntityNamespace();

		$sEntityName = self::$sEntityNamespace.$sEntity;

		if (!class_exists($sEntityName)) { return false; }
		else { return true; }
	}

	/**
	 * auto load the domain by a sql return
	 *
	 * exemple :
	 *  	autoLoadDomain('GenericUpdate', array('Generic_Message' => 'OK', 'Generic_Result' => 1), 'Generic');
	 *
	 *  A domain is an container of properties, getters and setters without crud methods (just a container)
	 *
	 *  You could give an object in entry!!!
	 *
	 * @access public
	 * @param  string $sEntity domain that we want load
	 * @param  array $aSql results in array by the sql array('id' => 1, 'title' => 'super');
	 * @param  string $sPrefix prefixe for the sql returns
	 * @param  bool $bAddOnStdClass add the parameter when there arent method of entity
	 * @return bool
	 *
	 * @deprecated not use actually
	 */

	public static function autoLoadEntity($sEntity, array $aSql, $sPrefix = '', $bAddOnStdClass = false) {

		if ($sEntity === '') { return; }

		self::setEntityNamespace();

		$sEntityName = self::$sEntityNamespace.$sEntity;

		if (!class_exists($sEntityName)) { return; }

		$oEntityCall = new $sEntityName;
		$oReflectionClass = new \ReflectionClass($sEntityName);
		$oReflectionProperties = $oReflectionClass->getProperties();

		foreach ($oReflectionProperties as $aProperty) {

			if (preg_match('/@map ([a-zA-Z_]+)/', $aProperty->getDocComment(), $aMatch)) {

				$sEntitieRealName = $aMatch[1];
			}
			else {

				$sEntitieRealName = $aProperty->getName();
			}

			if (method_exists($oEntityCall, 'set_'.$aProperty->getName())) {

				if (isset($aSql[$sPrefix.$sEntitieRealName])) {

					$sMethodName = 'set_'.$aProperty->getName();
					$oEntityCall->$sMethodName($aSql[$sPrefix.$sEntitieRealName]);
				}
			}
		}

		if ($bAddOnStdClass === true) {

			foreach ($aSql as $sKey => $asField) {

				if (preg_match('/^\.[^.]+$/', $sKey)) {

					$sParameterName = str_replace('.', '', $sKey);
					$oEntityCall->$sParameterName = $aSql[$sKey];
				}
			}
		}

		return $oEntityCall;
	}

	/**
	 * get all field of entity in array
	 *
	 * @access public
	 * @param  object $oEntityCall domain that we want load
	 * @param  bool $bReturnNotNulOnly if we return the null response
	 * @return array
	 */

	public static function getAllEntity($oEntityCall, $bReturnNotNulOnly = false) {

		self::setEntityNamespace();

		if (!is_object($oEntityCall)) { return array(); }

		$oReflectionClass = new \ReflectionClass(get_class($oEntityCall));
		$oReflectionMethod = $oReflectionClass->getMethods();
		$aFieldsToReturn = array();

		foreach ($oReflectionMethod as $aMethod) {

			if (preg_match('/^get_[a-zA-Z_]+/', $aMethod->getName())) {

				$sMethodsCall = $aMethod->getName();
				$sFieldName = preg_replace('/^get_/', '', $aMethod->getName());

				if ($oEntityCall->$sMethodsCall() !== null || ($oEntityCall->$sMethodsCall() === null
					&& $bReturnNotNulOnly === false)) {

					$aFieldsToReturn[$sFieldName] = $oEntityCall->$sMethodsCall();
				}
			}
		}

		$oReflectionProperties = $oReflectionClass->getProperties();

		foreach ($oEntityCall as $sKey => $aProperty) {

			$aFieldsToReturn[$sKey] = self::getAllEntity($aProperty, $bReturnNotNulOnly);
		}

		return $aFieldsToReturn;
	}

	/**
	 * get a real entity (with all parameters)
	 *
	 * @access public
	 * @param  object $oEntity entity that we want analyze
	 * @return mixed
	 */

	public static function getPrimaryKeyName($oEntity) {

		self::setEntityNamespace();

		$aEntitieSetup = array();

		$oReflectionClass = new \ReflectionClass($oEntity);
		$oProperties   = $oReflectionClass->getProperties();

		foreach ($oProperties as $oProperty) {

		    $sDoc = $oProperty->getDocComment();

		    if (strstr($sDoc, '@primary_key') && preg_match('/@map ([a-zA-Z_]+)/', $sDoc, $aMatch)) {

		    	$aEntitieSetup[] = $aMatch[1];
		    }
		    else if (strstr($sDoc, '@primary_key')) {

		    	$aEntitieSetup[] = $oProperty->getName();
		    }
		}

		if (count($aEntitieSetup) == 0) { return false; }
		else if (count($aEntitieSetup) == 1) { return $aEntitieSetup[0]; }
		else { return $aEntitieSetup; }
	}

	/**
	 * get a real entity (with all parameters)
	 *
	 * @access public
	 * @param  object $oEntity entity that we want analyze
	 * @return mixed
	 */

	public static function getPrimaryKeyNameWithoutMapping($oEntity) {

		self::setEntityNamespace();

		$aEntitieSetup = array();

		$oReflectionClass = new \ReflectionClass($oEntity);
		$oProperties   = $oReflectionClass->getProperties();

		foreach ($oProperties as $oProperty) {

			$sDoc = $oProperty->getDocComment();

			$aEntitieSetup[] = $oProperty->getName();
		}

		if (count($aEntitieSetup) == 0) {
			return false;
		}
		else if (count($aEntitieSetup) == 1) {
			return $aEntitieSetup[0];
		}
		else { return $aEntitieSetup;
		}
	}

	/**
	 * get a real entity (with all parameters)
	 *
	 * @access public
	 * @param  object $oEntity entity that we want analyze
	 * @return array
	 */

	public static function getNoPrimaryKeyFields($oEntity) {

		self::setEntityNamespace();

		$aEntitieSetup = array();

		$oReflectionClass = new \ReflectionClass($oEntity);
		$oProperties   = $oReflectionClass->getProperties();

		foreach ($oProperties as $oProperty) {

		    $sDoc = $oProperty->getDocComment();

		    if (!strstr($sDoc, '@primary_key') && preg_match('/@map ([a-zA-Z_]+)/', $sDoc, $aMatch)) {

		    	$aEntitieSetup[$aMatch[1]] = $oProperty->getValue();
		    }
		    else if (!strstr($sDoc, '@primary_key')) {

		    	$aEntitieSetup[$oProperty->getName()] = $oProperty->getValue();
		    }
		}

		$aEntitieSetup;
	}

	/**
	 * get a real entity (with all parameters)
	 *
	 * @param object $oEntity entity that we want analyze
	 * return
	 */

	public static function getRealEntity($oEntity) {

		self::setEntityNamespace();

		$oEntitieSetup = new \stdClass;

		$oReflectionClass = new \ReflectionClass($oEntity);
		$oProperties   = $oReflectionClass->getProperties();

		foreach ($oProperties as $oProperty) {

		    $sDoc = $oProperty->getDocComment();

		    if (preg_match('/@map ([a-zA-Z_]+)/', $sDoc, $aMatch)) {

		    	$sMethodName = 'get_'.$oProperty->getName();
		    	$oEntitieSetup->$aMatch[1] = $oEntity->$sMethodName();
		    }
		    else {

		    	$sMethodName = 'get_'.$oProperty->getName();
		    	$sPropertyName = $oProperty->getName();
		    	$oEntitieSetup->$sPropertyName = $oEntity->$sMethodName();
		    }
		}

		return $oEntitieSetup;
	}
}

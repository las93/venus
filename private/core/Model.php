<?php

/**
 * Model Manager
 *
 * @category  	core
 * @package   	core\Model
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\core;

use \Venus\lib\Orm as Orm;
use \Venus\lib\Entity as LibEntity;
use \Venus\lib\Orm\Where as Where;

/**
 * Model Manager
 *
 * @category  	core
 * @package   	core\Model
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

abstract class Model extends Mother {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$aClass = explode('\\', get_called_class());
		$sClassName = $aClass[count($aClass) - 1];
		$sNamespaceName = str_replace('\\'.$aClass[count($aClass) - 1], '', get_called_class());

		if (isset($sClassName)) {

			$sNamespaceBaseName = str_replace('\Model', '', $sNamespaceName);
			$defaultEntity = $sNamespaceBaseName.'\Entity\\'.$sClassName;

			$this->_sTableName = $sClassName;

			$this->entity = function() use ($defaultEntity) { return new $defaultEntity; };
			$this->orm = function() { return new Orm; };
			$this->where = function() { return new Where; };
		}
	}

	/**
	 * classic method to find an entity
	 *
	 * @access private
	 * @param  object $oEntityCriteria
	 * @return void
	 */

	public function find($oEntityCriteria) {

		$this->_checkEntity($oEntityCriteria);
		$aEntity = get_object_vars(LibEntity::getRealEntity($oEntityCriteria));

		$sPrimaryKeyName = LibEntity::getPrimaryKeyName($oEntityCriteria);

		$aResults = $this->orm
			 			 ->select(array('*'))
			 			 ->from($this->_sTableName)
			 			 ->where(array($sPrimaryKeyName => $aEntity[$sPrimaryKeyName]))
						 ->load();

		if ($aResults) { return $aResults[0]; }

		return $aResults;
	}

	/**
	 * magic method to create dynamically each methods
	 *
	 * @access public
	 * @param  string $sName
	 * @param  array $aArguments
	 * @return mixed
	 */

	public function __call($sName, $aArguments) {

		/**
		 * @example	$oModel->findOneByid(12);
		 * 			$oModel->findByfirstname('george');
		 *
		 * @example	$oModel->findOneOrderByid();
		 * 			$oModel->findOrderByfirstname();
		 * 			$oModel->findOneOrderByidDesc();
		 * 			$oModel->findOrderByfirstnameDesc();
		 */

        if (preg_match('/^findOneBy([a-zA-Z_]+)$/', $sName, $aMatchs)) {

        	$aResults = $this->orm
        					 ->select(array('*'))
        					 ->from($this->_sTableName)
        					 ->where(array($aMatchs[1] => $aArguments[0]))
        					 ->limit(1)
        					 ->load();

        	if (isset($aResults[0])) { return $aResults[0]; }
        	else { return array(); }
        }
        else if (preg_match('/^findBy([a-zA-Z_]+)$/', $sName, $aMatchs)) {

        	$aResults = $this->orm
        					 ->select(array('*'))
        					 ->from($this->_sTableName)
        					 ->where(array($aMatchs[1] => $aArguments[0]))
        					 ->load();

        	return $aResults;
        }
        else if (preg_match('/^findOneOrderBy([a-zA-Z_]+)$/', $sName, $aMatchs)) {

        	$aMatchs[1] = preg_replace('/^(.+)(Desc)$/', '$1 $2', $aMatchs[1]);
        	$aMatchs[1] = preg_replace('/^(.+)(Asc)$/', '$1 $2', $aMatchs[1]);

        	$aResults = $this->orm
        					 ->select(array('*'))
        					 ->from($this->_sTableName)
        					 ->orderBy(array($aMatchs[1]))
        					 ->limit(1)
        					 ->load();

        	if (isset($aResults[0])) { return $aResults[0]; }
        	else { return array(); }
        }
        else if (preg_match('/^findOrderBy([a-zA-Z_]+)$/', $sName, $aMatchs)) {

        	$aMatchs[1] = preg_replace('/^(.+)(Desc)$/', '$1 $2', $aMatchs[1]);
        	$aMatchs[1] = preg_replace('/^(.+)(Asc)$/', '$1 $2', $aMatchs[1]);

        	$aResults = $this->orm
        					 ->select(array('*'))
        					 ->from($this->_sTableName)
        					 ->orderBy(array($aMatchs[1]))
        					 ->load();

        	return $aResults;
        }
    }


    /**
     * get all line of the tables
     *
     * @access private
     * @return void
     */

    public function findAll() {

    	$aResults = $this->orm
    					 ->select(array('*'))
    					 ->from($this->_sTableName)
    					 ->load();

    	return $aResults;
    }

    /**
     * return an entity that it is found with the arguments
     *
     * @access public
     * @param  array $aArguments
     * @return object
     *
     * @example	$oModel->findOneBy(array('id' => 12);
     */

    public function findOneBy(array $aArguments) {

    	$aResults = $this->orm
    					 ->select(array('*'))
    					 ->from($this->_sTableName)
    					 ->where($aArguments)
    					 ->limit(1)
    					 ->load();

    	if (isset($aResults[0])) { return $aResults[0]; }
    	else { return false; }
    }

    /**
     * return list of entities that they are found with the arguments
     *
     * @access public
     * @param  array $aArguments
     * @return object
     *
     * @example	$oModel->findBy(array('id' => 12);
     */

    public function findBy(array $aArguments) {

    	$aResults = $this->orm
    					 ->select(array('*'))
    					 ->from($this->_sTableName)
    					 ->where($aArguments)
    					 ->load();

    	return $aResults;
    }

    /**
     * return an entity that it is found with the arguments
     *
     * @access public
     * @param  array $aArguments
     * @return object
     *
     * @example	$oModel->findOneBy(array('id' => 12);
     */

    public function findOneOrderBy(array $aArguments) {

    	$aResults = $this->orm
    					 ->select(array('*'))
    					 ->from($this->_sTableName)
    					 ->orderBy($aArguments)
    					 ->limit(1)
    					 ->load();

    	return $aResults[0];
    }

    /**
     * return list of entities that they are found with the arguments
     *
     * @access public
     * @param  array $aArguments
     * @return object
     *
     * @example	$oModel->findOrderBy(array('id DESC');
     */

    public function findOrderBy(array $aArguments) {

    	$aResults = $this->orm
    					 ->select(array('*'))
    					 ->from($this->_sTableName)
    					 ->orderBy($aArguments)
    					 ->load();

    	return $aResults;
    }

	/**
	 * classic method to get a list of entities
	 *
	 * @access private
	 * @param  object $oEntityCriteria
	 * @return void
	 */

	public function get($oEntityCriteria = null) {

		if ($oEntityCriteria !== null) {

			$this->_checkEntity($oEntityCriteria);
			$aEntityTmp = get_object_vars(LibEntity::getRealEntity($oEntityCriteria));
			$aEntity = array();

			foreach ($aEntityTmp as $sKey => $mField) {

				if ($mField !== null) {

					$aEntity[$sKey] = $mField;
				}
			}
		}
		else {

			$aEntity = array();
		}

		$aResults = $this->orm
			 			 ->select(array('*'))
			 			 ->from($this->_sTableName)
			 			 ->where($aEntity)
						 ->load();

		return $aResults;
	}

	/**
	 * classic method to get a list of entities
	 *
	 * @access private
	 * @param  object $oEntityCriteria
	 * @return void
	 */

	public function update($oEntityCriteria) {

		$this->_checkEntity($oEntityCriteria);

		if ($oEntityCriteria !== null) {

			$aEntity = get_object_vars(LibEntity::getRealEntity($oEntityCriteria));
		}
		else {

			$aEntity = array();
		}

		$sPrimaryKeyName = LibEntity::getPrimaryKeyName($oEntityCriteria);

		if (is_array($sPrimaryKeyName)) {

			$aPrimaryKeys = array();

			foreach ($sPrimaryKeyName as $sOne) {

				$aPrimaryKeys[$sOne] = $aEntity[$sOne];
			}

			$aResults = $this->orm
							 ->update($this->_sTableName)
							 ->set($aEntity)
							 ->where($aPrimaryKeys)
							 ->save();
		}
		else {

			$aResults = $this->orm
				 			 ->update($this->_sTableName)
				 			 ->set($aEntity)
				 			 ->where(array($sPrimaryKeyName => $aEntity[$sPrimaryKeyName]))
							 ->save();
		}

		return $aResults;
	}

	/**
	 * classic method to get a list of entities
	 *
	 * @access private
	 * @param  object $oEntityCriteria
	 * @return void
	 */

	public function insert($oEntity) {

		$this->_checkEntity($oEntity);

		$aResults = $this->orm
						 ->insert($this->_sTableName)
						 ->values(LibEntity::getAllEntity($oEntity))
						 ->save();

		return $aResults;
	}

	/**
	 * get last row
	 *
	 * @access private
	 * @return void
	 */

	public function getLastRow() {

		$result = $this->orm
					   ->select(array('*'))
			 		   ->from($this->_sTableName)
			 		   ->orderBy(array(LibEntity::getPrimaryKeyName($this->entity) => 'DESC'))
			 		   ->limit(1)
					   ->load();

		return $result[0];
	}

	/**
	 * save Entity and get it
	 *
	 * @access private
	 * @param  object $oEntity
	 * @return void
	 */

	public function insertAndGet($oEntity) {

		$result = $this->insert($oEntity);
		if ($result) {
			return $this->getLastRow();
		}

		return $result;
	}

	/**
	 * update Entity and get it
	 *
	 * @access private
	 * @param  object $oEntityCriteria
	 * @return void
	 */

	public function updateAndGet($oEntity) {

		$result = $this->update($oEntity);

		if ($result) {
			$aEntity = get_object_vars(LibEntity::getRealEntity($oEntity));
			$pk = LibEntity::getPrimaryKeyName($aEntity);
			$result = $this->orm
					   ->select(array('*'))
			 		   ->from($this->_sTableName)
			 		   ->where(array($pk => $aEntity[$pk]))
					   ->load();
		}

		return $result;
	}

	/**
	 * classic method to get a list of entities
	 *
	 * @access private
	 * @param  object $oEntityCriteria
	 * @return void
	 */

	public function delete($oEntityCriteria) {

		$this->_checkEntity($oEntityCriteria);

		$aEntity = LibEntity::getAllEntity($oEntityCriteria, true);

		$aResults = $this->orm
		 				 ->delete($this->_sTableName)
		 				 ->where($aEntity)
		 				 ->save();
	}

	/**
	 * check if the entity passed is good
	 *
	 * @access private
	 * @param  object $oEntityCriteria
	 * @return void
	 */

	private function _checkEntity($oEntityCriteria) {

		$sClassName = get_called_class();
		$sClassName = str_replace('Model', 'Entity', $sClassName);

		if (!is_object($oEntityCriteria) || !$oEntityCriteria instanceof $sClassName) {

			throw new \Exception('You must passed '.$sClassName.' like Entity!');
		}
	}
}

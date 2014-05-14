<?php

/**
 * Model to person
 *
 * @category  	src
 * @package   	src\BackOffice\Model
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\BackOffice\Model;

use \Venus\core\Model as Model;
use \Venus\lib\Orm\Where as Where;
use \Venus\lib\Db as Db;

/**
 * Model to person
 *
 * @category  	src
 * @package   	src\BackOffice\Model
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class person extends Model {

	/**
	 * Get person by alphabetic order
	 *
	 * @access public
	 * @param  integer $iLimit limit
	 * @return array
	 */

	public function getPersonOrderByName() {

		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName)
					   ->orderBy(array('firstname', 'name'))
					   ->load();

		return $result;
	}


	/**
	 * Get realisators for a record
	 *
	 * @access public
	 * @param  string $sTotalName firstname+name
	 * @return array
	 */

	public function isPersonExists($sTotalName) {

		$result = $this->orm
					   ->select(array('id_person'))
					   ->from('person_alias')
					   ->where(['alias' => $sTotalName])
					   ->limit(1)
					   ->load();

		if (isset($result[0])) {


			$oWhere = new Where;

			$result = $this->orm
						   ->select(array('*'))
						   ->from($this->_sTableName)
					   	   ->where(['id' => $result[0]->get_id_person()])
						   ->limit(1)
						   ->load();

			if (isset($result[0])) { return $result[0]; }
			else { return false; }
		}
		else {

			$aName = explode(' ', trim($sTotalName));

			if (isset($aName[2])) {

				$aName[1] .= ' '.$aName[2];
				unset($aName[2]);
			}

			if (!isset($aName[1])) {

				$aName[0] = '';
				$aName[1] = $aName[0];
			}

			$oWhere = new Where;

			$result = $this->orm
						   ->select(array('*'))
						   ->from($this->_sTableName)
						   ->where(
								$oWhere->whereEqual('firstname', $aName[0])
									   ->andWhereEqual('name', $aName[1])
						   )
						   ->limit(1)
						   ->load();

			if (isset($result[0])) { return $result[0]; }
			else { return false; }
		}
	}

	/**
	 * Get realisators for a record
	 *
	 * @access public
	 * @return array
	 */

	public function getAllVisible() {

		$oWhere = new Where;

		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName)
					   ->where(
					   		$oWhere->whereEqual('visible', 'n')
					   			   ->orWhereEqual('visible', '')
					   )
					   ->orderBy(['firstname', 'name'])
					   ->load();

		return $result;
	}

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @param  string $sName name
	 * @param  string $sFirstName firstname
	 * @return array
	 */

	public function getPersonByCompleteName($sName, $sFirstName) {

		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName)
					   ->where(
							$this->where->whereLike('name', '%'.$sName.'%')
								 ->andWhereLike('firstname', '%'.$sFirstName.'%')
					   )
					   ->orderBy(['firstname', 'name'])
					   ->limit(1000)
					   ->load();

		return $result;
	}

	/**
	 * Get the best movie record
	 *
	 * @access public
	 * @return array
	 */

	public function getAllList() {

		$aResults = Db::connect(DB_CONF)->query('
											SELECT name, firstname, id, visible
											FROM person
											ORDER BY firstname, name'
										)
										->fetchAll(\PDO::FETCH_ASSOC);

		return $aResults;
	}

	/**
	 * Get person who alias is ok
	 *
	 * @access public
	 * @param  string $sAlias alias
	 * @return array
	 */

	public function getPersonByAlias($sAlias) {

		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName)
					   ->where(
							$this->where->whereLike("CONCAT(name, ' ', firstname)", '%'.$sAlias.'%')
					   )
					   ->orderBy(['firstname', 'name'])
					   ->limit(1000)
					   ->load();

		return $result;
	}


	/**
	 * return list of entities that they are found with the arguments
	 * >> Highlight of \Venus\core\Model <<
	 *
	 * @access public
	 * @param  array $aArguments
	 * @return object
	 *
	 * @example	$oModel->findBy(array('id' => 12);
	 */

	public function findBy(array $aArguments) {

		if (count($aArguments) == 2 && isset($aArguments['firstname']) && isset($aArguments['name'])) {

			$aResult = $this->orm
						   	->select(array('id_person'))
						   	->from('person_alias')
						   	->where(['alias' => $aArguments['firstname'].' '.$aArguments['name']])
						   	->limit(1)
						   	->load();

			if (isset($aResult[0])) { $aArguments = array('id' => $aResult[0]->get_id_person()); }
		}

		$aResults = $this->orm
						 ->select(array('*'))
						 ->from($this->_sTableName)
						 ->where($aArguments)
						 ->load();

		return $aResults;
	}

	/**
	 * return list of persons
	 *
	 * @access public
	 * @param  string $sSearch
	 * @return object
	 *
	 * @example	$oModel->findBy(array('id' => 12);
	 */

	public function getPersonForAutocomplete($sSearch) {

		$aResults = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName)
					   ->where(
					   		$this->where->whereLike('firstname', $sSearch)
					   			   		->orWhereLike('name', $sSearch)
					   			   		->orWhereLike('CONCAT(firstname, \' \', name)', $sSearch)
					   )
					   ->orderBy(['firstname', 'name'])
					   ->load();

		return $aResults;
	}
}

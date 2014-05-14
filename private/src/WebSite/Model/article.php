<?php

/**
 * Model to article
 *
 * @category  	src
 * @package   	src\FrontOffice\Model
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\WebSite\Model;

use \Venus\core\Model as Model;
use \Venus\lib\Entity as LibEntity;
use \Venus\lib\Orm\Where as Where;

/**
 * Model to article
 *
 * @category  	src
 * @package   	src\FrontOffice\Model
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class article extends Model {

	/**
	 * Get Lasts news
	 *
	 * @access public
	 * @param  integer $iLimit limit
	 * @param  integer $iOffSet offset
	 * @return array
	 */

	public function getLastNews($iLimit = 3, $iOffSet = 0, $sType = '') {

		$result = array();

		$aJoin = [
					[
						'type' => 'right',
						'table' => 'article_type',
						'as' => 'at',
						'left_field' => 'at.id',
						'right_field' => 'a.id_article_type'
					],
		];

		$this->orm
			 ->select(array('SQL_CALC_FOUND_ROWS', '*'))
			 ->from($this->_sTableName, 'a');

		if ($sType == 'news') {

			$this->orm->where(
				$this->where->whereEqual('a.id_article_type', 1)
							->orWhereEqual('a.id_article_type', 4)
							->orWhereEqual('a.id_article_type', 20)
			);
		}
		else if ($sType == 'cinema') {

			$this->orm->where(
				$this->where->whereEqual('a.id_article_type', 1)
			);
		}
		else if ($sType == 'serie') {

			$this->orm->where(
				$this->where->whereEqual('a.id_article_type', 4)
			);
		}
		else if ($sType == 'tele') {

			$this->orm->where(
				$this->where->whereEqual('a.id_article_type', 20)
			);
		}
		else if ($sType == 'folder') {

			$this->orm->where(
				$this->where->whereEqual('a.id_article_type', 3)
			);
		}

		$result['items'] = $this->orm
					   			->join($aJoin)
					    		->orderBy(array('a.'.LibEntity::getPrimaryKeyName($this->entity).' DESC'))
					    		->limit($iLimit, $iOffSet)
					    		->load();

		$result['count'] = $this->orm
								->select(array('FOUND_ROWS()'))
								->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}
	/**
	 * Get Lasts news
	 *
	 * @access public
	 * @param  integer $iLimit limit
	 * @param  integer $iOffSet offset
	 * @return array
	 */

	public function getLastDvdNews($iLimit = 3, $iOffSet = 0) {

		$result = array();

		$aJoin = [
					[
						'type' => 'right',
						'table' => 'article_has_subtype',
						'as' => 'ahs',
						'left_field' => 'ahs.id_article',
						'right_field' => 'a.id'
					],
					[
						'type' => 'right',
						'table' => 'article_type',
						'as' => 'at',
						'left_field' => 'at.id',
						'right_field' => 'a.id_article_type'
					],
		];

		$this->orm
			 ->select(array('SQL_CALC_FOUND_ROWS', '*'))
			 ->from($this->_sTableName, 'a');

		$this->orm->where(
			$this->where->whereEqual('ahs.id_subtype', 21)
						->orWhereEqual('ahs.id_subtype', 22)
		);

		$result['items'] = $this->orm
					   			->join($aJoin)
					    		->orderBy(array('a.'.LibEntity::getPrimaryKeyName($this->entity).' DESC'))
					    		->limit($iLimit, $iOffSet)
					    		->load();

		$result['count'] = $this->orm
							 	->select(array('FOUND_ROWS()'))
								->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		if (isset($result)) { return $result; }
		else { return array(); }
	}

	/**
	 * Get Lasts news
	 *
	 * @access public
	 * @param  integer $iLimit limit
	 * @param  int $iOffset offset
	 * @param  int $iType subtype
	 * @return array
	 */

	public function getLastCinemaNews($iLimit = 3, $iOffset = 0, $iType = null) {

		if ($iType === null) {

			$aJoin = [
				[
					'type' => 'right',
					'table' => 'article_type',
					'as' => 'at',
					'left_field' => 'at.id',
					'right_field' => 'a.id_article_type'
				],
			];

			$oWhere = $this->where->whereEqual('a.id_article_type', 1);
		}
		else {

			$aJoin = [
				[
					'type' => 'right',
					'table' => 'article_type',
					'as' => 'at',
					'left_field' => 'at.id',
					'right_field' => 'a.id_article_type'
				],
				[
					'type' => 'right',
					'table' => 'article_has_subtype',
					'as' => 'ahs',
					'left_field' => 'ahs.id_article',
					'right_field' => 'a.id'
				]
			];

			$oWhere = $this->where->whereEqual('a.id_article_type', 1)
								  ->andWhereEqual('ahs.id_subtype', $iType);
		}

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', '*'))
					   ->from($this->_sTableName, 'a')
					   ->join($aJoin)
					   ->where($oWhere)
					   ->orderBy(array('a.'.LibEntity::getPrimaryKeyName($this->entity).' DESC'))
					   ->limit($iLimit, $iOffset)
					   ->load();

		if (!isset($result[0])) { $result[0] = new \StdClass(); }

		$result[0]->count = $this->orm
								 ->select(array('FOUND_ROWS()'))
								 ->load();

		$result[0]->pages = floor($result[0]->count / $iLimit);

		if (isset($result)) { return $result; }
		else { return array(); }
	}

	/**
	 * Get Lasts news
	 *
	 * @access public
	 * @param  integer $iLimit limit
	 * @param  int $iOffset offset
	 * @param  int $iType subtype
	 * @return array
	 */

	public function getLastSerieNews($iLimit = 3, $iOffset = 0, $iType = null) {

		if ($iType === null) {

			$aJoin = [
				[
					'type' => 'right',
					'table' => 'article_type',
					'as' => 'at',
					'left_field' => 'at.id',
					'right_field' => 'a.id_article_type'
				],
			];

			$oWhere = $this->where->whereEqual('a.id_article_type', 4);
		}
		else {

			$aJoin = [
				[
					'type' => 'right',
					'table' => 'article_type',
					'as' => 'at',
					'left_field' => 'at.id',
					'right_field' => 'a.id_article_type'
				],
				[
					'type' => 'right',
					'table' => 'article_has_subtype',
					'as' => 'ahs',
					'left_field' => 'ahs.id_article',
					'right_field' => 'a.id'
				]
			];

			$oWhere = $this->where->whereEqual('a.id_article_type', 4)
								  ->andWhereEqual('ahs.id_subtype', $iType);
		}

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', '*'))
					   ->from($this->_sTableName, 'a')
					   ->join($aJoin)
					   ->where($oWhere)
					   ->orderBy(array('a.'.LibEntity::getPrimaryKeyName($this->entity).' DESC'))
					   ->limit($iLimit, $iOffset)
					   ->load();

		if (!isset($result[0])) { $result[0] = new \StdClass(); }

		$result[0]->count = $this->orm
								 ->select(array('FOUND_ROWS()'))
								 ->load();

		$result[0]->pages = floor($result[0]->count / 10);

		if (isset($result)) { return $result; }
		else { return array(); }
	}

	/**
	 * Get Lasts folders
	 *
	 * @access public
	 * @param  integer $iLimit limit
	 * @return array
	 */

	public function getLastFolders($iLimit = 3) {

		$aJoin = [
					[
						'type' => 'right',
						'table' => 'article_type',
						'as' => 'at',
						'left_field' => 'at.id',
						'right_field' => 'a.id_article_type'
					]
		];

		$result = $this->orm
					   ->select(array('SQL_CALC_FOUND_ROWS', '*'))
					   ->from($this->_sTableName, 'a')
					   ->join($aJoin)
					   ->where(array('a.id_article_type' => 3))
					   ->orderBy(array('a.'.LibEntity::getPrimaryKeyName($this->entity).' DESC'))
					   ->limit($iLimit)
					   ->load();

		$result[0]->count = $this->orm
								 ->select(array('FOUND_ROWS()'))
								 ->load();

		$result[0]->pages = floor($result[0]->count / 10);

		if (isset($result)) { return $result; }
		else { return array(); }
	}

	/**
	 * Get Lasts news
	 *
	 * @access public
	 * @param  integer $iIdRecord limit
	 * @return array
	 */

	public function getReviewForOneRecord($iIdRecord) {

		$result = $this->orm
					   ->select(array('*'))
					   ->from($this->_sTableName)
					   ->where(array('id_article_type' => 2, 'id_record' => $iIdRecord))
					   ->load();

		return $result[0];
	}

	/**
	 * Get Lasts folders
	 *
	 * @access public
	 * @param  integer $iPerson id_person
	 * @param  integer $iLimit limit
	 * @return array
	 */

	public function getLastNewsByPerson($iPerson, $iLimit = 4, $iOffset = 0) {

		$result = array();

		$aJoin = [
					[
						'type' => 'right',
						'table' => 'article_has_person',
						'as' => 'ahp',
						'left_field' => 'ahp.id_article',
						'right_field' => 'a.id'
					],
					[
						'type' => 'right',
						'table' => 'article_type',
						'as' => 'at',
						'left_field' => 'at.id',
						'right_field' => 'a.id_article_type'
					],
		];

		$oWhere = new Where;

		$result['items'] = $this->orm
					   			->select(array('*'))
					   			->from($this->_sTableName, 'a')
					   			->join($aJoin)
					   			->where(['ahp.id_person'=> $iPerson])
					   			->orderBy(['created DESC'])
					   			->limit($iLimit, $iOffset)
					   			->load();

		$result['count'] = $this->orm
								->select(array('FOUND_ROWS()'))
								->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}

	/**
	 * Get Lasts news
	 *
	 * @access public
	 * @param  integer $iIdRecord id record
	 * @param  integer $iLimit limit
	 * @param  int $iOffset offset
	 * @return array
	 */

	public function getLastNewsByRecord($iIdRecord, $iLimit = 3, $iOffset = 0) {

		$result = array();

		$aJoin = [
					[
						'type' => 'right',
						'table' => 'article_has_record',
						'as' => 'ahr',
						'left_field' => 'ahr.id_article',
						'right_field' => 'a.id'
					],
					[
						'type' => 'right',
						'table' => 'article_type',
						'as' => 'at',
						'left_field' => 'at.id',
						'right_field' => 'a.id_article_type'
					],
		];

		$result['items'] = $this->orm
					   			->select(array('*'))
					  			->from($this->_sTableName, 'a')
					   			->where(array('ahr.id_record' => $iIdRecord))
					   			->join($aJoin)
					   			->orderBy(array('a.'.LibEntity::getPrimaryKeyName($this->entity).' DESC'))
					   			->limit($iLimit, $iOffset)
					   			->load();

		$result['count'] = $this->orm
								->select(array('FOUND_ROWS()'))
								->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}

	/**
	 * Get Lasts news
	 *
	 * @access public
	 * @param  integer $iIdRecord id record
	 * @param  integer $iLimit limit
	 * @param  int $iOffset offset
	 * @return array
	 */

	public function getLikeWord($sWord, $iLimit = 10, $iOffset = 0) {

		$result = array();

		$aJoin = [
			[
				'type' => 'right',
				'table' => 'article_type',
				'as' => 'at',
				'left_field' => 'at.id',
				'right_field' => 'a.id_article_type'
			],
		];

		$result['items'] = $this->orm
					   			->select(array('SQL_CALC_FOUND_ROWS', '*'))
					   			->from($this->_sTableName, 'a')
					   			->where($this->where->whereSoundex('a.title', $sWord)->orWhereSoundex('a.content', $sWord))
					   			->join($aJoin)
					   			->orderBy(['a.id DESC'])
					   			->limit($iLimit, $iOffset)
					   			->load();

		$result['count'] = $this->orm
								->select(array('FOUND_ROWS()'))
								->load();

		$result['pages'] = floor($result['count'] / $iLimit);

		return $result;
	}
}

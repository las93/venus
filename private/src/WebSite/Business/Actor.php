<?php

/**
 * Controller to Actor
 *
 * @category  	src
 * @package   	src\FrontOffice\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

namespace Venus\src\WebSite\Business;

use \Venus\core\Business as Business;
use \Venus\lib\Date as Date;
use \Venus\src\WebSite\Business\Record as businessRecord;
use \Venus\src\WebSite\Model\Record as modelRecord;
use \Venus\src\WebSite\Model\person as modelPerson;

/**
 * Controller to Actor
 *
 * @category  	src
 * @package   	src\FrontOffice\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class Actor extends Business {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelPerson = function() { return new modelPerson; };

		parent::__construct();
	}

	/**
	 * get last Actors
	 *
	 * @access public
	 * @param  int $iLimit limit
	 * @param  int $iOffset offset
	 * @param  string $sFirstLetter
	 * @return array
	 */

	public function getActorsList($iLimit = 20, $iOffSet = 0, $sFirstLetter = null) {

		$aActors = $this->modelPerson->getActorsList($iLimit, $iOffSet, $sFirstLetter);

		foreach ($aActors['items'] as $iKey => $oActor) {

			$aActors['items'][$iKey]->url = $this->url->getUrl('acteur-detail', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name())));
			$aActors['items'][$iKey]->image = $this->url->getUrl('images-nom', array('id' => $oActor->get_id(), 'title' => $this->url->encodeToUrl($oActor->get_firstname().' '.$oActor->get_name()), 'type' => 'person'));
		}

		return $aActors;
	}
}

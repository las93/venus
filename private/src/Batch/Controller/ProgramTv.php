<?php

/**
 * Batch that generate files and folders
 *
 * @category  	src
 * @package   	src\Batch\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 *
 * @tutorial    You could launch this Batch in /private/
 * 				php launch.php create_project -p [portal]
 * 				-p [portal] => it's the name where you want add your entities and models
 * 					by default, it's Batch
 */

namespace Venus\src\Batch\Controller;

use \Venus\src\Batch\common\Controller as Controller;
use \Venus\src\BackOffice\Model\channel as modelChannel;
use \Venus\src\BackOffice\Model\record as modelRecord;
use \Venus\src\BackOffice\Model\record_has_kind as modelRecordHasKind;
use \Venus\src\BackOffice\Model\record_has_realisator as modelRecordHasRealisator;
use \Venus\src\BackOffice\Model\record_has_actor as modelRecordHasActor;
use \Venus\src\BackOffice\Model\program_on_grid as modelProgramOnGrid;
use \Venus\src\BackOffice\Model\program as modelProgram;
use \Venus\src\BackOffice\Model\person as modelPerson;
use \Venus\src\BackOffice\Model\record_episode as modelRecordEpisode;
use \Venus\src\BackOffice\Entity\channel as entityChannel;
use \Venus\src\BackOffice\Entity\record as entityRecord;
use \Venus\src\BackOffice\Entity\record_has_kind as entityRecordHasKind;
use \Venus\src\BackOffice\Entity\record_has_realisator as entityRecordHasRealisator;
use \Venus\src\BackOffice\Entity\record_has_actor as entityRecordHasActor;
use \Venus\src\BackOffice\Entity\person as entityPerson;
use \Venus\src\BackOffice\Entity\program_on_grid as entityProgramOnGrid;
use \Venus\src\BackOffice\Entity\program as entityProgram;
use \Venus\src\BackOffice\Entity\record_episode as entityRecordEpisode;

/**
 * Batch that generate files and folders
 *
 * @category  	src
 * @package   	src\Batch\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class ProgramTv extends Controller {


	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->modelRecord = function() { return new modelRecord; };
		$this->modelChannel = function() { return new modelChannel; };
		$this->modelRecordHasKind = function() { return new modelRecordHasKind; };
		$this->modelRecordHasRealisator = function() { return new modelRecordHasRealisator; };
		$this->modelRecordHasActor = function() { return new modelRecordHasActor; };
		$this->modelPerson = function() { return new modelPerson; };
		$this->modelProgramOnGrid = function() { return new modelProgramOnGrid; };
		$this->modelProgram = function() { return new modelProgram; };
		$this->modelRecordEpisode = function() { return new modelRecordEpisode; };
		$this->entityChannel = function() { return new entityChannel; };
		$this->entityRecord = function() { return new entityRecord; };
		$this->entityRecordHasKind = function() { return new entityRecordHasKind; };
		$this->entityRecordHasRealisator = function() { return new entityRecordHasRealisator; };
		$this->entityRecordHasActor = function() { return new entityRecordHasActor; };
		$this->entityPerson = function() { return new entityPerson; };
		$this->entityProgramOnGrid = function() { return new entityProgramOnGrid; };
		$this->entityProgram = function() { return new entityProgram; };
		$this->entityRecordEpisode = function() { return new entityRecordEpisode; };

		define('PORTAIL', 'BackOffice');

		parent::__construct();
	}

	/**
	 * run the batch to create a project in this framework
	 * @tutorial launch.php create_project
	 *
	 * @access public
	 * @param  string $sPortail name of the portail that you would create
	 * @return void
	 */

	public function import(array $aOptions = array()) {

		/*
		mysql_connect('localhost', 'root', 'elo2305');
		mysql_select_db('cinema');

		$out = mysql_query("SELECT COUNT( * ) AS num, GROUP_CONCAT( id ) as gp, firstname, name
		FROM  `person`
		GROUP BY name, firstname
		HAVING num >1
		ORDER BY num DESC");

		while ($res = mysql_fetch_array($out)) {
			//var_dump($res);
			$ids = explode(',', $res['gp']);
			$idtodelete = min($ids);
			$res['gp'] = str_replace($idtodelete, '', $res['gp']);
			$res['gp'] = str_replace(',,', ',', $res['gp']);
			$res['gp'] = preg_replace('/,$/', '', $res['gp']);
			$res['gp'] = preg_replace('/^,/', '', $res['gp']);
			mysql_query("DELETE FROM  person WHERE id IN(".$res['gp'].")");
			echo "DELETE FROM  person WHERE id IN(".$res['gp'].")  ";
		}

		return ;
		*/

		echo "Part 1/2 : download program tv\n";
		copy('http://xmltv.dyndns.org/download/complet.zip', __DIR__.'/../../../../data/cache/complet.zip');

		echo "Part 2/2 : download program tv tnt\n";
		//copy('http://xmltv.dyndns.org/download/tnt.zip', __DIR__.'/../../../../data/cache/tnt.zip');

		echo "Part 3/2 : unzip program tv\n";
		$rZip = zip_open(__DIR__.'/../../../../data/cache/complet.zip');

		if ($rZip) {

		    while ($rZip_entry = zip_read($rZip)) {

		        if (zip_entry_open($rZip, $rZip_entry, "r")) {

		            echo "Contenu du fichier :\n";
		            $sContent = zip_entry_read($rZip_entry, zip_entry_filesize($rZip_entry));
		            //echo "$buf\n";

		            zip_entry_close($rZip_entry);
		        }
		        //echo "\n";
		    }

		    zip_close($rZip);
		}

		$oSimpleXMLElement = simplexml_load_string($sContent);

		foreach ($oSimpleXMLElement->channel as $aOne) {

			$oChannel = $this->entityChannel;

			$oChannel->set_id_xml((string)$aOne->attributes()->id)
					 ->set_name((string)$aOne->{'display-name'});

			$this->modelChannel->insert($oChannel);
		}

		$i = 0;

		foreach ($oSimpleXMLElement->programme as $aOne) {

			if ((string)$aOne->category[0] == 'série' || (string)$aOne->category[0] == 'feuilleton' || (string)$aOne->category[0] == 'film') {

				if (!$oRecord = $this->modelRecord->isRecordByTitleExists((string)$aOne->title)) {

					$oRecordToInsert = $this->entityRecord;

					$oRecordToInsert->set_title((string)$aOne->title)
									->set_visible('n');

					if ((string)$aOne->category[0] == 'film' && preg_match('/court m.trage/', (string)$aOne->category[1])) {

						$oRecordToInsert->set_type('court-metrage');
					}
					else if ((string)$aOne->category[0] == 'série' || (string)$aOne->category[0] == 'feuilleton') {

						$oRecordToInsert->set_type('serie');
					}
					else {

						$oRecordToInsert->set_type('film');
					}

					$this->modelRecord->insert($oRecordToInsert);

					$oRecord = $this->modelRecord->isRecordByTitleExists((string)$aOne->title);

					if ((string)$aOne->category[1] == "série hospitalière") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(25)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série d'animation") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(3)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série jeunesse") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(11)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série réaliste") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(12)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "feuilleton sentimental") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(29)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film sentimental") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(29)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série policière") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(28)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série humoristique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(1)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série fantastique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(21)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série dramatique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(15)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "thriller") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(34)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film policier") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(28)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "court métrage") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(12)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "comédie dramatique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(8)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "drame") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(15)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série judiciaire") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(24)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "feuilleton réaliste") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(12)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série d'aventures") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(5)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film d'animation") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(3)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "comédie") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(1)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "comédie burlesque") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(1)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "comédie sentimentale") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(1)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film sentimentale") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(1)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film noir") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(16)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série de guerre") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(22)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film fantastique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(21)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film documentaire") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(13)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film d'horreur") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(16)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film d'épouvante") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(16)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film pornographique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(17)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "court métrage d'animation") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(3)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série de suspense") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(37)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "essai") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(19)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "court métrage dramatique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(15)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série marionnettes") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(20)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série d'action") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(2)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série sentimentale") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(29)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "moyen métrage") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(12)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "drame historique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(15)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(23)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "drame social") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(15)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film d'aventures") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(5)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "feuilleton d'aventures") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(5)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film d'espionnage") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(18)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film d'action") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(2)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série de téléréalité") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(32)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "comédie musicale") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(9)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "comédie policière") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(1)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(28)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film musical") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(26)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série musical") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(26)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "comédie satirique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(1)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film de science-fiction") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(30)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série de science-fiction") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(30)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film de suspense") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(37)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "biographie") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(6)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film de guerre") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(22)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série musicale") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(26)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film catastrophe") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(38)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série pornographique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(17)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série érotique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(17)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film érotique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(17)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "thriller politique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(34)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "western") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(36)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "conte") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(21)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série western") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(36)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film de cape et d'épée") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(12)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série autre") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(12)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "feuilleton autre") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(12)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "drame psychologique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(15)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "drame criminel") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(15)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série historique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(23)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film historique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(23)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "feuilleton dramatique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(15)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série culinaire") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(12)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "mélodrame") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(15)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film pour la jeunesse") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(20)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "série à sketches") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(35)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "film à sketches") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(35)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "comédie romantique") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(1)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(29)
									   ->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else if ((string)$aOne->category[1] == "péplum") {

						$oRecordHasKind = $this->entityRecordHasKind;
						$oRecordHasKind->set_id_kind(27)
						->set_id_record($oRecord->get_id());

						$this->modelRecordHasKind->insert($oRecordHasKind);
					}
					else {

						var_dump((string)$aOne->title);
						var_dump((string)$aOne->category[0]);
						var_dump((string)$aOne->category[1]);
					}

					if (!$oPerson = $this->modelPerson->isPersonExists((string)$aOne->credits->director)) {

						$aName = explode(' ', (string)$aOne->credits->director);

						if (isset($aName[2])) {

							$aName[1] .= ' '.$aName[2];
							unset($aName[2]);
						}

						if (!isset($aName[1])) { $aName[1] = ''; }

						$oPerson = $this->entityPerson;

						$oPerson->set_name($aName[1])
								->set_firstname($aName[0]);

						$this->modelPerson->insert($oPerson);

						$oPerson = $this->modelPerson->isPersonExists((string)$aOne->credits->director);
					}

					if (!$oRecordHasRealisator = $this->modelRecordHasRealisator->isRecordHasRealisatorExists(
							$oPerson->get_id(),
							$oRecord->get_id())
					) {

						$oRecordHasRealisator = $this->entityRecordHasRealisator;

						$oRecordHasRealisator->set_id_person($oPerson->get_id())
											 ->set_id_record($oRecord->get_id())
											 ->set_role('Réalisateur');

						$this->modelRecordHasRealisator->insert($oRecordHasRealisator);

						$oRecordHasRealisator = $this->modelRecordHasRealisator->isRecordHasRealisatorExists($oPerson->get_id(), $oRecord->get_id());
					}

					foreach ($aOne->credits->actor as $aOneActor) {

						$sActor = preg_replace('/[^a-zA-Z- ]+/', '', (string)$aOneActor);

						if (!$oPerson = $this->modelPerson->isPersonExists($sActor)) {

							$aActorMatch = preg_replace('/^(.+) \(([^\)]+)\)$/', '$1||$2', $aOneActor);
							$aActorMatch2 = explode('||', $aActorMatch);

							$aName = explode(' ', $aActorMatch2[0]);
							//$aName = explode(' ', $sActor);
							$aRole = $aActorMatch2[1];

							if (isset($aName[2])) {

								$aName[1] .= ' '.$aName[2];
								unset($aName[2]);
							}

							if (!isset($aName[1])) { $aName[1] = ''; }

							$oPerson = $this->entityPerson;

							$oPerson->set_name($aName[1])
									->set_firstname($aName[0]);

							$this->modelPerson->insert($oPerson);

							$oPerson = $this->modelPerson->isPersonExists(trim($aName[0].' '.$aName[1]));
						}

						if (!$oRecordHasActor = $this->modelRecordHasActor->isRecordHasActorExists($oPerson->get_id(), $oRecord->get_id())) {

							$aActorMatch = preg_replace('/^(.+) \(([^\)]+)\)$/', '$1||$2', $aOneActor);
							$aActorMatch2 = explode('||', $aActorMatch);

							$aName = explode(' ', $aActorMatch2[0]);

							if (isset($aActorMatch2[1])) { $sRole = $aActorMatch2[1]; }
							else { $sRole = ''; }

							if (isset($aName[2])) {

								$aName[1] .= ' '.$aName[2];
								unset($aName[2]);
							}

							$oRecordHasActor = $this->entityRecordHasActor;

							$oRecordHasActor->set_id_person($oPerson->get_id())
											->set_id_record($oRecord->get_id())
											->set_role($sRole);

							$this->modelRecordHasActor->insert($oRecordHasActor);

							$oRecordHasRealisator = $this->modelRecordHasActor->isRecordHasActorExists($oPerson->get_id(), $oRecord->get_id());
						}
					}
				}
			}

			if (!$oProgram = $this->modelProgram->isProgramByTitleExists((string)$aOne->title)) {

				$oProgramToInsert = $this->entityProgram;

				$oProgramToInsert->set_name((string)$aOne->title);

				$this->modelProgram->insert($oProgramToInsert);

				$oProgram = $this->modelProgram->isProgramByTitleExists((string)$aOne->title);
			}

			$oChannel = $this->modelChannel->findOneByid_xml((string)$aOne->attributes()->channel);

			$oProgramOnGridToInsert = $this->entityProgramOnGrid;

			if (isset($oRecord)) { $iIdRecord = $oRecord->get_id(); }
			else { $iIdRecord = 0; }

			if ((string)$aOne->category[0] == 'série') {

				$sEpisodeSeason = $aOne->{"episode-num"};
				preg_match('/^\.*(?P<season>[0-9]+)\.(?P<episode>[0-9]+).*$/', $sEpisodeSeason, $aMatch);
				$iSeason = (int)$aMatch['season'] + 1;
				$iEpisode = (int)$aMatch['episode'] + 1;
			}
			else {

				$iSeason = 0;
				$iEpisode = 0;
			}

			if (isset($oRecord) && !$oRecordEpisode = $this->modelRecordEpisode->isRecordEpisodeExists($oRecord->get_id(), $iSeason, $iEpisode)) {

				$oRecordEpisodeToInsert = $this->entityRecordEpisode;

				$oRecordEpisodeToInsert->set_id_record($oRecord->get_id())
									   ->set_season($iSeason)
									   ->set_episode($iEpisode)
									   ->set_title((string)$aOne->{'sub-title'});

				$this->modelRecordEpisode->insert($oRecordEpisodeToInsert);

				$oRecordEpisode = $this->modelRecordEpisode->isRecordEpisodeExists($oRecord->get_id(), $iSeason, $iEpisode);
			}

			$oProgramOnGridToInsert->set_id_channel($oChannel->get_id())
								   ->set_id_record($iIdRecord)
								   ->set_id_program($oProgram->get_id())
								   ->set_start(preg_replace('/^([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2}) .+$/', '$1-$2-$3 $4:$5:$6', (string)$aOne->attributes()->start))
								   ->set_end(preg_replace('/^([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2}) .+$/', '$1-$2-$3 $4:$5:$6', (string)$aOne->attributes()->stop))
								   ->set_season($iSeason)
								   ->set_episode($iEpisode);

			$this->modelProgramOnGrid->insert($oProgramOnGridToInsert);

			unset($oRecord);

			if ((string)$aOne->category[0] == 'série' || (string)$aOne->category[0] == 'feuilleton') {

				//var_dump((string)$aOne->title);
				//var_dump(preg_replace('/^([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2}) .+$/', '$1-$2-$3 $4:$5:$6', (string)$aOne->attributes()->start));
				//var_dump(preg_replace('/^([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2}) .+$/', '$1-$2-$3 $4:$5:$6', (string)$aOne->attributes()->stop));

				//var_dump((string)$aOne->{'sub-title'});

				//var_dump($aOne->credits);

				//var_dump((string)$aOne->date);

				//var_dump((string)$aOne->category[0]);
				//var_dump((string)$aOne->category[1]);

				//var_dump((string)$aOne->{'episode-num'});
			}

			//if ($i == 800000) { exit; }
			$i++;
		}

		echo " FIN ";
	}
}



/*
 object(SimpleXMLElement)#111 (15) {
  ["@attributes"]=>
  array(4) {
    ["start"]=>
    string(20) "20130905000000 +0200"
    ["stop"]=>
    string(20) "20130905005500 +0200"
    ["showview"]=>
    string(5) "62312"
    ["channel"]=>
    string(14) "C1.telerama.fr"
  }
  ["title"]=>
  string(8) "Dr House"
  ["sub-title"]=>
  string(31) "L'argent ne fait pas le bonheur"
  ["desc"]=>
  string(649) "Saison : 6 - Episode : 4/21 - Roy Randall, riche homme d'affaires Ã  la tÃªte d'une compagnie pÃ©troliÃ¨re, se rend Ã  Princeton Plainsboro pour exiger de Cuddy que House s'occupe de son fils, Jack. Comme House est toujours interdit d'exercice, Cuddy doit dÃ©lÃ©guer le cas Ã  Foreman, tout en lui suggÃ©rant de laisser House, qui sera consultant, prendre les dÃ©cisions. Cameron commence toute une batterie de tests sur Jack, qui souffre de vives douleurs. Elle remarque une masse dans son abdomen. Pendant ce temps, NumÃ©ro Treize voit son vol pour Bangkok annulÃ©. Elle cherche Ã  savoir qui est le responsable et commence par interroger House..."
  ["credits"]=>
  object(SimpleXMLElement)#109 (2) {
    ["director"]=>
    string(13) "Greg Yaitanes"
    ["actor"]=>
    array(8) {
      [0]=>
      string(27) "Hugh Laurie (Gregory House)"
      [1]=>
      string(27) "Lisa Edelstein (Lisa Cuddy)"
      [2]=>
      string(24) "Omar Epps (Eric Foreman)"
      [3]=>
      string(34) "Robert Sean Leonard (James Wilson)"
      [4]=>
      string(35) "Jennifer Morrison (Allison Cameron)"
      [5]=>
      string(29) "Tanner Maguire (Jack Randall)"
      [6]=>
      string(45) "Olivia Wilde (Remy Â«NumÃ©ro TreizeÂ» Hadley)"
      [7]=>
      string(26) "Lee Tergesen (Roy Randall)"
    }
  }
  ["date"]=>
  string(4) "2009"
  ["category"]=>
  array(2) {
    [0]=>
    string(6) "sÃ©rie"
    [1]=>
    string(20) "sÃ©rie hospitaliÃ¨re"
  }
  ["icon"]=>
  object(SimpleXMLElement)#110 (1) {
    ["@attributes"]=>
    array(1) {
      ["src"]=>
      string(81) "http://guidetv-iphone.telerama.fr/verytv/procedures/images/2013-09-05_1_00:00.jpg"
    }
  }
  ["episode-num"]=>
  string(7) "5.3/21."
  ["video"]=>
  object(SimpleXMLElement)#112 (2) {
    ["aspect"]=>
    string(4) "16:9"
    ["quality"]=>
    string(4) "HDTV"
  }
  ["audio"]=>
  object(SimpleXMLElement)#113 (1) {
    ["stereo"]=>
    string(9) "bilingual"
  }
  ["premiere"]=>
  object(SimpleXMLElement)#114 (0) {
  }
  ["subtitles"]=>
  object(SimpleXMLElement)#115 (2) {
    ["@attributes"]=>
    array(1) {
      ["type"]=>
      string(8) "teletext"
    }
    ["language"]=>
    string(2) "fr"
  }
  ["rating"]=>
  object(SimpleXMLElement)#116 (3) {
    ["@attributes"]=>
    array(1) {
      ["system"]=>
      string(3) "CSA"
    }
    ["value"]=>
    string(3) "-10"
    ["icon"]=>
    object(SimpleXMLElement)#118 (1) {
      ["@attributes"]=>
      array(1) {
        ["src"]=>
        string(46) "http://www.csa.fr/picts/visuels/picto_cat2.gif"
      }
    }
  }
  ["star-rating"]=>
  object(SimpleXMLElement)#117 (1) {
    ["value"]=>
    string(3) "2/5"
  }
}
*/

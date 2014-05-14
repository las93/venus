<?php

/**
 * Controller to test
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

namespace Venus\src\FrontOffice\Controller;

use \Venus\core\Controller as Controller;
use \Venus\core\UrlManager as UrlManager;
use \Venus\src\FrontOffice\Controller\Trailer as controllerTrailer;
use \Venus\src\FrontOffice\Controller\Article as controllerArticle;
use \Venus\src\FrontOffice\Model\mea as modelMea;
use \Venus\src\FrontOffice\Model\trailer as modelTrailer;
use \Venus\src\FrontOffice\Controller\Record as controllerRecord;
use \Venus\src\FrontOffice\Model\record as modelRecord;
use \Venus\src\FrontOffice\Model\program_on_grid as modelProgramOnGrid;
use \Venus\src\FrontOffice\Model\top_search as modelTopSearch;

/**
 * Controller to test
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

class Home extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		$this->controllerArticle = function() { return new controllerArticle; };
		$this->controllerTrailer = function() { return new controllerTrailer; };
		$this->modelTrailer = function() { return new modelTrailer; };
		$this->modelMea = function() { return new modelMea; };
		$this->modelRecord = function() { return new modelRecord; };
		$this->controllerRecord = function() { return new controllerRecord; };
		$this->modelProgramOnGrid = function() { return new modelProgramOnGrid; };
		$this->modelTopSearch = function() { return new modelTopSearch; };

		parent::__construct();

		$aSearch = $this->modelTopSearch->getTop(5);
		$oUrlManager = new UrlManager;
		$sSearch = '';

		foreach ($aSearch as $oSearch) {

			$sSearch .= ' &nbsp;&nbsp; <a href="'.$oUrlManager->getUrl('recherche', array('word' => $oSearch->get_word())).'" style="color:white">'.$oSearch->get_word().'</a> ';
		}

		$this->layout->assign('word_to_search', $sSearch);
	}

	/**
	 * the main page
	 *
	 * @access public
	 * @return void
	 */

	public function show() {

		$aMea = $this->modelMea->findBy(['id_mea_page' => 1]);
		$aMea = array_reverse($aMea);
		$aTrailer = $this->controllerTrailer->getLastTrailers();
		$aMoviesOf4Week = $this->modelRecord->getMoviesOf4Week('film', 3);
		$aMoviesOf4Week = $this->controllerRecord->getExtendedInfos($aMoviesOf4Week);
		$oUrlManager = new UrlManager;

		$aMoviesOfWeek = $this->modelRecord->getMoviesOfWeek('film', 3);

		if ($aMoviesOfWeek[0]->count > 0 && $aMoviesOfWeek[0]->get_id()) { $aMoviesOfWeek = $this->controllerRecord->getExtendedInfos($aMoviesOfWeek); }
		else { $aMoviesOfWeek = $aMoviesOf4Week; }

		$aWantedMovies = $this->modelRecord->getWantedMovies();

		if ($aWantedMovies[0]->get_id()) { $aWantedMovies = $this->controllerRecord->getExtendedInfos($aWantedMovies);}
		else { $aWantedMovies = $aMoviesOf4Week; }

		$aBestSeries = $this->modelRecord->getBestMovies('serie');
		$aBestSeries = $this->controllerRecord->getExtendedInfos($aBestSeries);

		$aNews = $this->controllerArticle->getLastNewsByDay(6, 'all');

		$aSeriesThisDay = $this->modelProgramOnGrid->getSeriesThisDay();

		foreach ($aSeriesThisDay as $iKey => $oSerie) {

			$aSeries = $this->controllerRecord->getExtendedInfos([$oSerie->record]);
			$aSeriesThisDay[$iKey]->record = $aSeries[0];
		}

		$aFilmThisDay = $this->modelProgramOnGrid->getSeriesThisDay('film');

		foreach ($aFilmThisDay as $iKey => $oSerie) {

			$aSeries = $this->controllerRecord->getExtendedInfos([$oSerie->record]);
			$aFilmThisDay[$iKey]->record = $aSeries[0];
		}

		$this->layout
			 ->assign('tpl_last_trailers', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'TrailersLast.tpl')
			 ->assign('tpl_record_actual', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'RecordActual.tpl')
			 ->assign('tpl_one_movie', 'src'.DIRECTORY_SEPARATOR.'FrontOffice'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'OneMovie.tpl')
			 ->assign('title', 'iScreenway : Cinéma, Séries TV, Stars, Vidéos et DVD')
			 ->assign('description', 'iScreenway, le site du cinéma et des séries tv ! Découvrez le programme tv de vos séries préférées, l&#39;actualité cinéma et séries, les dernières bandes-annonces, et plus encore.')
			 ->assign('last_trailers', $aTrailer)
			 ->assign('meas', $aMea)
			 ->assign('movies_week', $aMoviesOfWeek)
			 ->assign('movies_4week', $aMoviesOf4Week)
			 ->assign('wanted_movies', $aWantedMovies)
			 ->assign('news', $aNews)
			 ->assign('menu_news', true)
			 ->assign('url_enfant', $oUrlManager->getUrl('genre-film-detail', array('id' => 3, 'title' => 'animation')))
			 ->assign('best_series', $aBestSeries)
			 ->assign('serie_tv', $aSeriesThisDay)
			 ->assign('film_tv', $aFilmThisDay)
			 ->display();


	}


	/**
	 * the main page
	 *
	 * @access public
	 * @return void
	 */

	public function showXmlLastTrailers() {

		header("Content-Type: application/xml; charset=utf-8");

		echo '<?xml version="1.0" encoding="utf-8"?>
				<Piecemaker>
 	 				<Contents>
		';

		$aMea = $this->modelMea->findBy(['id_mea_page' => 1]);

		foreach ($aMea as $oOne) {

			echo '<Image Source="/images/mea_'.$oOne->get_id().'.jpg" Title="Lots of new Features">
			      <Text>'.$oOne->get_title().'</Text>
			      <Hyperlink URL="'.$oOne->get_link().'" Target="_blank" />
			    </Image>
			';
		}

		echo '  	</Contents>
			  	<Settings ImageWidth="630" ImageHeight="295" LoaderColor="0x333333" InnerSideColor="0x222222" SideShadowAlpha="0.8" DropShadowAlpha="0.7" DropShadowDistance="25" DropShadowScale="0.95" DropShadowBlurX="40" DropShadowBlurY="4" MenuDistanceX="20" MenuDistanceY="50" MenuColor1="0x999999" MenuColor2="0x333333" MenuColor3="0xFFFFFF" ControlSize="100" ControlDistance="20" ControlColor1="0x222222" ControlColor2="0xFFFFFF" ControlAlpha="0.8" ControlAlphaOver="0.95" ControlsX="450" ControlsY="280&#xD;&#xA;" ControlsAlign="center" TooltipHeight="30" TooltipColor="0x222222" TooltipTextY="5" TooltipTextStyle="P-Italic" TooltipTextColor="0xFFFFFF" TooltipMarginLeft="5" TooltipMarginRight="7" TooltipTextSharpness="50" TooltipTextThickness="-100" InfoWidth="400" InfoBackground="0xFFFFFF" InfoBackgroundAlpha="0.95" InfoMargin="15" InfoSharpness="0" InfoThickness="0" Autoplay="10" FieldOfView="45"></Settings>
			  	<Transitions>
			    	<Transition Pieces="9" Time="1.2" Transition="easeInOutBack" Delay="0.1" DepthOffset="0" CubeDistance="30"></Transition>
			    	<Transition Pieces="15" Time="3" Transition="easeInOutElastic" Delay="0.03" DepthOffset="0" CubeDistance="10"></Transition>
			    	<Transition Pieces="5" Time="1.3" Transition="easeInOutCubic" Delay="0.1" DepthOffset="0" CubeDistance="50"></Transition>
			    	<Transition Pieces="9" Time="1.25" Transition="easeInOutBack" Delay="0.1" DepthOffset="0" CubeDistance="5"></Transition>
			  	</Transitions>
				</Piecemaker>
		';

		exit;
	}
}

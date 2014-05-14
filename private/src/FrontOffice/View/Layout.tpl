<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
    <head>
        <script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="/js/cookie.js"></script>
        <script type="text/javascript" src="/js/iscreenway.js"></script>
        <link rel="stylesheet" href="/css/style.css"/>
        <title>{if isset($title)}{$title}{else}iScreenway : Cinéma, Séries TV, Stars, Vidéos et DVD{/if}</title>
        <meta name="description" content="{if isset($description)}{$description}{else}iScreenway, le site du cinéma et des séries tv ! Découvrez le programme tv de vos séries préférées, l&#39;actualité cinéma et séries, les dernières bandes-annonces, et plus encore.{/if}" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content='iScreenway' />
		<meta name="country" content='Fr' />
		<meta name="geo.position" content='48.9049377;2.3214070999999876' />
		<meta name="geo.country" content='FR' />
		<meta name="ICBM" content='48.9049377;2.3214070999999876' />
		{if isset($og_img)}<link rel="image_src" href="http://www.iscreenway.com{$og_img}"/><meta content="http://www.iscreenway.com{$og_img}" property="og:image">{/if}
		<link rel="icon" type="image/png" href="/img/favicon.png" />
		<link rel="shortcut icon" type="image/png" href="/img/favicon.png" />
		<script type="text/javascript">
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-43697315-1', 'iscreenway.com');
		  ga('send', 'pageview');

		</script>
    </head>
    <body>
    	<div id="main">
    		<div id="top">
    			<div id="topleft"><a href="/"><img src="/img/t.png" width="205" height="104" border="0" alt="png transparent"/></a></div>
    			<div id ="globalrecherche">
    				<form name="formsearch" method="post" action="{url 'recherche'}">
    					<div id="recherche"><input type="text" style="width:140px;background:transparent;border:0;" name="word"/></div>
    					<div id="recherche2"><a href="javascript:document.formsearch.action='{url 'recherche'}'+encodeURIComponent(document.formsearch.word.value);document.formsearch.submit();" style="color:white">Rechercher</a></div>
    					<div id="toprecherche">Top: {if isset($word_to_search)}{$word_to_search}{/if}</div>
    				</form>
    			</div>
    			<div id="compte">
    				<a href="{url 'creer-compte'}" style="color:black" rel="nofollow">Créer un compte</a>
    				<br/><br/>
    				<a href="{url 'connexion'}" style="color:black" rel="nofollow">Se connecter</a> <a href="/"><img src="/img/facebook.jpg" height="15" style="border:0;" alt="Connexion iScreenway par Facebook" title="Connexion iScreenway par Facebook"/></a>
    			</div>
    		</div>
    		<div id="menu">
    			<div id="nomenu"></div>
    			<div id="menucentre">
    				<a href="{url 'home'}"><img src="/img/accueil{if !isset($category)}S{/if}.jpg" border="0" alt="accueil" title="accueil"/></a><a href="{url 'cinema'}"><img src="/img/cinema{if isset($category)}{if $category == 'cinema'}S{/if}{/if}.jpg" border="0" alt="cinéma" title="cinéma"/></a><a href="{url 'series'}"><img src="/img/series{if isset($category)}{if $category == 'series'}S{/if}{/if}.jpg" border="0" alt="série TV" title="série TV"/></a><a href="{url 'dvd'}"><img src="/img/dvd{if isset($category)}{if $category == 'dvd'}S{/if}{/if}.jpg" border="0" alt="DVD Blu-ray" title="DVD Blu-ray"/></a><a href="{url 'programme-tv'}"><img src="/img/programme-tv{if isset($category)}{if $category == 'tv'}S{/if}{/if}.jpg" border="0" alt="Programme TV" title="Programme TV"/></a>
    			</div>
    			<div id="endmenu">
    				<a href="javascript:fblink();"><img src="/img/facebook.jpg" border="0" style="margin-top:5px;" alt="iScreenway sur Facebook" title="iScreenway sur Facebook"/></a>
    				<a href="javascript:twlink();"><img src="/img/twitter.jpg" border="0" style="margin-top:5px;" alt="iScreenway sur Twitter" title="iScreenway sur Twitter"/></a>
    				<a href="javascript:gplink();"><img src="/img/googleplus.jpg" border="0" style="margin-top:5px;" alt="iScreenway sur Google+" title="iScreenway sur Google+"/></a>
    			</div>
    		</div>
    		<div id="submenu" style="text-align:center;padding-top:10px;">
    			{if isset($sub_menu)}{include "MenuFilm.tpl"}{/if}
    			{if isset($sub_menu2)}{include "MenuSerie.tpl"}{/if}
    			{if isset($sub_menu3)}{include "MenuprogrammeTv.tpl"}{/if}
    			{if isset($sub_menu4)}{include "MenuDvd.tpl"}{/if}
    			{if isset($menu_news)}
    				<marquee>
    					{foreach $news['news'] as $iKey => $oNews}
							{foreach $oNews as $iKey2 => $oNews2}
								<a href="{$oNews2->url}" style="color:white;"><b>{$oNews2->get_title()}</b></a> <span style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[...]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							{/foreach}
						{/foreach}
					</marquee>
    			{/if}
    		</div>
    		<div id="content">
    			<center style="margin-top:4px">{include 'Pub728x90.tpl'} &nbsp;&nbsp; &nbsp;{include 'Pub200x90.tpl'}</center>
    			{include model}
    		</div>
	    	<div id="contentbottom">
	    		<h4 style="color:#BBBBFF;font-size:24px;text-align:left;margin-bottom:5px;">Plan du site</h4>
	    		<div class="contentbottomdivbysix">
					<a href="{url 'cinema'}" style="color:white;font-weight:bold;tex-decoration:none;font-size:18px;">Cinéma</a><br/>
					<a href="{url 'bande-annonce-cinema'}" style="color:gray;font-weight:normal;">Bandes-Annonces Cinéma</a><br/>
					<a href="{url 'meilleurs-films'}" style="color:gray;font-weight:normal;">Meilleurs Films</a><br/>
					<a href="{url 'film-a-affiche'}" style="color:gray;font-weight:normal;">Films à l'affiche</a><br/>
					<a href="{url 'agenda-film'}" style="color:gray;font-weight:normal;">Agenda Cinéma</a><br/>
					<a href="{url 'box-office'}" style="color:gray;font-weight:normal;">Box Office</a><br/>
					<a href="{url 'liste-court-metrage'}" style="color:gray;font-weight:normal;">Court Métrage</a><br/>
					<a href="/cinema/genre/3/animation/" style="color:gray;font-weight:normal;">Films pour Enfants</a><br/>
					<a href="{url 'actu-film'}" style="color:gray;font-weight:normal;">Actualités cinéma</a><br/>
					<a href="{url 'liste-film'}" style="color:gray;font-weight:normal;">Liste des films</a><br/>
	    		</div>
	    		<div class="contentbottomdivbysix">
					<a href="{url 'series'}" style="color:white;font-weight:bold;tex-decoration:none;font-size:18px;">Séries TV</a><br/>
					<a href="{url 'meilleures-series'}" style="color:gray;font-weight:normal;">Meilleures Séries</a><br/>
					<a href="{url 'series-attendues'}" style="color:gray;font-weight:normal;">Séries les plus attendues</a><br/>
					<a href="{url 'agenda-serie'}" style="color:gray;font-weight:normal;">Agenda séries</a><br/>
					<a href="{url 'actu-series'}" style="color:gray;font-weight:normal;">Actualités séries TV</a><br/>
					<a href="{url 'liste-series'}" style="color:gray;font-weight:normal;">Toutes les séries</a><br/>
					<a href="{url 'bande-annonce-serie'}" style="color:gray;font-weight:normal;">Bandes-Annonces séries</a><br/>
	    		</div>
	    		<div class="contentbottomdivbysix">
					<a href="{url 'dvd'}" style="color:white;font-weight:bold;tex-decoration:none;font-size:18px;">DVD/Bluray</a><br/>
					<a href="{url 'meilleurs-dvd'}" style="color:gray;font-weight:normal;">Meilleurs DVD/Bluray</a><br/>
					<a href="{url 'notre-selection-dvd'}" style="color:gray;font-weight:normal;">Notre sélection DVD/Bluray</a><br/>
					<a href="{url 'agenda-dvd'}" style="color:gray;font-weight:normal;">Agenda DVD/Bluray</a><br/>
					<a href="{url 'dvd-attendus'}" style="color:gray;font-weight:normal;">DVD/Bluray attendus</a><br/>
	    		</div>
	    		<div class="contentbottomdivbysix">
					<a href="{url 'programme-tv'}" style="color:white;font-weight:bold;tex-decoration:none;font-size:18px;">Programme TV</a><br/>
					<a href="{url 'programme-tnt'}" style="color:gray;font-weight:normal;">Programme TNT</a><br/>
					<a href="{url 'programme-cable'}" style="color:gray;font-weight:normal;">Programme Satellite</a><br/>
					<a href="{url 'meilleurs-programme-tv'}" style="color:gray;font-weight:normal;">Top des programmes</a><br/>
	    		</div>
	    		<div class="contentbottomdivbysix">
					<span style="color:white;font-weight:bold;tex-decoration:none;font-size:18px;">Autres</span><br/>
					<a href="{url 'bande-annonce'}" style="color:gray;font-weight:normal;">Bandes-Annonces</a><br/>
					<a href="{url 'actu'}" style="color:gray;font-weight:normal;">Actualités</a><br/>
					<a href="{url 'dossier'}" style="color:gray;font-weight:normal;">Dossiers complets</a><br/>
				<a href="{url 'acteurs'}" style="color:gray;font-weight:normal;">Stars</a><br/>
    		</div>
	    		<div class="contentbottomdivbysix">
				<a href="{url 'service'}" style="color:white;font-weight:bold;tex-decoration:none;font-size:18px;">Sur le site</a><br/>
				<a href="{url 'contact'}" style="color:gray;font-weight:normal;">Contactez-nous</a><br/>
				<a href="{url 'a-propos'}" style="color:gray;font-weight:normal;">A propos d'iScreenway</a><br/>
				<a href="{url 'actu-site'}" style="color:gray;font-weight:normal;">Actualités iScreenway</a><br/>
				<a href="{url 'recrute'}" style="color:gray;font-weight:normal;">iScreenway recrute</a><br/>
				<a href="{url 'ads'}" style="color:gray;font-weight:normal;">Publicité/annonceur</a><br/>
				<a href="{url 'cgu'}" style="color:gray;font-weight:normal;">C.G.U.</a><br/>
				<a href="{url 'confidentialite'}" style="color:gray;font-weight:normal;">Charte de confidentialité</a><br/>
	    		</div>
	    		<div class="copyright">
		    		<span style="color:white">
		    			&copy;copyright iScreenway.com 2013-2014<br/>
		    			Toute reproduction partielle ou complète est interdite
		    		</span>
		    		<br/>&nbsp;
	    		</div>
    		</div>
 		</div>
    </body>
</html>
{* version=2; *}
<!DOCTYPE HTML>
<html>
    <head>
        <script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="/js/cookie.js"></script>
        <link rel="stylesheet" href="/css/style.css"/>
        <title>{if isset($title)}{$title}{else}Venus Framework : Framework PHP nouvelle génération{/if}</title>
        <meta name="description" content="{if isset($description)}{$description}{else}iScreenway, le site du cinéma et des séries tv ! Découvrez le programme tv de vos séries préférées, l&#39;actualité cinéma et séries, les dernières bandes-annonces, et plus encore.{/if}" />
        <meta charset="utf-8">
        <meta name="author" content='iScreenway' />
		<meta name="country" content='Fr' />
		<meta name="geo.position" content='48.9049377;2.3214070999999876' />
		<meta name="geo.country" content='FR' />
		<meta name="ICBM" content='48.9049377;2.3214070999999876' />
		{if isset($og_img)}<link rel="image_src" href="http://www.iscreenway.com{$og_img}"/><meta content="http://www.iscreenway.com{$og_img}" property="og:image">{/if}
		<link rel="icon" type="image/png" href="/img/favicon.png" />
		<link rel="shortcut icon" type="image/png" href="/img/favicon.png" />
    </head>
    <body>
    	<div id="top">
    		<div id="menu">
				<div id="logo"><img src="/img/logo-iscreenway{if $menu == 'cinema'}2{elseif $menu == 'serie'}3{elseif $menu == 'dvd'}4{elseif $menu == 'tele'}5{/if}.png" alt="Logo iScreenway" title="Logo iScreenway"/></div>
				<div class="menu_top{if $menu == 'home'}_select menu_top_select_blue{/if}"><a href="{url alias='home'}">Accueil</a></div>
				<div class="menu_top{if $menu == 'cinema'}_select menu_top_select_red{/if}"><a href="{url alias='cinema'}">A propos</a></div>
				<div class="menu_top{if $menu == 'serie'}_select menu_top_select_green{/if}"><a href="{url alias='series'}">Tutoriel</a></div>
				<div class="menu_top{if $menu == 'dvd'}_select menu_top_select_purple{/if}"><a href="{url alias='dvd'}">Participer</a></div>
				<div class="menu_top" style="width:170px;padding-top:7px;text-align:right;border-right:0;">
					<form id="search" name="search" method="post">
						<div style="float:right;"><input type="text" name="word" style="width:100px;"> <a href="javascript:void(0);" onClick="validForm()" style="text-decoration:none;color:white;" id="click_form">Ok</a></div>
						<div style="float:right;padding-top:3px;"><img src="/img/loupe.png" width="22"/></div>
						<script>
						$("#search").submit(function (event) {
							$("#search").attr("action", '{url alias='recherche'}'+encodeURIComponent(document.search.word.value));
							$("#search").submit();
						});
						function validForm() {
							document.search.action = '{url alias='recherche'}'+encodeURIComponent(document.search.word.value);
							document.search.submit();
						}
						</script>
					</form>
				</div>
			</div>
			{if $menu == 'home'}
	    		<div id="submenu_blue">
		    		<div id="submenu_center">
						<a href="{url alias='actu'}" class="submenutxt" {if isset($submenu) && $submenu == 'news'}style="color:yellow;"{/if}>Actualités</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='dossier'}" class="submenutxt" {if isset($submenu) && $submenu == 'folders'}style="color:yellow;"{/if}>Dossiers</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='bande-annonce'}" class="submenutxt" {if isset($submenu) && $submenu == 'trailers'}style="color:yellow;"{/if}>Bandes-annonces</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='acteurs'}" class="submenutxt" {if isset($submenu) && $submenu == 'actors'}style="color:yellow;"{/if}>Les stars</a>
					</div>
				</div>
			{elseif $menu == 'cinema'}
	    		<div id="submenu_red">
		    		<div id="submenu_center">
						<a href="{url alias='actu-film'}" class="submenutxt" {if isset($submenu) && $submenu == 'news'}style="color:yellow;"{/if}>Actualités</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='bande-annonce-cinema'}" class="submenutxt" {if isset($submenu) && $submenu == 'trailers'}style="color:yellow;"{/if}>Bandes-annonces</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='meilleurs-films'}" class="submenutxt" {if isset($submenu) && $submenu == 'best_movies'}style="color:yellow;"{/if}>Meilleurs films</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='film-de-la-semaine'}" class="submenutxt" {if isset($submenu) && $submenu == 'week_movies'}style="color:yellow;"{/if}>Films de la semaine</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='film-a-affiche'}" class="submenutxt" {if isset($submenu) && $submenu == 'week4_movies'}style="color:yellow;"{/if}>Films à l'affiche</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='agenda-film'}" class="submenutxt" {if isset($submenu) && $submenu == 'schedule_movies'}style="color:yellow;"{/if}>Agenda</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='box-office'}" class="submenutxt" {if isset($submenu) && $submenu == 'boxoffice_movies'}style="color:yellow;"{/if}>Box Office</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='liste-court-metrage'}" class="submenutxt" {if isset($submenu) && $submenu == 'little_movies'}style="color:yellow;"{/if}>Court Métrage</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='genre-film-detail' id=3 title='animation'}" class="submenutxt" {if isset($submenu) && $submenu == 'animation_movies'}style="color:yellow;"{/if}>Films pour Enfants</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='liste-film'}" class="submenutxt" {if isset($submenu) && $submenu == 'all_movies'}style="color:yellow;"{/if}>Tous les films</a>
					</div>
				</div>
			{elseif $menu == 'serie'}
	    		<div id="submenu_green">
		    		<div id="submenu_center">
						<a href="{url alias='actu-series'}" class="submenutxt" {if isset($submenu) && $submenu == 'news'}style="color:yellow;"{/if}>Actualités</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='bande-annonce-serie'}" class="submenutxt" {if isset($submenu) && $submenu == 'trailers'}style="color:yellow;"{/if}>Bandes-annonces</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='meilleures-series'}" class="submenutxt" {if isset($submenu) && $submenu == 'best_series'}style="color:yellow;"{/if}>Meilleures Séries</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='series-attendues'}" class="submenutxt" {if isset($submenu) && $submenu == 'wanted_series'}style="color:yellow;"{/if}>Séries les plus attendues</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='agenda-serie'}" class="submenutxt" {if isset($submenu) && $submenu == 'schedule_serie'}style="color:yellow;"{/if}>Agenda</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='liste-series'}" class="submenutxt" {if isset($submenu) && $submenu == 'list_serie'}style="color:yellow;"{/if}>Toutes les séries</a>
					</div>
				</div>
			{elseif $menu == 'dvd'}
	    		<div id="submenu_purple">
		    		<div id="submenu_center">
						<a href="{url alias='dvd-news'}" class="submenutxt" {if isset($submenu) && $submenu == 'dvd_news'}style="color:yellow;"{/if}>Actualités</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='meilleurs-dvd'}" class="submenutxt" {if isset($submenu) && $submenu == 'best_dvd'}style="color:yellow;"{/if}>Les meilleurs DVD/Blu-ray</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='dvd-attendus'}" class="submenutxt" {if isset($submenu) && $submenu == 'wanted_dvd'}style="color:yellow;"{/if}>DVD/Blu-ray bientôt en vente</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='liste-dvd'}" class="submenutxt" {if isset($submenu) && $submenu == 'list_dvd'}style="color:yellow;"{/if}>Tous les DVD/Blu-ray</a>
					</div>
				</div>
			{elseif $menu == 'tele'}
	    		<div id="submenu_orange">
		    		<div id="submenu_center">
						<a href="{url alias='actu-programme'}" class="submenutxt" {if isset($submenu) && $submenu == 'news_tele'}style="color:yellow;"{/if}>Actualités</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='programme-grandechaine'}" class="submenutxt" {if isset($submenu) && $submenu == 'program_tele'}style="color:yellow;"{/if}>Programme Grandes Chaînes</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='programme-grandechaine' type='tnt'}" class="submenutxt" {if isset($submenu) && $submenu == 'program_tele2'}style="color:yellow;"{/if}>Programme TNT</a>
		    			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{url alias='programme-grandechaine' type='cable'}" class="submenutxt" {if isset($submenu) && $submenu == 'program_tele3'}style="color:yellow;"{/if}>Programme du Cable</a>
					</div>
				</div>
			{/if}
    	</div>
    	<div id="main">
	    	{include file=$model}
		</div>
		<div class="copyright">
        	<span style="color:gray">
			<br/><br/>
            &copy;copyright venus-framework.com 2013-2014<br/>
            Toute reproduction partielle ou complète est interdite
          	</span>
      		<br/>&nbsp;
		</div>
    </body>
</html>
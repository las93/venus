{* version=2; *}
<!DOCTYPE HTML>
<html>
    <head>
        <script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="/js/cookie.js"></script>
        <link rel="stylesheet" href="/css/style.css"/>
        <title>{if isset($title)}{$title}{else}iScreenway : Cinéma, Séries TV, Stars, Vidéos et DVD{/if}</title>
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
		<script type="text/javascript">
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-43697315-1', 'iscreenway.com');
		  ga('send', 'pageview');
		</script>
		<script type="text/javascript">
		$( document ).ready(function() {
			var left_style = $(window).width() / 2 + 500;
			$("#menuright").css('left', left_style);
			{if $menu == 'cinema'}
			$("#menuright").css('background-color', '#D42020');
			{elseif $menu == 'serie'}
			$("#menuright").css('background-color', '#20D48C');
			{elseif $menu == 'dvd'}
			$("#menuright").css('background-color', '#DF01D7');
			{elseif $menu == 'tele'}
			$("#menuright").css('background-color', '#FE642E');
			{/if}
			{literal}
			if ($.cookie('usertoken')) {
				jQuery("#divcompte").html("salut "+$.cookie('user')+"<b"+"r/><b"+"r/><a"+" href='{/literal}{url alias='mon-compte'}{literal}'>Mon compte</a> &nbsp;&nbsp;<span style='color:blue'>|</span>&nbsp;&nbsp; <a href='{/literal}{url alias='deconnexion'}{literal}'>Deconnexion</a>");
			}
			{/literal}
		});
		</script>
    </head>
    <body>
    	<div id="top">
    		<div id="menu">
				<div id="logo"><img src="/img/logo-iscreenway{if $menu == 'cinema'}2{elseif $menu == 'serie'}3{elseif $menu == 'dvd'}4{elseif $menu == 'tele'}5{/if}.png" alt="Logo iScreenway" title="Logo iScreenway"/></div>
				<div class="menu_top{if $menu == 'home'}_select menu_top_select_blue{/if}"><a href="{url alias='home'}">Accueil</a></div>
				<div class="menu_top{if $menu == 'cinema'}_select menu_top_select_red{/if}"><a href="{url alias='cinema'}">Cinéma</a></div>
				<div class="menu_top{if $menu == 'serie'}_select menu_top_select_green{/if}"><a href="{url alias='series'}">Séries TV</a></div>
				<div class="menu_top{if $menu == 'dvd'}_select menu_top_select_purple{/if}"><a href="{url alias='dvd'}">DVD/Blu-ray</a></div>
				<div class="menu_top{if $menu == 'tele'}_select menu_top_select_orange{/if}"><a href="{url alias='programme-tv'}">Télévision</a></div>
				<div class="menu_top" style="width:140px;padding-top:7px;text-align:right;border-right:0;font-size:9px;" id="divcompte">
					<b><a href="{url alias="creer-compte"}" style="text-decoration:none;color:white;">Inscription</a></b> | <b><a href="{url alias="connexion"}" style="text-decoration:none;color:white;">Compte</a></b>
				</div>
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
    		<div id="pub_banniere">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- 728 x 90 -->
			<ins class="adsbygoogle"
			     style="display:inline-block;width:728px;height:90px"
			     data-ad-client="ca-pub-1464093566453217"
			     data-ad-slot="3993016883"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
    		</div>
	    	{include file=$model}
 		<div id="contentbottom">
                        <h4 style="color:#BBBBFF;font-size:24px;text-align:left;margin-bottom:5px;margin-left:10px;">Plan du site</h4>
                        <div class="contentbottomdivbysix" style="margin-left:10px;">
                                        <a href="{url alias='cinema'}" style="color:gray;font-weight:bold;tex-decoration:none;font-size:18px;">Cinéma</a><br/>                                       <a href="{url alias='bande-annonce-cinema'}" style="color:gray;font-weight:normal;">Bandes-Annonces</a><br/>
                                        <a href="{url alias='meilleurs-films'}" style="color:gray;font-weight:normal;">Meilleurs Films</a><br/>
                                        <a href="{url alias='film-a-affiche'}" style="color:gray;font-weight:normal;">Films à l'affiche</a><br/>
                                        <a href="{url alias='agenda-film'}" style="color:gray;font-weight:normal;">Agenda Cinéma</a><br/>
                                        <a href="{url alias='box-office'}" style="color:gray;font-weight:normal;">Box Office</a><br/>
                                        <a href="{url alias='liste-court-metrage'}" style="color:gray;font-weight:normal;">Court Métrage</a><br/>
                                        <a href="/cinema/genre/3/animation/" style="color:gray;font-weight:normal;">Films pour Enfants</a><br/>
                                        <a href="{url alias='actu-film'}" style="color:gray;font-weight:normal;">Actualités cinéma</a><br/>
                                        <a href="{url alias='liste-film'}" style="color:gray;font-weight:normal;">Liste des films</a><br/>
                        </div>
                        <div class="contentbottomdivbysix">
                                        <a href="{url alias='series'}" style="color:gray;font-weight:bold;tex-decoration:none;font-size:18px;">Séries TV</a><br/>
                                        <a href="{url alias='meilleures-series'}" style="color:gray;font-weight:normal;">Meilleures Séries</a><br/>
                                        <a href="{url alias='series-attendues'}" style="color:gray;font-weight:normal;">Séries les plus attendues</a><br/>
                                        <a href="{url alias='agenda-serie'}" style="color:gray;font-weight:normal;">Agenda séries</a><br/>
                                        <a href="{url alias='actu-series'}" style="color:gray;font-weight:normal;">Actualités séries TV</a><br/>
                                        <a href="{url alias='liste-series'}" style="color:gray;font-weight:normal;">Toutes les séries</a><br/>
                                        <a href="{url alias='bande-annonce-serie'}" style="color:gray;font-weight:normal;">Bandes-Annonces séries</a><br/>
                        </div>
                        <div class="contentbottomdivbysix">
                                        <a href="{url alias='dvd'}" style="color:gray;font-weight:bold;tex-decoration:none;font-size:18px;">DVD/Bluray</a><br/>
                                        <a href="{url alias='meilleurs-dvd'}" style="color:gray;font-weight:normal;">Meilleurs DVD/Bluray</a><br/>
                                        <a href="{url alias='dvd-news'}" style="color:gray;font-weight:normal;">Actualités DVD/Bluray</a><br/>
                                        <a href="{url alias='liste-dvd'}" style="color:gray;font-weight:normal;">Lites DVD/Bluray</a><br/>
                                        <a href="{url alias='dvd-attendus'}" style="color:gray;font-weight:normal;">DVD/Bluray attendus</a><br/>
                        </div>
                        <div class="contentbottomdivbysix">
                                        <a href="{url alias='programme-tv'}" style="color:gray;font-weight:bold;tex-decoration:none;font-size:18px;">Programme TV</a><br/>
                                        <a href="{url alias='actu-programme'}" style="color:gray;font-weight:normal;">Actualités TV</a><br/>
                                        <a href="{url alias='programme-grandechaine'}" style="color:gray;font-weight:normal;">Programme Complet</a><br/>
                                        <a href="{url alias='programme-grandechaine' type='tnt'}" style="color:gray;font-weight:normal;">Programme TNT</a><br/>
                                        <a href="{url alias='programme-grandechaine' type='cable'}" style="color:gray;font-weight:normal;">Programme Satellite</a><br/>
                                        <a href="{url alias='meilleurs-programme-tv'}" style="color:gray;font-weight:normal;">Top des programmes</a><br/>
                        </div>
                        <div class="contentbottomdivbysix">
                                        <span style="color:gray;font-weight:bold;tex-decoration:none;font-size:18px;">Autres</span><br/>
                                        <a href="{url alias='bande-annonce'}" style="color:gray;font-weight:normal;">Bandes-Annonces</a><br/>
                                        <a href="{url alias='actu'}" style="color:gray;font-weight:normal;">Actualités</a><br/>
                                        <a href="{url alias='dossier'}" style="color:gray;font-weight:normal;">Dossiers complets</a><br/>
                                <a href="{url alias='acteurs'}" style="color:gray;font-weight:normal;">Stars</a><br/>
                        </div>
                        <div class="contentbottomdivbysix">
                                <a href="{url alias='service'}" style="color:gray;font-weight:bold;tex-decoration:none;font-size:18px;">Sur le site</a><br/>
                                <a href="{url alias='contact'}" style="color:gray;font-weight:normal;">Contactez-nous</a><br/>
                                <a href="{url alias='a-propos'}" style="color:gray;font-weight:normal;">A propos d'iScreenway</a><br/>
                                <a href="{url alias='actu-site'}" style="color:gray;font-weight:normal;">Actualités iScreenway</a><br/>
                                <a href="{url alias='recrute'}" style="color:gray;font-weight:normal;">iScreenway recrute</a><br/>
                                <a href="{url alias='ads'}" style="color:gray;font-weight:normal;">Publicité/annonceur</a><br/>
                                <a href="{url alias='cgu'}" style="color:gray;font-weight:normal;">C.G.U.</a><br/>
                                <a href="{url alias='confidentialite'}" style="color:gray;font-weight:normal;">Charte de confidentialité</a><br/>
                        </div>
                </div>
	</div>
<div class="copyright">
                                <span style="color:gray">
					<br/><br/>
                                        &copy;copyright iScreenway.com 2013-2014<br/>
                                        Toute reproduction partielle ou complète est interdite
                                </span>
                                <br/>&nbsp;
                        </div>

	    <div id="menuright" style="display:none;">
	    TTT
		</div>
    </body>
</html>
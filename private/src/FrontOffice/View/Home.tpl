<div id="left">
	<div id="title" style="width:600px;margin-top:0px;">
		<h1>iScreenway, le site web du ciné, des séries et des DVD</h1>
		<h3>Retrouvez les meilleurs <a href="{url 'actu'}">news</a>, <a href="{url 'dossier'}">dossiers</a> et les dernières <a href="{url 'bande-annonce'}">bandes-annonces</a> sur iScreenway</h3>
	</div>
	{include 'Mea.tpl'}
	{include $tpl_last_trailers}
</div>
<div id="pub" style="margin-top:2px;">
	{include 'Pub300x600.tpl'}
</div>
	<div class="megacadre2">
		<div class="demicadre">
			<h2>Les sorties cinéma de la semaine</h2>
			{foreach $movies_week as $iKey => $oMovieOfWeek}
				{$oMovie assign $oMovieOfWeek}
				{include $tpl_one_movie}
			{/foreach}
			<div class="liendemicadre">
				<br/>&gt; <a href="{url 'film-de-la-semaine'}">Tous les films de la semaine</a>
			</div>
		</div>
		<div class="demicadre">
			<h2>Films à l'affiche</h2>
			{foreach $movies_4week as $iKey => $oMovieOfWeek}
				{if $iKey < 3}
					{$oMovie assign $oMovieOfWeek}
					{include $tpl_one_movie}
				{else}
				{/if}
			{/foreach}
			<div class="liendemicadre">
				<br/>&gt; <a href="{url 'film-a-affiche'}">Tous les films à l'affiche</a>
			</div>
		</div>
		<div class="demicadre">
			<h2>Les films les plus attendus</h2>
			{foreach $wanted_movies as $iKey => $oWantedMovie}
				{if $iKey == 0}
					{$iMovie assign $iKey+1}
					{$oMovie assign $oWantedMovie}
					{include $tpl_one_movie}
				{else}
					<div class="liendemicadre" style="margin-top:10px;">
						{$iKey+1}. <a href="{$oWantedMovie->url}">{$oWantedMovie->get_title()}</a>
					</div>
				{/if}
			{/foreach}
			<div class="liendemicadre">
				<br/>&gt; <a href="{url 'films-attendus'}">Tous les films attendus</a>
			</div>
		</div>
		<div class="liencadre" style="width:100%">
			<br/>Voir aussi : <a href="{url 'critique-liste-film'}">Les meilleurs films selon les spectateurs</a> | <a href="{url 'box-office'}">Box-Office</a> | <a href="{url 'agenda-film'}">Agenda</a> | <a href="{$url_enfant}">Films pour enfants</a> | <a href="{url 'liste-film'}">Tous les films</a> | <a href="{url 'acteurs'}">Toutes les stars</a>
		</div>
	</div>

	<!-- 3 cadres -->
	<div class="megacadre" style="background-color:transparent;padding:0px;margin-left:0px;width:100%">
		<div class="cadre_solo_tier" style="height:950px;">
			<h2>Les meilleures séries TV</h2>
			<div class="cadre_dans_cadre_solo_tier">
				{foreach $best_series as $iKey => $oBestMovie}
					{if $iKey == 0}
						{$iMovie assign $iKey+1}
						{$oMovie assign $oBestMovie}
						{include $tpl_one_movie}
					{else}
						<div class="liendemicadre" style="margin-top:10px;">
							{$iKey+1}. <a href="{$oBestMovie->url}">{$oBestMovie->get_title()}</a>
						</div>
					{/if}
				{/foreach}
			</div>
			<div class="cadre_dans_cadre_solo_tier">
				<br/>
				| <a href="{url 'series-les-plus-vues'}">Séries les plus consultées</a>
	 			| <a href="{url 'meilleures-series'}">Meilleures Séries</a> |
	 			<br/>&nbsp;<br/>&nbsp;
			</div>
			<h2>Séries à la TV en ce moment</h2>
			<div class="cadre_dans_cadre_solo_tier">
				{foreach $serie_tv as $oProgram}
					<img src="/img/logo_{$oProgram->get_id_channel()}.jpg" alt="{$oProgram->get_channel()->get_name() addslashes}" title="{$oProgram->get_channel()->get_name() addslashes}" width="20" /> &nbsp;
					<span style="color:#777777;font-size:10px;"><b>{$oProgram->get_start() hour} - {$oProgram->get_end() hour}</b></span>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="{$oProgram->record->url}"><span style="font-size:12px;"><b>{$oProgram->record->get_title()}</b></span></a><br/><br/>
				{/foreach}
			</div>
			<div class="cadre_dans_cadre_solo_tier">
				| <a href="{url 'programme-tv'}">Programme TV complet</a> |
	 			<a href="{url 'liste-series'}">Toutes les séries</a> |
			</div>
		</div>

		<div class="cadre_solo_tier" style="height:950px;">
			<h2>Actualités</h2>
			<div class="cadre_dans_cadre_solo_tier">
			{foreach $news['news'] as $iKey => $oNews}
				<b>Actualités du {$iKey}</b>
				{foreach $oNews as $iKey2 => $oNews2}
						<div class='imgnew'><a href="{$oNews2->url}"><img src="{$oNews2->image}" alt="{$oNews2->get_title() addslashes}" title="{$oNews2->get_title() addslashes}" border="0" width="290"/></a></div>
						<div style="margin:0px;">
							<a href="{$oNews2->url}"><b>{$oNews2->get_title()}</b></a><br/>
						</div>
				{/foreach}
			{/foreach}
			<br/>
			</div>
			<div class="cadre_dans_cadre_solo_tier">
				| <a href="{url 'actu'}">Toute l'actualité</a> |
				<a href="{url 'dossier'}">Nos dossiers spéciaux</a> |
			</div>
		</div>

		<div class="cadre_solo_tier" style="height:950px;">
			<div class="cadre_dans_cadre_solo_tier">
				<h2>Films à la TV en ce moment</h2>
			<div class="cadre_dans_cadre_solo_tier">
				{foreach $film_tv as $oProgram}
					<img src="/img/logo_{$oProgram->get_id_channel()}.jpg" alt="{$oProgram->get_channel()->get_name() addslashes}" title="{$oProgram->get_channel()->get_name() addslashes}" width="20"/> &nbsp;
					<span style="color:#777777;font-size:10px;"><b>{$oProgram->get_start() hour} - {$oProgram->get_end() hour}</b></span>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="{$oProgram->record->url}"><span style="font-size:12px;"><b>{$oProgram->record->get_title()}</b></span></a>
					{if $oProgram->record->get_review()}
						<br/>
						{if $oProgram->record->get_score() > 0.5}<img src="/img/star.png">{elseif $oProgram->record->get_score() > 0}<img src="/img/starD.png" alt="etoile" title="etoile" />{else}<img src="/img/starS.png" alt="etoile" title="etoile" />{/if}
						{if $oProgram->record->get_score() > 1.5}<img src="/img/star.png">{elseif $oProgram->record->get_score() > 1}<img src="/img/starD.png" alt="etoile" title="etoile" />{else}<img src="/img/starS.png" alt="etoile" title="etoile" />{/if}
						{if $oProgram->record->get_score() > 2.5}<img src="/img/star.png">{elseif $oProgram->record->get_score() > 2}<img src="/img/starD.png" alt="etoile" title="etoile" />{else}<img src="/img/starS.png" alt="etoile" title="etoile" />{/if}
						{if $oProgram->record->get_score() > 3.5}<img src="/img/star.png">{elseif $oProgram->record->get_score() > 3}<img src="/img/starD.png" alt="etoile" title="etoile" />{else}<img src="/img/starS.png" alt="etoile" title="etoile" />{/if}
						{if $oProgram->record->get_score() > 4.5}<img src="/img/star.png">{elseif $oProgram->record->get_score() > 4}<img src="/img/starD.png" alt="etoile" title="etoile" />{else}<img src="/img/starS.png" alt="etoile" title="etoile" />{/if}
					{/if}
					<br/><br/>
				{/foreach}
			</div>
			<div class="cadre_dans_cadre_solo_tier">
				| <a href="{url 'programme-tv'}">Programme TV complet</a> |
	 			<a href="{url 'liste-series'}">Toutes les séries</a> |
	 			<br/><br/>
	 			{include 'Pub300x250.tpl'}
			</div>
			</div>
		</div>

	</div>

	<!-- 3 cadres -->

	<div class="megacadre" style="background-color:transparent;padding:0px;margin-left:0px;width:100%">
		<div class="cadre_solo_tier" style="height:150px;">
			<h2>Pourquoi rejoindre iScreenway</h2>
			<img src="img/partage.jpg" style="float:left;" alt="partage iscreenway" title="partage iscreenway"/><b>Partagez</b> vos avis et commentaires<br/><br/>
			N'attendez plus, c'est totalement gratuit de s'inscrire sur iScreenway :<br/>
			<a href="{url 'creer-compte'}">Créer mon compte maintenant !!!</a>
		</div>
		<div class="cadre_solo_tier" style="height:150px;">
			<h2>Critiques de films et séries TV</h2>
			Découvrez la critique du jour :<br/><br/>
		</div>
		<div class="cadre_solo_tier" style="height:150px;">
			<h2>Les derniers concours :</h2>
		</div>
	</div>

	<div class="megacadre" style="background-color:transparent;padding:0px;">
		<h2>iScreenway partout avec vous</h2>
		<div class="megacadre_division_par4" style="text-align:center;height:200px;">
			<h2>Par email</h2>
			<img src="/img/email.jpg" alt="email iscreenway" title="email iscreenway"/><br/><br/>
			<b><span style="color:blue;">iScreenway Actu</span></b><br/>
			Recevez notre Newsletter
		</div>
		<div class="megacadre_division_par4" style="text-align:center;height:200px;">
			<h2>Sur mobile</h2>
			<img src="/img/smartphone.jpg" alt="smartphone iscreenway" title="smartphone iscreenway"/><br/><br/>
			<b><span style="color:blue;">iScreenway sur Mobile</span></b><br/>
			Site Web pour Smartphone<br/><br/>
			<b><span style="color:blue;">iScreenway en App</span></b><br/>
			App Android/iOS
		</div>
		<div class="megacadre_division_par4" style="text-align:center;height:200px;">
			<h2>Sur réseaux</h2>
			<img src="/img/reseaux-sociaux.jpg" alt="réseaux sociaux iscreenway" title="réseauc sociaux iscreenway"/><br/><br/>
			<b><span style="color:blue;">iScreenway est social</span></b><br/>
			Présent sur Facebook, Twitter, Google+
		</div>
		<div class="megacadre_division_par4" style="margin-right:0px;text-align:center;height:200px;">
			<h2>Podcasts et Rss</h2>
			<img src="/img/podcast.jpg" alt="podcast iscreenway" title="podcast iscreenway"/><br/><br/>
			<b><span style="color:blue;">iScreenway sur Podcast et Rss</span></b><br/>
			Choisissez tous vos chaînes
		</div>
	</div>



<div id="title">
	<h1>Les séries TV, les épisodes et saisons, les actualités, les dossiers</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'series'}">Séries TV</a>
</div>
<div id="left">
	{include 'Mea.tpl'}
	<div class="grandcadre">
		<div class="demicadre">
			<h2>Les meilleurs séries TV</h2>
			{foreach $best_movies as $iKey => $oBestMovie}
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
			<div class="liendemicadre">
				<br/>&gt; <a href="{url 'meilleures-series'}">Toutes les meilleures séries TV</a>
			</div>
		</div>
		<div class="demicadre">
			<h2>Les actualités séries TV</h2>
			{foreach $news['news'] as $iKey => $oNews}
				<b>Actualités du {$iKey}</b>
				{foreach $oNews as $iKey2 => $oNews2}
						<div id='imgnew'><a href="{$oNews2->url}"><img src="/images/article_{$oNews2->get_id()}.jpg" border="0" width="290"/></a></div>
						<div id='contentnews'>
							<a href="{$oNews2->url}"><b>{$oNews2->get_title()}</b></a><br/>
						</div>
				{/foreach}
			{/foreach}
			<div class="liencadre">
				<br/>&gt; <a href="{url 'actu-series'}">Toutes les actualités de séries TV</a>
			</div>
		</div>
	</div>
	<div class="grandcadre">
		<div class="demicadre">
			<h2>Séries à la télévision aujourd'hui</h2>
			<div class="cadre_dans_cadre_solo_tier">
				{foreach $serie_tv as $oProgram}
					<img src="/img/logo_{$oProgram->get_id_channel()}.jpg" width="20">&nbsp;&nbsp;
					<span style="color:#777777;font-size:10px;"><b>{$oProgram->get_start() hour} - {$oProgram->get_end() hour}<b></span>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="{$oProgram->record->url}"><span style="font-size:12px;"><b>{$oProgram->record->get_title()}<b></span></a><br/><br/>
				{/foreach}
			</div>
			<div class="liencadre">
				<br/>&gt; <a href="{url 'series-du-jour'}">Toutes les séries TV du jour</a>
			</div>
		</div>
		<div class="demicadre">
			<h2>Les séries TV les plus attendus</h2>
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
				<br/>&gt; <a href="{url 'series-attendus'}">Toutes les séries TV attendues</a>
			</div>
		</div>
	</div>
	{include $tpl_last_trailers}
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>
	<div class="megacadre">
		<div class="cadre_solo_tier">
			<h2>Tous les genres de séries</h2>
			{foreach $kinds as $oKind}
				<div class="quartcadre"><a href="{$oKind->url}">{$oKind->get_name()}</a></div>
			{/foreach}
		</div>
		<div class="cadre_solo_tier">
			<h2>Tous les années de films</h2>
			Depuis 2010<br/>
			De 2000 à 2010<br/>
			De 1990 à 2000<br/>
			De 1980 à 1990<br/>
			De 1970 à 1980<br/>
			De 1960 à 1970<br/>
			De 1950 à 1960<br/>
			De 1940 à 1950<br/>
			avant 1940<br/>
		</div>
		<div class="cadre_solo_tier">
			<h2>Box-Office</h2>
			-- BIENTOT DISPONIBLE --
		</div>
	</div>




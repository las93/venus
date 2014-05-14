<div id="title">
	<h1>Le cinéma, ces bande annonces, ces actualités, ces dossiers</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'cinema'}">Cinéma</a>
</div>
<div id="left">
	{include 'Mea.tpl'}

	<div class="grandcadre">
		<h2>Les sorties cinéma de la semaine</h2>
		{foreach $movies_week as $iKey => $oMovieOfWeek}
			{$oMovie assign $oMovieOfWeek}
			{include $tpl_one_movie2}
		{/foreach}
		<div class="liencadre">
			<br/>&gt; <a href="{url 'film-de-la-semaine'}">Tous les films de la semaine</a>
		</div>
	</div>

</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>
	<div class="megacadre">
		<div class="demicadre">
			<h2>Films à l'affiche</h2>
			{foreach $movies_4week as $iKey => $oMovieOfWeek}
				{if $iKey < 3}
					{$oMovie assign $oMovieOfWeek}
					{include $tpl_one_movie}
				{else}
				{/if}
			{/foreach}
			<div class="liencadre">
				<br/>&gt; <a href="{url 'film-de-la-semaine'}">Tous les films de la semaine</a>
			</div>
		</div>
		<div class="demicadre">
			<h2>Les actualités cinéma</h2>
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
				<br/>&gt; <a href="{url 'actu-film'}">Toutes les actualités de film</a>
			</div>
		</div>
		<div class="demicadre" style="margin-left:10px;">
			<h2>Les meilleurs films</h2>
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
				<br/>&gt; <a href="{url 'meilleurs-films'}">Tous les meilleurs films</a>
			</div>
		</div>
	</div>
	<div class="megacadre">
		{include $tpl_last_trailers}
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
	</div>

	<div class="megacadre">
		<div class="cadre_solo_tier">
			<h2>Tous les genres de films</h2>
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

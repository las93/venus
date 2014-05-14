<div id="title">
	<h1>Les meilleurs film selon les spectateurs</h1>
	<h3>Retrouvez toutes les meilleurs film selon les spectateurs sur iScreenway</h3>
</div>
<div id="left">
	<div class="grandcadre">
		<h2>Les sorties cinéma de la semaine</h2>
		{foreach $movies_week as $iKey => $oMovieOfWeek}
			{$oMovie assign $oMovieOfWeek}
			{include $tpl_one_movie}
		{/foreach}
	</div>
	<div class="grandcadre">
		{if $movies_week[0]->pages > 1}
			| {loop $movies_week[0]->pages} <a href="{url 'dvd-page' 'page' as $i}">{$loop}</a> |{/loop}
		{else}
			-- Aucune page complémentaire --
		{/if}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


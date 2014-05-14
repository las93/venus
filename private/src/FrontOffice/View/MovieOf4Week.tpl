<div id="title">
	<h1>Les films du moment au cinéma</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'cinema'}">Cinéma</a>
	&gt; <a href="{url 'film-a-affiche'}">Films à l'affiche</a>
</div>
<div id="left">
	<div class="grandcadre">
		<h2>Les sorties cinéma du moment</h2>
		{foreach $movies_week as $iKey => $oMovieOfWeek}
			{$oMovie assign $oMovieOfWeek}
			{include $tpl_one_movie}
		{/foreach}
	</div>
	<div class="grandcadre" style="text-align:center;">
		{if $movies_week[0]->pages > 1}
			&lt;&lt; <a href="{$url}">Début</a>
			| {loop $movies_week[0]->pages}
				{if $i != $movies_week[0]->pages}
					{if $i > 0}
						{if $i > $app['get']['offset'] - 10}
							{if $i < $app['get']['offset'] + 10}
								<a href="{$url}{$i}">{$loop}</a> |
							{/if}
						{/if}
					{/if}
				{/if}
			{/loop}
			<a href="{$url}{$movies_week[0]->pages}">Fin</a> &gt;&gt;
		{else}
			-- Aucune page complémentaire --
		{/if}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


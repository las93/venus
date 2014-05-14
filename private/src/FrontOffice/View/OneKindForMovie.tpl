<div id="title">
	<h1>Tous les films {$kind->get_name()}</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'cinema'}">Cinéma</a>
	&gt; Genre
	&gt; <a href="{$actual_url}">{$kind->get_name()}</a>
</div>
<div id="left">
	<div class="grandcadre">
		<h2>Films {$kind->get_name()}</h2>
		{foreach $movies_by_kind as $iKey => $oMovieOfWeek}
			{$oMovie assign $oMovieOfWeek}
			{include $tpl_one_movie}
		{/foreach}
	</div>

		<div class="grandcadre" style ="text-align:center;">
		{if $movies_by_kind[0]->pages > 1}
			&lt;&lt; <a href="{$url}">Début</a>
			| {loop $movies_by_kind[0]->pages}
				{if $i != $movies_by_kind[0]->pages}
					{if $i > 1}
						{if $i > $app['get']['offset'] - 10}
							{if $i < $app['get']['offset'] + 10}
								<a href="{$url}{$i}">{$loop}</a> |
							{/if}
						{/if}
					{/if}
				{/if}
			{/loop}
			<a href="{$url}{$movies_by_kind[0]->pages}">Fin</a> &gt;&gt;
		{else}
			-- Aucune page complémentaire --
		{/if}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


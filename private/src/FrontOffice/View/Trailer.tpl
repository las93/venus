<div id="title">
	<h1>{$title}</h1>
	<a href="{url 'home'}">iScreenway</a>
	{if $type == 'cinema'}
		&gt; <a href="{url 'cinema'}">Cinéma</a>
		&gt; <a href="{url 'bande-annonce-cinema'}">Bandes-annonces</a>
	{elseif $type == 'serie'}
		&gt; <a href="{url 'series'}">Séries TV</a>
		&gt; <a href="{url 'bande-annonce-serie'}">Bandes-annonces</a>
	{else}
		&gt; <a href="{url 'bande-annonce'}">Bandes-annonces</a>
	{/if}
</div>
<div id="left">
	<div class="grandcadre">
		<h2>Les dernières bandes-annonces</h2>
		{foreach $last_trailers as $oTrailer}
		<div class="bacadre" style="height:150px">
			<a href="{$oTrailer->url}"><img src="/images/trailer_{$oTrailer->get_id()}.jpg" border="0"/><br/>
			<span style="color:black;">{$oTrailer->get_title()}</span></a>
		</div>
		{/foreach}
	</div>
	<div class="grandcadre" style ="text-align:center;">
		{if $last_trailers[0]->pages > 1}
			&lt;&lt; <a href="{$url}">Début</a>
			| {loop $last_trailers[0]->pages}
				{if $i != $last_trailers[0]->pages}  
					{if $i > 0}
						{if $i > $app['get']['offset'] - 10}
							{if $i < $app['get']['offset'] + 10}
								<a href="{$url}{$i}">{$loop}</a> |
							{/if}
						{/if}
					{/if}
				{/if}
			{/loop}
			<a href="{$url}{$last_trailers[0]->pages}">Fin</a> &gt;&gt;
		{else}
			-- Aucune page complémentaire --
		{/if}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


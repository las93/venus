<div id="title">
	{if $record->get_type() == 'serie'}
		<h1>Actualités {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'series'}">Séries TV</a>
		&gt; <a href="{url 'liste-series'}">liste des séries TV</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_casting}">Actualités</a>
	{else}
		<h1>Actualités {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'cinema'}">Cinéma</a>
		&gt; <a href="{url 'liste-film'}">Liste des films</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_casting}">Actualités</a>
	{/if}
</div>
<div id="left">
	{include $tpl_record_menu}
	<div class="grandcadre">
		<h2>Les actualités de {$record->get_title()}</h2>
			{foreach $news as $iKey2 => $oNews2}
					{if $iKey2 < 1}
						<div class='imgnew2'><a href="{$oNews2->url}">
							<a href="{$oNews2->url}"><img src="/images/article_{$oNews2->get_id()}.jpg" alt="{$oNews2->get_title() addslashes}" title="{$oNews2->get_title() addslashes}" border="0" width="600"/></a><br/>
							<a href="{$oNews2->url}"><b>{$oNews2->get_title()}</b></a><br/>
							{truncate $oNews2->get_content() 100}</b><br/><br/><br/>
						</div>
					{else}
						<div class="demicadre" style="margin-bottom:20px;">
							<div class='imgnew'><a href="{$oNews2->url}"><img src="/images/article_{$oNews2->get_id()}.jpg" alt="{$oNews2->get_title() addslashes}" title="{$oNews2->get_title() addslashes}" border="0" width="300"/></a></div>
							<div class='contentnews'>
								<a href="{$oNews2->url}"><b>{$oNews2->get_title()}</b></a><br/>
								{truncate $oNews2->get_content() 100}</b>
							</div>
						</div>
					{/if}
			{/foreach}
	</div>
	<div class="grandcadre" style ="text-align:center;">
		{if $news[0]->pages > 1}
			&lt;&lt; <a href="{$url}">Début</a>
			| {loop $news[0]->pages}
				{if $i != $news[0]->pages}
					{if $i > 1}
						{if $i > $app['get']['offset'] - 10}
							{if $i < $app['get']['offset'] + 10}
								<a href="{url 'dvd-page'}{$i}">{$loop}</a> |
							{/if}
						{/if}
					{/if}
				{/if}
			{/loop}
			<a href="{$url}{$news[0]->pages}">Fin</a> &gt;&gt;
		{else}
			-- Aucune page complémentaire --
		{/if}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


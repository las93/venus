<div id="title">
	{if $record->get_type() == 'serie'}
		<h1>Photos {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'series'}">Séries TV</a>
		&gt; <a href="{url 'liste-series'}">liste des séries TV</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_photo}">Photos</a>
	{else}
		<h1>Photos {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'cinema'}">Cinéma</a>
		&gt; <a href="{url 'liste-film'}">Liste des films</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_photo}">Photos</a>
	{/if}
</div>
<div id="left">
	{include $tpl_record_menu}
	<div class="grandcadre">
		<h2>Les photos de {$record->get_title()}</h2>
			{foreach $photos as $iKey2 => $oPhoto}
				<div class='imgnew2'><a href="{$oPhoto->url}">
					<a href="{$oPhoto->url}"><img src="/images/photo_{$oPhoto->get_id()}.jpg" border="0" width="600" alt="{$oPhoto->get_title() addslashes}" title="{$oPhoto->get_title() addslashes}"/></a><br/>
					<a href="{$oPhoto->url}"><b>{$oPhoto->get_title()}</b></a><br/>
				</div>
			{/foreach}
	</div>
	<div class="grandcadre" style ="text-align:center;">
		{if $photos[0]->pages > 1}
			&lt;&lt; <a href="{$url}">Début</a>
			| {loop $photos[0]->pages}
				{if $i != $photos[0]->pages}
					{if $i > 1}
						{if $i > $app['get']['offset'] - 10}
							{if $i < $app['get']['offset'] + 10}
								<a href="{url 'dvd-page'}{$i}">{$loop}</a> |
							{/if}
						{/if}
					{/if}
				{/if}
			{/loop}
			<a href="{$url}{$photos[0]->pages}">Fin</a> &gt;&gt;
		{else}
			-- Aucune page complémentaire --
		{/if}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


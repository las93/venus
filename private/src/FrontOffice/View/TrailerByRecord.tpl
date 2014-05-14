<div id="title">
	{if $record->get_type() == 'serie'}
		<h1>Vidéos de {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'series'}">Séries TV</a>
		&gt; <a href="{url 'liste-series'}">liste des séries TV</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_ba}">Bande-annonce</a>
	{else}
		<h1>Bandes-annonces de {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'cinema'}">Cinéma</a>
		&gt; <a href="{url 'liste-film'}">Liste des films</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_ba}">Bande-annonce</a>
	{/if}
</div>
<div id="left">
	{include $tpl_record_menu}
	<span itemscope itemtype="http://www.schema.org/VideoObject">
	<meta itemprop="name" content="{$trailer->get_title()}" />
	<iframe width="630" height="358" src="{$trailer->get_link()}" frameborder="0" allowfullscreen></iframe>
	<meta itemprop="duration" content="PT38S" />
	<meta itemprop="thumbnail" content="http://www.iscreenway.com/images/trailer_{$trailer->get_id()}.jpg" />
	<meta itemprop="embedURL" content="http://www.iscreenway.com/{$app['environment']['REQUEST_URI']}" />
	<meta itemprop="width" content="630" />
	<meta itemprop="height" content="358" />
	<meta itemprop="playerType" content="Flash" />
	</span>
	<br/>
	{include $tpl_last_trailers}
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


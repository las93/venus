<div id="title">
	<h1>Toutes les saisons de {$record->get_title()}</h1>
	<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'series'}">Séries TV</a>
		&gt; <a href="{url 'liste-series'}">Liste des séries TV</a>
	&gt; <a href="{$url_film}">{$record->get_title()}</a>
	&gt; <a href="{$url_film_episodes}">Saisons</a>
</div>
<div id="left">
	{include $tpl_record_menu}
	<div class="grandcadre">
		<h2>Les saisons de {$record->get_title()}</h2>
		{foreach $seasons as $key => $one} 
			<p style="border-bottom:1px solid #BBBBBB;" itemscope itemtype="http://www.schema.org/TVSeason">
				<b style="font-size:18px;" itemprop="numberofEpisodes" content="{$key}"><span itemprop="name">Season {$key}</span></b><br/>
				<a href="{$url_film_episodes}{$key}">{$one} épisodes</a><br/>
				&nbsp;
			</p>
		{/foreach}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


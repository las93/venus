<div id="title">
	<h1>Episodes de la saison {$season} de {$record->get_title()}</h1>
	<a href="{url 'home'}">iScreenway</a> 
	&gt; <a href="{url 'series'}">Séries TV</a>
	&gt; <a href="{url 'liste-series'}">Liste des séries TV</a>
	&gt; <a href="{$url_film}">{$record->get_title()}</a>
	&gt; <a href="{$url_film_saisons}">Saisons</a>
	&gt; <a href="{$url_film_episodes}">Episodes</a>
</div>
<div id="left">
	{include $tpl_record_menu}
	<div class="grandcadre">
		<h2>Les saisons de {$record->get_title()}</h2>
		|
		{loop $max_season}
			<a href="{$url_film_saisons}{$i}">Saison {$i}</a> |
		{/loop}
		<br/>&nbsp;<br/>&nbsp;<br/>
		<h2>Episodes de la saison {$season} de {$record->get_title()}</h2>
		<table style="background-color:#BBBBBB;" cellspacing="1" cellpadding="5" width="100%">
		{foreach $seasons as $key => $one} 
			<tr>
				<td style="background-color:white;" width="25%">
					<b style="font-size:18px;">Episode {$one->get_episode()}</b>
				</td><td style="background-color:white;">
					<span itemscope itemtype="http://www.schema.org/TVEpisode"><span itemprop="episodeNumber" content="{$one->get_episode()}"><span itemprop="name">{$one->get_title()}</span></span></span>
				</td>
			</tr>
		{/foreach}
		</table>
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


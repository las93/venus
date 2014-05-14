<div id="title">
	{if $record->get_type() == 'serie'}
		<h1>Diffusions de la série {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'series'}">Séries TV</a>
		&gt; <a href="{url 'liste-series'}">Liste des séries TV</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_episodes}">Diffusions</a>
	{else}
		<h1>Diffusions du film {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'cinema'}">Cinéma</a>
		&gt; <a href="{url 'liste-film'}">Liste des films</a>
		&gt; <a href="{url 'url_film'}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_episodes}">Diffusions</a>
	{/if}
</div>
<div id="left">
	{include $tpl_record_menu}
	<div class="grandcadre">
		<h2>Les Diffusions de {$record->get_title()}</h2>
		{foreach $diffusions as $keyChannel => $channel}
			<table style="background-color:#BBBBBB;margin-bottom:5px;" cellspacing="1" cellpadding="5" width="100%">
			<tr> 
				<td>  
					<img src="/img/logo_{$channel[0]->get_id_channel()}.jpg" alt="{$keyChannel addslashes}" title="{$keyChannel addslashes}" style="border:solid 1px black;"> Tous les épisodes diffusés sur {$keyChannel}
					<table style="background-color:#BBBBBB;" cellspacing="1" cellpadding="5" width="100%">
						{foreach $channel as $key => $one} 
						<tr>
							<td style="background-color:white;" width="25%">
								<b>Saison {$one->get_season()} Episode {$one->get_episode()}</b>
							</td><td style="background-color:white;">
								{$one->get_start()} - {$one->get_end()}
							</td>
						</tr>
						{/foreach}
					</table>
				</td>
			</tr>
			</table>
		{/foreach}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


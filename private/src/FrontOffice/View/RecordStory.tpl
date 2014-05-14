<div id="title">
	{if $record->get_type() == 'serie'}
		<h1>Anecdotes et Secrets de tournage de {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'series'}">Séries TV</a>
		&gt; <a href="{url 'liste-series'}">liste des séries TV</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_story}">Anecdotes et Secrets de tournage</a>
	{else}
		<h1>Anecdotes et Secrets de tournage de {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'cinema'}">Cinéma</a>
		&gt; <a href="{url 'liste-film'}">Liste des films</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_story}">Anecdotes et Secrets de tournage</a>
	{/if}
</div>
<div id="left">
	{include $tpl_record_menu}
	<div class="grandcadre">
		<h2>Les anecdotes et secrets de tournage de de {$record->get_title()}</h2>
			{foreach $stories as $iKey => $oStory}
				<div class="imgnew2">
					<b>{$oStory->get_title()}</b><br/><br/>
					{$oStory->get_content()}</b><br/><br/><br/>
				</div>
			{/foreach}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


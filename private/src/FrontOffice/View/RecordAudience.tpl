<div id="title">
	{if $record->get_type() == 'serie'}
		<h1>Audiences {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'cinema'}">Cinéma</a>
		&gt; <a href="{url 'liste-film'}">Liste des films</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_episodes}">Audiences</a>
	{else}
		<h1>Audiences {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'cinema'}">Cinéma</a>
		&gt; <a href="{url 'liste-film'}">Liste des films</a>
		&gt; <a href="{url 'url_film'}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_episodes}">Audiences</a>
	{/if}
</div>
<div id="left">
	{include $tpl_record_menu}
	<div class="grandcadre">
		<h2>Les audiences de {$record->get_title()}</h2>
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


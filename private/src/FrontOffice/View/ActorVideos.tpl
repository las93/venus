<div id="title">
	<h1>Vidéos de {$actor->get_firstname()} {$actor->get_name()}</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'acteurs'}">Stars</a>
	&gt; <a href="{$url_star}">{$actor->get_firstname()} {$actor->get_name()}</a>
	&gt; <a href="{$url_video}">Vidéos</a>
</div>
<div id="left">
	{include $tpl_actor_menu}
	{include $tpl_last_trailers}
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


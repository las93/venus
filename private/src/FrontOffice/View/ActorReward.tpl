<div id="title">
	<h1>Récompenses obtenues par {$actor->get_firstname()} {$actor->get_name()}</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'acteurs'}">Stars</a>
	&gt; <a href="{$url_star}">{$actor->get_firstname()} {$actor->get_name()}</a>
	&gt; <a href="{$url_reward}">Récompenses</a>
</div>
<div id="left">
	{include $tpl_actor_menu}
	<div class="grandcadre">
		--BIENTOT DISPONIBLE--
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


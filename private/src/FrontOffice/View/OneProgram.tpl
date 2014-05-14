<div id="title">
	<h1>{$program->get_name()}</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'programme-tv'}">Programme TV</a>
	&gt; <a href="{$app['environment']['REQUEST_URI']}">{$program->get_name()}</a>
</div>
<div id="left">
	<div class="grandcadre">
		<h2>{$program->get_name()}</h2>
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>

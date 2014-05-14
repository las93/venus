<div id="title">
	<h1>Photo {$photo->get_title()}</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'cinema'}">Cinéma</a>
	&gt; <a href="{$app['environment']['REQUEST_URI']}">Photo {$photo->get_title()}</a>
</div>
<div id="left">
	<div class="grandcadre">
		<h2>Photo {$photo->get_title()}</h2>
		<img src="/images/photo_{$photo->get_id()}.jpg" border="0" width="605" title="{$photo->get_title() addslashes}" alt="{$photo->get_title() addslashes}"/><br/><br/>
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


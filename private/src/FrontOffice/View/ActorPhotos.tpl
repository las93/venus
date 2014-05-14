<div id="title">
	<h1>Photos de {$actor->get_firstname()} {$actor->get_name()}</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'acteurs'}">Stars</a>
	&gt; <a href="{$url_star}">{$actor->get_firstname()} {$actor->get_name()}</a>
	&gt; <a href="{$url_photo}">photos</a>
</div>
<div id="left">
	{include $tpl_actor_menu}
	<div class="grandcadre">
		<h2>Photos de {$actor->get_firstname()} {$actor->get_name()}</h2>
		{foreach $photos as $iKey2 => $oPhoto}
			<div class='imgphotorecord'>
				<a href="{$oPhoto->url}"><img src="/images/photo_{$oPhoto->get_id()}.jpg" border="0" width="95" alt="{$oPhoto->get_title() addslashes}" title="{$oPhoto->get_title() addslashes}"/></a><br/>
			</div>
		{/foreach}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


<div id="title">
	<h1>Actualités sur {$actor->get_firstname()} {$actor->get_name()}</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'acteurs'}">Stars</a>
	&gt; <a href="{$url_star}">{$actor->get_firstname()} {$actor->get_name()}</a>
	&gt; <a href="{$url_news}">Actualités</a>
</div>
<div id="left">
	{include $tpl_actor_menu}
	<div class="grandcadre">
			{foreach $news['news'] as $iKey => $oNews}
				<br/><b>Actualités du {$iKey}</b>
				{foreach $oNews as $iKey2 => $oNews2}
						<div id='imgnew'><a href="{$oNews2->url}"><img src="/images/article_{$oNews2->get_id()}.jpg" border="0" width="290"/></a></div>
						<div id='contentnews'>
							<a href="{$oNews2->url}"><b>{$oNews2->get_title()}</b></a><br/>
						</div>
				{/foreach}
			{/foreach}
	</div>
	<div class="grandcadre">
		--PLUS D'ACTU--
	</div>
	<div class="grandcadre">
		| <a href="{url 'actu-par-theme' 'theme' as 'Stars'}">Voir les dernières interviews de star</a>
		| <a href="{url 'actu-series'}">Voir les dernières news Cinéma</a>
		| <a href="{url 'actu-film'}">Voir les dernières news Séries</a>
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


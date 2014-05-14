<div id="title">
	<h1>Les actualités des séries TV</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'series'}">Séries TV</a>
	&gt; <a href="{url 'actu-series'}">Actualités</a>
	{if isset($type_select)}&gt; <a href="{$type_select_url}">Actualités {$type_select}</a>{/if} 
</div>
<div id="left">
	<div class="grandcadre">
		<h2>Les actualités séries TV</h2>
		{if $news[0]->count > 0}
			{foreach $news as $iKey2 => $oNews2}
					{if $iKey2 < 2}
						<div class='imgnew2'><a href="{$oNews2->url}">
							<a href="{$oNews2->url}"><img src="/images/article_{$oNews2->get_id()}.jpg" alt="{$oNews2->get_title() addslashes}" title="{$oNews2->get_title() addslashes}" border="0" width="600"/></a><br/>
							<a href="{$oNews2->url}"><b>{$oNews2->get_title()}</b></a>
							<span style="color:gray"><small>| {$oNews2->date}</small></span><br/>
							{truncate $oNews2->get_content() 100}</b><br/><br/><br/>
						</div>
					{else}
						<div class="demicadre" style="margin-bottom:20px;">
							<div class='imgnew'><a href="{$oNews2->url}"><img src="/images/article_{$oNews2->get_id()}.jpg" alt="{$oNews2->get_title() addslashes}" title="{$oNews2->get_title() addslashes}" border="0" width="300"/></a></div>
							<div class='contentnews'>
								<a href="{$oNews2->url}"><b>{$oNews2->get_title()}</b></a>
								<span style="color:gray"><small>| {$oNews2->date2}</small></span><br/>
								{truncate $oNews2->get_content() 100}</b>
							</div>
						</div>
					{/if}
			{/foreach}
		{/if}
	</div>
	<div class="grandcadre" style ="text-align:center;">
		{if $news[0]->pages > 1}
			&lt;&lt; <a href="{$url}">Début</a>
			| {loop $news[0]->pages}
				{if $i != $news[0]->pages}
					{if $i > 0}
						{if $i > $app['get']['offset'] - 10}
							{if $i < $app['get']['offset'] + 10}
								<a href="{$url}{$i}">{$loop}</a> |
							{/if}
						{/if}
					{/if}
				{/if}
			{/loop}
			<a href="{$url}{$news[0]->pages}">Fin</a> &gt;&gt;
		{else}
			-- Aucune page complémentaire --
		{/if}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
	<div class="cadre_solo_tier_solo_right">
		<h2 style="border-top:5px solid blue;">Actualités séries TV par thèmes</h2>
		{foreach $type['serie'] as $sType => $sUrl}<a href="{$sUrl}">{$sType}</a> {/foreach}<br/>
	</div>
</div>


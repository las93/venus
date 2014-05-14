<div id="title">
	<h1>Tous les acteurs et stars</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'acteurs'}">Stars</a>
</div>
<div id="left">
	<div class="grandcadre">
	<h2>Les stars</h2>
		{foreach $actors as $iKey => $oActor}
			<div class="bacadre" style="text-align:center;" itemprop="actors" itemscope itemtype="http://schema.org/Person">
				<a href="{$oActor->url}" itemprop="url"><img src="/images/person_{$oActor->get_id()}.jpg" border="0" width="140" height="210" alt="{$oActor->get_firstname() addslashes} {$oActor->get_name() addslashes}" title="{$oActor->get_firstname() addslashes} {$oActor->get_name() addslashes}"/><br/>
				<span style="color:black;" itemprop="name">{$oActor->get_firstname()} {$oActor->get_name()}</a>
				<br/>&nbsp;
			</div>
		{/foreach}
	</div>
	<div class="grandcadre" style ="text-align:center;">
		{if $actors[0]->pages > 1}
			&lt;&lt; <a href="/acteur/">Début</a>
			| {loop $actors[0]->pages}
				{if $i != $actors[0]->pages}
					{if $i > 0}
						{if $i > $app['get']['offset'] - 10}
							{if $i < $app['get']['offset'] + 10}
								<a href="/acteur/{$i}">{$loop}</a>  |
							{/if}
						{/if}
					{/if} 
				{/if}
			{/loop}
			<a href="/acteur/{$actors[0]->pages}">Fin</a> &gt;&gt;
		{else}
			-- Aucune page complémentaire --
		{/if}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


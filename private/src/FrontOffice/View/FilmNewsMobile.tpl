	<div class="grandcadre">
		<a href="{url 'home'}">&lt; Retour</a>
	</div>
	<div class="grandcadre" style="border-top:solid 1px black;">
		{foreach $news as $iKey2 => $oNews2}
			<div class='demi_div_for_news'>
				<a href="{$oNews2->url}" style="color:black;font-size:10px;"><b>{$oNews2->get_title()}</b></a>
				<span style="color:gray;font-size:8px;"><small>| {$oNews2->date}</small></span>
			</div>
			<div class='demi_div_for_news'>
				<a href="{$oNews2->url}"><img src="/images/article_{$oNews2->get_id()}.jpg" alt="{$oNews2->get_title() addslashes}" title="{$oNews2->get_title() addslashes}" border="0" width="150"/></a>
			</div>
		{/foreach}
	</div>
	<div class="grandcadre" style ="text-align:center;font-size:18px;">
		{if $news[0]->pages > 1}
			&lt;&lt; <a href="{$url}">Début</a>
			| {loop $news[0]->pages}
				{if $i != $news[0]->pages}
					{if $i > 0}
						{if $i > $app['get']['offset'] - 3}
							{if $i < $app['get']['offset'] + 3}
								<a href="{$url}{$i}">{$loop}</a>  |
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

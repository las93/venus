{* version=2; *}
	<div class="grandcadre" style="border-top:solid 1px black;">
		{foreach from=$news['items'] key=$iKey2 item=$oNews2}
			<div class='demi_div_for_news'>
				<a href="{$oNews2->url}" style="color:black;font-size:10px;"><b>{$oNews2->get_title()}</b></a>
				<span style="color:gray;font-size:8px;"><small>| {$oNews2->date_ago}</small></span>
			</div>
			<div class='demi_div_for_news'>
				<a href="{$oNews2->url}"><img src="{$app.const.IMG_PROD}{$oNews2->image}" alt="{$oNews2->get_title()|escape}" title="{$oNews2->get_title()|escape}" border="0" width="150"/></a>
			</div>
		{/foreach}
	</div>
	{if !isset($alias)}{assign var=$alias value='actu'}{/if}
	<div class="grandcadre" style ="text-align:center;font-size:18px;">
		{if $news['pages'] > 1}
			&lt;&lt; <a href="{url alias=$alias}">Début</a>
			| {section name=$i loop=$news['pages'] start=0}
				{if $i != $news['pages']}
					{if $i > 0}
						{if $i > $app['get']['offset'] - 3}
							{if $i < $app['get']['offset'] + 3}
								<a href="{url alias=$alias}{$i}">{$i}</a>  |
							{/if}
						{/if}
					{/if}
				{/if}
			{/section}
			<a href="{url alias=$alias}{$news['pages']}">Fin</a> &gt;&gt;
		{else}
			-- Aucune page complémentaire --
		{/if}
	</div>

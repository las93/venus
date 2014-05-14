	<div class="tier_cadre{if $type == 'all'}_select_bar{/if}" style="height:2px;"></div>
	<div class="tier_cadre{if $type == 'cinema'}_select_bar{/if}" style="height:2px;"></div>
	<div class="tier_cadre{if $type == 'serie'}_select_bar{/if}" style="height:2px;width:106px;"></div>
	<div class="tier_cadre{if $type == 'all'}_select{/if}">
		<div style="height:15px;top:20%;position:relative;"><a href="{url 'bande-annonce'}" style="color:{if $type == 'all'}white{else}#AAAAAA{/if};">Toutes</a></div>
	</div>
	<div class="tier_cadre{if $type == 'cinema'}_select{/if}">
		<div style="height:15px;top:20%;position:relative;"><a href="{url 'bande-annonce-cinema'}" style="color:{if $type == 'cinema'}white{else}#AAAAAA{/if};">Cinéma</a></div>
	</div>
	<div class="tier_cadre{if $type == 'serie'}_select{/if}" style="width:106px;">
		<div style="height:15px;top:20%;position:relative;"><a href="{url 'bande-annonce-serie'}" style="color:{if $type == 'serie'}white{else}#AAAAAA{/if};">Série</a></div>
	</div>
	<div class="grandcadre">
		{foreach $last_trailers as $oTrailer}
			<div class='demi_div_for_trailer_img'><a href="{$oTrailer->url}"><img src="/images/trailer_{$oTrailer->get_id()}.jpg" alt="{$oTrailer->get_title() addslashes}" title="{$oTrailer->get_title() addslashes}" border="0" width="74"/></a></div>
			<div class='demi_div_for_trailer_txt'>
				<a href="{$oTrailer->url}" style="color:black;font-size:10px;"><b>{$oTrailer->get_title()}</b></a>
			</div>
		{/foreach}
	</div>
	<div class="grandcadre" style ="text-align:center;font-size:18px">
		<br/><br/>
		{if $last_trailers[0]->pages > 1}
			&lt;&lt; <a href="{$url}">Début</a>
			| {loop $last_trailers[0]->pages}
				{if $i != $last_trailers[0]->pages}
					{if $i > 0}
						{if $i > $app['get']['offset'] - 3}
							{if $i < $app['get']['offset'] + 3}
								<a href="{$url}{$i}">{$loop}</a> |
							{/if}
						{/if}
					{/if}
				{/if}
			{/loop}
			<a href="{$url}{$last_trailers[0]->pages}">Fin</a> &gt;&gt;
		{else}
			-- Aucune page complémentaire --
		{/if}
	</div>

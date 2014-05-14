	<div class="tier_cadre{if $menu == 'all'}_select_bar{/if}" style="height:2px;"></div>
	<div class="tier_cadre{if $menu == 'cinema'}_select_bar{/if}" style="height:2px;"></div>
	<div class="tier_cadre{if $menu == 'serie'}_select_bar{/if}" style="height:2px;width:106px;"></div>
	<div class="tier_cadre{if $menu == 'all'}_select{/if}">
		<div style="height:15px;top:20%;position:relative;"><a href="{url alias='bande-annonce'}" style="color:{if $menu == 'home'}white{else}#AAAAAA{/if};">Toutes</a></div>
	</div>
	<div class="tier_cadre{if $menu == 'cinema'}_select{/if}">
		<div style="height:15px;top:20%;position:relative;"><a href="{url alias='bande-annonce-cinema'}" style="color:{if $menu == 'cinema'}white{else}#AAAAAA{/if};">Cinéma</a></div>
	</div>
	<div class="tier_cadre{if $menu == 'serie'}_select{/if}" style="width:106px;">
		<div style="height:15px;top:20%;position:relative;"><a href="{url alias='bande-annonce-serie'}" style="color:{if $menu == 'serie'}white{else}#AAAAAA{/if};">Série</a></div>
	</div>
	<div class="grandcadre">
		{foreach from=$trailers['items'] key=$iKey item=$oTrailer}
			<div class='demi_div_for_trailer_img'><a href="{$oTrailer->url}"><img src="{$app.const.IMG_PROD}/images/trailer_{$oTrailer->get_id()}.jpg" alt="{$oTrailer->get_title()|escape}" title="{$oTrailer->get_title()|escape}" border="0" width="74"/></a></div>
			<div class='demi_div_for_trailer_txt'>
				<a href="{$oTrailer->url}" style="color:black;font-size:10px;"><b>{$oTrailer->get_title()}</b></a>
			</div>
		{/foreach}
	</div>
	<div class="grandcadre" style ="text-align:center;font-size:18px">
		<br/><br/>
		{if $menu == 'all'}{assign alias=$alias value='bande-annonce'}{elseif $menu == 'cinema'}{assign alias=$alias value='bande-annonce-cinema'}{elseif $menu == 'serie'}{assign alias=$alias value='bande-annonce-serie'}{/if}
		{if $trailers['pages'] > 1}
			&lt;&lt; <a href="{url alias=$alias}">Début</a>
			| {section name=$i loop=$trailers['pages'] start=0}
				{if $i != $trailers['pages']}
					{if $i > 0}
						{if $i > $app['get']['offset'] - 3}
							{if $i < $app['get']['offset'] + 3}
								<a href="{url alias=$alias}{$i}">{$i}</a> |
							{/if}
						{/if}
					{/if}
				{/if}
			{/section}
			<a href="{url alias=$alias}{$trailers['pages']}">Fin</a> &gt;&gt;
		{else}
			-- Aucune page complémentaire --
		{/if}
	</div>

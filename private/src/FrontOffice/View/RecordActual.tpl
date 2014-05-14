	<div class="grandcadre">
		<h2>Films du moment</h2>
			{foreach $movies_4week as $iKey => $oBestMovie}
				{if $iKey == 0}
					{$iMovie assign $iKey+1}
					{$oMovie assign $oBestMovie}
					{include $tpl_one_movie}
				{else}
					<div class="liendemicadre" style="margin-top:10px;">
						{$iKey+1}. <a href="{$oBestMovie->url}">{$oBestMovie->get_title()}</a>
					</div>
				{/if}
			{/foreach}
			<div class="liencadre">
				<br/>&gt; <a href="{url 'bande-annonce'}">Tous les films du moment</a>
			</div>
	</div>
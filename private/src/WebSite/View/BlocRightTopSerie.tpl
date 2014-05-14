{* version=2; *}
<div class="one_tier_right_bloc">
	<h1 style="border-bottom:dotted 1px gray;">Les meilleures séries TV</h1>
	{foreach from=$top_series['items'] key=$iKey item=$oRecord}
		{if $iKey == 0}
			<div class="one_right_subbloc">
				<div class="img_bloc_in_right_bloc">
					<a href="{$oRecord->url}"><img src="{$app.const.IMG_PROD}{$oRecord->image}" style="border:0" alt="{$oRecord->get_title()|escape}" title="{$oRecord->get_title()|escape}" width="100"/></a>
				</div>
				<div class="txt_bloc_in_right_bloc">
					<span class="number_round">&nbsp;{$iKey+1}&nbsp;</span> &nbsp;<a href="{$oRecord->url}" style="color:black">{$oRecord->get_title()}</a>
				</div>
			</div>
		{else}
			<div class="one_right_subbloc" style="padding-bottom:2px;">
				<span class="number_round">&nbsp;{$iKey+1}&nbsp;</span> <a href="{$oRecord->url}" style="color:black">{$oRecord->get_title()}</a>
			</div>
		{/if}
	{/foreach}
	<div class="one_right_subbloc" style="height:20px;padding-top:5px;">
		&gt; <a href="{url 'meilleures-series'}">Toutes les meilleures séries</a>
	</div>
</div>
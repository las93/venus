{* version=2; *}
<h1 style="border-bottom:dotted 1px gray;">{if !isset($h1_trailers)}Bandes-annonces{else}{$h1_trailers}{/if}</h1>
{foreach from=$trailers['items'] key=$iKey item=$oTrailer}
	<div class="double_tier_left_bloc_divisible_by_two double_tier_left_bloc_divisible_by_two_video">
		<a href="{$oTrailer->url}" style="color:black"><img src="{$app.const.IMG_PROD}/images/trailer_{$oTrailer->get_id()}.jpg" style="border:0" alt="{$oTrailer->get_title()|escape}" title="{$oTrailer->get_title()|escape}" width="100"/><br/>
		{$oTrailer->get_title()}</a>
	</div>
{/foreach}
<div class="one_news_bloc" style="height:20px;padding-top:5px;width:960px;{if isset($paging) && $paging === true}text-align:center;{/if}">
	{if isset($paging) && $paging === true}

		{if $app.get.offset < 1}
			{assign var=$offset value=1}
		{else}
			{assign var=$offset value=$app.get.offset}
		{/if}

		{if !isset($alias)}{assign var=$alias value='bande-annonce'}{/if}

		{if $offset - 8 > 1}
			{assign var=$start value=$offset-8}
		{else}
			{assign var=$start value=1}
		{/if}
		{if $trailers['pages'] > $offset + 8}
			{assign var=$loop value=$offset+8}
		{else}
			{assign var=$loop value=$trailers['pages']-$start}
		{/if}

		{if $start == 1 && $offset - 8 < 1}
			{assign var=$loop value=$loop-$offset+8}
		{/if}
		{if $loop + $start > $trailers['pages']}
			{assign var=$loop value=$trailers['pages']}
		{/if}

		{if $trailers['pages'] == 0}
			-- AUCUNE AUTRE PAGE DE DISPONIBLE --
		{else}
			&lt;&lt; <a href="{url alias=$alias}">début</a> |
			&lt; <a href="{url alias=$alias offset=$offset-1}">précédente</a> |
			{section name=$i loop=$loop start=$start}
				<a href="{url alias=$alias offset=$i}">{$i}</a> |
			{/section}
			<a href="{url alias=$alias offset=$offset+1}">suivante</a> &gt; |
			<a href="{url alias=$alias offset=$trailers['pages']}">fin</a> &gt;&gt;
		{/if}
	{else}

	{/if}
</div>
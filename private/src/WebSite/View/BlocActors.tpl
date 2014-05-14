{* version=2; *}
<h1 style="border-bottom:dotted 1px gray;">{if !isset($h1_actors)}Stars{else}{$h1_actors}{/if}</h1>
{foreach from=$actors['items'] key=$iKey item=$oActor}
	<div class="double_tier_left_bloc_divisible_by_two double_tier_left_bloc_divisible_by_two_person">
		<a href="{$oActor->url}" style="color:black"><img src="{$app.const.IMG_PROD}{$oActor->image}" style="border:0" alt="{$oActor->get_firstname()|escape} {$oActor->get_firstname()|escape}" title="{$oActor->get_firstname()|escape} {$oActor->get_firstname()|escape}" width="100"/><br/>
		{$oActor->get_firstname()} {$oActor->get_name()}</a>
	</div>
{/foreach}
<div class="one_news_bloc" style="height:20px;padding-top:5px;width:960px;{if isset($paging) && $paging === true}text-align:center;{/if}">
	{if isset($paging) && $paging === true}

		{if $app.get.offset < 1}
			{assign var=$offset value=1}
		{else}
			{assign var=$offset value=$app.get.offset}
		{/if}

		{if !isset($app.get.letter)}
			{assign var=$letter value=''}
		{else}
			{assign var=$letter value=$app.get.letter}
		{/if}

		{if !isset($alias)}{assign var=$alias value='acteurs'}{/if}

		{if $offset - 8 > 1}
			{assign var=$start value=$offset-8}
		{else}
			{assign var=$start value=1}
		{/if}
		{if $actors['pages'] > $offset + 8}
			{assign var=$loop value=$offset+8}
		{else}
			{assign var=$loop value=$actors['pages']-$start}
		{/if}

		{if $start == 1 && $offset - 8 < 1}
			{assign var=$loop value=$loop-$offset+8}
		{/if}
		{if $loop + $start > $actors['pages']}
			{assign var=$loop value=$actors['pages']}
		{/if}

		{if $actors['pages'] == 0}
			-- AUCUNE AUTRE PAGE DE DISPONIBLE --
		{else}
			&lt;&lt; <a href="{url alias=$alias letter=$letter}">début</a> |
			&lt; <a href="{url alias=$alias offset=$offset-1 letter=$letter}">précédente</a> |
			{section name=$i loop=$loop start=$start}
				<a href="{url alias=$alias offset=$i letter=$letter}">{$i}</a> |
			{/section}
			<a href="{url alias=$alias offset=$offset+1 letter=$letter}">suivante</a> &gt; |
			<a href="{url alias=$alias offset=$actors['pages'] letter=$letter}">fin</a> &gt;&gt;
		{/if}
	{else}

	{/if}
</div>
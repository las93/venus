{* version=2; *}
<div class="double_tier_left_bloc">
	<h1 style="border-bottom:dotted 1px gray;">{if !isset($h1_news)}Actualités{else}{$h1_news}{/if}</h1>
	{foreach from=$news['items'] key=$iKey item=$oNews}
		<div class="one_news_bloc">
			<div class="img_left_bloc">
				<a href="{$oNews->url}" style="color:black;text-decoration:none;"><img src="{$app.const.IMG_PROD}{$oNews->image}" width="200" alt="{$oNews->get_title()|escape}" title="{$oNews->get_title()|escape}" style="border:0"/></a>
			</div>
			<div class="text_left_bloc">

					<div class="title_list"><a href="{$oNews->url}" style="color:black;text-decoration:none;">{$oNews->get_title()}</a></div>
					<a href="{$oNews->url}" style="color:black;text-decoration:none;"><span style="color:gray;">{$oNews->date_ago}</span> {$oNews->get_content()|truncate:150}</a>
			</div>
		</div>
	{/foreach}
	<div class="one_news_bloc" style="height:20px;padding-top:5px;{if isset($paging) && $paging === true}text-align:center;{/if}">
		{if isset($paging) && $paging === true}

			{if $app.get.offset < 1}
				{assign var=$offset value=1}
			{else}
				{assign var=$offset value=$app.get.offset}
			{/if}

			{if !isset($alias)}{assign var=$alias value='actu'}{/if}

			{if $offset - 8 > 1}
				{assign var=$start value=$offset-8}
			{else}
				{assign var=$start value=1}
			{/if}
			{if $news['pages'] > $offset + 8}
				{assign var=$loop value=$offset+8}
			{else}
				{assign var=$loop value=$news['pages']-$start}
			{/if}

			{if $start == 1 && $offset - 8 < 1}
				{assign var=$loop value=$loop-$offset+8}
			{/if}
			{if $loop + $start > $news['pages']}
				{assign var=$loop value=$news['pages']}
			{/if}

			{if $news['pages'] == 0}
				-- AUCUNE AUTRE PAGE DE DISPONIBLE --
			{else}
				&lt;&lt; <a href="{url alias=$alias}">début</a> |
				&lt; <a href="{url alias=$alias offset=$offset-1}">précédente</a> |
				{section name=$i loop=$loop start=$start}
					<a href="{url alias=$alias offset=$i}">{$i}</a> |
				{/section}
				<a href="{url alias=$alias offset=$offset+1}">suivante</a> &gt; |
				<a href="{url alias=$alias offset=$news['pages']}">fin</a> &gt;&gt;
			{/if}
		{else}
			&gt; <a href="/">Actualités cinémas</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&gt; <a href="/">Actualités séries</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&gt; <a href="/">Actualités télé</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&gt; <a href="{url 'dossier'}">Dossiers complets</a>
		{/if}
	</div>
</div>
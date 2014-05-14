{* version=2; *}
<div class="right_and_left_bloc">
	<div style="float:left;width:440px;marging-bottom:5px;">
		<h1 style="border-bottom:dotted 1px gray;">Recherche {urldecode($app.get.word)}</h1>
	</div>
</div>
{if $movies['count'] > 0}
<div class="right_and_left_bloc" style="margin-top:10px;">
	<h2 style="border-bottom:dotted 1px gray;margin-bottom:5px;">Films/Séries de la recherche {urldecode($app.get.word)}</h2>
	{foreach from=$movies['items'] key=$iKey item=$oRecord}
		<div class="double_tier_left_bloc_divisible_by_two double_tier_left_bloc_divisible_by_two_person">
			<a href="{$oRecord->url}" style="color:black"><img src="{$app.const.IMG_PROD}{$oRecord->image}" style="border:0" alt="{$oRecord->get_title()|escape}" title="{$oRecord->get_title()|escape}" width="100"/><br/>
			{$oRecord->get_title()}</a>
		</div>
	{/foreach}
</div>
{/if}
{if $persons['count'] > 0}
<div class="right_and_left_bloc" style="margin-top:10px;">
	<h2 style="margin-bottom:10px;">Les stars de la recherche {urldecode($app.get.word)}</h2>
	<div style="width:900px;float:left;margin-top:5px;">
		{foreach from=$persons['items'] item=$oActor}
		<div style="width:157px;float:left;text-align:center;margin-bottom:10px;">
			<a href="{$oActor->url}"><img src="{$app.const.IMG_PROD}{$oActor->image}" border="0" width="140" alt="{$oActor->person->get_firstname()|escape} {$oActor->person->get_name()|escape}" title="{$oActor->person->get_firstname()|escape} {$oActor->person->get_name()|escape}"/><br/>
			<span style="color:black;">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</span></a>
		</div>
		{/foreach}
	</div>
</div>
{/if}
{if $news['count'] > 0}
<div class="right_and_left_bloc" style="margin-top:10px;">
	<h2>Les Actualités de la recherche {urldecode($app.get.word)}</h2>
	<div style="width:100%;float:left;margin-top:5px;">
		{foreach from=$news['items'] key=$iKey2 item=$oNews2}
			<div style="margin-bottom:20px;width:315px;float:left;height:170px;">
				<a href="{$oNews2->url}"><img src="{$app.const.IMG_PROD}{$oNews2->image}" alt="{$oNews2->get_title()|escape}" title="{$oNews2->get_title()|escape}" border="0" width="300"/></a><br/>
				<a href="{$oNews2->url}"><b>{$oNews2->get_title()}</b></a><br/>
				{$oNews2->get_content()|truncate:100}</b>
			</div>
		{/foreach}
	</div>
</div>
{/if}
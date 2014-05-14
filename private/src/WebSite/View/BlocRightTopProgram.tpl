{* version=2; *}
<div class="one_tier_right_bloc">
	<h1 style="border-bottom:dotted 1px gray;">Meilleurs programmes TV</h1>
	{foreach from=$top_program['items'] key=$iKey item=$oProgram}
		<div class="one_right_subbloc" style="padding-bottom:2px;">
			<span class="number_round">&nbsp;{$iKey+1}&nbsp;</span> <a href="{$oProgram->url}" style="color:black">{$oProgram->get_name()}</a>
		</div>
	{/foreach}
	<div class="one_right_subbloc" style="height:20px;padding-top:5px;">
		&gt; <a href="{url 'meilleures-series'}">Tous les meilleurs programmes</a>
	</div>
</div>
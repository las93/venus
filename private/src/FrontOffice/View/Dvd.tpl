<div id="title">
	<h1>Les DVD de films et de séries TV</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'dvd'}">DVD / Bluray</a>
	{if $type == 'best'}
		&gt; <a href="{url 'meilleurs-dvd'}">Les meilleurs DVD / Bluray du moment</a>
	{elseif $type == 'bestforus'}
		&gt; <a href="{url 'notre-selection-dvd'}">Notre sélection DVD / Bluray</a>
	{/if}
</div>
<div id="left">
	{include $tpl_dvd_menu}
	<div class="grandcadre">
		<h2>Les meilleurs DVD et Bluray du mois selon les spectateurs</h2>
		<form name="filterform" method="post">
			<div class = "demicadre">
				Support :<br/>
				<select name="support"><option value="">Tous</option><option value="dvd">DVD</option><option value="bluray">Bluray</option></select>
			</div>
			<div class = "demicadre">
				par genre :<br/>
				<select name="kind">
					<option value="">Tous</option>
					{foreach $kinds as $iKey => $okind}
						<option value="{$okind->get_id()}">{$okind->get_name()}</option>
					{/foreach}
				</select>
			</div>
		</form>
		
		{foreach $best_dvd as $iKey => $oBestDvd}
			{$iDvd assign $iKey+1}
			{$oDvd assign $oBestDvd}
			{include $tpl_one_dvd}
		{/foreach}
	</div>
	<div class="grandcadre" style ="text-align:center;">
		{if $best_dvd[0]->pages > 1}
			&lt;&lt; <a href="{$url}">Début</a>
			| {loop $best_dvd[0]->pages}
				{if $i != $best_dvd[0]->pages}
					{if $i > 0}
						{if $i > $app['get']['offset'] - 10}
							{if $i < $app['get']['offset'] + 10}
								<a href="{$url}{$i}">{$loop}</a> |
							{/if}
						{/if}
					{/if}
				{/if}
			{/loop}
			<a href="{$url}{$best_dvd[0]->pages}">Fin</a> &gt;&gt;
		{else}
			-- Aucune page complémentaire --
		{/if}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


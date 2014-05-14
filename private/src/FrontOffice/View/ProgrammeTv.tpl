<div id="title">
	<h1>Programme TV de ce soir - iScreenway</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'programme-tv'}">Programme TV</a>
	{if $app['environment']['REQUEST_URI'] == '/programme-tv/tnt/'}
		&gt; <a href="{url 'programme-tnt'}">Programme TNT</a>
	{elseif $app['environment']['REQUEST_URI'] == '/programme-tv/cable-et-satelite/'}
		&gt; <a href="{url 'programme-cable'}">Programme Cable et satellite</a>
	{/if}
</div>
<div id="left">
	<div class="grandcadre">
		<table width="100%"><tr>
			<td>
				<a href="{url 'programme-tv'}">Ce soir</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="{url 'programme-tv-du-moment'}">En ce moment</a>
			</td>
		</tr></table>
		<table width="100%">
			{foreach $program as $iKey => $oOneChannel}
				<tr>
					<td height="80"><a href="{$oOneChannel->url}"><img src="/img/logo_{$oOneChannel->get_id()}.jpg"/></a></td>
					{foreach $oOneChannel->program as $iKey2 => $oProgram}
						<td>
							<table width="100%"><tr>
								<td style="color:#777777;font-size:10px;"><b>{$oProgram->get_start() hour} - {$oProgram->get_end() hour}<b></td>
								<td style="font-size:14px;"><b>{$oProgram->program->get_name()}<b></td>
							</tr><tr>
								<td style="font-size:10px;" colspan="2">
									{if isset($oProgram->record)}
										| <a href="{$oProgram->record->url}">Voir la fiche</a> |
									{else}
										| <a href="{$oProgram->url}">Voir la fiche</a> |
									{/if}
								</td>
							</tr></table>
						</td>
					{/foreach}
				</tr>
			{/foreach}
		</table>
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>



		<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF"><tr>
			<th style="background-color:#BBBBFF">Nom</th>
			<th style="background-color:#BBBBFF">Options</th>
		</tr>
		{foreach $persons as $aOne}
		<tr>
			<td style="background-color:#DDDDFF">{$aOne->get_firstname() html} {$aOne->get_name() html}</td>
			<td style="background-color:#DDDDFF"><a href="{url 'modifier_personne' 'id' as $aOne->get_id()}">Modifier</a></td>
		</tr>
		{/foreach}
		</table>
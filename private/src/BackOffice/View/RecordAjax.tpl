		<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF"><tr>
			<th style="background-color:#BBBBFF">Titre</th>
			<th style="background-color:#BBBBFF">Options</th>
		</tr>
		{foreach $records as $aOne}
		<tr>
			<td style="background-color:#DDDDFF">{$aOne->get_title()}</td>
			<td style="background-color:#DDDDFF">
				| <a href="{$aOne->url1}">Modifier</a> |
				<a href="{$aOne->url2}">Ajouter personnes</a> |
			</td>
		</tr>
		{/foreach}
		</table>
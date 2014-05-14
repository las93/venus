<a href="{url 'ajouter_photo'}">Ajouter une photo</a>
<br/><br/>
	<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF"><tr>
	{foreach $photos as $aOne}
	<tr>
		<td style="background-color:#DDDDFF">{$aOne->get_title()}</td>
		<td style="background-color:#DDDDFF">
			| <a href="{$aOne->url1}">Modifier</a> |
			<a href="{$aOne->url2}">Ajouter personnes</a> |
		</td>
	</tr>
	{/foreach}
	</table>
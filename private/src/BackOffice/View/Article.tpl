<input type="button" onClick="window.location.href='{url 'ajouter_article'}'" value="Ajouter un article"/><br/><br/>
<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF"><tr>
	<th style="background-color:#BBBBFF">Titre</th>
	<th style="background-color:#BBBBFF">Options</th>
</tr>
{foreach $articles as $aOne}
<tr>
	<td style="background-color:#DDDDFF">{$aOne->get_title()}</td>
	<td style="background-color:#DDDDFF">
		<input type="button" onClick="window.location.href='{$aOne->url1}'" value="Modifier"/>
	</td>
</tr>
{/foreach}
</table>
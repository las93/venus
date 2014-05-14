La fiche {$record->get_title()} - ajouter un distributeur
<form method="post">
<br/><br/>
	<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF">
	<tr>
		<th style="background-color:#BBBBFF">
			Personne
		</th><th style="background-color:#BBBBFF">
			Rôle
		</th>
		<th style="background-color:#BBBBFF">
			Options
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">
			<select name="id_person">
				{foreach $person as $aOne}<option value="{$aOne['person.id']}">{$aOne['person.firstname']} {$aOne['person.name']}</option>{/foreach}
			</select>
		</td><td style="background-color:#DDDDFF">
			<input type="text" name="role"/>
		</td>
		<td style="background-color:#DDDDFF">
			<input type="submit"/>
		</td>
	</tr>
	</table>
</form>
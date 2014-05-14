Ajouter un distributor :<p>
<form name="form1" method="post">
	<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF"><tr>
		<td style="background-color:#DDDDFF">Nom</td>
		<td style="background-color:#DDDDFF" colspan="2"><input name="name" type="text"/></td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Nationalité</td>
		<td style="background-color:#DDDDFF" colspan="2"><select name="id_nationality">
			{foreach $nationality as $aOne}
				<option value="{$aOne->get_id()}">{$aOne->get_name()}</option>
			{/foreach}
			</select> <a href="/nationalite/add">Créer une nationalité</a>
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF" colspan="3">Logo : <input type="file" name="fichier"></td>
	</tr><tr>
		<td style="background-color:#DDDDFF" colspan="3"><input type="submit"></td>
	</tr></table>
</form>
Ajouter une mise en avant :<p>
<form name="form1" method="post" enctype="multipart/form-data">
	<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF"><tr>
		<td style="background-color:#DDDDFF">Titre</td>
		<td style="background-color:#DDDDFF" colspan="2"><input name="title" type="text"/></td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Lien</td>
		<td style="background-color:#DDDDFF" colspan="2"><input name="link" type="text"/></td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Boutton</td>
		<td style="background-color:#DDDDFF" colspan="2"><input name="button" type="text"/></td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Page</td>
		<td style="background-color:#DDDDFF" colspan="2">
			{foreach $pages as $aOne}
				<input type="checkbox" name="id_mea_page[]" value="{$aOne->get_id()}">{$aOne->get_title()} |
			{/foreach}
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF" colspan="3">Image de la mea : <input type="file" name="fichier"> (630x295)</td>
	</tr><tr>
		<td style="background-color:#DDDDFF" colspan="3"><input type="submit" type="button" onClick="submitForm();"></td>
	</tr></table>
	<script>
	function submitForm() {
		if (document.form1.title.value != '' && document.form1.link.value != '' && document.form1.button.value != '') { document.form1.submit(); }
		else { alert('Tous les champs sont obligatoires !'); }
	}
	</script>
</form>
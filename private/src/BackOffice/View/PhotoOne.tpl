La fiche {$photo->get_title()}
<br/><br/>
	<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF">
	<tr>
		<td style="background-color:#DDDDFF">
			<b>Personnes sur la photo :</b>
		</td><td style="background-color:#DDDDFF">
			{$liste_actor}
		</td>
		<td style="background-color:#DDDDFF">
			<a href="{url 'modifier_photo_ajouter_personne' 'id' as $record->get_id()}">Ajouter un acteur
		</td>
	</tr>
	</table>
<br/><br/>
<a href="{url 'liste_photo'}">Retour aux photos</a>
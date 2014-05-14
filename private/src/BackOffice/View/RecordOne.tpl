La fiche {$record->get_title()}
<br/><br/>
	<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF">
	<tr>
		<td style="background-color:#DDDDFF">
			<b>Acteurs :</b>
		</td><td style="background-color:#DDDDFF">
			{$liste_actor}
		</td>
		<td style="background-color:#DDDDFF">
			<a href="{url 'modifier_fiche_ajouter_acteur' 'id' as $record->get_id()}">Ajouter un acteur
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">
			<b>Equipe technique :</b>
		</td><td style="background-color:#DDDDFF">
			{$liste_technicalteam}
		</td>
		<td style="background-color:#DDDDFF">
			<a href="{url 'modifier_fiche_ajouter_equipe_technique' 'id' as $record->get_id()}">Ajouter un équipe technique
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">
			<b>Producteurs :</b>
		</td><td style="background-color:#DDDDFF">
			{$liste_productor}
		</td>
		<td style="background-color:#DDDDFF">
			<a href="{url 'modifier_fiche_ajouter_producteur' 'id' as $record->get_id()}">Ajouter un producteur
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">
			<b>Réalisateurs :</b>
		</td><td style="background-color:#DDDDFF">
			{$liste_realisator}
		</td>
		<td style="background-color:#DDDDFF">
			<a href="{url 'modifier_fiche_ajouter_realisateurs' 'id' as $record->get_id()}">Ajouter un réalisateur
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">
			<b>Scénaristes :</b>
		</td><td style="background-color:#DDDDFF">
			{$liste_screenwriter}
		</td>
		<td style="background-color:#DDDDFF">
			<a href="{url 'modifier_fiche_ajouter_scenaristes' 'id' as $record->get_id()}">Ajouter un scénariste
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">
			<b>Distributeur :</b>
		</td><td style="background-color:#DDDDFF">
			{$liste_distributor}
		</td>
		<td style="background-color:#DDDDFF">
			<a href="{url 'modifier_fiche_ajouter_distributeur' 'id' as $record->get_id()}">Ajouter un distributeur
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">
			<b>Société :</b>
		</td><td style="background-color:#DDDDFF">
			{$liste_company}
		</td>
		<td style="background-color:#DDDDFF">
			<a href="{url 'modifier_fiche_ajouter_societe' 'id' as $record->get_id()}">Ajouter une société
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">
			<b>Créateurs & showrunners :</b>
		</td><td style="background-color:#DDDDFF">
			{$liste_creator}
		</td>
		<td style="background-color:#DDDDFF">
			<a href="{url 'modifier_fiche_ajouter_createur' 'id' as $record->get_id()}">Ajouter un créateur ou showrunner
		</td>
	</tr>
	</table>
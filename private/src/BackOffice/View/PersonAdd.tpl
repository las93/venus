{if isset($person)}Modifier une fiche :{else}Ajouter une fiche :{/if}<p>
<form name="form1" method="post" enctype="multipart/form-data">
	<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF"><tr>
		<td style="background-color:#DDDDFF">Prénom</td>
		<td style="background-color:#DDDDFF" colspan="2"><input name="firstname" type="text" {if isset($person)}value="{$person->get_firstname()}"{/if}/></td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Nom</td>
		<td style="background-color:#DDDDFF" colspan="2"><input name="name" type="text" {if isset($person)}value="{$person->get_name()}"{/if}/></td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Nationalité</td>
		<td style="background-color:#DDDDFF" colspan="2"><select name="id_nationalite">
			{foreach $nationality as $aOne}
				<option value="{$aOne->get_id()}" {if isset($person)}{if $person->get_id_nationality() == $aOne->get_id()}selected="selected"{/if}{/if}>{$aOne->get_name()}</option>
			{/foreach}
			</select> <a href="/nationalite/add">Créer une nationalité</a>
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Sexe</td>
		<td style="background-color:#DDDDFF" colspan="2">
			<input type="radio" name="sex" value="m" {if isset($person)}{if $person->get_sex() == 'm'}checked="checked"{/if}{else}checked="checked"{/if}> Homme<br/>
			<input type="radio" name="sex" value="f" {if isset($person)}{if $person->get_sex() == 'f'}checked="checked"{/if}{/if}> Femme</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Biographie</td>
		<td style="background-color:#DDDDFF" colspan="2"><textarea name="biography" cols="100" rows="10">{if isset($person)}{$person->get_biography()}{/if}</textarea></td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Date de naissance</td>
		<td style="background-color:#DDDDFF" colspan="2"><input type="radio" name="ladate" value="o" checked="checked"> <select name="birthday_j">
			{from 1 to 31}<option value="{if $i < 10}0{/if}{$i}" {if isset($person)}{if $day == $i}selected="selected"{/if}{/if}>{if $i < 10}0{/if}{$i}</option>{/from}
			</select>/<select name="birthday_m">
			{from 1 to 12}<option value="{if $i < 10}0{/if}{$i}" {if isset($person)}{if $month == $i}selected="selected"{/if}{/if}>{if $i < 10}0{/if}{$i}</option>{/from}
			</select>/<select name="birthday_a">
				{from 1900 to 2020}<option value="{$i}" {if isset($person)}{if $year == $i}selected="selected"{/if}{/if}>{$i}</option>{/from}
			</select><br/>
			<input type="radio" name="ladate" value="n"> Date inconnue
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF" colspan="3">
			{if isset($record)}
				<img src="/images/record_{$app['get']['id']}.jpg"/><br/>
				Photo de la personne : <input type="file" name="fichier">(160x240)
			{else}
				Photo de la personne : <input type="file" name="fichier">(160x240)
			{/if}
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF" colspan="3"><input type="submit"></td>
	</tr></table>
</form>
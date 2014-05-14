{if isset($record)}Modifier la{else}Ajouter une{/if} fiche :<p>
<form name="form1" method="post" enctype="multipart/form-data">
	<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF"><tr>
		<td style="background-color:#DDDDFF">Titre</td>
		<td style="background-color:#DDDDFF" colspan="2"><input name="title" type="text" {if isset($record)}value="{$record->get_title()}"{/if}/></td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Type</td>
		<td style="background-color:#DDDDFF" colspan="2"><input name="type" type="radio" value="serie"/> Série - <input name="type" type="radio" value="film" checked="checked"/> Film - <input name="type" type="radio" value="court-metrage"/> Court-métrage</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Nationalité</td>
		<td style="background-color:#DDDDFF" colspan="2"><select name="id_nationalite">
			{foreach $nationality as $aOne}
				<option value="{$aOne->get_id()}" {if isset($record)}{if $record->get_id_nationality() == $aOne->get_id()}selected="selected"{/if}{/if}>{$aOne->get_name()}</option>
			{/foreach}
			</select> <a href="/nationalite/add">Créer une nationalité</a>
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Genre</td>
		<td style="background-color:#DDDDFF">
			<input type="hidden" name="kinds" {if isset($record)}value="{$record_has_kind_value}"{/if}>
			<div id="div3">--Liste--{if isset($record)}{$record_has_kind_name}{/if}</div>
		</td>
		<td style="background-color:#DDDDFF">
			<select name="id_kind">{foreach $kind as $aOne}
				<option value="{$aOne->get_id()}">{$aOne->get_name()}</option>
			{/foreach}
			</select>
			<a href="javascript:addKind()">Ajouter</a>
			<script>
				function addKind() {

					document.form1.kinds.value = document.form1.kinds.value+';'+document.form1.id_kind.options[document.form1.id_kind.options.selectedIndex].value;
					document.getElementById("div3").innerHTML += '<br/>'+document.form1.id_kind.options[document.form1.id_kind.options.selectedIndex].text;
				}
			</script>
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Synopsis</td>
		<td style="background-color:#DDDDFF" colspan="2"><textarea name="synopsis" cols="100" rows="10">{if isset($record)}{$record->get_synopsis()}{/if}</textarea></td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Note/Critique</td>
		<td style="background-color:#DDDDFF" colspan="2">
			Note : <select name="score"><option value="0.5" {if isset($record)}{if $record->get_score() == 0.5}selected="selected"{/if}{/if}>0.5</option><option value="1" {if isset($record)}{if $record->get_score() == 1}selected="selected"{/if}{/if}>1</option><option value="1.5" {if isset($record)}{if $record->get_score() == 1.5}selected="selected"{/if}{/if}>1.5</option><option value="2" {if isset($record)}{if $record->get_score() == 2}selected="selected"{/if}{/if}>2</option><option value="2.5" {if isset($record)}{if $record->get_score() == 2.5}selected="selected"{/if}{/if}>2.5</option><option value="3" {if isset($record)}{if $record->get_score() == 3}selected="selected"{/if}{/if}>3</option><option value="3.5" {if isset($record)}{if $record->get_score() == 3.5}selected="selected"{/if}{/if}>3.5</option><option value="4" {if isset($record)}{if $record->get_score() == 4}selected="selected"{/if}{/if}>4</option><option value="4.5" {if isset($record)}{if $record->get_score() == 4.5}selected="selected"{/if}{/if}>4.5</option><option value="5" {if isset($record)}{if $record->get_score() == 5}selected="selected"{/if}{/if}>5</option></select>
			<br/><textarea name="review" cols="100" rows="10">{if isset($record)}{$record->get_review()}{/if}</textarea>
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Date de production</td>
		<td style="background-color:#DDDDFF" colspan="2"><select name="production_date">
			{from 1920 to 2020}<option value="{$i}" {if isset($record)}{if $record->get_production_date() == $i}selected="selected"{/if}{/if}>{$i}</option>{/from}
			</select>
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Date Cinéma</td>
		<td style="background-color:#DDDDFF" colspan="2"><select name="date_cinema_j">
			{from 1 to 31}<option value="{if $i < 10}0{/if}{$i}" {if isset($record)}{if $day1 == $i}selected="selected"{/if}{/if}>{if $i < 10}0{/if}{$i}</option>{/from}
			</select>/<select name="date_cinema_m">
			{from 1 to 12}<option value="{if $i < 10}0{/if}{$i}" {if isset($record)}{if $month1 == $i}selected="selected"{/if}{/if}>{if $i < 10}0{/if}{$i}</option>{/from}
			</select>/<select name="date_cinema_a">
				{from 1920 to 2020}<option value="{$i}" {if isset($record)}{if $year1 == $i}selected="selected"{/if}{/if}>{$i}</option>{/from}
			</select>
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Date DVD</td>
		<td style="background-color:#DDDDFF" colspan="2"><select name="date_dvd_j">
			{from 1 to 31}<option value="{if $i < 10}0{/if}{$i}" {if isset($record)}{if $day2 == $i}selected="selected"{/if}{/if}>{if $i < 10}0{/if}{$i}</option>{/from}
			</select>/<select name="date_dvd_m">
			{from 1 to 12}<option value="{if $i < 10}0{/if}{$i}" {if isset($record)}{if $month2 == $i}selected="selected"{/if}{/if}>{if $i < 10}0{/if}{$i}</option>{/from}
			</select>/<select name="date_dvd_a">
				{from 1920 to 2020}<option value="{$i}" {if isset($record)}{if $year2 == $i}selected="selected"{/if}{/if}>{$i}</option>{/from}
			</select>
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Date Blu-ray</td>
		<td style="background-color:#DDDDFF" colspan="2"><select name="date_bluray_j">
				{from 1 to 31}<option value="{if $i < 10}0{/if}{$i}" {if isset($record)}{if $day3 == $i}selected="selected"{/if}{/if}>{if $i < 10}0{/if}{$i}</option>{/from}
			</select>/<select name="date_bluray_m">
				{from 1 to 12}<option value="{if $i < 10}0{/if}{$i}" {if isset($record)}{if $month3 == $i}selected="selected"{/if}{/if}>{if $i < 10}0{/if}{$i}</option>{/from}
			</select>/<select name="date_bluray_a">
				{from 1920 to 2020}<option value="{$i}" {if isset($record)}{if $year3 == $i}selected="selected"{/if}{/if}>{$i}</option>{/from}
			</select>
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Date VOD</td>
		<td style="background-color:#DDDDFF" colspan="2"><select name="date_vod_j">
				{from 1 to 31}<option value="{if $i < 10}0{/if}{$i}" {if isset($record)}{if $day4 == $i}selected="selected"{/if}{/if}>{if $i < 10}0{/if}{$i}</option>{/from}
			</select>/<select name="date_vod_m">
				{from 1 to 12}<option value="{if $i < 10}0{/if}{$i}" {if isset($record)}{if $month4 == $i}selected="selected"{/if}{/if}>{if $i < 10}0{/if}{$i}</option>{/from}
			</select>/<select name="date_vod_a">
				{from 1920 to 2020}<option value="{$i}" {if isset($record)}{if $year4 == $i}selected="selected"{/if}{/if}>{$i}</option>{/from}
			</select>
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF" colspan="3">
			{if isset($record)}
				<img src="/images/record_{$app['get']['id']}.jpg"/><br/>
				Affiche du film : <input type="file" name="fichier">(160x240)
			{else}
				Affiche du film : <input type="file" name="fichier">(160x240)
			{/if}
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF" colspan="3"><input type="submit"></td>
	</tr></table>
</form>
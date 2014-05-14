<a href="{url 'ajouter_fiche'}">Ajouter une fiche</a> - <a href="{url 'ajouter_alias_fiche'}">Ajouter un alias de fiche</a><br/><br/>
<form name="f1" method="get">
	<input type="radio" name="typerecord" id="film" value="film" checked="checked"> Film -
	<input type="radio" name="typerecord" id= "serie" value="serie"> Série -
	<input type="text" name="id" value=""><a href="javascript:void(0);" onClick="if(document.getElementById('film').checked){var radio='film';}else{var radio='serie';}document.f1.action='/url/'+radio+'/'+document.f1.id.value;document.f1.submit();">Ajouter une fiche</a>
</form>
<br/><br/>
	<form name="f2" method="get">
		<input type="text" name="title" value="Spi"/> <a href="javascript:void(0);" onClick="loadRecord()">Chercher</a>
		<script>
		function loadRecord() {
			jQuery.ajax({
			  type: 'GET',
			  url: '/fiches-search/'+document.f2.title.value,
			  success: function(data) {
			  	$("#listRecord").html(data);
			  }
			});
		}
		</script>
	</form>
	<div id="listRecord">
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
	</div>
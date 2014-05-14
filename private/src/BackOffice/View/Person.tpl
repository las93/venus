| <a href="{url 'ajouter_personne'}">Ajouter une personne</a> | <a href="{url 'ajouter_alias_personne'}">Ajouter un alias de personne</a> |
<br/><br/>
	<form name="f2" method="get">
		<input type="text" name="firstname" value="Bruce"/> <input type="text" name="name" value=""/> <a href="javascript:void(0);" onClick="loadPerson()">Chercher</a>
		<script>
		function loadPerson() {
			jQuery.ajax({
			  type: 'GET',
			  url: '/personne-search/'+document.f2.firstname.value+'/'+document.f2.name.value+'/',
			  success: function(data) {
			  	$("#listPerson").html(data);
			  }
			});
		}
		</script>
	</form>
	<div id="listPerson">
		<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF"><tr>
			<th style="background-color:#BBBBFF">Nom</th>
			<th style="background-color:#BBBBFF">Options</th>
		</tr>
		{foreach $persons as $aOne}
		<tr>
			<td style="background-color:#DDDDFF">{$aOne->get_firstname()} {$aOne->get_name()}</td>
			<td style="background-color:#DDDDFF"><a href="{url 'modifier_personne' 'id' as $aOne->get_id()}">Modifier</a></td>
		</tr>
		{/foreach}
		</table>
	</div>
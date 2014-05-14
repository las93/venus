{if isset($record)}Modifier la{else}Ajouter une{/if} fiche :<p>
<form name="form1" method="post" enctype="multipart/form-data">
	<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF"><tr>
		<td style="background-color:#DDDDFF">Titre</td>
		<td style="background-color:#DDDDFF" colspan="2"><input name="title" type="text" {if isset($record)}value="{$record->get_title()}"{/if}/></td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Type</td>
		<td style="background-color:#DDDDFF" colspan="2"><input name="type" type="radio" value="affiches"/> Affiches - <input name="type" type="radio" value="photosdufilm" checked="checked"/> Photos du film</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Personnes</td>
		<td style="background-color:#DDDDFF">
			<input type="hidden" name="actors" {if isset($article)}value="{$article_has_person_value}"{/if}>
			<div id="div2">--Liste--{if isset($article)}{$article_has_person_name}{/if}</div>
		</td>
		<td style="background-color:#DDDDFF">
			<script>
				function addActor(iIdPerson, sName) {

					document.form1.actors.value = document.form1.actors.value+';'+iIdPerson;
					document.getElementById("div2").innerHTML += '<br/>'+sName;
				}
			</script>

			<input id="autocomplete">

			<script>
				$( "#autocomplete" ).autocomplete({
				  minLength: 2,
	    		  scrollHeight: 220,
				  source: function( request, response ) {
				  		$.ajax({
							url: "/personne-autocomplete/"+request.term+"/",
							type: "get",
	            			dataType: 'json',
	            			async: true,
	            			cache:true,
						}).done(function( returnHtml ) {
							response($.map(returnHtml, function(item) {
								return {
	                        		id : item.id,
	                        		name : item.name
	                    		}
							}));
						});
				      }
				}).data("ui-autocomplete")._renderItem = function (ul, item) {
	    			return $( "<li>" )
						    .attr( "data-value", item.id )
						    .append('<a href="javascript:void(0);" onClick="addActor(\'' + item.id + '\', \'' + item.name + '\')">' + item.name + '</a>')
						    .appendTo( ul );
				};
			</script>
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Fiches</td>
		<td style="background-color:#DDDDFF">
			<input type="hidden" name="id_record" {if isset($article)}value="{$article_has_record_value}"{/if}>
			<div id="div1">{if isset($article)}{$article_has_record_name}{/if}</div>
		</td>
		<td style="background-color:#DDDDFF">
			<script>
				function addRecord(iIdRecord, sName) {

					document.form1.id_record.value = iIdRecord;
					document.getElementById("div1").innerHTML = sName;
				}
			</script>

			<input id="autocomplete2">

			<script>
				$( "#autocomplete2" ).autocomplete({
				  minLength: 2,
	    		  scrollHeight: 220,
				  source: function( request, response ) {
				  		$.ajax({
							url: "/film-autocomplete/"+request.term+"/",
							type: "get",
	            			dataType: 'json',
	            			async: true,
	            			cache:true,
						}).done(function( returnHtml ) {
							response($.map(returnHtml, function(item) {
								return {
	                        		id : item.id,
	                        		name : item.title
	                    		}
							}));
						});
				      }
				}).data("ui-autocomplete")._renderItem = function (ul, item) {
	    			return $( "<li>" )
						    .attr( "data-value", item.id )
						    .append('<a href="javascript:void(0);" onClick="addRecord(\'' + item.id + '\', \'' + item.name + '\')">' + item.name + '</a>')
						    .appendTo( ul );
				};
			</script>
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF" colspan="3">
			{if isset($record)}
				<img src="/images/record_{$app['get']['id']}.jpg"/>
			{else}
				Photo : <input type="file" name="fichier">
			{/if}
		</td>
	</tr><tr>
		<td style="background-color:#DDDDFF" colspan="3"><input type="submit"></td>
	</tr></table>
</form>
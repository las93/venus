Ajouter un alias :<p>
<form name="form1" method="post" enctype="multipart/form-data">
	<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF"><tr>
		<td style="background-color:#DDDDFF">Alias</td>
		<td style="background-color:#DDDDFF" colspan="2"><input name="alias" type="text" {if isset($person)}value="{$person->get_firstname()}"{/if}/></td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Personnes</td>
		<td style="background-color:#DDDDFF">
			<input type="hidden" name="id_person">
			<div id="div2">--Liste--</div>
		</td>
		<td style="background-color:#DDDDFF">
			<script>
				function addActor(iIdPerson, sName) {

					document.form1.id_person.value = iIdPerson;
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
		<td style="background-color:#DDDDFF" colspan="3"><input type="submit"></td>
	</tr></table>
</form>
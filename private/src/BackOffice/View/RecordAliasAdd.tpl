Ajouter un alias :<p>
<form name="form1" method="post" enctype="multipart/form-data">
	<table cellpadding="10" cellspacing="1" style="background-color:#BBBBFF"><tr>
		<td style="background-color:#DDDDFF">Alias</td>
		<td style="background-color:#DDDDFF" colspan="2"><input name="alias" type="text" {if isset($person)}value="{$person->get_firstname()}"{/if}/></td>
	</tr><tr>
		<td style="background-color:#DDDDFF">Fiches</td>
		<td style="background-color:#DDDDFF">
			<input type="hidden" name="id_record" {if isset($article)}value="{$article_has_record_value}"{/if}>
			<div id="div1">--Liste--{if isset($article)}{$article_has_record_name}{/if}</div>
		</td>
		<td style="background-color:#DDDDFF">
			<script>
				function addRecord(iIdRecord, sName) {

					document.form1.id_record.value = iIdRecord;
					document.getElementById("div1").innerHTML += '<br/>'+sName;
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
		<td style="background-color:#DDDDFF" colspan="3"><input type="submit"></td>
	</tr></table>
</form>
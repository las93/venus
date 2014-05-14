{if isset($article)}Modifier un article :{else}Ajouter un article :{/if}<p>
<form name="form1" id="testForm" method="post" enctype="multipart/form-data">
	<table cellpadding="10" cellspacing="1"><tr>
		<td>Titre</td>
		<td colspan="2"><input name="title" id="inputTitle" type="text" {if isset($article)}value="{$article->get_title()}"{/if}/></td>
	</tr><tr>
		<td>Type</td>
		<td colspan="2"><select name="id_article_type" onChange="changeCheckbox(this.value)">
			{foreach $type as $aOne}
				<option value="{$aOne->get_id()}" {if isset($article)}{if $article->get_id_article_type() == $aOne->get_id()}selected="selected"{/if}{/if}>{$aOne->get_name()}</option>
			{/foreach}
			</select>
			<script>
				function changeCheckbox(valueBox) {
					if (valueBox == 1) { document.getElementById('box1').style.display='block'; document.getElementById('box2').style.display='none'; document.getElementById('box3').style.display='none'; }
					if (valueBox == 3) { document.getElementById('box1').style.display='none'; document.getElementById('box2').style.display='block'; document.getElementById('box3').style.display='none'; }
					if (valueBox == 4) { document.getElementById('box1').style.display='none'; document.getElementById('box2').style.display='none'; document.getElementById('box3').style.display='block'; }
				}
			</script>
		</td>
	</tr><tr>
		<td>Sous-Type</td>
		<td colspan="2">
			<div id="box1" style="display:{if isset($article)}{if $article->get_id_article_type() == 1}block{/if}{elseif !isset($article)}block{else}none{/if};">
			{foreach $subtype_cinema as $aOne}
				<input type="checkbox" name="subtype[]" value="{$aOne->get_id()}"> {$aOne->get_name()} |
			{/foreach}
			</div>
			<div id="box2" style="display:{if isset($article)}{if $article->get_id_article_type() == 3}block{/if}{else}none{/if};">
			{foreach $subtype_folder as $aOne}
				<input type="checkbox" name="subtype[]" value="{$aOne->get_id()}"> {$aOne->get_name()} |
			{/foreach}
			</div>
			<div id="box3" style="display:{if isset($article)}{if $article->get_id_article_type() == 4}block{/if}{else}none{/if};">
			{foreach $subtype_serie as $aOne}
				<input type="checkbox" name="subtype[]" value="{$aOne->get_id()}"> {$aOne->get_name()} |
			{/foreach}
			</div>
		</td>
	</tr><tr>
		<td>Fiches</td>
		<td>
			<input type="hidden" name="records" {if isset($article)}value="{$article_has_record_value}"{/if}>
			<div id="div1">--Liste--{if isset($article)}{$article_has_record_name}{/if}</div>
		</td>
		<td>
			<script>
				function addRecord(iIdRecord, sName) {

					document.form1.records.value = document.form1.records.value+';'+iIdRecord;
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
		<td>Personnes</td>
		<td>
			<input type="hidden" name="actors" {if isset($article)}value="{$article_has_person_value}"{/if}>
			<div id="div2">--Liste--{if isset($article)}{$article_has_person_name}{/if}</div>
		</td>
		<td>
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
		<td>Content</td>
		<td colspan="2">
			<textarea name="content" id="textcontent" cols="100" rows="10">{if isset($article)}{$article->get_content()}{/if}</textarea>
			<br/>
			Photo : <select name="myphoto" id="myphoto">{foreach $photo as $aOne}<option value="{$aOne->url}">{$aOne->get_title()}</option>{/foreach}</select>
			<span id="addImg" style="text-decoration:underline;color:blue;">Ajouter</span>
			<br/>
			Vidéo : <select name="myvideo" id="myvideo">{foreach $trailer as $aOne}<option value="{$aOne->get_link()}">{$aOne->get_title()}</option>{/foreach}</select>
			<span id="addVideo" style="text-decoration:underline;color:blue;">Ajouter</span>
			<br/>
			Articles : <select name="myarticle" id="myarticle">{foreach $articles as $aOne}<option value="<a href='{$aOne->url}'><img src='{$aOne->urlImg}' style='border:0;' height='15'> {$aOne->get_title() addslashes}</a>">{$aOne->get_title()}</option>{/foreach}</select>
			<span id="addArticle" style="text-decoration:underline;color:blue;">Ajouter</span>
			<script>
			$("#addImg").click(function() {
			  $("#textcontent").val($("#textcontent").val()+' <img src="'+document.form1.myphoto.options[document.form1.myphoto.options.selectedIndex].value+'" width="600"/>');
			});
			$("#addVideo").click(function() {
			  $("#textcontent").val($("#textcontent").val()+' <iframe width="600" height="358" src="'+document.form1.myvideo.options[document.form1.myvideo.options.selectedIndex].value+'" frameborder="0" allowfullscreen></iframe>');
			});
			$("#addArticle").click(function() {
			  $("#textcontent").val($("#textcontent").val()+' '+document.form1.myarticle.options[document.form1.myarticle.options.selectedIndex].value);
			});
			</script>
		</td>
	</tr><tr>
		<td colspan="3">
			{if isset($article)}
				<img src="/images/article_{$app['get']['id']}.jpg"/><br/>
				Image de l'actu : <input type="file" name="fichier">(160x240)
			{else}
				Image de l'actu : <input type="file" name="fichier">(160x240)
			{/if}
		</td>
	</tr><tr>
		<td colspan="3"><input type="submit" id="submitButton"></td>
	</tr></table>
</form>
<script type="text/javascript">
   // $(document).ready(function () {
    	$('#submitButton').bind('click', function () {
            $('#testForm').jqxValidator('validate');
        });
    	$('#testForm').jqxValidation({
    		rules: [
    			{ input: '#inputTitle', message: 'Le titre est obligatoire!', action: 'keyup', rule: 'required' }
    		],
    		theme: 'summer'
    	});
    //});
</script>
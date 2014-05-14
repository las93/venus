{* version=2; *}
<div class="double_tier_left_bloc">
	<div style="float:left;width:440px;marging-bottom:5px;">
		<h1 style="border-bottom:dotted 1px gray;">{$actor->get_firstname()} {$actor->get_name()}</h1>
	</div>
	<div style="float:left;width:190px;text-align:right;">
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=666235750056206";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="fb-like" data-href="http://www.iscreenway.com{$app.server.REQUEST_URI}" data-width="80" width="80"  data-colorscheme="light" data-layout="box_count" data-action="like" data-show-faces="true" data-send="false"></div>


		<a href="https://twitter.com/share" class="twitter-share-button" data-lang="fr" data-count="vertical">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

		<!-- Place this tag where you want the +1 button to render. -->
		<div class="g-plusone" data-size="tall" data-width="50px;"></div>

		<!-- Place this tag after the last +1 button tag. -->
		<script type="text/javascript">
		  window.___gcfg = {lang: 'fr'};

		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
	</div>
	<div style="width:200px;float:left;margin-top:5px;text-align:center;">
		<img src="{$app.const.IMG_PROD}{$actor->image}" alt="{$actor->get_firstname()|escape} {$actor->get_name()|escape}" title="{$actor->get_firstname()|escape} {$actor->get_name()|escape}"/>
	</div>
	<div style="width:430px;float:left;margin-top:5px;">
		<table cellpadding="10" cellspacing="1" width="100%">
			<tr>
				<td style="background-color:white" align="center">
					Métiers
				</td>
				<td style="background-color:white" align="center">
					{$actor->jobs}
				</td>
			</tr><tr>
				<td style="background-color:white" align="center">
					Nationalité
				</td>
				<td style="background-color:white" align="center">
					{$actor->get_nationality()->get_name()}
				</td>
			</tr><tr>
				<td style="background-color:white" align="center">
					Naissance
				</td>
				<td style="background-color:white" align="center">
					{if ($actor->get_birthday() == '01/01/1900')}Inconnue
					{elseif ($actor->get_birthday() != '00/00/0000')}{$actor->get_birthday()}{else}Inconnue{/if}
				</td>
			</tr><tr>
				<td style="background-color:white" align="center">
					Âge
				</td>
				<td style="background-color:white" align="center">
					{if ($actor->get_birthday() == '01/01/1900')}N.C.
					{elseif ($actor->get_birthday() != '00/00/0000')}{$actor->age}{else}N.C.{/if}
				</td>
			</tr>
		</table>
		<br/><br/>
		{if count($actor->trailer) > 0}<a href="{url alias='acteur-videos' id=$actor->get_id() title=$actor->title_encode}"><img src="/img/bandeannonce.png" title="boutton bande annonce" alt="boutton bande annonce" style="border:0;"></a>{/if}
	</div>
</div>
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2 style="border-bottom:dotted 1px gray;margin-top:5px;">Biographie de {$actor->get_firstname()} {$actor->get_name()}</h2>
	<div style="width:630px;float:left;margin-top:5px;">
		{$actor->get_biography()|nl2br}
	</div>
</div>
{if count($movies) > 0}
	<div class="double_tier_left_bloc" style="margin-top:10px;">
		<h2 style="border-bottom:dotted 1px gray;">Filmographie {$actor->get_firstname()} {$actor->get_name()}</h2>
		<div style="width:630px;float:left;margin-top:5px;">
		{assign var=$i value=0}
		{foreach from=$movies key=$iKey item=$oRecord}
			{if $i < 4}
				<div style="text-align:center;width:157px;float:left;">
					<a href="{$oRecord->url}"><img src="{$app.const.IMG_PROD}{$oRecord->image}" border="0" width="140"/><br/>
					<span style="color:black;">{$oRecord->get_title()}</span></a>
				</div>
			{/if}
			{assign var=$i value=$i+1}
		{/foreach}
		</div>
		<div style="width:630px;float:left;margin-top:5px;">
			<br/>&gt; <a href="{url alias='acteur-filmography' id=$actor->get_id() title=$actor->title_encode}">Filmographie de {$actor->get_firstname()} {$actor->get_name()}</a>
		</div>
	</div>
{/if}
{if $actor->photo['count'] > 0}
	<div class="double_tier_left_bloc" style="margin-top:10px;">
		<h2>Photos de {$actor->get_firstname()} {$actor->get_name()}</h2>
		<div style="width:630px;float:left;margin-top:5px;">
			{assign var=$iKey2 value=0}
			{foreach from=$actor->photo['items'] key=$iKey2 item=$oPhoto}
				{if $iKey2 == 0 || $iKey2 == 4 || $iKey2 == 8 || $iKey2 == 12 || $iKey2 == 16}<div style="width:630px;float:left;">{/if}
				<div style="width:157px;float:left;text-align:center;">
					<a href="{url alias='une-photos' id=$oPhoto->get_id() title=$oPhoto->title_encode}"><img src="{$app.const.IMG_PROD}/images/photo_{$oPhoto->get_id()}.jpg" border="0" width="95" alt="{$oPhoto->get_title()|escape}" title="{$oPhoto->get_title()|escape}"/></a><br/>
				</div>
				{if $iKey2 == 3 || $iKey2 == 7 || $iKey2 == 11 || $iKey2 == 15 || $iKey2 == 19}</div>{/if}
			{/foreach}
			{if $iKey2 != 3 && $iKey2 != 7 && $iKey2 != 11 && $iKey2 != 15 && $iKey2 != 19}</div>{/if}
			<div style="width:630px;float:left;margin-top:5px;">
				<br/>&gt; <a href="{url alias='acteur-photos' id=$actor->get_id() title=$actor->title_encode}">Toutes les photos de {$actor->get_firstname()} {$actor->get_name()}</a>
			</div>
		</div>
	</div>
{/if}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2>Actualités de {$actor->get_firstname()} {$actor->get_name()}</h2>
	<div style="width:630px;float:left;margin-top:5px;">
		{if $actor->news['count'] > 0}
			{foreach from=$actor->news['items'] key=$iKey2 item=$oNews2}
				<div class="demicadre" style="margin-bottom:20px;width:315px;float:left;">
					<div class='imgnew'><a href="{$oNews2->url}"><img src="{$app.const.IMG_PROD}{$oNews2->image}" alt="{$oNews2->get_title()|escape}" title="{$oNews2->get_title()|escape}" border="0" width="300"/></a></div>
					<div class='contentnews'>
						<a href="{$oNews2->url}"><b>{$oNews2->get_title()}</b></a><br/>
						{$oNews2->get_content()|truncate:100}</b>
					</div>
				</div>
			{/foreach}
			<div style="width:630px;float:left;margin-top:5px;">
				<br/>&gt; <a href="{url alias='acteur-news' id=$actor->get_id() title=$actor->title_encode}">Toutes les actualités de {$actor->get_firstname()} {$actor->get_name()}</a>
			</div>
		{else}
			<div style="width:630px;float:left;margin-top:5px;">
				<br/>&gt; Il n'y a pas d'actualité de {$actor->get_firstname()} {$actor->get_name()}</a>
			</div>
		{/if}
	</div>
</div>
{if $last_trailers['count'] > 0}
	<div class="double_tier_left_bloc" style="margin-top:10px;">
		<h2 style="border-bottom:dotted 1px gray;">Vidéos de {$actor->get_firstname()} {$actor->get_name()}</h2>
		<div style="width:630px;float:left;">
			{foreach from=$last_trailers['items'] item=$oTrailer}
				<div style="width:157px;float:left;text-align:center;margin-top:5px;">
					<a href="{url alias='bande-annonce-detail' base=$oTrailer->record_base_type id_record=$oTrailer->record_id title_record=$oTrailer->record_title_encode id=$oTrailer->get_id() title=$oTrailer->title_encode}"><img src="{$app.const.IMG_PROD}/images/trailer_{$oTrailer->get_id()}.jpg" border="0"/><br/>
					<span style="color:black;">{$oTrailer->get_title()}</span></a>
				</div>
			{/foreach}
		</div>
		<div style="width:630px;float:left;margin-top:5px;">
			<br/>&gt; <a href="{url alias='acteur-videos' id=$actor->get_id() title=$actor->title_encode}">Toutes les vidéos de {$actor->get_firstname()} {$actor->get_name()}</a>
		</div>
	</div>
{/if}
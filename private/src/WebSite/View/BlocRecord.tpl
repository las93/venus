{* version=2; *}
<div class="double_tier_left_bloc">
	<div style="float:left;width:440px;marging-bottom:5px;">
		<h1 style="border-bottom:dotted 1px gray;">{$record->get_title()}</h1>
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
	<div style="width:200px;float:left;">
		<img src="{$app.const.IMG_PROD}{$record->image}"/>
	</div>
	<div style="width:430px;float:left;">
		<table cellpadding="5" cellspacing="1">
			<tr>
				<td align="left" style="color:gray;" width="100">
					Date de sortie
				</td>
				<td align="left">
					{$record->get_date_cinema()}
				</td>
			</tr><tr>
				<td align="left" style="color:gray;">
					Réalisateurs
				</td>
				<td align="left">
					{$realisators}
				</td>
			</tr><tr>
				<td align="left" style="color:gray;">
					Acteurs
				</td>
				<td align="left">
					{$actors}
				</td>
			</tr><tr>
				<td align="left" style="color:gray;">
					Genre
				</td>
				<td align="left">
					{$kinds}
				</td>
			</tr><tr>
				<td align="left" style="color:gray;">
					Nationalité
				</td>
				<td align="left">
					{$nationality}
				</td>
			</tr>
		</table>
		<br/><br/>
		{if count($record->trailer) > 0}<a href="{url alias='bande-annonce-film' base=$record->base_type id=$record->get_id() title=$record->title_encode}"><img src="/img/bandeannonce.png" title="boutton bande annonce" alt="boutton bande annonce" style="border:0;"></a>{/if}
	</div>
</div>
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2 style="border-bottom:dotted 1px gray;">Synopsis {$record->get_title()}</h2>
	<br/>{$record->get_synopsis()}<br/><br/>
	{if $menu == "cinema"}
		<table cellpadding="2" cellspacing="0" width="100%">
			<tr>
				<td style="background-color:#DDDDDD" align="center" width="30%">
					Distributeur
				</td>
				<td style="background-color:#DDDDDD" align="center" width="20%">
					{$distributor}
				</td>
				<td style="background-color:#FFFFFF" align="center" width="30%">
					Type de film
				</td>
				<td style="background-color:#FFFFFF" align="center" width="20%">
					???
				</td>
			</tr><tr>
				<td style="background-color:#FFFFFF" align="center">
					Année de production
				</td>
				<td style="background-color:#FFFFFF" align="center">
					{$record->get_production_date()}
				</td>
				<td style="background-color:#DDDDDD" align="center">
					Secrets de tournage
				</td>
				<td style="background-color:#DDDDDD" align="center">
					???
				</td>
			</tr><tr>
				<td style="background-color:#DDDDDD" align="center">
					Sortie en DVD/Blu-ray
				</td>
				<td style="background-color:#DDDDDD" align="center">
					{if $record->get_date_dvd() == '1920-01-01'}N.C.{else}{$record->get_date_dvd()}{/if}
				</td>
				<td style="background-color:#FFFFFF" align="center">
					Box Office France
				</td>
				<td style="background-color:#FFFFFF" align="center">
					???
				</td>
			</tr><tr>
				<td style="background-color:#FFFFFF" align="center">
					Date de sortie en VOD
				</td>
				<td style="background-color:#FFFFFF" align="center">
					{if $record->get_date_vod() == '1920-01-01'}N.C.{else}{$record->get_date_vod()}{/if}
				</td>
				<td style="background-color:#DDDDDD" align="center">
					Budget
				</td>
				<td style="background-color:#DDDDDD" align="center">
					???
				</td>
			</tr>
		</table>
	{else}
		|
		{section name=$i loop=$max_season start=1}
			<a href="{$app.server.REQUEST_URI}/saison/{$i}">Saison {$i}</a> |
		{/section}
	{/if}
</div>
{if $menu == "serie"}
	{if count($channels)}
		<div class="grandcadre">
			<h2>Diffusion de {$record->get_title()}</h2>
			<div class="grandcadre" style="width:500px">
			{foreach from=$channels item=$oChannel}
				<a href="{url alias='diffusion-tv' base=$record->base_type id=$record->get_id() title=$record->title_encode}#channel_{$oChannel->get_id()}"><img src="/img/logo_{$oChannel->get_id()}.jpg" alt="{$oChannel->get_name() addslashes}" title="{$oChannel->get_name() addslashes}" style="border:solid 1px black;"></a>
			{/foreach}
			</div>
			{foreach from=$diffusions item=$oProgram}
				<div class="demicadre">
					<div style="float:left;">
						<img src="{$app.const.IMG_PROD}/img/logo_{$oProgram->get_id_channel()}.jpg" alt="{$oProgram->get_channel()->get_name() addslashes}" title="{$oProgram->get_channel()->get_name() addslashes}">
						&nbsp;&nbsp;&nbsp;&nbsp;
					</div>
					<div style="float:left;">
						&nbsp;<br/>
						<span style="color:#777777;font-size:10px;"><b>Le {$oProgram->get_start()|date_format:'Y-m-d'} de {$oProgram->get_start()|hour} à {$oProgram->get_end()|hour}</b></span><br/>
						<span style="color:#777777;font-size:10px;"><b>Saison {$oProgram->get_season()} épisode {$oProgram->get_episode()}</b></span><br/><br/>
					</div>
				</div>
			{/foreach}
			{if count($diffusions) > 0}
				<div class="liencadre">
					<br/>&gt; <a href="{url alias='diffusion-tv' base=$record->base_type id=$record->get_id() title=$record->title_encode}">Toutes les diffusions de {$record->get_title()}</a>
				</div>
			{else}
				<div class="liencadre">
					<br/>&gt; Aucune diffusion de {$record->get_title()}</a>
				</div>
			{/if}
		</div>
	{/if}
{/if}
{if count($record->trailer) > 0}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2 style="border-bottom:dotted 1px gray;">Bandes-annonces {$record->get_title()}</h2>
	<div style="width:630px;float:left;">
		{foreach from=$record->trailer item=$oTrailer}
			<div style="width:157px;float:left;text-align:center;">
				<a href="{url alias='bande-annonce-detail' base=$record->base_type id_record=$record->get_id() title_record=$record->title_encode id=$oTrailer->get_id() title=$oTrailer->title_encode}"><img src="{$app.const.IMG_PROD}/images/trailer_{$oTrailer->get_id()}.jpg" border="0"/><br/>
				<span style="color:black;">{$oTrailer->get_title()}</span></a>
			</div>
		{/foreach}
	</div>
	<div style="width:630px;float:left;margin-top:5px;">
		<br/>&gt; <a href="{url alias='bande-annonce-film' base=$record->base_type id=$record->get_id() title=$record->title_encode}">Toutes les bandes-annonces de {$record->get_title()}</a>
	</div>
</div>
{/if}
{if count($list_actors) > 0}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2>Acteurs et actrices de {$record->get_title()}</h2>
	<div style="width:630px;float:left;">
	{foreach from=$list_actors key=$iKey item=$oActor}
		{if $iKey < 4}
			<div class="bacadre" style="text-align:center;width:157px;float:left;">
				<a href="{$oActor->url}"><img src="{$app.const.IMG_PROD}{$oActor->image}" border="0" width="140"/><br/>
				<span style="color:black;">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</span></a>
			</div>
		{/if}
	{/foreach}
	</div>
	<div style="width:630px;float:left;margin-top:5px;">
		<br/>&gt; <a href="{url alias='casting' base=$record->base_type id=$record->get_id() title=$record->title_encode}">Casting de {$record->get_title()}</a>
	</div>
</div>
{/if}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2>Critique de {$record->get_title()}</h2>
	<div style="width:630px;float:left;margin-top:5px;">
		{if $record->get_review() != ''}
			{if $record->get_score() > 0.5}<img src="/img/star.png">{elseif $record->get_score() > 0}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
			{if $record->get_score() > 1.5}<img src="/img/star.png">{elseif $record->get_score() > 1}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
			{if $record->get_score() > 2.5}<img src="/img/star.png">{elseif $record->get_score() > 2}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
			{if $record->get_score() > 3.5}<img src="/img/star.png">{elseif $record->get_score() > 3}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
			{if $record->get_score() > 4.5}<img src="/img/star.png">{elseif $record->get_score() > 4}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
			<br/>
			{$record->get_review()|truncate:100} <a href="{url alias='critique-film' base=$record->base_type id=$record->get_id() title=$record->title_encode}">[suite]</a>
		{else}
			Nous n'avons pas encore fait de critique de {$record->get_title()}
		{/if}
	</div>
</div>
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2>Critiques de {$record->get_title()} par les spectateurs</h2>
	<div style="width:630px;float:left;margin-top:5px;">
		Nous n'avons pas encore fait de critique de {$record->get_title()}
	</div>
</div>
{if $record->photo['count'] > 0}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2>Photos de {$record->get_title()}</h2>
	<div style="width:630px;float:left;margin-top:5px;">
		{assign var=$iKey2 value=0}
		{foreach from=$record->photo['items'] key=$iKey2 item=$oPhoto}
			{if $iKey2 == 0 || $iKey2 == 4 || $iKey2 == 8 || $iKey2 == 12 || $iKey2 == 16}<div style="width:630px;float:left;">{/if}
			<div style="width:157px;float:left;">
				<a href="{url alias='une-photos' id=$oPhoto->get_id() title=$oPhoto->title_encode}"><img src="{$app.const.IMG_PROD}/images/photo_{$oPhoto->get_id()}.jpg" border="0" width="95" alt="{$oPhoto->get_title()|escape}" title="{$oPhoto->get_title()|escape}"/></a><br/>
			</div>
			{if $iKey2 == 3 || $iKey2 == 7 || $iKey2 == 11 || $iKey2 == 15 || $iKey2 == 19}</div>{/if}
		{/foreach}
		{if $iKey2 != 3 && $iKey2 != 7 && $iKey2 != 11 && $iKey2 != 15 && $iKey2 != 19}</div>{/if}
		<div style="width:630px;float:left;margin-top:5px;">
			<br/>&gt; <a href="{url alias='photo-film' base=$record->base_type id=$record->get_id() title=$record->title_encode}">Toutes les photos de {$record->get_title()}</a>
		</div>
	</div>
</div>
{/if}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2>Actualités de {$record->get_title()}</h2>
	<div style="width:630px;float:left;margin-top:5px;">
		{if $record->news['count'] > 0}
			{foreach from=$record->news['items'] key=$iKey2 item=$oNews2}
				<div class="demicadre" style="margin-bottom:20px;width:315px;float:left;">
					<div class='imgnew'><a href="{$oNews2->url}"><img src="{$app.const.IMG_PROD}{$oNews2->image}" alt="{$oNews2->get_title()|escape}" title="{$oNews2->get_title()|escape}" border="0" width="300"/></a></div>
					<div class='contentnews'>
						<a href="{$oNews2->url}"><b>{$oNews2->get_title()}</b></a><br/>
						{$oNews2->get_content()|truncate:100}</b>
					</div>
				</div>
			{/foreach}
			<div style="width:630px;float:left;margin-top:5px;">
				<br/>&gt; <a href="{url alias='film-news' base=$record->base_type id=$record->get_id() title=$record->title_encode}">Toutes les actualités de {$record->get_title()}</a>
			</div>
		{else}
			<div style="width:630px;float:left;margin-top:5px;">
				<br/>&gt; Il n'y a pas d'actualité de {$record->get_title()}</a>
			</div>
		{/if}
	</div>
</div>
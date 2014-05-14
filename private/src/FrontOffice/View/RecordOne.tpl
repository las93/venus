<div id="title">
	{if $record->get_type() == 'serie'}
		<div style="float:left;width:500px;"><h1>Série {$record->get_title()}</h1></div>
		<div style="float:left;width:400px;">
			<form name="like" method="post">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="like" value="1">
				<a href="javascript:void(0);" onCLick="document.like.submit();"><img src="/img/coeur.png"> <b style="font-size:18px;">&nbsp; {$like}</b> like</a>
			</form>
		</div>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'series'}">Séries TV</a>
		&gt; <a href="{url 'liste-series'}">liste des séries TV</a>
		&gt; <a href="{url 'url_film'}">{$record->get_title()}</a>
	{else}
		<div style="float:left;width:500px;"><h1>Film {$record->get_title()}</h1></div>
		<div style="float:left;width:400px;">
			<form name="like" method="post">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="like" value="1">
				<a href="javascript:void(0);" onCLick="document.like.submit();"><img src="/img/coeur.png"> <b style="font-size:18px;">&nbsp; {$like}</b> like</a>
			</form>
		</div>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'cinema'}">Cinéma</a>
		&gt; <a href="{url 'liste-film'}">Liste des films</a>
		&gt; <a href="{url 'url_film'}">{$record->get_title()}</a>
	{/if}
</div>
<div id="left">
	{include $tpl_record_menu}
	<div class="grandcadre">
		<div class="tiercadre"><img src="{url 'images' 'file_name' as $url_img}"/></div>
		<div class="2tiercadre">
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
			<br/>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=666235750056206";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like" data-href="http://www.iscreenway.com{$app['environment']['REQUEST_URI']}" data-width="80" width="80"  data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="true" data-send="false"></div>
			&nbsp;&nbsp;&nbsp;&nbsp;

			<a href="https://twitter.com/share" class="twitter-share-button" data-lang="fr">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

			<!-- Place this tag where you want the +1 button to render. -->
			<div class="g-plusone"  data-size="medium" data-width="50px;"></div>

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
	</div>
	<div class="grandcadre">
		<h2>Synopsis de {$record->get_title()}</h2>
		{$record->get_synopsis()}<br/><br/>
		{if $type == "cinema"}
			<table cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td style="background-color:#DDDDDD" align="center">
						Distributeur
					</td>
					<td style="background-color:#DDDDDD" align="center">
						{$distributor}
					</td>
					<td style="background-color:#FFFFFF" align="center">
						Type de film
					</td>
					<td style="background-color:#FFFFFF" align="center">
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
						Date de sortie en DVD/Bluray
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
			{loop $max_season}
				<a href="{$app['environment']['REQUEST_URI']}/saison/{$i}">Saison {$i}</a> |
			{/loop}
		{/if}
	</div>
	{if $type == "serie"}
		{if count($channels)}
			<div class="grandcadre">
				<h2>Diffusion de {$record->get_title()}</h2>
				<div class="grandcadre" style="width:500px">
				{foreach $channels as $oChannel}
					<a href="{$record_menu['diffusiontv']}#channel_{$oChannel->get_id()}"><img src="/img/logo_{$oChannel->get_id()}.jpg" alt="{$oChannel->get_name() addslashes}" title="{$oChannel->get_name() addslashes}" style="border:solid 1px black;"></a>
				{/foreach}
				</div>
				{foreach $diffusions as $oProgram}
					<div class="demicadre">
						<div style="float:left;">
							<img src="/img/logo_{$oProgram->get_id_channel()}.jpg" alt="{$oProgram->get_channel()->get_name() addslashes}" title="{$oProgram->get_channel()->get_name() addslashes}">
							&nbsp;&nbsp;&nbsp;&nbsp;
						</div>
						<div style="float:left;">
							&nbsp;<br/>
							<span style="color:#777777;font-size:10px;"><b>Le {$oProgram->get_start() date} de {$oProgram->get_start() hour} à {$oProgram->get_end() hour}</b></span><br/>
							<span style="color:#777777;font-size:10px;"><b>Saison {$oProgram->get_season()} épisode {$oProgram->get_episode()}</b></span><br/><br/>
						</div>
					</div>
				{/foreach}
				{if count($diffusions) > 0}
					<div class="liencadre">
						<br/>&gt; <a href="{$record_menu['diffusiontv']}">Toutes les diffusions de {$record->get_title()}</a>
					</div>
				{else}
					<div class="liencadre">
						<br/>&gt; Aucune diffusion de {$record->get_title()}</a>
					</div>
				{/if}
			</div>
		{/if}
	{/if}
	{if count($trailers) > 0}
	<div class="grandcadre">
		<h2>{if $type == "serie"}Vidéos{else}Bandes-annonces{/if} de {$record->get_title()}</h2>
		{foreach $trailers as $oTrailer}
		<div class="bacadre" style="height:150px;">
			<a href="{$oTrailer->url}"><img src="/images/trailer_{$oTrailer->get_id()}.jpg" border="0"/><br/>
			<span style="color:black;">{$oTrailer->get_title()}</span></a>
		</div>
		{/foreach}
		<div class="liencadre">
			<br/>&gt; <a href="{$record_menu['trailer']}">Toutes les bandes-annonces de {$record->get_title()}</a>
		</div>
	</div>
	{/if}
	{if count($list_actors) > 0}
	<div class="grandcadre">
		<h2>Acteurs et actrices de {$record->get_title()}</h2>
		{foreach $list_actors as $iKey => $oActor}
			{if $iKey < 4}
				<div class="bacadre" style="text-align:center;">
					<a href="{$oActor->url}"><img src="/images/person_{$oActor->person->get_id()}.jpg" border="0" width="140"/><br/>
					<span style="color:black;">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</span></a>
				</div>
			{/if}
		{/foreach}
		<div class="liencadre">
			<br/>&gt; <a href="{$record_menu['casting']}">Casting de {$record->get_title()}</a>
		</div>
	</div>
	{/if}
	<div class="grandcadre">
		<h2>Critique de {$record->get_title()}</h2>
		<div class="liencadre">
			{if $record->get_review() != ''}
				{if $record->get_score() > 0.5}<img src="/img/star.png">{elseif $record->get_score() > 0}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
				{if $record->get_score() > 1.5}<img src="/img/star.png">{elseif $record->get_score() > 1}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
				{if $record->get_score() > 2.5}<img src="/img/star.png">{elseif $record->get_score() > 2}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
				{if $record->get_score() > 3.5}<img src="/img/star.png">{elseif $record->get_score() > 3}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
				{if $record->get_score() > 4.5}<img src="/img/star.png">{elseif $record->get_score() > 4}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
				<br/>
				{truncate $record->get_review() 100} <a href="{$record_menu['critique']}">[suite]</a>
			{else}
				Nous n'avons pas encore fait de critique de {$record->get_title()}
			{/if}
		</div>
	</div>
	<div class="grandcadre">
		<h2>Critiques de {$record->get_title()} par les spectateurs</h2>
		<div class="liencadre">
			Nous n'avons pas encore fait de critique de {$record->get_title()}
		</div>
	</div>
	<div class="grandcadre">
		<h2>Photos de {$record->get_title()}</h2>
		{foreach $photos as $iKey2 => $oPhoto}
			<div class='imgphotorecord'>
				<a href="{$oPhoto->url}"><img src="/images/photo_{$oPhoto->get_id()}.jpg" border="0" width="95" alt="{$oPhoto->get_title() addslashes}" title="{$oPhoto->get_title() addslashes}"/></a><br/>
			</div>
		{/foreach}
	</div>
	<div class="grandcadre">
		<h2>Actualités de {$record->get_title()}</h2>
			{if $news[0]->count > 0}
				{foreach $news as $iKey2 => $oNews2}
					<div class="demicadre" style="margin-bottom:20px;">
						<div class='imgnew'><a href="{$oNews2->url}"><img src="/images/article_{$oNews2->get_id()}.jpg" alt="{$oNews2->get_title() addslashes}" title="{$oNews2->get_title() addslashes}" border="0" width="300"/></a></div>
						<div class='contentnews'>
							<a href="{$oNews2->url}"><b>{$oNews2->get_title()}</b></a><br/>
							{truncate $oNews2->get_content() 100}</b>
						</div>
					</div>
				{/foreach}
				<div class="liencadre">
					<br/>&gt; <a href="{$record_menu['news']}">Toutes les actualités de {$record->get_title()}</a>
				</div>
			{else}
				<div class="liencadre">
					<br/>&gt; Il n'y a pas d'actualité de {$record->get_title()}</a>
				</div>
			{/if}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


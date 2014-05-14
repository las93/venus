{* version=2; *}
<div class="double_tier_left_bloc">
	<div style="float:left;width:440px;marging-bottom:5px;">
		<h1 style="border-bottom:dotted 1px gray;">Filmographie de {$actor->get_firstname()} {$actor->get_name()}</h1>
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
</div>
{if count($actors) > 0}
	<div class="double_tier_left_bloc" style="margin-top:10px;">
		<h2 style="border-bottom:dotted 1px gray;margin-bottom:5px;">{$actor->get_firstname()} {$actor->get_name()} est acteur dans :</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach from=$actors key=$iKey item=$oActor}
				<tr>
					<td width="50%" style="background-color:#FFFFFF" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:#FFFFFF" align="center">
						<a href="{$oActor->url}">{$oActor->record->get_title()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
{/if}
{if count($creators) > 0}
	<div class="double_tier_left_bloc" style="margin-top:10px;">
		<h2 style="border-bottom:dotted 1px gray;margin-bottom:5px;">{$actor->get_firstname()} {$actor->get_name()} est créateur (ou) showrunner dans :</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach from=$creators key=$iKey item=$oActor}
				<tr>
					<td width="50%" style="background-color:#FFFFFF" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:#FFFFFF" align="center">
						<a href="{$oActor->url}">{$oActor->record->get_title()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
{/if}
{if count($creators) > 0}
	<div class="double_tier_left_bloc" style="margin-top:10px;">
		<h2 style="border-bottom:dotted 1px gray;margin-bottom:5px;">{$actor->get_firstname()} {$actor->get_name()} est réalisateur dans :</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach from=$creators key=$iKey item=$oActor}
				<tr>
					<td width="50%" style="background-color:#FFFFFF" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:#FFFFFF" align="center">
						<a href="{$oActor->url}">{$oActor->record->get_title()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
{/if}
{if count($productors) > 0}
	<div class="double_tier_left_bloc" style="margin-top:10px;">
		<h2 style="border-bottom:dotted 1px gray;margin-bottom:5px;">{$actor->get_firstname()} {$actor->get_name()} est producteur dans :</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach from=$productors key=$iKey item=$oActor}
				<tr>
					<td width="50%" style="background-color:#FFFFFF" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:#FFFFFF" align="center">
						<a href="{$oActor->url}">{$oActor->record->get_title()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
{/if}
{if count($distributors) > 0}
	<div class="double_tier_left_bloc" style="margin-top:10px;">
		<h2 style="border-bottom:dotted 1px gray;margin-bottom:5px;">{$actor->get_firstname()} {$actor->get_name()} est distributeur dans :</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach from=$distributors key=$iKey item=$oActor}
				<tr>
					<td width="50%" style="background-color:#FFFFFF" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:#FFFFFF" align="center">
						<a href="{$oActor->url}">{$oActor->record->get_title()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
{/if}
{if count($technical_team) > 0}
	<div class="double_tier_left_bloc" style="margin-top:10px;">
		<h2 style="border-bottom:dotted 1px gray;margin-bottom:5px;">{$actor->get_firstname()} {$actor->get_name()} est de l'équipe technique dans :</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach from=$technical_team key=$iKey item=$oActor}
				<tr>
					<td width="50%" style="background-color:#FFFFFF" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:#FFFFFF" align="center">
						<a href="{$oActor->url}">{$oActor->record->get_title()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
{/if}
{* version=2; *}
<div class="double_tier_left_bloc">
	<div style="float:left;width:440px;marging-bottom:5px;">
		<h1 style="border-bottom:dotted 1px gray;">Casting de {$record->get_title()}</h1>
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
{if $record->get_type() == 'serie' && count($creators) > 0}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2 style="margin-bottom:10px;">Créateurs et showrunners de {$record->get_title()}</h2>
	<div style="width:630px;float:left;margin-top:5px;">
		{foreach from=$creators['items'] item=$oActor}
		<div style="width:157px;float:left;text-align:center;margin-bottom:10px;">
			<a href="{$oActor->url}"><img src="{$app.const.IMG_PROD}{$oActor->image}" border="0" width="140" alt="{$oActor->person->get_firstname()|escape} {$oActor->person->get_name()|escape}" title="{$oActor->person->get_firstname()|escape} {$oActor->person->get_name()|escape}"/><br/>
			<span style="color:black;">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</span></a>
		</div>
		{/foreach}
	</div>
</div>
{/if}
{if count($realisators) > 0}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2 style="margin-bottom:10px;">Réalisateurs de {$record->get_title()}</h2>
	<div style="width:630px;float:left;margin-top:5px;" itemprop="director" itemscope itemtype="http://schema.org/Person">
		{foreach from=$realisators['items'] item=$oActor}
		<div style="width:157px;float:left;text-align:center;margin-bottom:10px;">
			<a href="{$oActor->url}" itemprop="url"><img src="{$app.const.IMG_PROD}{$oActor->image}" border="0" width="140" alt="{$oActor->person->get_firstname()|escape} {$oActor->person->get_name()|escape}" title="{$oActor->person->get_firstname()|escape} {$oActor->person->get_name()|escape}"/><br/>
			<span style="color:black;" itemprop="name">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</span></a>
		</div>
		{/foreach}
	</div>
</div>
{/if}
{if count($actors) > 0}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2 style="margin-bottom:10px;">Acteurs et actrices de {$record->get_title()}</h2>
	<div style="width:630px;float:left;margin-top:5px;">
		{assign var=$iKey value=0}
		{foreach from=$actors['items'] key=$iKey item=$oActor}
			{if $iKey < 8}
				<div style="width:157px;float:left;text-align:center;margin-bottom:10px;" itemprop="actors" itemscope itemtype="http://schema.org/Person">
					<a href="{$oActor->url}" itemprop="url"><img src="{$app.const.IMG_PROD}{$oActor->image}" border="0" width="140" alt="{$oActor->person->get_firstname()|escape} {$oActor->person->get_name()|escape}" title="{$oActor->person->get_firstname()|escape} {$oActor->person->get_name()|escape}"/><br/>
					<span style="color:black;" itemprop="name">{$oActor->person->get_firstname()} {$oActor->person->get_name()}<br/><small><i>Rôle : {$oActor->get_role()}</i></small></span></a>
				</div>
			{else}
				{if $iKey == 8}<table cellpadding="10" cellspacing="1" width="100%">{/if}
				<tr>
					<td width="50%" style="background-color:{if $iKey/2 == round($iKey/2)}#DDDDDD{else}#FFFFFF{/if}" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:{if $iKey/2 == round($iKey/2)}#DDDDDD{else}#FFFFFF{/if}" align="center">
						<a href="{$oActor->url}" itemprop="url"><span itemprop="name">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</span></a>
					</td>
				</tr>
			{/if}
		{/foreach}
		{if $iKey >= 8}</table>{/if}
	</div>
</div>
{/if}
{if count($productors) > 0}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2 style="margin-bottom:10px;">Producteurs de {$record->get_title()}</h2>
	<table cellpadding="10" cellspacing="1" width="100%">
		{foreach from=$productors['items'] key=$iKey item=$oActor}
			<tr>
				<td width="50%" style="background-color:{if $iKey/2 == round($iKey/2)}#DDDDDD{else}#FFFFFF{/if}" align="center">
					{$oActor->get_role()}
				</td>
				<td width="50%" style="background-color:{if $iKey/2 == round($iKey/2)}#DDDDDD{else}#FFFFFF{/if}" align="center">
					<a href="{$oActor->url}">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</a>
				</td>
			</tr>
		{/foreach}
	</table>
</div>
{/if}
{if count($screenwriters) > 0}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2 style="margin-bottom:10px;">Scénaristes de {$record->get_title()}</h2>
	<table cellpadding="10" cellspacing="1" width="100%">
		{foreach from=$screenwriters['items'] key=$iKey item=$oActor}
			<tr>
				<td width="50%" style="background-color:{if $iKey/2 == round($iKey/2)}#DDDDDD{else}#FFFFFF{/if}" align="center">
					{$oActor->get_role()}
				</td>
				<td width="50%" style="background-color:{if $iKey/2 == round($iKey/2)}#DDDDDD{else}#FFFFFF{/if}" align="center">
					<a href="{$oActor->url}">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</a>
				</td>
			</tr>
		{/foreach}
	</table>
</div>
{/if}
{if count($technical_team) > 0}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2 style="margin-bottom:10px;">Equipe technique de {$record->get_title()}</h2>
	<table cellpadding="10" cellspacing="1" width="100%">
		{foreach from=$technical_team['items'] key=$iKey item=$oActor}
			<tr>
				<td width="50%" style="background-color:{if $iKey/2 == round($iKey/2)}#DDDDDD{else}#FFFFFF{/if}" align="center">
					{$oActor->get_role()}
				</td>
				<td width="50%" style="background-color:{if $iKey/2 == round($iKey/2)}#DDDDDD{else}#FFFFFF{/if}" align="center">
					<a href="{$oActor->url}">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</a>
				</td>
			</tr>
		{/foreach}
	</table>
</div>
{/if}
{if $record->get_type() == 'serie' && count($distributors) > 0}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2 style="margin-bottom:10px;">Distributeurs de {$record->get_title()}</h2>
	<table cellpadding="10" cellspacing="1" width="100%">
		{foreach from=$distributors['items'] key=$iKey item=$oActor}
			<tr>
				<td width="50%" style="background-color:{if $iKey/2 == round($iKey/2)}#DDDDDD{else}#FFFFFF{/if}" align="center">
					{$oActor->get_role()}
				</td>
				<td width="50%" style="background-color:{if $iKey/2 == round($iKey/2)}#DDDDDD{else}#FFFFFF{/if}" align="center">
					<a href="{$oActor->url}">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</a>
				</td>
			</tr>
		{/foreach}
	</table>
</div>
{/if}
{if $record->get_type() == 'serie' && count($companies) > 0}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2 style="margin-bottom:10px;">Sociétés de {$record->get_title()}</h2>
	<table cellpadding="10" cellspacing="1" width="100%">
		{foreach from=$distributors['items'] key=$iKey item=$oActor}
			<tr>
				<td width="50%" style="background-color:{if $iKey/2 == round($iKey/2)}#DDDDDD{else}#FFFFFF{/if}" align="center">
					{$oActor->get_role()}
				</td>
				<td width="50%" style="background-color:{if $iKey/2 == round($iKey/2)}#DDDDDD{else}#FFFFFF{/if}" align="center">
					<a href="{$oActor->url}">{$oActor->company->get_name()}</a>
				</td>
			</tr>
		{/foreach}
	</table>
</div>
{/if}
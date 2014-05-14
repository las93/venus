{* version=2; *}
<div class="double_tier_left_bloc">
	<div style="float:left;width:440px;marging-bottom:5px;">
		<h1 style="border-bottom:dotted 1px gray;">Actualités de {$actor->get_firstname()} {$actor->get_name()}</h1>
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
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2>Les Actualités de {$actor->get_firstname()} {$actor->get_name()}</h2>
	<div style="width:630px;float:left;margin-top:5px;">
		{if $news['count'] > 0}
			{foreach from=$news['items'] key=$iKey2 item=$oNews2}
				<div style="margin-bottom:20px;width:315px;float:left;height:170px;">
					<a href="{$oNews2->url}"><img src="{$app.const.IMG_PROD}{$oNews2->image}" alt="{$oNews2->get_title()|escape}" title="{$oNews2->get_title()|escape}" border="0" width="300"/></a><br/>
					<a href="{$oNews2->url}"><b>{$oNews2->get_title()}</b></a><br/>
					{$oNews2->get_content()|truncate:100}</b>
				</div>
			{/foreach}
		{else}
			<div style="width:630px;float:left;margin-top:5px;">
				<br/>&gt; Il n'y a pas d'actualité de {$record->get_title()}</a>
			</div>
		{/if}
	</div>
</div>
<div class="double_tier_left_bloc" style="margin-top:10px;text-align:center;">
	{if $app.get.offset < 1}
		{assign var=$offset value=1}
	{else}
		{assign var=$offset value=$app.get.offset}
	{/if}

	{if !isset($alias)}{assign var=$alias value='acteur-news'}{/if}

	{if $offset - 8 > 1}
		{assign var=$start value=$offset-8}
	{else}
		{assign var=$start value=1}
	{/if}
	{if $news['pages'] > $offset + 8}
		{assign var=$loop value=$offset+8}
	{else}
		{assign var=$loop value=$news['pages']-$start}
	{/if}

	{if $start == 1 && $offset - 8 < 1}
		{assign var=$loop value=$loop-$offset+8}
	{/if}
	{if $loop + $start > $news['pages']}
		{assign var=$loop value=$news['pages']}
	{/if}

	{if $news['pages'] == 0}
		-- AUCUNE AUTRE PAGE DE DISPONIBLE --
	{else}
		&lt;&lt; <a href="{url alias=$alias id=$actor->get_id() title=$actor->title_encode}">début</a> |
		&lt; <a href="{url alias=$alias id=$actor->get_id() title=$actor->title_encode offset=$offset-1}">précédente</a> |
		{section name=$i loop=$loop start=$start}
			<a href="{url alias=$alias id=$actor->get_id() title=$actor->title_encode offset=$i}">{$i}</a> |
		{/section}
		<a href="{url alias=$alias id=$actor->get_id() title=$actor->title_encode offset=$offset+1}">suivante</a> &gt; |
		<a href="{url alias=$alias id=$actor->get_id() title=$actor->title_encode offset=$news['pages']}">fin</a> &gt;&gt;
	{/if}
</div>
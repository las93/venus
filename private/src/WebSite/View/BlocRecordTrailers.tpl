{* version=2; *}
<div class="double_tier_left_bloc">
	<div style="float:left;width:440px;marging-bottom:5px;">
		<h1 style="border-bottom:dotted 1px gray;">Vidéos de {$record->get_title()}</h1>
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
	<h2>{$trailer->get_title()}</h2>
	<div style="width:630px;float:left;margin-top:5px;">
		<span itemscope itemtype="http://www.schema.org/VideoObject">
			<meta itemprop="name" content="{$trailer->get_title()}" />
			<iframe width="630" height="358" src="{$trailer->get_link()}" frameborder="0" allowfullscreen></iframe>
			<meta itemprop="duration" content="PT38S" />
			<meta itemprop="thumbnail" content="http://www.iscreenway.com/images/trailer_{$trailer->get_id()}.jpg" />
			<meta itemprop="embedURL" content="http://www.iscreenway.com/{$app.server.REQUEST_URI}" />
			<meta itemprop="width" content="630" />
			<meta itemprop="height" content="358" />
			<meta itemprop="playerType" content="Flash" />
		</span>
		<br/>
	</div>
</div>
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2>Les bandes-annonces de {$record->get_title()}</h2>
	<div style="width:630px;float:left;margin-top:5px;">
		{foreach from=$trailers['items'] key=$iKey item=$oTrailer}
			<div style="width:315px;float:left;">
				<a href="{$oTrailer->url}" style="color:black"><img src="{$app.const.IMG_PROD}/images/trailer_{$oTrailer->get_id()}.jpg" style="border:0" alt="{$oTrailer->get_title()|escape}" title="{$oTrailer->get_title()|escape}" width="100"/><br/>
				{$oTrailer->get_title()}</a>
			</div>
		{/foreach}
	</div>
</div>
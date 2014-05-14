{* version=2; *}
<div class="one_tier_right_bloc">
	<h1 style="border-bottom:dotted 1px gray;">News de la semaine</h1>
	{foreach from=$news['items'] key=$iKey item=$oNews}
		<div class="one_right_subbloc" width="100%">
			<div style="float:left;width:60%;padding-bottom:5px;">
				<a href="{$oNews->url}" style="color:black;text-decoration:none;"><img src="{$app.const.IMG_PROD}{$oNews->image}" width="159" alt="{$oNews->get_title()|escape}" title="{$oNews->get_title()|escape}" style="border:0"/></a>
				<div class="mea_news_title" width="100%"><a href="{$oNews->url}" style="color:black;text-decoration:none;">{$oNews->get_title()}</a></div>
				<div class="mea_news_temps" width="100%">{$oNews->date_ago}</div>
			</div>
			<div style="float:left;;width:40%;">
				<!-- Placez cette balise où vous souhaitez faire apparaître le gadget Bouton +1. -->
				<div class="g-plusone" data-size="normal" data-href="http://www.iscreenway.com{$oNews->url}"></div>

				<!-- Placez cette ballise après la dernière balise Bouton +1. -->
				<script type="text/javascript">
				  window.___gcfg = {lang: 'fr'};

				  (function() {
				    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				    po.src = 'https://apis.google.com/js/plusone.js';
				    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=666235750056206";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
				<div class="fb-like" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false" data-href="http://www.iscreenway.com{$oNews->url}"></div>
				<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-url="http://www.iscreenway.com{$oNews->url}">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
		</div>
	{/foreach}
	<div class="one_right_subbloc" style="height:20px;padding-top:5px;">
		{if !isset($alias_global) || !isset($title_global)}
			&gt; <a href="{url alias='actu-film'}">Tous les actualités cinéma</a>
		{else}
			&gt; <a href="{$alias_global}">{$title_global}</a>
		{/if}
	</div>
</div>
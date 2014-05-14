<div id="title">
	<h1>{$title}</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'dossier'}">Dossiers</a>
</div>
<div id="left">
	<div class="grandcadre">
		<h2>Les dossiers cinéma, séries TV et stars</h2>
			{foreach $news as $iKey2 => $oNews2}
					{if $iKey2 < 2}
						<div class='imgnew2' itemscope itemtype="http://schema.org/NewsArticle"><a href="{$oNews2->url}">
							<a href="{$oNews2->url}" itemprop="url"><img src="/images/article_{$oNews2->get_id()}.jpg" alt="{$oNews2->get_title() addslashes}" title="{$oNews2->get_title() addslashes}" border="0" width="600" itemprop="image"/></a><br/>
							<a href="{$oNews2->url}" itemprop="name"><b>{$oNews2->get_title()}</b></a>
							<span style="color:gray"><small>| {$oNews2->date}</small></span><br/>
							{truncate $oNews2->get_content() 100}</b><br/><br/><br/>
						</div>
					{else}
						<div class="demicadre" style="margin-bottom:20px;" itemscope itemtype="http://schema.org/NewsArticle">
							<div class='imgnew'><a href="{$oNews2->url}" itemprop="url"><img src="/images/article_{$oNews2->get_id()}.jpg" alt="{$oNews2->get_title() addslashes}" title="{$oNews2->get_title() addslashes}" border="0" width="300" itemprop="image"/></a></div>
							<div class='contentnews'>
								<a href="{$oNews2->url}" itemprop="name"><b>{$oNews2->get_title()}</b></a>
								<span style="color:gray"><small>| {$oNews2->date2}</small></span><br/>
								{truncate $oNews2->get_content() 100}</b>
							</div>
						</div>
					{/if}
			{/foreach}
	</div>
	<div class="grandcadre" style ="text-align:center;">
		{if $news[0]->pages > 1}
			&lt;&lt; <a href="{$url}">Début</a>
			| {loop $news[0]->pages}
				{if $i != $news[0]->pages}
					{if $i > 0}
						{if $i > $app['get']['offset'] - 10}
							{if $i < $app['get']['offset'] + 10}
								<a href="{$url}{$i}">{$loop}</a>  |
							{/if}
						{/if}
					{/if}
				{/if}
			{/loop}
			<a href="{$url}{$news[0]->pages}">Fin</a> &gt;&gt;
		{else}
			-- Aucune page complémentaire --
		{/if}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
	<div class="cadre_solo_tier_solo_right">
		<h2 style="border-top:5px solid blue;">Dernières actualités</h2>
		{foreach $last_news as $iKey2 => $oNews2}
			<div class="demicadre" style="margin-bottom:20px;" itemscope itemtype="http://schema.org/NewsArticle">
				<div class='imgnew'><a href="{$oNews2->url}" itemprop="url"><img src="/images/article_{$oNews2->get_id()}.jpg" alt="{$oNews2->get_title() addslashes}" title="{$oNews2->get_title() addslashes}" border="0" width="300" itemprop="image"/></a></div>
				<div class='contentnews'>
					<a href="{$oNews2->url}" itemprop="name"><b>{$oNews2->get_title()}</b></a>
					<span style="color:gray"><small>| {$oNews2->date2}</small></span><br/>
					{truncate $oNews2->get_content() 100}</b>
				</div>
				<!-- Placez cette balise où vous souhaitez faire apparaître le gadget Bouton +1. -->
				<div class="g-plusone" data-size="small" data-href="http://www.iscreenway.com{$oNews2->url}"></div>

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
				<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false" data-href="http://www.iscreenway.com{$oNews2->url}"></div>
				<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-url="http://www.iscreenway.com{$oNews2->url}">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
		{/foreach}
		<br/>&gt; <a href="{url 'actu'}">Toutes les actualités</a>
	</div>
	<div class="cadre_solo_tier_solo_right">
		<h2 style="border-top:5px solid blue;">Recommandations Facebook</h2>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=666235750056206";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="fb-recommendations-bar" data-site="www.iscreenway.com" data-read-time="30" data-side="left" data-action="like"></div>
	</div>
</div>


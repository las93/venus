<div id="title">
	{if $record->get_type() == 'serie'}
		<h1>Vidéo {$trailer->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'series'}">Séries TV</a>
		&gt; <a href="{url 'liste-series'}">liste des séries TV</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_ba}">Bande-annonce</a>
		&gt; <a href="{$app['environment']['REQUEST_URI']}">{$trailer->get_title()}</a>
	{else}
		<h1>Vidéo {$trailer->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'cinema'}">Cinéma</a>
		&gt; <a href="{url 'liste-film'}">Liste des films</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_ba}">Bande-annonce</a>
		&gt; <a href="{$app['environment']['REQUEST_URI']}">{$trailer->get_title()}</a>
	{/if}
</div>
<div id="left">
	{include $tpl_record_menu}
	<iframe width="630" height="358" src="{$trailer->get_link()}" frameborder="0" allowfullscreen></iframe>
	<br/>
	<div class="grandcadre" style="text-align:center;">
				<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=666235750056206";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like" data-href="http://www.iscreenway.com{$app['environment']['REQUEST_URI']}" data-width="80" width="80"  data-colorscheme="light" data-layout="box_count" data-action="like" data-show-faces="true" data-send="false"></div> 
			
			
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
	{include $tpl_last_trailers}
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


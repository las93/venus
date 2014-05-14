<div id="title">

		<h1>{$news->get_title()}</h1>
	{if $news->get_id_article_type() == 1}
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'cinema'}">Cinéma</a>
		&gt; <a href="{url 'actu-film'}">Actualités</a>
		&gt; <a href="{$app['environment']['REQUEST_URI']}">{$news->get_title()}</a>
	{elseif $news->get_id_article_type() == 2}
	{elseif $news->get_id_article_type() == 3}
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'dossier'}">Dossiers</a>
		&gt; <a href="{$app['environment']['REQUEST_URI']}">{$news->get_title()}</a>
	{elseif $news->get_id_article_type() == 4}
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'series'}">Séries TV</a>
		&gt; <a href="{url 'actu-series'}">Actualités</a>
		&gt; <a href="{$app['environment']['REQUEST_URI']}">{$news->get_title()}</a>
	{elseif $news->get_id_article_type() == 5}
	{/if}
</div>
<div id="left">
	<div class="grandcadre" itemscope itemtype="http://schema.org/NewsArticle">
		<div style="float:left;width:400px;">
			<h2 itemprop="name">{$news->get_title()}</h2>
			<b><span style="color:gray">{$news->date} écrit par {$user->get_login()}</span></b><br/><br/>
		</div>
		<div style="float:left;width:200px;text-align:right;">
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

		<img src="{$news->image}" style="border:0px;" width="605" itemprop="image" alt="{$news->get_title() addslashes}" title="{$news->get_title() addslashes}"/><br/><br/>
		{$news->get_content() nl2br}
		<br/><br/>
		<b>Suivez nous sur Twitter : </b>
		<a href="https://twitter.com/iscreenway" class="twitter-follow-button" data-show-count="false" data-lang="fr">Suivre @iscreenway</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	</div>
	<div class="grandcadre">
			{foreach $list_news['news'] as $iKey => $oNews}
				{foreach $oNews as $iKey2 => $oNews2}
					<div class="demicadre" style="margin-bottom:20px;" itemscope itemtype="http://schema.org/NewsArticle">
						<div class='imgnew'><a href="{$oNews2->url}" itemprop="url"><img src="{$oNews2->image}" alt="{$oNews2->get_title() addslashes}" title="{$oNews2->get_title() addslashes}" border="0" width="300" itemprop="image"/></a></div>
						<div class='contentnews'>
							<a href="{$oNews2->url}" itemprop="name"><b>{$oNews2->get_title()}</b></a>
							<span style="color:gray"><small>| {$oNews2->date2}</small></span><br/>
							{truncate $oNews2->get_content() 100}</b>
						</div>
					</div>
				{/foreach}
			{/foreach}
	</div>
	<div class="grandcadre">
		<form name="postcomment" method="post">
			<textarea name="comment" cols="60" rows="5"></textarea>
			<br/>{if $is_connect}<input type="submit"/>{else}Vous devez vous connecter pour écrire un commentaire{/if}
		</form>
	</div>
	<div class="grandcadre">
		{foreach $comments as $comment}
			{if $comment->count > 0}
				<table border="0" cellpadding="5" cellspacing="0"></tr>
					<td valign="top"><img src="/images/avatar_{$comment->get_id_user()}.jpg" width="50"></td>
					<td valign="top">
						<b>{$comment->get_user()->get_login()}</b> <small>{$comment->get_created()}</small><br/><br/>
						{$comment->get_content()}
					</td>
				</tr></table>
			{else}
				Soyez le premier à poster un commentaire sur cet article !
			{/if}
		{/foreach}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
	<div class="cadre_solo_tier_solo_right">
	<h2>Top bandes-annonces</h2>
		{foreach $trailers as $oTrailer}
		<div class="bacadre" style="height:150px;width:125px;">
			<a href="{$oTrailer->url}"><img src="/images/trailer_{$oTrailer->get_id()}.jpg" border="0"/><br/>
			<span style="color:black;">{$oTrailer->get_title()}</span></a>
		</div>
		{/foreach}
		<br/>&gt; <a href="{url 'bande-annonce'}">Toutes les bandes annonces</a>
	</div>
	<div class="cadre_solo_tier_solo_right">
		<h2>{$wanted_title}</h2>
		{foreach $wanted_movies as $iKey => $oMovie}
			{if $iKey == 0}
				{$iMovie assign $iKey+1}
				{include $tpl_one_movie}
			{else}
				<div class="liendemicadre" style="margin-top:10px;">
					{$iKey+1}. <a href="{$oMovie->url}">{$oMovie->get_title()}</a>
				</div>
			{/if}
		{/foreach}
		<div class="liendemicadre">
			<br/>&gt; <a href="{$wanted_url}">{$wanted_all}</a>
		</div>
	</div>
</div>

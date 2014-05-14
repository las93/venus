{* version=2; *}
<div class="double_tier_left_bloc" itemscope itemtype="http://schema.org/NewsArticle">
	<div style="float:left;width:440px;marging-bottom:5px;">
		<h1 style="border-bottom:dotted 1px gray;font-size:18px;" itemprop="name">{$one_news->get_title()}</h1>
		<br/>
		<span style="color:gray;font-size:14px;font-weight:bold;margin-right:5px;">Le {$one_news->date} par {$user->get_login()}</span>
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
	<img src="{$app.const.IMG_PROD}{$one_news->image}" width="650" alt="{$one_news->get_title()|escape}" title="{$one_news->get_title()|escape}" style="border:0"/>
	<br/><br/>
	{$one_news->get_content()|nl2br}
</div>
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h1 style="border-bottom:dotted 1px gray;font-size:18px;">Les commentaires</h1>
	<form name="postcomment" method="post">
		<textarea name="comment" cols="60" rows="5"></textarea>
		<br/>{if $is_connect}<input type="submit"/>{else}Vous devez vous connecter pour écrire un commentaire{/if}
	</form>
</div>
<div class="double_tier_left_bloc" style="margin-top:10px;">
	{foreach from=$comments item=$comment}
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
	<div class="grandcadre">
		&nbsp;
	</div>
	<div class="grandcadre" itemscope itemtype="http://schema.org/Movie" style="background-color:white;">
		<img src="/images/article_{$news->get_id()}.jpg" style="border:0px;" width="300" itemprop="image" alt="{$news->get_title() addslashes}" title="{$news->get_title() addslashes}"/><br/><br/>
		<div style="padding:5px;width:290px;">
			<h2 itemprop="name">{$news->get_title()}</h2>
			<b><span style="color:#AAAAAA;font-size:14px;">{$news->date} écrit par {$user->get_login()}</span></b><br/><br/>

			{$news->get_content() nl2br}
			<br/><br/>
			<b>Partagez cette news :</b><br/><br/>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=666235750056206";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like" data-href="http://www.iscreenway.com{$app['environment']['REQUEST_URI']}" data-width="150" width="150"  data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="true" data-send="false"></div>


			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
			<a href="http://twitter.com/share" class="twitter-share-button">Tweet</a>

			<!-- Place this tag where you want the +1 button to render. -->
			<div class="g-plusone"></div>

			<!-- Place this tag after the last +1 button tag. -->
			<script type="text/javascript">
			  (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/plusone.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		</div>
	</div>
	<div class="grandcadre">
		<form name="postcomment" method="post">
			<textarea name="comment" cols="40" rows="5"></textarea>
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
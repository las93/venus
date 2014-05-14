{* version=2; *}
<div class="double_tier_left_bloc">
	<div style="float:left;width:440px;marging-bottom:5px;">
		<h1 style="border-bottom:dotted 1px gray;">Critiques de {$record->get_title()}</h1>
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
{if $record->get_review() != ''}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2>Critique de {$record->get_title()} par iScreenway</h2>
	{if $record->get_score() > 0.5}<img src="/img/star.png">{elseif $record->get_score() > 0}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
	{if $record->get_score() > 1.5}<img src="/img/star.png">{elseif $record->get_score() > 1}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
	{if $record->get_score() > 2.5}<img src="/img/star.png">{elseif $record->get_score() > 2}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
	{if $record->get_score() > 3.5}<img src="/img/star.png">{elseif $record->get_score() > 3}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
	{if $record->get_score() > 4.5}<img src="/img/star.png">{elseif $record->get_score() > 4}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
	<br/>
	{$record->get_review()}
</div>
{/if}
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<form name="postavis" method="post">
		Note : <select name="score">
			<option value="0">0</option>
			<option value="0.5">0.5</option>
			<option value="1">1</option>
			<option value="1.5">1.5</option>
			<option value="2">2</option>
			<option value="2.5">2.5</option>
			<option value="3">3</option>
			<option value="3.5">3.5</option>
			<option value="4">4</option>
			<option value="4.5">4.5</option>
			<option value="5">5</option>
		</select><br/>
		<textarea name="critic" cols="60" rows="5"></textarea>
		<br/>{if $is_connect}<input type="submit"/>{else}Vous devez vous connecter pour écrire un avis sur {$record->get_title()}{/if}
	</form>
</div>
<div class="double_tier_left_bloc" style="margin-top:10px;">
	<h2>Vos avis sur {$record->get_title()}</h2>
	{if $critics[0]->count > 0}
		{foreach from=$critics item=$critic}
			<table border="0" cellpadding="5" cellspacing="0"></tr>
				<td valign="top"><img src="/images/avatar_{$critic->get_id_user()}.jpg" width="50"></td>
				<td valign="top">
					<b>{$critic->get_user()->get_login()}</b> <small>{$critic->get_created()}</small><br/><br/>
					{if $critic->get_score() > 0.5}<img src="/img/star.png">{elseif $critic->get_score() > 0}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
					{if $critic->get_score() > 1.5}<img src="/img/star.png">{elseif $critic->get_score() > 1}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
					{if $critic->get_score() > 2.5}<img src="/img/star.png">{elseif $critic->get_score() > 2}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
					{if $critic->get_score() > 3.5}<img src="/img/star.png">{elseif $critic->get_score() > 3}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
					{if $critic->get_score() > 4.5}<img src="/img/star.png">{elseif $critic->get_score() > 4}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}
					<br/>
					{$comment->get_content()}
				</td>
			</tr></table>
		{/foreach}
	{else}
		Soyez le premier à poster un avis sur {$record->get_title()} !
	{/if}
</div>
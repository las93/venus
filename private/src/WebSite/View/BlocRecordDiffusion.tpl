{* version=2; *}
<div class="double_tier_left_bloc">
	<div style="float:left;width:440px;marging-bottom:5px;">
		<h1 style="border-bottom:dotted 1px gray;">Diffusions TV de {$record->get_title()}</h1>
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
	<h2>Les Diffusions de {$record->get_title()}</h2>
	{foreach from=$diffusions key=$keyChannel item=$channel}
		<table style="background-color:#BBBBBB;margin-bottom:5px;" cellspacing="1" cellpadding="5" width="100%">
		<tr>
			<td>
				<img src="/img/logo_{$channel[0]->get_id_channel()}.jpg" alt="{$keyChannel|escape}" title="{$keyChannel|escape}" style="border:solid 1px black;"> Tous les épisodes diffusés sur {$keyChannel}
				<table style="background-color:#BBBBBB;" cellspacing="1" cellpadding="5" width="100%">
					{foreach from=$channel key=$key item=$one}
					<tr>
						<td style="background-color:white;" width="25%">
							<b>Saison {$one->get_season()} Episode {$one->get_episode()}</b>
						</td><td style="background-color:white;">
							{$one->get_start()} - {$one->get_end()}
						</td>
					</tr>
					{/foreach}
				</table>
			</td>
		</tr>
		</table>
	{/foreach}
</div>
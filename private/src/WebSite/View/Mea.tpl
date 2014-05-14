{* version=2; *}
<div id="mea">
	{foreach from=$meas key=$i item=$oOne}
		<div class="mea_quart"{if $i == 3} style="border-right:0;"{/if}><a href="{$oOne->get_link()}" style="color:black;text-decoration:none;">{$oOne->get_title()|truncate:80}</a></div>
	{/foreach}
	{foreach from=$meas key=$i item=$oOne}
		<div class="mea_quart_{if $i != 0}no_{/if}select" id="measelect{$i}" {if $i == 0}{if $menu == 'cinema'}style="background-color:#D42020;"{elseif $menu == 'serie'}style="background-color:#20D48C;"{elseif $menu == 'dvd'}style="background-color:#DF01D7;"{elseif $menu == 'tele'}style="background-color:#FE642E;"{/if}{/if}></div>
	{/foreach}
	{foreach from=$meas key=$i item=$oOne}
		<div class="mea_img" id="mea{$i}"><a href="{$oOne->get_link()}"><img src="{$app.const.IMG_PROD}/images/mea_{$oOne->get_id()}.jpg" width="980" height="270" alt="{$oOne->get_title()|escape}" title="{$oOne->get_title()|escape}" style="border:0"/></a></div>
	{/foreach}
	<script>
		var numberOfMea=0;
		{foreach from=$meas key=$i item=$oOne}
			{if $i > 0}jQuery("#mea{$i}").css( "display", "none");{/if}
		{/foreach}
		$(document).ready(function() {
			setInterval(function(){
				jQuery("#mea"+numberOfMea).css( "display", "none");
				jQuery("#measelect"+numberOfMea).css( "background-color", "#BBBBBB");
				numberOfMea++;
				if (numberOfMea > {$i}) { numberOfMea=0; }
				jQuery("#mea"+numberOfMea).css( "display", "block");
				jQuery("#measelect"+numberOfMea).css( "background-color", "{if $menu == 'cinema'}#D42020{elseif $menu == 'serie'}#20D48C{elseif $menu == 'dvd'}#DF01D7{elseif $menu == 'tele'}#FE642E{else}#208CD4{/if}");
			}, 5000);
		});
	</script>
	{foreach from=$news_mea['items'] key=$iKey item=$oNews}
		<div class="mea_news" {if $iKey > 2} style="border-right:0;"{/if}>
			<a href="{$oNews->url}" style="color:black;text-decoration:none;"><img src="{$app.const.IMG_PROD}{$oNews->image}" width="159" alt="{$oNews->get_title()|escape}" title="{$oNews->get_title()|escape}" style="border:0"/></a>
			<div class="mea_news_title"><a href="{$oNews->url}" style="color:black;text-decoration:none;">{$oNews->get_title()}</a></div>
			<div class="mea_news_temps">{$oNews->date_ago}</div>
			&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>
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
	{/foreach}
	<div id="pub_banniere_300">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- 300x250 -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:300px;height:250px"
		     data-ad-client="ca-pub-1464093566453217"
		     data-ad-slot="1619803281"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
</div>
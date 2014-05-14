{* version=2; *}
<div class="one_tier_right_bloc">
	<h1 style="border-bottom:dotted 1px gray;">Bandes-annonces</h1>
	{foreach from=$trailers['items'] key=$iKey item=$oTrailer}
		<div class="one_right_subbloc">
			<div class="img_bloc_in_right_bloc">
				<a href="{$oTrailer->url}"><img src="{$app.const.IMG_PROD}/images/trailer_{$oTrailer->get_id()}.jpg" style="border:0" alt="{$oTrailer->get_title()|escape}" title="{$oTrailer->get_title()|escape}" width="100"/></a>
			</div>
			<div class="txt_bloc_in_right_bloc">
				<a href="{$oTrailer->url}" style="color:black">{$oTrailer->get_title()}</a>
			</div>
		</div>
	{/foreach}
	<div class="one_right_subbloc" style="height:20px;padding-top:5px;">
		&gt; <a href="{url  alias='bande-annonce-cinema'}">Vidéos cinéma</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&gt; <a href="{url  alias='bande-annonce-serie'}">Vidéos séries</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&gt; <a href="{url  alias='bande-annonce-serie'}">Vidéos TV</a>
	</div>
</div>
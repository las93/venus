	<div class="grandcadre">
		<h2>Bandes-annonces</h2>
		{foreach $last_trailers as $oTrailer}
		<div class="bacadre" style="height:150px;">
			<a href="{$oTrailer->url}"><img src="/images/trailer_{$oTrailer->get_id()}.jpg" border="0" alt="{$oTrailer->get_title() addslashes}" title="{$oTrailer->get_title() addslashes}" /><br/>
			<span style="color:black;">{$oTrailer->get_title()}</span></a>
		</div>
		{/foreach}
		<div class="liencadre">
			{if isset($trailer_record)}
				<br/>&gt; <a href="{$url_trailer_record}">Bandes annonces de {$record->get_title()}</a>
				&gt; <a href="{url 'bande-annonce-cinema'}">Bandes annonces cinéma</a>
				&gt; <a href="{url 'bande-annonce-serie'}">Bandes annonces série</a>
			{elseif !isset($type)}
				<br/>&gt; <a href="{url 'bande-annonce-cinema'}">Toutes les bandes annonces cinéma</a>
				&gt; <a href="{url 'bande-annonce-serie'}">Toutes les bandes annonces série</a>
			{else}
				<br/>&gt; <a href="{$url_type}">Toutes les bandes annonces {$type}</a>
			{/if}
		</div>
	</div>
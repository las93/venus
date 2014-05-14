{*
	$oMovie -> vidéo
	$oMovie->url
	$oMovie->realisator
	$oMovie->actors
	$oMovie->kinds
	$oMovie->trailer_url
*}
<div class="demicadre" itemscope itemtype="http://schema.org/{if $oMovie->get_type() == 'film'}Movie{else}TVSeries{/if}">
	<div class="grandrecordimg" style="margin-bottom:10px;">
		<a href="{$oMovie->url}" itemprop="url"><img src="{if isset($oMovie->image)}{$oMovie->image}{else}/images/record_{$oMovie->get_id()}.jpg{/if}" alt="{$oMovie->get_title() addslashes}" title="{$oMovie->get_title() addslashes}" width="120" border="0" itemprop="image"/></a>
	</div>
	<div class = "grandrecordtxt">
		<span style="font-size:12px;" itemprop="name">{if isset($iMovie)}{$iMovie}.{/if} {$oMovie->get_title()}</span><br/>
		<div itemprop="director" itemscope itemtype="http://schema.org/Person" style="font-size:10px;color:gray;">De {$oMovie->realisator}</div>
		<div itemprop="actor" itemscope itemtype="http://schema.org/Person" style="font-size:10px;color:gray;">Avec {$oMovie->actors}</div>
		<span style="font-size:10px;color:gray;" itemprop="genre">{$oMovie->get_type()} {$oMovie->kinds}</span><br/>
		{if $oMovie->trailer_url}<span style="font-size:10px;color:gray;"><a href="{$oMovie->trailer_url}">Regarder la bande-annonce</a></span><br/>{/if}
	</div>
</div>
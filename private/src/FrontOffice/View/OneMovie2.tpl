{*
	$oMovie -> vidéo
	$oMovie->url
	$oMovie->realisator
	$oMovie->actors
	$oMovie->kinds
	$oMovie->trailer_url
*}

<div class = "grandrecordimg2" itemscope itemtype="http://schema.org/{if $oMovie->get_type() == 'film'}Movie{else}TVSeries{/if}">
	<span><a href="{$oMovie->url}" itemprop="url"><img src="/images/record_{$oMovie->get_id()}.jpg" alt="{$oMovie->get_title() addslashes}" title="{$oMovie->get_title() addslashes}" width="120" itemprop="image"/></a></span><br/>
	<span style="font-size:12px;" itemprop="name">{$oMovie->get_title()}</span><br/>
	<div itemprop="director" itemscope itemtype="http://schema.org/Person" style="font-size:10px;color:gray;">De {$oMovie->realisator}</div>
	<div itemprop="actor" itemscope itemtype="http://schema.org/Person" style="font-size:10px;color:gray;">Avec {$oMovie->actors}</div>
	<span style="font-size:10px;color:gray;" itemprop="genre">{$oMovie->get_type()} {$oMovie->kinds}</span><br/>
	{if $oMovie->trailer_url}<span style="font-size:10px;color:gray;"><a href="{$oMovie->trailer_url}">Bande-annonce</a></span><br/>{/if}
</div>
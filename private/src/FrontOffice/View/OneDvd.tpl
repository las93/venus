{*
	$oDvd -> vidéo
	$oDvd->url
	$oDvd->realisator
	$oDvd->actors
	$oDvd->kinds
	$oDvd->trailer_url
*}

<div class = "demicadre" style="width:200px;height:200px;margin-top:10px;">
	<a href="{$oDvd->url}"><img src="/images/record_{$oDvd->get_id()}.jpg" width="120"></a>
</div>
<div class = "demicadre" style="width:400px;height:200px;margin-top:10px;">
	<span style="font-size:12px;">{if isset($iDvd)}{$iDvd}.{/if} {$oDvd->get_title()}</span><br/>
	<span style="font-size:10px;color:gray;">De {$oDvd->realisator}</span><br/>
	<span style="font-size:10px;color:gray;">Avec {$oDvd->actors}</span><br/>
	<span style="font-size:10px;color:gray;">{$oDvd->get_type()} {$oDvd->kinds}</span><br/>
	<span style="font-size:10px;color:gray;"><a href="{$oDvd->trailer_url}">Regarder la bande-annonce</a></span><br/>
	{if $oDvd->get_review()}
		{if $oDvd->get_score() > 0.5}<img src="/img/star.png">{elseif $oDvd->get_score() > 0}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}</a>
		{if $oDvd->get_score() > 1.5}<img src="/img/star.png">{elseif $oDvd->get_score() > 1}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}</a>
		{if $oDvd->get_score() > 2.5}<img src="/img/star.png">{elseif $oDvd->get_score() > 2}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}</a>
		{if $oDvd->get_score() > 3.5}<img src="/img/star.png">{elseif $oDvd->get_score() > 3}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}</a>
		{if $oDvd->get_score() > 4.5}<img src="/img/star.png">{elseif $oDvd->get_score() > 4}<img src="/img/starD.png">{else}<img src="/img/starS.png">{/if}</a>
		<br/>
	{/if}
</div>
<div id="title">
	<div style="float:left;width:500px;"><h1>Fiche {$actor->get_firstname()} {$actor->get_name()}</h1></div>
	<div style="float:left;width:400px;">
		<form name="like" method="post">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="hidden" name="like" value="1">
			<a href="javascript:void(0);" onCLick="document.like.submit();"><img src="/img/coeur.png"> <b style="font-size:18px;">&nbsp; {$like}</b> like</a>
		</form>
	</div>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'acteurs'}">Stars</a>
	&gt; <a href="{$url_star}">{$actor->get_firstname()} {$actor->get_name()}</a>
</div>
<div id="left">
	{include $tpl_actor_menu}
	<div class="grandcadre">
		<div class="tiercadre"><img src="{url 'images' 'file_name' as $url_img}"/></div>
		<div class="2tiercadre">
			<table cellpadding="10" cellspacing="1" width="70%">
				<tr>
					<td style="background-color:#DDDDFF" align="center">
						Métiers
					</td>
					<td style="background-color:#DDDDFF" align="center">
						{$actor->jobs}
					</td>
				</tr><tr>
					<td style="background-color:#DDDDFF" align="center">
						Nationalité
					</td>
					<td style="background-color:#DDDDFF" align="center">
						{$actor->get_nationality()->get_name()}
					</td>
				</tr><tr>
					<td style="background-color:#DDDDFF" align="center">
						Naissance
					</td>
					<td style="background-color:#DDDDFF" align="center">
						{if ($actor->get_birthday() == '01/01/1900')}Inconnue
						{elseif ($actor->get_birthday() != '00/00/0000')}{$actor->get_birthday()}{else}Inconnue{/if}
					</td>
				</tr><tr>
					<td style="background-color:#DDDDFF" align="center">
						Âge
					</td>
					<td style="background-color:#DDDDFF" align="center">
						{if ($actor->get_birthday() == '01/01/1900')}N.C.
						{elseif ($actor->get_birthday() != '00/00/0000')}{$actor->age}{else}N.C.{/if}
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="grandcadre">
		<h2>Biographie</h2>
		{$actor->get_biography() nl2br}
	</div>
	<div class="grandcadre">
		<h2>Filmographie</h2>
		{foreach $movies as $iKey => $oMovie}
			{include $tpl_one_movie2}
		{/foreach}
		<div class="liencadre">
			<br/>&gt; <a href="{url 'film-de-la-semaine'}">Tous les films de la semaine</a>
		</div>
	</div>
	<div class="grandcadre">
		<h2>Photos</h2>
		--BIENTOT DISPONIBLE--
	</div>
	<div class="grandcadre">
		<h2>News</h2>
			{foreach $news['news'] as $iKey => $oNews}
				<br/><b>Actualités du {$iKey}</b>
				{foreach $oNews as $iKey2 => $oNews2}
					{if $iKey2 < 2}
						<div id='imgnew'><a href="{$oNews2->url}"><img src="/images/article_{$oNews2->get_id()}.jpg" border="0" width="290"/></a></div>
						<div id='contentnews'>
							<a href="{$oNews2->url}"><b>{$oNews2->get_title()}</b></a><br/>
							{truncate $oNews2->get_content() 100}</b>
						</div>
					{else}
						<div class="liencadre">
							<a href="{$oNews2->url}"><b>{$oNews->get_title()}</b></a> <small><i><span style="color:gray">{$oNews2->get_theme()}</span></i></small><br/>
						</div>
					{/if}
				{/foreach}
			{/foreach}
	</div>
	{include $tpl_last_trailers}
	<div class="grandcadre">
		<h2>Commentaires</h2>
		--BIENTOT DISPONIBLE--
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


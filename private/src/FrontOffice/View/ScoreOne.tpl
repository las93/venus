<div id="title">
	{if $record->get_type() == 'serie'}
		<h1>Critiques {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'series'}">Séries TV</a>
		&gt; <a href="{url 'liste-series'}">liste des séries TV</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_casting}">Critiques</a>
	{else}
		<h1>Critiques {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'cinema'}">Cinéma</a>
		&gt; <a href="{url 'liste-film'}">Liste des films</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_casting}">Critiques</a>
	{/if}
</div>
<div id="left">
	{include $tpl_record_menu}
	{if $record->get_review() != ''}
	<div class="grandcadre">
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
	<div class="grandcadre">
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
	<div class="grandcadre">
		<h2>Vos avis sur {$record->get_title()}</h2>
		{if $critics[0]->count > 0}
			{foreach $critics as $critic}
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
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


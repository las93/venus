<div id="title">
	{if $record->get_type() == 'serie'}
		<h1>Casting {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'series'}">Séries TV</a>
		&gt; <a href="{url 'liste-series'}">liste des séries TV</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_casting}">Casting</a>
	{else}
		<h1>Casting {$record->get_title()}</h1>
		<a href="{url 'home'}">iScreenway</a>
		&gt; <a href="{url 'cinema'}">Cinéma</a>
		&gt; <a href="{url 'liste-film'}">Liste des films</a>
		&gt; <a href="{$url_film}">{$record->get_title()}</a>
		&gt; <a href="{$url_film_casting}">Casting</a>
	{/if}
</div>
<div id="left" itemscope itemtype="http://schema.org/Movie">
	{include $tpl_record_menu}
	{if $record->get_type() == 'serie' && count($creators) > 0}
	<div class="grandcadre">
		<h2>Créateurs et showrunners de {$record->get_title()}</h2>
		{foreach $creators as $oActor}
		<div class="bacadre" style="text-align:center;">
			<a href="{$oActor->url}"><img src="/images/person_{$oActor->person->get_id()}.jpg" border="0" width="140"/><br/>
			<span style="color:black;">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</span></a>
		</div>
		{/foreach}
	</div>
	{/if}
	{if count($realisators) > 0}
	<div class="grandcadre">
		<h2>Réalisateurs de {$record->get_title()}</h2>
		{foreach $realisators as $oActor}
		<div class="bacadre" style="text-align:center;" itemprop="director" itemscope itemtype="http://schema.org/Person">
			<a href="{$oActor->url}" itemprop="url"><img src="/images/person_{$oActor->person->get_id()}.jpg" border="0" width="140" height="210" alt="{$oActor->person->get_firstname() addslashes} {$oActor->person->get_name() addslashes}" title="{$oActor->person->get_firstname() addslashes} {$oActor->person->get_name() addslashes}"/><br/>
			<span style="color:black;" itemprop="name">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</span></a>
		</div>
		{/foreach}
	</div>
	{/if}
	{if count($actors) > 0}
	<div class="grandcadre">
		<h2>Acteurs et actrices de {$record->get_title()}</h2>
		{$iKey assign 0}
		{foreach $actors as $iKey => $oActor}
			{if $iKey < 8}
				<div class="bacadre" style="text-align:center;" itemprop="actors" itemscope itemtype="http://schema.org/Person">
					<a href="{$oActor->url}" itemprop="url"><img src="/images/person_{$oActor->person->get_id()}.jpg" border="0" width="140" height="210" alt="{$oActor->person->get_firstname() addslashes} {$oActor->person->get_name() addslashes}" title="{$oActor->person->get_firstname() addslashes} {$oActor->person->get_name() addslashes}"/><br/>
					<span style="color:black;" itemprop="name">{$oActor->person->get_firstname()} {$oActor->person->get_name()}<br/><small><i>Rôle : {$oActor->get_role()}</i></small></span></a>
					<br/>&nbsp;
				</div>
			{else}
				{if $iKey == 8}<table cellpadding="10" cellspacing="1" width="100%">{/if}
				<tr>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						<a href="{$oActor->url}" itemprop="url"><span itemprop="name">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</span></a>
					</td>
				</tr>
			{/if}
		{/foreach}
		{if $iKey >= 8}</table>{/if}
	</div>
	{/if}
	{if count($productors) > 0}
	<div class="grandcadre">
		<h2>Production de {$record->get_title()}</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach $productors as $iKey => $oActor}
				<tr>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						<a href="{$oActor->url}">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
	{/if}
	{if count($screenwriters) > 0}
	<div class="grandcadre">
		<h2>Scénario de {$record->get_title()}</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach $screenwriters as $iKey => $oActor}
				<tr>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						<a href="{$oActor->url}">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
	{/if}
	{if count($technical_team) > 0}
	<div class="grandcadre">
		<h2>Equipe technique de {$record->get_title()}</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach $technical_team as $iKey => $oActor}
				<tr>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						<a href="{$oActor->url}">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
	{/if}
	{if $record->get_type() != 'serie'}
		{if count($distributors) > 0}
		<div class="grandcadre">
			<h2>Distribution de {$record->get_title()}</h2>
			<table cellpadding="10" cellspacing="1" width="100%">
			{foreach $distributors as $iKey => $oActor}
					<tr>
						<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
							{$oActor->get_role()}
						</td>
						<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
							<a href="{$oActor->url}">{$oActor->person->get_firstname()} {$oActor->person->get_name()}</a>
						</td>
					</tr>
			{/foreach}
			</table>
		</div>
		{/if}
		{if count($companies) > 0}
		<div class="grandcadre">
			<h2>Société de {$record->get_title()}</h2>
			<table cellpadding="10" cellspacing="1" width="100%">
			{foreach $companies as $iKey => $oActor}
					<tr>
						<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
							{$oActor->get_role()}
						</td>
						<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
							<a href="{$oActor->url}">{$oActor->company->get_name()}</a>
						</td>
					</tr>
			{/foreach}
			</table>
		</div>
		{/if}
	{/if}
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


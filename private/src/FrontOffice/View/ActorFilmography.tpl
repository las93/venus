<div id="title">
	<h1>Filmographie de {$actor->get_firstname()} {$actor->get_name()}</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'acteurs'}">Stars</a>
	&gt; <a href="{$url_star}">{$actor->get_firstname()} {$actor->get_name()}</a>
	&gt; <a href="{$url_filmography}">Filmographie</a>
</div>
<div id="left">
	{include $tpl_actor_menu}
	<div class="grandcadre">
		<h2>Acteur</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach $actors as $iKey => $oActor}
				<tr>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						<a href="{$oActor->url}">{$oActor->record->get_title()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
	<div class="grandcadre">
		<h2>Créateur (ou) showrunner</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach $creators as $iKey => $oActor}
				<tr>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						<a href="{$oActor->url}">{$oActor->record->get_title()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
	<div class="grandcadre">
		<h2>Réalisateur</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach $realisators as $iKey => $oActor}
				<tr>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						<a href="{$oActor->url}">{$oActor->record->get_title()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
	<div class="grandcadre">
		<h2>Producteur</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach $productors as $iKey => $oActor}
				<tr>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						<a href="{$oActor->url}">{$oActor->record->get_title()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
	<div class="grandcadre">
		<h2>Distributeur</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach $distributors as $iKey => $oActor}
				<tr>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						<a href="{$oActor->url}">{$oActor->record->get_title()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
	<div class="grandcadre">
		<h2>Equipe technique</h2>
		<table cellpadding="10" cellspacing="1" width="100%">
		{foreach $technical_team as $iKey => $oActor}
				<tr>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						{$oActor->get_role()}
					</td>
					<td width="50%" style="background-color:{odd $iKey}#DDDDFF{/odd}{even $iKey}#FFFFFF{/even}" align="center">
						<a href="{$oActor->url}">{$oActor->record->get_title()}</a>
					</td>
				</tr>
		{/foreach}
		</table>
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


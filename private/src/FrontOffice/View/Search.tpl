<div id="title">
	<h1>{$title}</h1>
</div>
<div id="left">
	<div class="grandcadre">
		<h2>Les fiches recherchées</h2>
		{foreach $movies_week as $iKey => $oMovieOfWeek}
			{$oMovie assign $oMovieOfWeek}
			{include 'OneMovie2.tpl'}
		{/foreach}
		<div class="liencadre">
			<br/>&gt; <a href="{url 'liste-film'}">Tous les films</a> |
			&gt; <a href="{url 'liste-series'}">Toutes les séries</a>
		</div>
	</div>
	<div class="grandcadre">
		<h2>Personnes</h2>
		{foreach $persons as $iKey => $oActor}
				<div class="bacadre" style="text-align:center;">
					<a href="{$oActor->url}"><img src="/images/person_{$oActor->get_id()}.jpg" border="0" width="140" height=210""/><br/>
					<span style="color:black;">{$oActor->get_firstname()} {$oActor->get_name()}</span></a>
					<br/>&nbsp;
				</div>
		{/foreach}
	</div>
	<div class="grandcadre">
		<h2>Les actualités</h2>
			{foreach $news as $iKey2 => $oNews2}
					{if $iKey2 < 2}
						<div class='imgnew2' itemscope itemtype="http://schema.org/NewsArticle"><a href="{$oNews2->url}">
							<a href="{$oNews2->url}" itemprop="url"><img src="/images/article_{$oNews2->get_id()}.jpg" alt="{$oNews2->get_title() addslashes}" title="{$oNews2->get_title() addslashes}" border="0" width="600" itemprop="image"/></a><br/>
							<a href="{$oNews2->url}" itemprop="name"><b>{$oNews2->get_title()}</b></a>
							<span style="color:gray"><small>| {$oNews2->date}</small></span><br/>
							{truncate $oNews2->get_content() 100}</b><br/><br/><br/>
						</div>
					{else}
						<div class="demicadre" style="margin-bottom:20px;" itemscope itemtype="http://schema.org/NewsArticle">
							<div class='imgnew'><a href="{$oNews2->url}" itemprop="url"><img src="/images/article_{$oNews2->get_id()}.jpg" alt="{$oNews2->get_title() addslashes}" title="{$oNews2->get_title() addslashes}" border="0" width="300" itemprop="image"/></a></div>
							<div class='contentnews'>
								<a href="{$oNews2->url}" itemprop="name"><b>{$oNews2->get_title()}</b></a>
								<span style="color:gray"><small>| {$oNews2->date2}</small></span><br/>
								{truncate $oNews2->get_content() 100}</b>
							</div>
						</div>
					{/if}
			{/foreach}
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


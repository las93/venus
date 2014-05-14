<div id="title">
	<h1>Biographie {$actor->get_firstname()} {$actor->get_name()}</h1>
	<a href="{url 'home'}">iScreenway</a>
	&gt; <a href="{url 'acteurs'}">Stars</a>
	&gt; <a href="{$url_star}">{$actor->get_firstname()} {$actor->get_name()}</a>
	&gt; <a href="{$url_biography}">Biographie</a>
</div>
<div id="left">
	{include $tpl_actor_menu}
	<div class="grandcadre">
		<h2>Etat civil</h2>
		<div class="tiercadre"><img src="{url 'images' 'file_name' as $url_img}"/></div>
		<div class="2tiercadre">
			<table cellpadding="10" cellspacing="1">
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
						{$actor->nationality->get_name()}
					</td>
				</tr><tr>
					<td style="background-color:#DDDDFF" align="center">
						Naissance
					</td>
					<td style="background-color:#DDDDFF" align="center">
						{$actor->get_birthday()}
					</td>
				</tr><tr>
					<td style="background-color:#DDDDFF" align="center">
						Âge
					</td>
					<td style="background-color:#DDDDFF" align="center">
						{$actor->age}
					</td>
				</tr><tr>
					-- NOMINATIONS -- TOP STAR ---
				</tr>
			</table>
		</div>
	</div>
	<div class="grandcadre">
		<h2>Biographie</h2>
		<div class="2tiercadre">
			{$actor->get_biography() nl2br}
		</div>
		<div class="tiercadre" style="font-size:24px;color:#DDDDFF">
			Acteur dans {$actor->nb_actor} films/séries<br/>
			Producteur/Réalisateur dans {$actor->nb_productor} films/séries
		</div>
	</div>
	<div class="grandcadre">
		<h2>Ses meilleurs films et séries</h2>
		--BIENTOT DISPONIBLE--
	</div>
	<div class="grandcadre">
		<h2>Ses Récompenses</h2>
		--BIENTOT DISPONIBLE--
	</div>
	<div class="grandcadre">
		<h2>{$actor->get_firstname()} {$actor->get_name()} a tourné avec :</h2>
		--BIENTOT DISPONIBLE--
	</div>
</div>
<div id="pub">
	{include 'Pub300x600.tpl'}
</div>


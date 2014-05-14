{* version=2; *}
<div class="double_left_bloc">
	<div class="grandcadre">
		<h2>Créer mon compte par Facebook</h2>
		<img src="/img/star.png"/> Rapide et connexion avec mon Facebook<br/>
		<img src="/img/star.png"/> Nous ne postons pas sur votre mur<br/>
		<br/>
		{if $is_connect != 0}
			<a href="{url alias='creer-compte' type='fb'}"><img src="/img/facebook.jpg" border="0"/> Créer mon compte à partir de mon Facebook.<br/></a>
		{else}
			{$login}<br/>
		{/if}
	</div>
	<div class="grandcadre">
		<h2>Créer mon compte</h2>
		<img src="/img/star.png"/> Seuls le pseudo, mot de passe et l'email sont obligatoires<br/>
		<img src="/img/star.png"/> Compte intégralement gratuit<br/>
		<br/>
		<h2>Formulaire d'inscription</h2>
		<form name="finscription" method="post">
			<table cellpadding="0" cellspacing="1">
				{if count($error) > 0}
					{foreach from=$error key=$i item=$one}<span style="color:red;">{$one}</span>{/foreach}
				{/if}
				<tr>
					<td>Pseudo :</td><td><input type="text" name="login"/></td>
				</tr><tr>
					<td>Mot de passe :</td><td><input type="password" name="pswd"/></td>
				</tr><tr>
					<td>Email :</td><td><input type="text" name="mail"/></td>
				</tr><tr>
					<td colspan="2"><input type="checkbox" name="cgu" value="1"/> J'accepte et je confirme avoir pris connaissance des CGU.</td>
				</tr><tr>
					<td colspan="2"><input type="submit"/></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<div class="one_right_bloc">
	{include file='BlocRightPub300.tpl'}
</div>

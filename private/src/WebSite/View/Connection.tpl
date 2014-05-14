{* version=2; *}
<div class="double_left_bloc">
	<div class="grandcadre">
		<h2>Me connecter par mon Facebook</h2>
		<img src="/img/star.png"/> Rapide et connexion avec mon Facebook<br/>
		<img src="/img/star.png"/> Nous ne postons pas sur votre mur<br/>
		<br/>
		{if $is_connect != 0}
			<a href="{url 'creer-compte' 'type' as 'fb'}"><img src="/img/facebook.jpg" border="0"/> Créer mon compte à partir de mon Facebook.<br/></a>
		{else}
			{$login}<br/>
		{/if}
	</div>
	<div class="grandcadre">
		<form name="fconnection" method="post">
			{$error}
			Pseudo : <input type="text" name ="login"/><br/>
			Mot de passe : <input type="password" name="pswd"/><br/>
			<input type="submit" value="Me connecter"/>
		</form>
	</div>
</div>
<div class="one_right_bloc">
	{include file='BlocRightPub300.tpl'}
</div>

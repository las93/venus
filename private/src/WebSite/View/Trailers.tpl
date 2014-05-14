{* version=2; *}
<div class="right_and_left_bloc_black_menu">
	{if $menu == 'cinema'}
		<div class="right_and_left_bloc_black_menu_bloc">Bandes-Annonces<br/><span style="color:gray;font-size:10px;">de films...</span></div>
		<div class="right_and_left_bloc_black_menu_bloc">Interviews Vidéos<br/><span style="color:gray;font-size:10px;">de stars, de réalisateurs...</span></div>
		<div class="right_and_left_bloc_black_menu_bloc">Teasers<br/><span style="color:gray;font-size:10px;">des futurs films...</span></div>
		<div class="right_and_left_bloc_black_menu_bloc">Vidéos insolites<br/><span style="color:gray;font-size:10px;">frisson, rire, délire...</span></div>
		<div class="right_and_left_bloc_black_menu_bloc">Vidéos Bonus<br/><span style="color:gray;font-size:10px;">de films...</span></div>
	{elseif $menu == 'serie'}
		<div class="right_and_left_bloc_black_menu_bloc">Bandes-Annonces<br/><span style="color:gray;font-size:10px;">de séries TV...</span></div>
		<div class="right_and_left_bloc_black_menu_bloc">Interviews Vidéos<br/><span style="color:gray;font-size:10px;">de stars, de réalisateurs...</span></div>
		<div class="right_and_left_bloc_black_menu_bloc">Teasers<br/><span style="color:gray;font-size:10px;">des futures séries TV...</span></div>
		<div class="right_and_left_bloc_black_menu_bloc">Vidéos insolites<br/><span style="color:gray;font-size:10px;">frisson, rire, délire...</span></div>
		<div class="right_and_left_bloc_black_menu_bloc">Vidéos Bonus<br/><span style="color:gray;font-size:10px;">de séries TV...</span></div>
	{else}
		<div class="right_and_left_bloc_black_menu_bloc">Bandes-Annonces<br/><span style="color:gray;font-size:10px;">de films, de séries TV...</span></div>
		<div class="right_and_left_bloc_black_menu_bloc">Interviews Vidéos<br/><span style="color:gray;font-size:10px;">de stars, de réalisateurs...</span></div>
		<div class="right_and_left_bloc_black_menu_bloc">Teasers<br/><span style="color:gray;font-size:10px;">des futurs films, séries TV...</span></div>
		<div class="right_and_left_bloc_black_menu_bloc">Vidéos insolites<br/><span style="color:gray;font-size:10px;">frisson, rire, délire...</span></div>
		<div class="right_and_left_bloc_black_menu_bloc">Vidéos Bonus<br/><span style="color:gray;font-size:10px;">de films, de séries TV...</span></div>
	{/if}
</div>
<div class="right_and_left_bloc">
	{assign var=$paging value=true}
	{include file='BlocTrailers.tpl'}
</div>
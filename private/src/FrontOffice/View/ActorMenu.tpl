	<h1 style="font-size:24px;color:#3a6279;">{$actor->get_firstname()} {$actor->get_name()}</h1>
	<table cellpadding="10" cellspacing="0" width="100%" style="border-bottom:3px solid #8888FF;">
	<tr>
			<td style="background-color:#DDDDDD;border-top:1px solid white;border-left:1px solid #8888FF;border-right:1px solid #8888FF;border-bottom:1px solid #88888FF;" align="center">
				<a href="{$actor_menu['fiche']}">Fiche</a>
			</td>
			<td style="background-color:#DDDDDD;border-top:1px solid white;border-right:1px solid #8888FF;border-bottom:1px solid #88888FF;" align="center">
				<a href="{$actor_menu['biography']}">Biographie</a>
			</td>
			<td style="background-color:#DDDDDD;border-top:1px solid white;border-right:1px solid #8888FF;border-bottom:1px solid #88888FF;" align="center">
				<a href="{$actor_menu['filmographie']}">Filmographie</a>
			</td>
			<td style="{if $menu_select == 4}background-color:white;border-bottom:1px solid white;{else}background-color:#DDDDDD;border-bottom:1px solid #8888FF;{/if}border-top:1px solid white;border-right:1px solid #8888FF;border-bottom:1px solid #88888FF;" align="center">
				{if $actor_menu['photo']}
					<a href="{$actor_menu['photos']}" {if $menu_select == 4}style="color:black"{/if}>Photos</a>
				{else}
					<span style="color:#BBBBBB">Photos</span>
				{/if}
			</td>
			<td style="background-color:#DDDDDD;border-top:1px solid white;border-right:1px solid #8888FF;border-bottom:1px solid #88888FF;" align="center">
				<a href="{$actor_menu['recompenses']}">Récompenses</a>
			</td>
			<td style="{if $menu_select == 6}background-color:white;border-bottom:1px solid white;{else}background-color:#DDDDDD;border-bottom:1px solid #8888FF;{/if}border-right:1px solid #8888FF;border-bottom:1px solid #88888FF;" align="center">
				{if $actor_menu['news']}
					<a href="{$actor_menu['news']}" {if $menu_select == 6}style="color:black"{/if}>News</a>
				{else}
					<span style="color:#BBBBBB">News</span>
				{/if}
			</td>
			<td style="{if $menu_select == 7}background-color:white;border-bottom:1px solid white;{else}background-color:#DDDDDD;border-bottom:1px solid #8888FF;{/if}border-right:1px solid #8888FF;border-bottom:1px solid #88888FF;" align="center">
				{if $actor_menu['videos']}
					<a href="{$actor_menu['videos']}" {if $menu_select == 7}style="color:black"{/if}>Vidéos</a>
				{else}
					<span style="color:#BBBBBB">Vidéos</span>
				{/if}
			</td>
			<td style="background-color:#DDDDDD;border-top:1px solid white;border-right:1px solid #8888FF;border-bottom:1px solid #88888FF;" align="center">
				<a href="{$actor_menu['dvd']}">DVD</a>
			</td>
	</tr>
	</table>
	<meta itemprop="name" content="{$record->get_title() addslashes}" />
	<table cellpadding="10" cellspacing="0" style="border-top:1px solid #8888FF;">
	<tr>
		<td style="{if $menu_select == 1}background-color:white;border-bottom:1px solid white;{else}background-color:#DDDDDD;border-bottom:1px solid #8888FF;{/if}border-top:1px solid white;border-left:1px solid #8888FF;border-right:1px solid #8888FF;" align="center">
			<a href="{$record_menu['record']}" {if $menu_select == 1}style="color:black"{/if}>Fiche</a>
		</td>
		{if isset($record_menu['episodes'])}
			<td style="{if $menu_select == 2}background-color:white;border-bottom:1px solid white;{else}background-color:#DDDDDD;border-bottom:1px solid #8888FF;{/if}border-top:1px solid white;border-right:1px solid #8888FF;" align="center">
				<a href="{$record_menu['episodes']}" {if $menu_select == 2}style="color:black"{/if}>Episodes</a>
			</td>
		{/if}
		<td style="{if $menu_select == 3}background-color:white;border-bottom:1px solid white;{else}background-color:#DDDDDD;border-bottom:1px solid #8888FF;{/if}border-top:1px solid white;border-right:1px solid #8888FF;" align="center">
			{if $record_menu['trailer']}
				<a href="{$record_menu['trailer']}" {if $menu_select == 3}style="color:black"{/if}>Bandes-annonces</a>
			{else}
				<span style="color:#BBBBBB">Bandes-annonces</span>
			{/if}
		</td>
		<td style="{if $menu_select == 4}background-color:white;border-bottom:1px solid white;{else}background-color:#DDDDDD;border-bottom:1px solid #8888FF;{/if}border-top:1px solid white;border-right:1px solid #8888FF;" align="center">
			<a href="{$record_menu['casting']}" {if $menu_select == 4}style="color:black"{/if}>Casting</a>
		</td>
		{if isset($record_menu['diffusiontv'])}
			<td style="{if $menu_select == 5}background-color:white;border-bottom:1px solid white;{else}background-color:#DDDDDD;border-bottom:1px solid #8888FF;{/if}border-top:1px solid white;border-right:1px solid #8888FF;" align="center">
				<a href="{$record_menu['diffusiontv']}" {if $menu_select == 5}style="color:black"{/if}>Diffusion TV</a>
			</td>
		{/if}
		<td style="{if $menu_select == 6}background-color:white;border-bottom:1px solid white;{else}background-color:#DDDDDD;border-bottom:1px solid #8888FF;{/if}border-top:1px solid white;border-right:1px solid #8888FF;" align="center">
			<a href="{$record_menu['critique']}" {if $menu_select == 6}style="color:black"{/if}>Critiques</a>
		</td>
		<td style="{if $menu_select == 7}background-color:white;border-bottom:1px solid white;{else}background-color:#DDDDDD;border-bottom:1px solid #8888FF;{/if}border-top:1px solid white;border-right:1px solid #8888FF;" align="center">
			{if $record_menu['photo']}
				<a href="{$record_menu['photo']}" {if $menu_select == 7}style="color:black"{/if}>Photos</a>
			{else}
				<span style="color:#BBBBBB">Photos</span>
			{/if}
		</td>
		<td style="{if $menu_select == 8}background-color:white;border-bottom:1px solid white;{else}background-color:#DDDDDD;border-bottom:1px solid #8888FF;{/if}border-top:1px solid white;border-right:1px solid #8888FF;" align="center">
			{if $record_menu['news']}
				<a href="{$record_menu['news']}" {if $menu_select == 8}style="color:black"{/if}>Actualités</a>
			{else}
				<span style="color:#BBBBBB">Actualités</span>
			{/if}
		</td>
		{if isset($record_menu['story'])}
		<td style="{if $menu_select == 9}background-color:white;border-bottom:1px solid white;{else}background-color:#DDDDDD;border-bottom:1px solid #8888FF;{/if}border-top:1px solid white;border-right:1px solid #8888FF;" align="center">
			{if $record_menu['story']}
				<a href="{$record_menu['story']}" {if $menu_select == 9}style="color:black"{/if}>Anecdotes</a>
			{else}
				<span style="color:#BBBBBB">Anecdotes</span>
			{/if}
		</td>
		{/if}
	</tr>
	</table>
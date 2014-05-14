{* version=2; *}
<div class="double_tier_left_bloc_black_menu">
	<div class="right_and_left_bloc_black_menu_bloc" style="padding-top:6px;font-size:14px;padding-left:5px;padding-right:5px;text-align:center;"><a href="{url alias='distributeur-detail' id=$company->get_id() title=$company->title_encode}"><img src="/img/home.png" width="32" alt="icone home" title="icone home" style="border:0px;"></a></div>
	<div class="right_and_left_bloc_black_menu_bloc" style="padding-top:12px;font-size:14px;padding-left:5px;padding-right:5px;text-align:center;">
	<form name="like" method="post" action="{url alias='distributeur-detail' id=$company->get_id() title=$company->title_encode}">
		<input type="hidden" name="like" value="1">
		<a href="javascript:void(0);" onCLick="document.like.submit();"><img src="/img/coeur.png"> <b style="font-size:18px;">{$like}</b>
	</form>
	</div>
</div>
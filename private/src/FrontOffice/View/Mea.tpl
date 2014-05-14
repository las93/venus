	{foreach $meas as $i => $oOne}
		<div class="mea" id="mea{$i}">
			<div class="meaimg">
				<a href="{$oOne->get_link()}"><img src="/images/mea_{$oOne->get_id()}.jpg" alt="{$oOne->get_title() addslashes}" title="{$oOne->get_title() addslashes}" border="0"/></a>
			</div>
			<div class="meatext">
				&nbsp;<br/>{$oOne->get_title()}
				<br/><br/><a href="{$oOne->get_link()}"><input type="submit" value="{$oOne->get_button()}"/></a>
			</div>
		</div>
	{/foreach}
	<script>
		var numberOfMea=0;
		{foreach $meas as $i => $oOne}
			{if $i > 0}jQuery("#mea{$i}").css( "display", "none");{/if}
		{/foreach}
		$(document).ready(function() {
			setInterval(function(){
				jQuery("#mea"+numberOfMea).css( "display", "none");
				numberOfMea++;
				if (numberOfMea > {$i}) { numberOfMea=0; }
				jQuery("#mea"+numberOfMea).css( "display", "block");
			}, 5000);
		});
	</script>
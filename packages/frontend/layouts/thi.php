<div class="container">
	<header>
		<div class="header">[[|header|]]</div>
		<span class="glyphicon glyphicon-th" id="openPanel"></span>
	</header>
	<div class="content clearfix" data-spy="scroll" data-target=".question-list" data-offset="200">		
		<div id="panel" data-spy="affix" data-offset-top="100">
			[[|panel|]]
		</div>
		<div class="panelOut">[[|main|]]</div>
		[[|zone1|]]
	</div>
	<footer id="footer">
		<div class="footer">[[|footer|]]</div></div>
	</footer>
</div>
<script>
	jQuery(function(){
		jQuery('#panel').css('height',jQuery('#panel').height()+100);
		jQuery('#openPanel').click(function()
		{
			if(jQuery("#panel").is(':visible')===true){
				jQuery("#panel").animate({'width':'toggle'},300,function(){
					jQuery('.panelOut').addClass('panelOutFull');
				});
			}else{
				jQuery('.panelOut').removeClass('panelOutFull');
				jQuery("#panel").animate({'width':'toggle'},500);
			}			
		});
		jQuery('.content').scrollspy({ target: '#question-list' })		
	})
</script>
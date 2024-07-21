<div class="container">
	<header>
		<div class="header">[[|header|]]</div>
	</header>
	<div class="content clearfix" data-spy="scroll" data-target=".question-list" data-offset="200">		
		[[|main|]]
	</div>
	<footer id="footer">
		<div class="footer">[[|footer|]]</div></div>
	</footer>
</div>
<script>
	jQuery(function(){
		jQuery('.content').scrollspy({ target: '#question-list' })		
	})
</script>
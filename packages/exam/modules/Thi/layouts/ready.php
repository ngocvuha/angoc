<div class="jumbotron">
	<h2>Bạn đang ở trong phòng thi [[|Ten|]]</h2>
	<p>Bạn có thể làm bài thi</p>
	<form name="Wait" method="post">
		<input type="submit" id="confirm" value="Làm bài thi" class="btn btn-success" />
		<input name="phongthi" type="hidden" id="phongthi" class="" />
	</form>
	<script type="text/javascript">
        window.onbeforeunload = function () {
			item=document.getElementById("confirm");
			item.disabled=true;
		}
	</script>
	<p>{{Portal::get_setting('exam_notice')}}</p>
</div>
<script>
	
</script>
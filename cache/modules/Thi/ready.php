<div class="jumbotron">
	<h2>Bạn đang ở trong phòng thi <?php echo $this->map['Ten'];?></h2>
	<p>Bạn có thể làm bài thi</p>
	<form name="Wait" method="post">
		<input type="submit" id="confirm" value="Làm bài thi" class="btn btn-success" />
		<input  name="phongthi" id="phongthi" class="" / type ="hidden" value="<?php echo String::html_normalize(URL::get('phongthi'));?>">
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
	<script type="text/javascript">
        window.onbeforeunload = function () {
			item=document.getElementById("confirm");
			item.disabled=true;
		}
	</script>
	<p><?php echo Portal::get_setting('exam_notice');?></p>
</div>
<script>
	
</script>
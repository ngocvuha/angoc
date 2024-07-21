<div class="row width50">
	<div class="col-xs-4">
		<div class="panel panel-primary">
			<div class="panel-heading">Dành cho Quản trị viên</div>
			<div class="panel-body">
				<div class="intro">Đăng nhập để quản trị hệ thống, ngân hàng câu hỏi...</div><hr />
				<center><a href="<?php echo Url::build('admin');?>" class="btn btn-success">Đăng nhập</a></center>
			</div>
		</div>
	</div>	
	<div class="col-xs-4">
		<div class="panel panel-primary">
			<div class="panel-heading">Dành cho Quản lý</div>
			<div class="panel-body">
				<div class="intro">Đăng nhập xem báo cáo, tra cứu điểm thi....</div><hr />
				<center><a href="<?php echo Url::build('admin');?>" class="btn btn-success">Đăng nhập</a></center>
			</div>
		</div>
	</div>
	
	<div class="col-xs-4">
		<div class="panel panel-primary">
			<div class="panel-heading">Dành cho Sinh viên</div>
			<div class="panel-body">
				<div class="intro">Đăng nhập để xem danh sách môn thi, làm bài thi....</div><hr />
				<center><a href="<?php echo Url::build('dang-nhap');?>" class="btn btn-success">Đăng nhập</a></center>
			</div>
		</div>
	</div>
</div>
<script>
	jQuery(function(){
		height = 0;
		jQuery('.intro').each(function(){
			h = jQuery(this).height();
			if(height<h) height = h;
		}).css('height',height);
	})
</script>
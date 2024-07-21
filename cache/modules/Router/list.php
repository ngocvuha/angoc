<div class="row">
	<?php if((User::can_view(MODULE_DASHBOARD))){?>
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="panel panel-default">
		  <div class="panel-heading">Administrator</div>
		  <div class="panel-body">
			<p>Quản lý thành viên, quản trị hồ sơ sinh viên.....</p>
			<p><a class="btn btn-primary btn-lg" href="?page=dashboard" role="button">Truy cập</a></p>
		  </div>
		</div>
	</div>
	<?php } ?>
	<?php if((isset($this->map['PhongThi']))){?>
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="panel panel-default">
		  <div class="panel-heading">Lịch Thi</div>
		  <div class="panel-body">
			<?php if(isset($this->map['PhongThi']) and is_array($this->map['PhongThi'])){ foreach($this->map['PhongThi'] as $key1=>&$item1){ if($key1!='current'){$this->map['PhongThi']['current'] = &$item1;?>
			<p><a class="" href="?page=thi&phongthi=<?php echo $this->map['PhongThi']['current']['PhongThiID'];?>" role="button"><?php echo $this->map['PhongThi']['current']['MonThi'];?> (<?php echo $this->map['PhongThi']['current']['Ten'];?>) <span class="glyphicon glyphicon-hand-right"></span></a></p>
			<?php }}unset($this->map['PhongThi']['current']);} ?>
		  </div>
		</div>
	</div>
	<?php } ?>
	<?php if((User::is_login())){?>
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="panel panel-default">
		  <div class="panel-heading">Tra cứu điểm thi</div>
		  <div class="panel-body">
			<a class="" href="?page=tra-cuu-diem-thi" role="button">Tra cứu<span class="glyphicon glyphicon-hand-right"></span></a>
		  </div>
		</div>
	</div>
	<?php } ?>
</div>
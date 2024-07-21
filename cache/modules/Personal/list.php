<div class="panel panel-default">
  <div class="panel-heading">THÔNG TIN CÁ NHÂN</div>
  <div class="panel-body">
    <div class="row" >
		<div class="col-xs-3">
			<div class="thumbnail"><img src="<?php echo $this->map['avatar'];?>" onerror="this.src='templates/web/images/no_avatar.png'" /></div>
		</div>
		<div class="col-xs-9">
			<h3><?php echo $this->map['HoDem'];?> <?php echo $this->map['Ten'];?></h3>
			<p>Ngày sinh: <?php echo Date_time::to_common_date(substr($this->map['NgaySinh'],0,10));?></p>
			<?php if(trim($this->map['MaSV'])){?>
			<p>Mã SV: <?php echo $this->map['MaSV'];?></p>
			<p>Số CMTND: <?php echo $this->map['Cmt'];?></p>
			<p>Lớp: <?php echo $this->map['LopNienChe'];?></p>
			<?php }?>
			<a href="?page=sign_out" class="btn btn-danger">Thoát</a>
		</div>
	</div>
  </div>
</div>
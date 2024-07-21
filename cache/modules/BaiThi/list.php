<div class="panel panel-default">
	<div class="panel-heading">THÔNG TIN BÀI THI</div>
	<div class="panel-body">
		<div class="row" >
			<div class="col-xs-4">
				<div class="thumbnail"><img src="<?php echo $this->map['avatar'];?>" onerror="this.src='templates/web/images/no_avatar.png'" /></div>
			</div>
			<div class="col-xs-8">
				<h3><?php echo $this->map['HoTen'];?></h3>
				<p><?php echo $this->map['NgaySinh'];?></p>
				<p>Phòng thi: <?php echo $this->map['PhongThi'];?></p>
				<p>Ngày Thi: <?php echo $this->map['NgayThi'];?></p>
				<p>Điểm: <?php echo $this->map['Diem'];?></p>
			</div>
		</div>
	</div>
</div>
<div>
	<center class="alert alert-success" role="alert">Bạn đã hoàn thành bài thi với số điểm là </center>
	<?php if((Portal::get_setting('show_mark'))){?>
	<center style="font-size:64px; margin:50px 0; font-weight:bold; color:red"><?php echo  $this->map['TongDiemTraLoi'] .' / '. $this->map['TongDiem'];?> </center>
	 <?php }else{ ?>
	<center style="font-size:64px; margin:50px 0; font-weight:bold; color:red"><?php echo  $this->map['Diem'];?> Điểm </center>
	<?php } ?>
</div>
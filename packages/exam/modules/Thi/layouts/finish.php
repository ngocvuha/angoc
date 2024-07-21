<div>
	<center class="alert alert-success" role="alert">Bạn đã hoàn thành bài thi với số điểm là </center>
	<!--IF:diem(Portal::get_setting('show_mark'))-->
	<center style="font-size:64px; margin:50px 0; font-weight:bold; color:red">{{ [[=TongDiemTraLoi=]] .' / '. [[=TongDiem=]]}} </center>
	<!--ELSE-->
	<center style="font-size:64px; margin:50px 0; font-weight:bold; color:red">{{ [[=Diem=]]}} Điểm </center>
	<!--/IF:diem-->
</div>
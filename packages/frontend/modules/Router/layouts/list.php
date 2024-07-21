<div class="row">
	<!--IF:admin(User::can_view(MODULE_DASHBOARD))-->
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="panel panel-default">
		  <div class="panel-heading">Administrator</div>
		  <div class="panel-body">
			<p>Quản lý thành viên, quản trị hồ sơ sinh viên.....</p>
			<p><a class="btn btn-primary btn-lg" href="?page=dashboard" role="button">Truy cập</a></p>
		  </div>
		</div>
	</div>
	<!--/IF:admin-->
	<!--IF:admin(isset([[=PhongThi=]]))-->
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="panel panel-default">
		  <div class="panel-heading">Lịch Thi</div>
		  <div class="panel-body">
			<!--LIST:PhongThi-->
			<p><a class="" href="?page=thi&phongthi=[[|PhongThi.PhongThiID|]]" role="button">[[|PhongThi.MonThi|]] ([[|PhongThi.Ten|]]) <span class="glyphicon glyphicon-hand-right"></span></a></p>
			<!--/LIST:PhongThi-->
		  </div>
		</div>
	</div>
	<!--/IF:admin-->
	<!--IF:admin(User::is_login())-->
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="panel panel-default">
		  <div class="panel-heading">Tra cứu điểm thi</div>
		  <div class="panel-body">
			<a class="" href="?page=tra-cuu-diem-thi" role="button">Tra cứu<span class="glyphicon glyphicon-hand-right"></span></a>
		  </div>
		</div>
	</div>
	<!--/IF:admin-->
</div>
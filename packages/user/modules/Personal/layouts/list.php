<div class="panel panel-default">
  <div class="panel-heading">THÔNG TIN CÁ NHÂN</div>
  <div class="panel-body">
    <div class="row" >
		<div class="col-xs-3">
			<div class="thumbnail"><img src="[[|avatar|]]" onerror="this.src='templates/web/images/no_avatar.png'" /></div>
		</div>
		<div class="col-xs-9">
			<h3>[[|HoDem|]] [[|Ten|]]</h3>
			<p>Ngày sinh: {{Date_time::to_common_date(substr([[=NgaySinh=]],0,10))}}</p>
			<.if(trim([[=MaSV=]])){.>
			<p>Mã SV: [[|MaSV|]]</p>
			<p>Số CMTND: [[|Cmt|]]</p>
			<p>Lớp: [[|LopNienChe|]]</p>
			<.}.>
			<a href="?page=sign_out" class="btn btn-danger">Thoát</a>
		</div>
	</div>
  </div>
</div>
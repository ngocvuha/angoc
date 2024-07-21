<div id="dieuhanhthi" class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">ĐIỀU HÀNH THI</div>
    </div>
	<div class="dth-left">
		<h3>Chọn Phòng Thi</h3>
		<ul><!--LIST:phongthi--><li><a href="{{Url::build_current(array('PhongThi'=>[[=phongthi.id=]]))}}">[[|phongthi.Ten|]]</a></li><!--/LIST:phongthi--></ul>
	</div>
	<div class="dth-right">		
		<form name="DieuHanhThi" method="post">
		<div class="clrfix">
			<div class="fl"><h3>Phòng thi: [[|TenPhongThi|]] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button>Cập nhật</button></h3></div>
			<div class="fr">Tự động refresh (Min:20): <input onchange="SaveTimeOut(this.value)" style="width:30px; text-align:center" id="timeout"></div>
		</div>		
		<div class="clrfix">			
			<div class="column column-3">
				<h4>Danh sách chưa thi ([[|ChuaThi_C|]])</h4>				
				<table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
					<thead><tr class="ht">
						<th width="84">SBD</th>
						<th width="176">Họ và Tên</th>
						<th width="69">Ngày sinh</th>
					</tr></thead><tbody>
					<!--IF:chuathi(isset([[=ChuaThi=]]))--><!--LIST:ChuaThi-->
					<tr>
						<td width="84">[[|ChuaThi.SoBaoDanh|]]</td>
						<td width="176">[[|ChuaThi.HoDem|]] [[|ChuaThi.Ten|]]</td>
						<td width="69">{{[[=ChuaThi.NgaySinh=]]}}</td>
					</tr>
					<!--/LIST:ChuaThi--><!--/IF:chuathi--></tbody>
				</table>				
			</div>
			<div class="column column-3">
				<h4>Danh sách chờ thi  ([[|ChoThi_C|]])</h4>
				<table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
					<thead><tr class="ht">
						<th width="23"></th>
						<th width="84">SBD</th>
						<th width="177">Họ và Tên</th>
						<th width="69">Ngày sinh</th>
					</tr></thead><tbody>
					<!--IF:ChoThi(isset([[=ChoThi=]]))--><!--LIST:ChoThi-->
					<tr>
						<td width="22"><input name="ChoThi[[[|ChoThi.id|]]]" value="1" type="checkbox"></td>
						<td width="84">[[|ChoThi.SoBaoDanh|]]</td>
						<td width="177">[[|ChoThi.HoDem|]] [[|ChoThi.Ten|]]</td>
						<td width="69">{{[[=ChoThi.NgaySinh=]]}}</td>
					</tr>
					<!--/LIST:ChoThi--><!--/IF:ChoThi--></tbody>
				</table>
			</div>
			<div class="column column-3">
				<h4>Danh sách được thi ([[|DuocThi_C|]])</h4>
				<table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
					<thead><tr class="ht">
						<th width="23"></th>
						<th width="84">SBD</th>
						<th width="181">Họ và Tên</th>
						<th width="69">Ngày sinh</th>
					</tr></thead><tbody>
					<!--IF:DuocThi(isset([[=DuocThi=]]))--><!--LIST:DuocThi-->
					<tr>
						<td width="22"><input name="DuocThi[[[|DuocThi.id|]]]" value="1" type="checkbox"></td>
						<td width="84">[[|DuocThi.SoBaoDanh|]]</td>
						<td width="181">[[|DuocThi.HoDem|]] [[|DuocThi.Ten|]]</td>
						<td width="69">{{[[=DuocThi.NgaySinh=]]}}</td>
					</tr>
					<!--/LIST:DuocThi--><!--/IF:DuocThi--></tbody>
				</table>
			</div>
		</div>
		<br>
		<div class="clrfix">
			<div class="column column-2">
				<h4>Danh sách đang thi ([[|DangThi_C|]])</h4>
				<table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
					<thead><tr class="ht">
						<th width="22"></th>
						<th width="84">SBD</th>
						<th width="179">Họ và Tên</th>
						<th width="69">Ngày sinh</th>
						<th width="69">Bắt đầu</th>
						<th width="69">Còn</th>
					</tr></thead><tbody>
					<!--IF:DangThi(isset([[=DangThi=]]))--><!--LIST:DangThi-->
					<tr>
						<td width="22"><input name="DangThi[[[|DangThi.id|]]]" value="1" type="checkbox"></td>
						<td width="84">[[|DangThi.SoBaoDanh|]]</td>
						<td width="180">[[|DangThi.HoDem|]] [[|DangThi.Ten|]]</td>
						<td width="69">{{[[=DangThi.NgaySinh=]]}}</td>
						<td width="69">{{date('H:i:s',[[=DangThi.T_BatDau=]])}}</td>
						<td width="69">{{Date_time::remain([[=DangThi.T_KetThuc=]]-time())}}</td>
					</tr>
					<!--/LIST:DangThi--><!--/IF:DangThi--></tbody>
				</table>
			</div>
			<div class="column column-2">
				<h4>Danh sách đã thi ([[|DaThi_C|]])</h4>
				<table width="100%" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
					<thead><tr class="ht">
						<th width="84">SBD</th>
						<th width="200">Họ và Tên</th>
						<th width="75">Ngày sinh</th>
						<th width="70">Bắt đầu</th>
						<th width="70">Kết thúc</th>
						<th width="40">Điểm</th>
					</tr></thead><tbody>
					<!--IF:DaThi(isset([[=DaThi=]]))--><!--LIST:DaThi-->
					<tr>
						<td width="84">[[|DaThi.SoBaoDanh|]]</td>
						<td width="200">[[|DaThi.HoDem|]] [[|DaThi.Ten|]]</td>
						<td width="75">{{[[=DaThi.NgaySinh=]]}}</td>
						<td width="70">{{date('H:i:s',[[=DaThi.T_BatDau=]])}}</td>
						<td width="70">{{date('H:i:s',[[=DaThi.T_KetThuc=]])}}</td>
						<td width="40">[[|DaThi.Diem|]]</td>
					</tr>
					<!--/LIST:DaThi--><!--/IF:DaThi--></tbody>
				</table>
			</div>
		</div>
		</form>
	</div>
</div>
<script>
	var localStorage = window.localStorage;
	var autoR;
	if (localStorage.TimeOut) {
		
	} else {
		localStorage.TimeOut = 60;
	}
	$('timeout').value = localStorage.TimeOut;
	function SaveTimeOut(value){
		TimeOut = parseInt(value);
		if(TimeOut<10) TimeOut = 10;
		localStorage.setItem("TimeOut", TimeOut);
		myStopFunction();
		autoRefresh();
	}
	function myStopFunction() {
		clearTimeout(autoR);
	}
	function autoRefresh(){
		autoR = setTimeout(function(){ location.reload(); }, localStorage.TimeOut*1000);
	}
	autoRefresh();
</script>
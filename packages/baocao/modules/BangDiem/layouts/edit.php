<div class="middle" style="padding-bottom:50px;">
	<div class="content-header clrfix">
    	<div class="fl title">Bảng điểm</div>
        <div class="fr">
        <a target="_blank" href="[[|path_xlsx|]]" class="red-button">Danh sách thi (excel)</a>
		<a target="_blank" href="[[|bangdiem_t10_xlsx|]]" class="red-button">Bảng điểm (excel hệ số 10)</a>
		<a target="_blank" href="[[|bangdiem_total_xlsx|]]" class="red-button">Bảng điểm (excel tổng điểm)</a>
        <button class="gray-button" onclick="goto('{{Url::build_current()}}');">Quay lại</button>
        </div>
    </div>
	<div class="form-content"><.$i=1.>
	<table width="100%" cellpadding="4" cellspacing="0" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
		<tr class="ht">
			<td nowrap>STT</td>
			<td nowrap width="100">Số báo danh</td>
			<td nowrap width="200" align="left">Họ tên</td>
			<td nowrap width="70" align="left">Ngày sinh</td>
			<td nowrap width="50" align="left">Giới tính</td>
			<td nowrap width="100" align="left">Lớp</td>
			<td nowrap width="100" align="left">Điểm</td>
			<td nowrap width="1%">Chữ ký</td>
		</tr><.$show_mark=Portal::get_setting('show_mark');.>
		<!--LIST:items-->
		<tr>	
			<td nowrap width="1%" align="right">{{$i++}}</td>
			<td nowrap width="100">[[|items.SoBaoDanh|]]</td>
			<td nowrap width="200">[[|items.HoDem|]] [[|items.Ten|]]</td>
			<td nowrap width="70" align="center">{{Date_time::to_common_date(substr([[=items.NgaySinh=]],0,10))}}</td>
			<td nowrap width="50">{{[[=items.GioiTinh=]]?'Nữ':'Nam'}}</td>
			<td nowrap width="100">[[|items.name|]]</td>
			<!--IF:diem($show_mark)-->
			<td nowrap width="100" align="right">[[|items.TongDiemTraLoi|]] / [[|items.TongDiem|]]</td>
			<!--ELSE-->
			<td nowrap width="100" align="right">[[|items.Diem|]]</td>
			<!--/IF:diem-->
			
			<td></td>
		</tr>
		<!--/LIST:items-->
	</table>
    </div>
</div>
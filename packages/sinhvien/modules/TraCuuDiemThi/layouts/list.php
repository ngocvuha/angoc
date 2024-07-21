<div class="">
	<table class="table table-responsive table-bordered">
	<thead><tr class="active">
		<th>Phòng thi</th>
		<th>Ngày Thi</th>
		<th>Điểm</th>
		<th>Điểm (quy đổi hệ số 10)</th>
	</tr></thead>
	<!--LIST:items-->
	<tr>
		<td>[[|items.Ten|]]</td>
		<td>{{date('d/m/Y',[[=items.T_KetThuc=]])}}</td>
		<td>[[|items.TongDiemTraLoi|]] / [[|items.TongDiem|]]</td>
		<td align="right">[[|items.Diem|]]</td>
	</tr>
	<!--/LIST:items-->
	</table>
</div>
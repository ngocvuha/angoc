<div class="middle" style="padding-bottom:50px;">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý Phòng thi{{' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <button class="gray-button" onclick="goto('{{Url::build_current()}}');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
		<h2>Thông tin Phòng Thi</h2>
		<div class="tab-content">
			<table cellpadding="6" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">
				<tr>
					<td class="ht"><label for="Ten">Phòng thi số</label></td>
					<td>[[|Ten|]]</td>
				</tr>
				<tr>
					<td class="ht"><label>Ngày - Giờ Thi</label></td>
					<td>Từ [[|T_BatDau|]] Đến [[|T_KetThuc|]]</td>
				</tr>
				<tr>
					<td class="ht"><label for="IDCauTrucDeThi">Đề thi</label></td>
					<td>[[|DeThi|]]</td>
				</tr>
				<tr>
					<td class="ht"><label for="IDQuanLyThi">Giám thị</label></td>
					<td>[[|GiamThi|]]</td>
				</tr>
				<tr>
					<td class="ht"><label for="NgayThi">Ghi chú</label></td>
					<td>[[|GhiChu|]]</td>
				</tr>
				<tr>
					<td class="ht" width="1%" nowrap><label for="NgayThi">Tổng số bài thi đã nộp</label></td>
					<td><span id="Tong">{{isset([[=items=]])?count([[=items=]]):''}}</span></td>
				</tr>
			</table>
		</div>
		<div id="tabs-options">
			<center><h3>DANH SÁCH BÀI THI</h3></center>
			<table cellpadding="5" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">					
				<tr class="ht">
					<td>Mã Dự thi</td>
					<td>Họ và Tên</td>
					<td>Điểm</td>
					<td width="1%" nowrap>Xem bài thi</td>
				</tr>
				<!--LIST:items-->
				<tr>
					<td>[[|items.MaSV|]]</td>
					<td>[[|items.HoDem|]] [[|items.Ten|]]</td>
					<td align="right">[[|items.Diem|]]</td>
					<td><a target="_blank" href="{{Url::build('phuc-tra-bai-thi',array('id'=>[[=items.BaiThi=]]))}}"><img width="16px" src="templates/admin/images/buttons/search.gif"></a></td>
				</tr>
				<!--/LIST:items-->
			</table>					
		</div>
    </div>
</div>
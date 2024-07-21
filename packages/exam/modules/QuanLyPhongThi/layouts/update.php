<div class="middle" style="padding-bottom:50px;">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý Phòng thi{{' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())-->
        <button id="update_time" class="red-button">Ghi lại</button>
        <!--/IF:can-->
        <button class="gray-button" onclick="goto('{{Url::build_current()}}');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
	<form name="EditQuanLyPhongThi" id="EditQuanLyPhongThi" method="post" onsubmit="SelectAllList()" enctype="multipart/form-data">
    	<.if(Form::$current->is_error()){echo Form::$current->error_messages();}.>
           	<h2>Thông tin Phòng Thi</h2>
            <div class="tab-content">
				<table cellpadding="5" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">
					<tr>
						<td class="m-label"><label for="Ten">Phòng thi số</label></td>
						<td>[[|Ten|]]</td>
					</tr>
					<tr>
						<td class="m-label"><label>Ngày - Giờ Thi</label></td>
						<td>Từ <input name="T_BatDau" type="text" id="T_BatDau" class="datetime" /> Đến <input name="T_KetThuc" type="text" id="T_KetThuc" class="datetime" /></td>
					</tr>
					<tr>
						<td class="m-label"><label for="IDCauTrucDeThi">Cấu trúc đề thi</label></td>
						<td>[[|CauTrucDeThi|]]</td>
					</tr>
					<tr>
						<td class="m-label"><label for="IDQuanLyThi">Giám thị</label></td>
						<td>[[|QuanLyThi|]]</td>
					</tr>					
					<tr>
						<td class="m-label"><label for="NgayThi">Ghi chú</label></td>
						<td>[[|GhiChu|]]</td>
					</tr>
				</table>
            </div>
        </div>
        <.if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}.>
        <input type="hidden" name="action" id="action" />
	</form>
    </div>
</div>
<script type="text/javascript">
jQuery(function(){
	jQuery('.datetime').datetimepicker({format:"d/m/Y H:i",datepicker:true,step:5});
	
	jQuery('button#update_time').click(function(){
		var form = get_form();
		make_cmd("update");
		if (typeof FormSubmit == 'function') { 
		  FormSubmit(); 
		}
		form.submit();
	});
});
</script>
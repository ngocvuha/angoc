<div class="middle" style="padding-bottom:50px;">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý Phòng thi<?php echo ' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?>
        <button id="update_time" class="red-button">Ghi lại</button>
        <?php } ?>
        <button class="gray-button" onclick="goto('<?php echo Url::build_current();?>');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
	<form name="EditQuanLyPhongThi" id="EditQuanLyPhongThi" method="post" onsubmit="SelectAllList()" enctype="multipart/form-data">
    	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
           	<h2>Thông tin Phòng Thi</h2>
            <div class="tab-content">
				<table cellpadding="5" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">
					<tr>
						<td class="m-label"><label for="Ten">Phòng thi số</label></td>
						<td><?php echo $this->map['Ten'];?></td>
					</tr>
					<tr>
						<td class="m-label"><label>Ngày - Giờ Thi</label></td>
						<td>Từ <input  name="T_BatDau" id="T_BatDau" class="datetime" / type ="text" value="<?php echo String::html_normalize(URL::get('T_BatDau'));?>"> Đến <input  name="T_KetThuc" id="T_KetThuc" class="datetime" / type ="text" value="<?php echo String::html_normalize(URL::get('T_KetThuc'));?>"></td>
					</tr>
					<tr>
						<td class="m-label"><label for="IDCauTrucDeThi">Cấu trúc đề thi</label></td>
						<td><?php echo $this->map['CauTrucDeThi'];?></td>
					</tr>
					<tr>
						<td class="m-label"><label for="IDQuanLyThi">Giám thị</label></td>
						<td><?php echo $this->map['QuanLyThi'];?></td>
					</tr>					
					<tr>
						<td class="m-label"><label for="NgayThi">Ghi chú</label></td>
						<td><?php echo $this->map['GhiChu'];?></td>
					</tr>
				</table>
            </div>
        </div>
        <?php if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}?>
        <input type="hidden" name="action" id="action" />
	<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
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
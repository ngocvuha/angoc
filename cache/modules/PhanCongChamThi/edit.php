<div class="middle" style="padding-bottom:50px;">
	<div class="content-header clrfix">
    	<div class="fl title">Phân công chấm thi <?php echo ' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?>
        <button id="save" class="red-button">Ghi lại</button>
        <?php } ?>
        <button class="gray-button" onclick="goto('<?php echo Url::build_current();?>');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
	<form name="EditPhanCongChamThi" id="EditPhanCongChamThi" method="post">
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
						<td>Từ <?php echo $this->map['T_BatDau'];?> Đến <?php echo $this->map['T_KetThuc'];?></td>
					</tr>
					<tr>
						<td class="m-label"><label for="IDCauTrucDeThi">Môn Thi</label></td>
						<td></td>
					</tr>
					<tr>
						<td class="m-label"><label for="IDCauTrucDeThi">Số bài thi</label></td>
						<td><?php echo $this->map['TongSoBai'];?></td>
					</tr>
					<tr>
						<td class="m-label"><label for="IDCauTrucDeThi" style="color:red"><strong>Số bài thi trong mỗi túi bài(mặc định là 30)*</strong></label></td>
						<td><input name="tuithi" /></td>
					</tr>
					<tr style="display:none">
						<td class="m-label"><label for="IDCauTrucDeThi" style="color:red">Chọn người chấm</label></td>
						<td><input  name="users" id="users" value="<?php echo $this->map['users'];?>" style="width:100%" /></td>
					</tr>
					<tr>
						<td class="m-label"><label for="IDCauTrucDeThi">Chọn người chấm</label><button type="button" id="addUser">Thêm</button></td>
						<td>
							<table id="listUser" cellpadding="6" width="100%" border="1"><tr>
								<td>Họ và Tên</td>
								<td>Khoa</td>
								<td>Tên đăng nhập</td>
								<td>Mật khẩu</td>
							</tr><?php $i=1?>
							<?php if((isset($this->map['users']))){?><?php if(isset($this->map['users']) and is_array($this->map['users'])){ foreach($this->map['users'] as $key1=>&$item1){ if($key1!='current'){$this->map['users']['current'] = &$item1;?>
							<tr>
								<td><input name="user[<?php echo $i;?>][id]" type="hidden" value="<?php echo $this->map['users']['current']['id'];?>" /><input name="user[<?php echo $i;?>][HoTen]" value="<?php echo $this->map['users']['current']['HoTen'];?>" /></td>
								<td><input name="user[<?php echo $i;?>][Khoa]" value="<?php echo $this->map['users']['current']['Khoa'];?>" /></td>
								<td><input name="user[<?php echo $i;?>][IDUser]" value="<?php echo $this->map['users']['current']['IDUser'];?>" /></td>
								<td><input name="user[<?php echo $i++;?>][Password]" value="**********" type="password" /></td>
							</tr>
							<?php }}unset($this->map['users']['current']);} ?><?php } ?>
							</table>
						</td>
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
jQuery(function() {
	var index = <?php echo $i;?>;
    var row = '<tr>';
	row += '<td><input name="user[index][1][id]" type="hidden" /><input name="user[index][1][HoTen]" /></td>';
	row += '<td><input name="user[index][1][Khoa]" /></td>';
	row += '<td><input name="user[index][1][IDUser]" /></td>';
	row += '<td><input name="user[index][1][Password]" type="password" /></td>';	
	row += '</tr>';
	row += '<tr>';
	row += '<td><input name="user[index][2][id]" type="hidden" /><input name="user[index][2][HoTen]" /></td>';
	row += '<td><input name="user[index][2][Khoa]" /></td>';
	row += '<td><input name="user[index][2][IDUser]" /></td>';
	row += '<td><input name="user[index][2][Password]" type="password" /></td>';	
	row += '</tr>';
	breakline = '<tr style="background:#CCC"><td colspan="4"></td></tr>';
	jQuery('#addUser').click(function(){
		r = row.replace(/index/g,index);
		index++;
		jQuery('#listUser').append(r);
		//r = row.replace(/index/g,index);
		//index++;
		//jQuery('#listUser').append(r);
		jQuery('#listUser').append(breakline);
	});
});
</script>
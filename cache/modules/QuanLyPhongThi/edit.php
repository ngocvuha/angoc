<div class="middle" style="padding-bottom:50px;">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý Phòng thi<?php echo ' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?>
        <button id="save" class="red-button">Ghi lại</button>
        <button id="save_continue" class="red-button">Ghi lại & Tiếp tục <?php echo Portal::get_action(Url::get('cmd'));?></button>
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
						<td><input  name="Ten" id="Ten" class="" autofocus / type ="text" value="<?php echo String::html_normalize(URL::get('Ten'));?>"></td>
					</tr>
					<tr>
						<td class="m-label"><label>Ngày - Giờ Thi</label></td>
						<td>Từ <input  name="T_BatDau" id="T_BatDau" class="datetime" / type ="text" value="<?php echo String::html_normalize(URL::get('T_BatDau'));?>"> Đến <input  name="T_KetThuc" id="T_KetThuc" class="datetime" / type ="text" value="<?php echo String::html_normalize(URL::get('T_KetThuc'));?>"></td>
					</tr>
					<tr>
						<td class="m-label"><label for="IDCauTrucDeThi">Cấu trúc đề thi</label></td>
						<td><select  name="IDCauTrucDeThi" id="IDCauTrucDeThi"><?php
					if(isset($this->map['IDCauTrucDeThi_list']))
					{
						foreach($this->map['IDCauTrucDeThi_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('IDCauTrucDeThi').value = "<?php echo addslashes(URL::get('IDCauTrucDeThi',isset($this->map['IDCauTrucDeThi'])?$this->map['IDCauTrucDeThi']:''));?>";</script></td>
					</tr>
					<tr>
						<td class="m-label"><label for="IDQuanLyThi">Giám thị</label></td>
						<td><select  name="IDQuanLyThi" id="IDQuanLyThi"><?php
					if(isset($this->map['IDQuanLyThi_list']))
					{
						foreach($this->map['IDQuanLyThi_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('IDQuanLyThi').value = "<?php echo addslashes(URL::get('IDQuanLyThi',isset($this->map['IDQuanLyThi'])?$this->map['IDQuanLyThi']:''));?>";</script></td>
					</tr>
					<tr>
						<td class="m-label"><label for="Locked">Khóa phòng thi</label></td>
						<td><input  name="Locked"  type="checkbox"  id="Locked" value="1" <?php echo Url::get('Locked')?'checked':'aa';?>></td>
					</tr>
					<tr>
						<td class="m-label"><label for="NgayThi">Ghi chú</label></td>
						<td><input name="GhiChu" id="GhiChu" style="width:100%;" value="<?php echo $this->map['GhiChu'];?>" /></td>
					</tr>
					<tr>
						<td class="m-label"><label for="NgayThi">Tổng số thí sinh</label></td>
						<td><span id="Tong"><?php echo isset($this->map['items'])?count($this->map['items']):'';?></span></td>
					</tr>
				</table>
            </div>
            <div id="tabs-options">
            	<table cellpadding="5" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">
					<tr><td colspan="2"><center>
						<button id="addStudent" type="button">></button>
						<button id="addAllStudent" type="button">>></button>
						<button id="removeStudent" type="button">X</button>
					</center></td></tr>
					<tr><td width="50%"><center><h3>DANH SÁCH SINH VIÊN</h3></center>
					<span>Chọn lớp</span>
					<input name="lop" id="lop" />
					<span>Chọn Nhóm</span>
					<input name="nhom" id="nhom" />
					<select id="sinhvien" name="sinhvien" multiple class="select-responsive"></select>
				</td><td width="50%"><center><h3>DANH SÁCH THÍ SINH PHÒNG THI</h3></center>
					<select id="danhsachduthi" name="danhsachduthi[]" multiple size="<?php echo $this->map['items_size'];?>" class="select-responsive">
					<?php if(isset($this->map['items']) and is_array($this->map['items'])){ foreach($this->map['items'] as $key1=>&$item1){ if($key1!='current'){$this->map['items']['current'] = &$item1;?>
					<option value="<?php echo $this->map['items']['current']['id'];?>" id="danhsachduthi_<?php echo $this->map['items']['current']['id'];?>"><?php echo $this->map['items']['current']['MaSV'];?> - <?php echo $this->map['items']['current']['HoDem'];?> <?php echo $this->map['items']['current']['Ten'];?></option>
					<?php }}unset($this->map['items']['current']);} ?>
					</select>
					</td></tr></table>					
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
	jQuery('#addStudent').click(function(){
		jQuery('#sinhvien').find(':selected').each(function(e){
			var sv = jQuery(this).val();
			if (jQuery('#danhsachduthi_'+sv).length) {
				
			}else{
				jQuery('#danhsachduthi').append(jQuery(this).clone().attr('id','danhsachduthi_'+sv));
			}
		})
		//jQuery('#sinhvien').find(':selected').appendTo('#danhsachduthi');
		var size = jQuery('#danhsachduthi option').size();
		jQuery('#danhsachduthi').attr('size',size);
		jQuery('#Tong').html(size);
	});
	jQuery('#addAllStudent').click(function(){
		jQuery('#sinhvien').children().each(function(e){
			var sv = jQuery(this).val();
			if (jQuery('#danhsachduthi_'+sv).length) {
				
			}else{
				jQuery('#danhsachduthi').append(jQuery(this).clone().attr('id','danhsachduthi_'+sv));
			}
		})
		//jQuery('#sinhvien').find(':selected').appendTo('#danhsachduthi');
		var size = jQuery('#danhsachduthi option').size();
		jQuery('#danhsachduthi').attr('size',size);
		jQuery('#Tong').html(size);
	});
	jQuery('#removeStudent').click(function(){
		jQuery('#danhsachduthi').find(':selected').remove();
		var size = jQuery('#danhsachduthi option').size();
		jQuery('#danhsachduthi').attr('size',size);
		jQuery('#Tong').html(size);
	});
	jQuery( "#lop" ).autocomplete({
		source: 'form.php?cmd=get_lop&block_id=<?php echo Module::block_id();?>',
		minLength: 3,
		focus: function( event, ui ) {
			jQuery( "#lop" ).val( ui.item.label );
			  return false;
		},
		select: function( event, ui ) {
			jQuery( "#lop" ).val( ui.item.label );
			get_sv(ui.item.value,'');
			return false;
		}
    });
	jQuery( "#nhom" ).autocomplete({
		source: 'form.php?cmd=get_nhom&block_id=<?php echo Module::block_id();?>',
		minLength: 3,
		focus: function( event, ui ) {
			jQuery( "#nhom" ).val( ui.item.label );
			  return false;
		},
		select: function( event, ui ) {
			jQuery( "#nhom" ).val( ui.item.label );
			get_sv('',ui.item.value);
			return false;
		}
    });
});
function get_sv(lop,nhom){
	jQuery.ajax({
		method: "POST",url: 'form.php?block_id=<?php echo Module::block_id();?>',
		data : {
			'cmd':'get_ts',
			'lop':lop,
			'nhom':nhom
		},
		beforeSend: function(){
		},
		success: function(content){
			var data = jQuery.parseJSON(content);
			jQuery('#sinhvien').attr('size',data.size).html(data.content);
		}
	});
}
function FormSubmit(){
	jQuery('#danhsachduthi').children().attr('selected','selected');
}
</script>
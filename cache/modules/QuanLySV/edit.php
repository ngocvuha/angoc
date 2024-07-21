<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button class="red-button" onclick="create_account(<?php echo Module::block_id();?>);">Ghi lại</button><?php } ?>
        <button class="gray-button" onclick="goto('<?php echo Url::build_current();?>');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
        <form name="EditManageCustomerForm" method="post">
        	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
			<table cellpadding="10" cellspacing="0" border="1" width="100%" bordercolor="#e7e7e7">
			<tr><td width="50%">
            <h3>Thông tin tài khoản</h3>
			<table cellpadding="10" cellspacing="0" border="1" width="100%" bordercolor="#e7e7e7">
                <tr>
                    <td width="1%" align="right" nowrap><?php echo Portal::language('user_name');?></td>
                    <td><input  name="id" id="id" class="input-large" autofocus / type ="text" value="<?php echo String::html_normalize(URL::get('id'));?>"></td>
                </tr>
                <tr>
                    <td align="right" nowrap><?php echo Portal::language('password');?></td>
                    <td><input  name="password" id="password" class="input-large" / type ="password" value="<?php echo String::html_normalize(URL::get('password'));?>"> </td>
                </tr>
                <tr>
                    <td align="right" nowrap><?php echo Portal::language('email');?></td>
                    <td><input  name="email" id="email" class="input-large" / type ="text" value="<?php echo String::html_normalize(URL::get('email'));?>"> </td>
                </tr>                
                <tr>
                    <td align="right"><?php echo Portal::language('status');?></td>
                    <td align="left">
                        <input name="active" id="active" type="checkbox" value="1" <?php echo (URL::get('is_active')?'checked':'');?> />
                        <label for="active"><?php echo Portal::language('active');?></label>
                        <input name="block" id="block" type="checkbox" value="1" <?php echo (URL::get('is_block')?'checked':'');?>/>
                        <label for="block"><?php echo Portal::language('block');?></label>
                    </td>
                </tr>
            </table>
			</td><td>
				<h3>Thông tin cá nhân</h3>
				<table cellpadding="10" cellspacing="0" border="1" width="100%" bordercolor="#e7e7e7">
					<tr>
						<td width="1%" align="right" nowrap>Họ</td>
						<td><input  name="HoDem" id="HoDem" class="input-medium" / type ="text" value="<?php echo String::html_normalize(URL::get('HoDem'));?>">Tên: <input  name="Ten" id="Ten" class="input-medium" / type ="text" value="<?php echo String::html_normalize(URL::get('Ten'));?>"></td>
					</tr>
					<tr>
						<td width="1%" align="right" nowrap>Ngày sinh</td>
						<td><input  name="NgaySinh" id="NgaySinh" class="input-large date" / type ="text" value="<?php echo String::html_normalize(URL::get('NgaySinh'));?>"></td>
					</tr>
					<tr>
						<td width="1%" align="right" nowrap>Giới tính</td>
						<td><select  name="GioiTinh" id="GioiTinh"><?php
					if(isset($this->map['GioiTinh_list']))
					{
						foreach($this->map['GioiTinh_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?></select><script type="text/javascript">$('GioiTinh').value = "<?php echo addslashes(URL::get('GioiTinh',isset($this->map['GioiTinh'])?$this->map['GioiTinh']:''));?>";</script></td>
					</tr>
					<tr>
						<td width="1%" align="right" nowrap>Quê Quán</td>
						<td><input  name="QueQuan" id="QueQuan" class="input-large" / type ="text" value="<?php echo String::html_normalize(URL::get('QueQuan'));?>"></td>
					</tr>
					<tr>
						<td width="1%" align="right" nowrap>MaSV</td>
						<td><input  name="MaSV" id="MaSV" class="input-large" / type ="text" value="<?php echo String::html_normalize(URL::get('MaSV'));?>"></td>
					</tr>
					<tr>
						<td width="1%" align="right" nowrap>CMTND</td>
						<td><input  name="Cmt" id="Cmt" class="input-large" / type ="text" value="<?php echo String::html_normalize(URL::get('Cmt'));?>"></td>
					</tr>
					<tr>
						<td align="right" nowrap>Lớp</td>
						<td><select  name="tblLopNienChe_id" id="tblLopNienChe_id" class="input-large"><?php echo String::get_select_list($this->map['tblLopNienChe'],'tblLopNienChe_id',true);?></select></td>
					</tr>
				</table>
			</td></tr></table>
            <input type="hidden" value="1" name="confirm_edit" >
            <input type="hidden" name="privilege_deleted_ids" value=""/>
            <input type="hidden" name="group_deleted_ids" value=""/>
            <?php if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}?>
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
	</div>
</div>
<script type="text/javascript">
function create_account(block_id){
	var email = document.getElementById('email');
	var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	<?php if((Url::get('cmd')=='edit')){?>
	var check_account = check_ajax(block_id,{'cmd':'edit','id':'<?php echo Url::nget("id");?>','action':'check_account','account':$('id').value});
	 <?php }else{ ?>
	var check_account = check_ajax(block_id,{'cmd':'add','action':'check_account','account':$('id').value});
	<?php } ?>
	if(jQuery('#account').val()==''){
		alert('Hãy nhập tên tài khoản.'); jQuery('#account').focus();
	}else if(check_account=='true'){
		alert('Tài khoản này đã được đăng ký. Vui lòng chọn tài khoản khác.'); jQuery('#account').focus();
	<?php if((Url::get('cmd')!='edit')){?>
	}else if(jQuery('#password').val()==''){
		alert('Hãy nhập mật khẩu'); jQuery('#password').focus();
	}else if((jQuery('#password').val()).length<6){
		alert('Hãy nhập mật khẩu lớn hơn 6 ký tự.'); jQuery('#password').focus();
	<?php } ?>
	}else if(jQuery('#email').val()!='' && !filter.test(email.value)){
		alert('Hãy nhập chính xác định dạng Email.'); jQuery('#email').focus();
	}else{
		document.EditManageCustomerForm.submit();
	}
}
jQuery(function(){
	jQuery('.date').css('text-align','center').datepicker({'changeYear':true,'yearRange':'c-60:c','dateFormat':'dd/mm/yy'});
});
</script>
<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Quản lý tài khoản<?php echo ' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
        <div class="fr">
        <?php if((User::can_add())){?><button class="red-button" onclick="create_account(<?php echo Module::block_id();?>);">Ghi lại</button><?php } ?>
        <button class="gray-button" onclick="goto('<?php echo Url::build_current();?>');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
        <form name="EditUserAdminForm" method="post">
        	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
            <table cellpadding="10" cellspacing="0" border="1" width="100%" bordercolor="#e7e7e7">
                <tr>
                    <td width="1%" align="right" nowrap>Tài khoản</td>
                    <td><input  name="account_id" id="account_id"<?php echo Url::get('cmd')=='edit'?' disabled="disabled"':'';?> class="input-large" / type ="text" value="<?php echo String::html_normalize(URL::get('account_id'));?>"></td>
                </tr>
                <tr>
                    <td align="right" nowrap>Mật khẩu</td>
                    <td><input  name="password" id="password" class="input-large" / type ="password" value="<?php echo String::html_normalize(URL::get('password'));?>"> </td>
                </tr>
                <tr>
                    <td align="right" nowrap>Email</td>
                    <td><input  name="email" id="email" class="input-large" / type ="text" value="<?php echo String::html_normalize(URL::get('email'));?>"> </td>
                </tr>
                <tr>
                    <td align="right" nowrap="nowrap">Trạng thái</td>
                    <td align="left">
                        <input name="active" id="active" type="checkbox" value="1" <?php echo (URL::get('is_active')?'checked':'');?> />
                        <label for="active">Kích hoạt</label>
                        <input name="block" id="block" type="checkbox" value="1" <?php echo (URL::get('is_block')?'checked':'');?>/>
                        <label for="block">Khóa</label>
                    </td>
                </tr>
            </table>		
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
	var check_account = check_ajax(block_id,{'cmd':'edit','id':'<?php echo Url::nget("id");?>','action':'check_account','account':$('account_id').value});
	 <?php }else{ ?>
	var check_account = check_ajax(block_id,{'cmd':'add','action':'check_account','account':$('account_id').value});
	<?php } ?>
	if(jQuery('#account_id').val()==''){
		alert('Hãy nhập tên tài khoản.'); jQuery('#account_id').focus();
	}else if(check_account=='true'){
		alert('Tài khoản này đã được đăng ký. Vui lòng chọn tài khoản khác.'); jQuery('#account_id').focus();
	<?php if((Url::get('cmd')!='edit')){?>
	}else if(jQuery('#password').val()==''){
		alert('Hãy nhập mật khẩu'); jQuery('#password').focus();
	}else if((jQuery('#password').val()).length<6){
		alert('Hãy nhập mật khẩu lớn hơn 6 ký tự.'); jQuery('#password').focus();
	<?php } ?>
	}else if(jQuery('#email').val()!='' && !filter.test(email.value)){
		alert('Hãy nhập chính xác định dạng Email.'); jQuery('#email').focus();
	}else{
		document.EditUserAdminForm.submit();
	}
}
</script>
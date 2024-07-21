<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button class="red-button" onclick="create_account({{Module::block_id()}});">Ghi lại</button><!--/IF:can-->
        <button class="gray-button" onclick="goto('{{Url::build_current()}}');">Quay lại</button>
        </div>
    </div>
	<div class="form-content">
        <form name="EditManageCustomerForm" method="post">
        	<.if(Form::$current->is_error()){echo Form::$current->error_messages();}.>
			<table cellpadding="10" cellspacing="0" border="1" width="100%" bordercolor="#e7e7e7">
			<tr><td width="50%">
            <h3>Thông tin tài khoản</h3>
			<table cellpadding="10" cellspacing="0" border="1" width="100%" bordercolor="#e7e7e7">
                <tr>
                    <td width="1%" align="right" nowrap>[[.user_name.]]</td>
                    <td><input name="id" type="text" id="id" class="input-large" autofocus /></td>
                </tr>
                <tr>
                    <td align="right" nowrap>[[.password.]]</td>
                    <td><input name="password" type="password" id="password" class="input-large" /> </td>
                </tr>
                <tr>
                    <td align="right" nowrap>[[.email.]]</td>
                    <td><input name="email" type="text" id="email" class="input-large" /> </td>
                </tr>                
                <tr>
                    <td align="right">[[.status.]]</td>
                    <td align="left">
                        <input  name="active" id="active" type="checkbox" value="1" <?php echo (URL::get('is_active')?'checked':'');?> />
                        <label for="active">[[.active.]]</label>
                        <input  name="block" id="block" type="checkbox" value="1" <?php echo (URL::get('is_block')?'checked':'');?>/>
                        <label for="block">[[.block.]]</label>
                    </td>
                </tr>
            </table>
			</td><td>
				<h3>Thông tin cá nhân</h3>
				<table cellpadding="10" cellspacing="0" border="1" width="100%" bordercolor="#e7e7e7">
					<tr>
						<td width="1%" align="right" nowrap>Họ</td>
						<td><input name="HoDem" type="text" id="HoDem" class="input-medium" />Tên: <input name="Ten" type="text" id="Ten" class="input-medium" /></td>
					</tr>
					<tr>
						<td width="1%" align="right" nowrap>Ngày sinh</td>
						<td><input name="NgaySinh" type="text" id="NgaySinh" class="input-large" /></td>
					</tr>
					<tr>
						<td width="1%" align="right" nowrap>Giới tính</td>
						<td><select name="GioiTinh" id="GioiTinh"></select></td>
					</tr>
					<tr>
						<td width="1%" align="right" nowrap>Quê Quán</td>
						<td><input name="QueQuan" type="text" id="QueQuan" class="input-large" /></td>
					</tr>
					<tr>
						<td width="1%" align="right" nowrap>CMTND</td>
						<td><input name="Cmt" type="text" id="Cmt" class="input-large" /></td>
					</tr>
				</table>
			</td></tr></table>
            <input type="hidden" value="1" name="confirm_edit" >
            <input type="hidden" name="privilege_deleted_ids" value=""/>
            <input type="hidden" name="group_deleted_ids" value=""/>
            <.if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}.>
        </form>
	</div>
</div>
<script type="text/javascript">
function create_account(block_id){
	var email = document.getElementById('email');
	var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	<!--IF:cond(Url::get('cmd')=='edit')-->
	var check_account = check_ajax(block_id,{'cmd':'edit','id':'{{Url::nget("id")}}','action':'check_account','account':$('id').value});
	<!--ELSE-->
	var check_account = check_ajax(block_id,{'cmd':'add','action':'check_account','account':$('id').value});
	<!--/IF:cond-->
	if(jQuery('#account').val()==''){
		alert('Hãy nhập tên tài khoản.'); jQuery('#account').focus();
	}else if(check_account=='true'){
		alert('Tài khoản này đã được đăng ký. Vui lòng chọn tài khoản khác.'); jQuery('#account').focus();
	<!--IF:cond(Url::get('cmd')!='edit')-->
	}else if(jQuery('#password').val()==''){
		alert('Hãy nhập mật khẩu'); jQuery('#password').focus();
	}else if((jQuery('#password').val()).length<6){
		alert('Hãy nhập mật khẩu lớn hơn 6 ký tự.'); jQuery('#password').focus();
	<!--/IF:cond-->
	}else if(jQuery('#email').val()!='' && !filter.test(email.value)){
		alert('Hãy nhập chính xác định dạng Email.'); jQuery('#email').focus();
	}else{
		document.EditManageCustomerForm.submit();
	}
}
</script>
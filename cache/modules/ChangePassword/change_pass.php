<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Đổi mật khẩu</div>
        <div class="fr">
        <?php if((User::is_login())){?><button id="save" class="red-button">Ghi lại</button><?php } ?>
        </div>
    </div>
	<div class="form-content">
        <form method="post" name="ChangePassword" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>" id="ChangePassword">
        	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
            <table cellpadding="10" cellspacing="0" width="100%" border="1" bordercolor="#E7E7E7" align="center">
                <tr class="change_pass_text">
                    <td align="right" width="1%" nowrap="nowrap">Mật khẩu cũ</td>
                    <td align=left><input  name="old_password" id="old_password" autofocus / type ="password" value="<?php echo String::html_normalize(URL::get('old_password'));?>"></td>
                </tr>
                <tr class="change_pass_text">
                    <td align="right" nowrap>Mật khẩu mới</td>
                    <td align=left><input  name="new_password" id="new_password" / type ="password" value="<?php echo String::html_normalize(URL::get('new_password'));?>"></td>
                </tr>
                <tr class="change_pass_text">
                    <td align="right" nowrap>Nhập lại mật khẩu mới</td>
                    <td align=left><input  name="retype_new_password" id="retype_new_password" / type ="password" value="<?php echo String::html_normalize(URL::get('retype_new_password'));?>"></td>
                </tr>
            </table> 
            <?php if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}?>
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >	
	</div>
</div>

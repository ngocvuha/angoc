<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">Đổi mật khẩu</div>
        <div class="fr">
        <!--IF:can(User::is_login())--><button id="save" class="red-button">Ghi lại</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
        <form method="post" name="ChangePassword" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>" id="ChangePassword">
        	<.if(Form::$current->is_error()){echo Form::$current->error_messages();}.>
            <table cellpadding="10" cellspacing="0" width="100%" border="1" bordercolor="#E7E7E7" align="center">
                <tr class="change_pass_text">
                    <td align="right" width="1%" nowrap="nowrap">Mật khẩu cũ</td>
                    <td align=left><input name="old_password" type="password" id="old_password" autofocus /></td>
                </tr>
                <tr class="change_pass_text">
                    <td align="right" nowrap>Mật khẩu mới</td>
                    <td align=left><input name="new_password" type="password" id="new_password" /></td>
                </tr>
                <tr class="change_pass_text">
                    <td align="right" nowrap>Nhập lại mật khẩu mới</td>
                    <td align=left><input name="retype_new_password" type="password" id="retype_new_password" /></td>
                </tr>
            </table> 
            <.if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}.>
        </form>	
	</div>
</div>

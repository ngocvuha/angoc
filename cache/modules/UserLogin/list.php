<div class="userlogin-bound" style="width:400px; margin:auto; margin-top:10%; border:1px solid #CCC;">
	<h3 align="center">Đăng nhập</h3>
	<form name="SignInForm" method="POST" id="SignInForm">
        <?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
                <td align="right"><label for="user_id">Tên đăng nhập: </label></td>
                <td><input  name="user_id" id="user_id" class="userlogin-info" value="<?php echo Cookie::get('nova_user_id')?Cookie::get('nova_user_id'):'';?>" autofocus / type ="text" value="<?php echo String::html_normalize(URL::get('user_id'));?>"></td>
            </tr>
            <tr>
            	<td align="right"><label for="password">Mật khẩu: </label></td>
            	<td><input type="password" id="password" name="password" value="<?php echo Cookie::get('nova_password')?Cookie::get('nova_password'):'';?>" class="userlogin-info" /></td>
            </tr>
            <tr>
            	<td></td>
                <td><button type="submit">Đăng nhập</button><input type="hidden" name="block_id" id="block_id" value="<?php echo Module::block_id();?>" /></td>
            </tr>
        </table>
        <?php if(Form::$current->is_error()){echo '<script type="text/javascript">notify_errors(error_name);</script>';}?>
    <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
</div>
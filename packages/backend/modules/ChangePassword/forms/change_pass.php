<?php
class ChangePasswordForm extends Form
{
	function ChangePasswordForm()
	{
		Form::Form('ChangePasswordForm');
		$this->add('old_password',new PasswordType(true,'invalid_old_password'));
		$this->add('new_password',new PasswordType(true,'invalid_new_password'));
		$this->add('retype_new_password',new PasswordType(true,'invalid_retype_password'));
	}
	function on_submit()
	{
		if($this->check())
		{
			$row = DB::select('account',Session::get('user_id'));
			if (User::encode_password($_REQUEST['old_password'])==($row['password']))
			{
				$password = $_REQUEST['new_password'];
				$retypepassword = $_REQUEST['retype_new_password'];
				if ($password!=$retypepassword)
				{
					$this->error('retype_new_password','retype_password');
					return false;
				}
				else
				{
					DB::update('account',array('password'=>User::encode_password($password)),"id='".User::id()."'");
					echo "<script>alert('Thay đổi mật khẩu thành công');window.location.href='change_password.html'</script>";
				}
			}
			else
			{
				$this->error('old_password','invalid_old_password');
				return false;
			}
		}
	}	
	function draw()
	{
		$this->parse_layout('change_pass');
	}
}
?>
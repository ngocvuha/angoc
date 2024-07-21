<?php
class ChangePassword extends Module
{
	function ChangePassword($row)
	{
		Module::Module($row);
		if(User::is_login()){
			require_once 'forms/change_pass.php';
			$this->add_form(new ChangePasswordForm);
		}
	}
}
?>
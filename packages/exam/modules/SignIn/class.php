<?php
class SignIn extends Module
{
	function SignIn($row)
	{
		Module::Module($row);		
		require_once 'db.php';
		if(!User::is_login()){
			require_once 'forms/sign_in.php';
			$this->add_form(new SignInForm);
		}else{
			Url::redirect('ca-nhan');			
		}
	}
}
?>
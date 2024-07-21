<?php
class UserLogin extends Module
{
	function UserLogin($row)
	{
		Module::Module($row);		
		require_once 'db.php';
		if(!User::is_login() or !$user=DB::select('account','id=\''.User::id().'\' and type=\'USER\'')){
			if(Url::get('cmd')=='check_user'){
				$this->check_user(); exit();
			}
			require_once 'forms/list.php';
			$this->add_form(new UserLoginForm);
		}else{
			Url::redirect('dashboard');
		}
	}
	function check_user(){
		if($user_id=Url::get('user_id') and $password=Url::get('password')){
			if($row=DB::select('account','account.id="'.$user_id.'" and account.password="'.User::encode_password($password).'" and (type="" or type="USER") and account.is_active and !account.is_block')){
				echo 1; exit();
			}elseif(!DB::select('account','account.id="'.$user_id.'" and (type="" or type="USER")')){
				echo 2; exit();
			}elseif(!DB::select('account','account.id="'.$user_id.'" and account.password="'.User::encode_password($password).'" and (type="" or type="USER")')){
				echo 3; exit();
			}elseif(DB::select('account','account.id="'.$user_id.'" and account.password="'.User::encode_password($password).'" and (type="" or type="USER") and account.is_active and account.is_block')){
				echo 4; exit();
			}elseif(!DB::select('account','account.id="'.$user_id.'" and account.password="'.User::encode_password($password).'" and (type="" or type="USER") and account.is_active')){
				echo 5; exit();
			}
		}
	}
}
?>
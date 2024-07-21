<?php
class UserLoginForm extends Form
{
	function UserLoginForm()
	{
		Form::Form('UserLoginForm');
		$this->add('user_id',new UsernameType(true,'invalid_user_id'));
		$this->add('password',new PasswordType(true,'invalid_password'));
		$this->link_css(Portal::template('frontend').'css/sign_in.css');
		$this->link_js('packages/user/includes/js/signin.js');
	}
	function on_submit(){
		if($this->check()){
			$user_id = Url::nget('user_id');
			$password = Url::nget('password');
			if($row = User::login($user_id,$password) and !$row['tblLopNienChe_id']){				
				Session::set('personal',$row);				
				Url::redirect('dashboard');
			}else{
				$this->error('user_id','Tài khoản hoặc mật khẩu không đúng');
				return false;
			}
		}
	}
	function draw()
	{
		$this->parse_layout('list');
	}
}
?>
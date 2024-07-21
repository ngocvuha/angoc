<?php
class SignInForm extends Form
{
	function SignInForm()
	{
		Form::Form('SignInForm');
		//$this->add('user_id',new UsernameType(true,'invalid_user_id'));
		$this->add('password',new PasswordType(true,'invalid_password'));
		$this->link_css('templates/web/css/login.css');
	}
	function on_submit(){
		if($this->check()){
			$user_id = Url::nget('user_id');
			$password = Url::nget('password');
			if($row = User::login($user_id,$password) and $row['tblLopNienChe_id']){
				if($row['tblLopNienChe_id']){
					$lop = DB::fetch('select id,name from tblLopNienChe where id = '.$row['tblLopNienChe_id'],'name');
					$row['LopNienChe'] = $lop;
				}
				Session::set('personal',$row);				
				Url::redirect('ca-nhan');
			}elseif($row = $this->ChamThiLogin($user_id,$password)){
				Session::set('ChamThi',$row);
				Session::set('PhongThi',$row['IDPhongThi']);
				Url::redirect('cham-thi');
			}else{
				$this->error('user_id','Tài khoản hoặc mật khẩu không đúng');
				return false;
			}
		}
	}
	function ChamThiLogin($u,$p){
		return DB::fetch("select * from tblChamThi where IDUser = '".$u."' and Password='".User::encode_password($p)."' and tblChamThi.Locked=0");
	}
	function check_user($user_id,$password)
	{	
		return DB::fetch("
			select 
				id,email,HoDem,Ten,last_online_time,type,Cmt,tblLopNienChe_id,MaSV,QueQuan,NgaySinh,
				CASE WHEN GioiTinh=1 THEN 'Nữ' ELSE 'Nam' END AS GioiTinh,avatar
			from 
				account
			where 
				account.id='".$user_id."'
				and password='".$password."'
				and account.is_active=1
				and account.is_block=0
		");
	}
	function draw()
	{
		$this->parse_layout('sign_in');
	}
}
?>
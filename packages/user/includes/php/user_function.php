<?php
class UserFunction
{
	/* Kiểm tra tài khoản có tồn tại trong hệ thống hay không
	*/
	function account_exists($cond)
	{
		if(DB::fetch('select id from account where '.$cond)){
			echo 'true';
		}else{
			echo 'false';
		}
	}
	/* Kiểm tra email của tài khoản có tồn tại trong hệ thống hay không
	*/
	function email_exists()
	{
		if($email=Url::nget('email') and DB::fetch('select account.id from account inner join party on account.id=party.user_id where party.email=\''.$email.'\'')){
			echo 'true';
		}else{
			echo 'false';
		}
	}
	/* Xóa tài khoản
	*/
	function delete_account($id){
		if(DB::exists_id('account',$id)){
			// Xóa tài khoản
			DB::delete_id('account',$id);
			// Xóa quyền
			DB::delete('account_privilege','account_id=\''.$id.'\'');
		}
	}
	/* Xóa quyền của tài khoản
	*/
	function delete_account_privilege($account){
		if(DB::exists('SELECT id,account_id FROM account_privilege WHERE account_id=\''.$account.'\''))
		{
			DB::delete('account_privilege','account_id=\''.$account.'\'');
			DB::update('account',array('cache_privilege'=>''),' id =\''.$account.'\'');
		}	
	}
	/* Xóa quyền
	*/
	function delete_privilege($id){
		if(DB::exists_id('privilege',$id)){
			DB::delete('account_privilege', 'privilege_id=\''.$id.'\''); 
			DB::delete_id('privilege',$id);
			DB::delete('privilege_module','privilege_id='.$id);
			if(file_exists('cache/menu/m_'.$id.'.cache.php')){
				@unlink('cache/menu/m_'.$id.'.cache.php');
			}
		}
	}
}
?>
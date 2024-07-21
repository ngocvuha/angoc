<?php 
class UserAdmin extends Module
{
	function UserAdmin($row)
	{
		Module::Module($row);
		if(User::can_admin())
		{
			require_once 'db.php';
			require_once 'packages/user/includes/php/user_function.php';
			switch(URL::get('cmd'))
			{
				case 'edit':
					if((Url::nget('account_id')=='admin' and !User::is_admin()) or !Url::get('account_id') or !$account=DB::exists_id('account',Url::nget('account_id'))){
						Url::redirect_current();
					}
					if(Url::get('action')=='check_account'){
						$cond='id=\''.Url::nget('account_id').'\' and id!=\''.$account['id'].'\'';
						UserFunction::account_exists($cond);
						exit();
					}
					require_once 'forms/edit.php';
					$this->add_form(new EditUserAdminForm());
					break;
				case 'add':
					if(Url::nget('id')=='admin' and !User::is_admin()){
						Url::redirect_current();
					}
					if(Url::get('action')=='check_account'){
						$cond='id=\''.Url::nget('account_id').'\'';
						UserFunction::account_exists($cond);
						exit();
					}
					require_once 'forms/edit.php';
					$this->add_form(new EditUserAdminForm());
					break;
				case 'delete':
					if($items=Url::get('selected_ids') and is_array($items) and sizeof($items)>0 and User::can_delete())
					{
						foreach($items as $item){
							UserFunction::delete_account($item);
						}
						require_once 'packages/core/includes/system/update_privilege.php';
						make_privilege_cache();
					}
					Url::redirect_current();
				default: 
					require_once 'forms/list.php';
					$this->add_form(new ListUserAdminForm());
			}		
		}
		else
		{
			URL::access_denied();
		}
	}
}
?>

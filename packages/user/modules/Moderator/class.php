<?php 
class MODERATOR extends Module
{
	function MODERATOR($row)
	{
		Module::Module($row);
		if(User::can_admin())
		{	
			require_once 'db.php';
			require_once 'packages/user/includes/php/user_function.php';
			switch(Url::get('cmd'))
			{
				case 'delete':
					$this->delete_cmd();
					break;
				case 'grant':
					if(Url::get('action')=='check_account'){
						$cond='id="'.Url::nget('account').'"';
						UserFunction::account_exists($cond);
						exit();
					}
					require_once 'forms/select_portal.php';
					$this->add_form(new GrantModeratorForm());
					break;
				default:
					require_once 'forms/list.php';
					$this->add_form(new ListModeratorForm());
					break;
			}			
		}
		else
		{
			URL::access_denied();
		}
	}	
	function delete_cmd()
	{
		if(URL::get('selected_ids'))
		{
			foreach(URL::get('selected_ids') as $id)
			{
				UserFunction::delete_account_privilege($id);
			}
		}
		Url::redirect_current();
	}
}
?>
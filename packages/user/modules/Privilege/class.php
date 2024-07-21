<?php 
class Privilege extends Module
{
	function Privilege($row)
	{
		Module::Module($row);
		if(User::can_admin())
		{
			require_once 'db.php';
			require_once 'packages/user/includes/php/user_function.php';
			switch(URL::get('cmd'))
			{
				case 'delete':
					if($items=Url::get('selected_ids') and is_array($items) and sizeof($items)>0 and User::can_delete())
					{
						foreach($items as $item){
							UserFunction::delete_privilege($item);
						}
						require_once 'packages/core/includes/system/update_privilege.php';
						make_privilege_cache();
					}
					Url::redirect_current();
				case 'edit':
				case 'add':
				case 'grant':
					require_once 'forms/grant.php';
					$this->add_form(new GrantPrivilegeForm());
					break;
				default: 
					require_once 'forms/list.php';
					$this->add_form(new ListPrivilegeForm());
			}
		}
		else
		{
			URL::access_denied();
		}
	}
}
?>

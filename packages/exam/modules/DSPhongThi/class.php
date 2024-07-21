<?php
class DSPhongThi extends Module
{
	function DSPhongThi($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(Url::get('cmd'))
			{
				case 'view':
					$this->view_cmd();
					break;	
				default:
					$this->list_cmd();
					break;
			}
		}else{
			Url::access_denied();
		}
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListDSPhongThiForm());
	}
	function view_cmd()
	{
		require_once 'forms/edit.php';
		$this->add_form(new EditDSPhongThiForm());
	}
}
?>

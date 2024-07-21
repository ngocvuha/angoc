<?php
class BangDiem extends Module
{
	function BangDiem($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(Url::get('cmd'))
			{
				case 'view':
					$this->view();
					break;
				default:
					$this->list_cmd();
					break;
			}
		}else{
			Url::access_denied();
		}
	}
	function view(){
		require_once 'forms/edit.php';
		$this->add_form(new EditBangDiemForm());
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListBangDiemForm());
	}
}
?>

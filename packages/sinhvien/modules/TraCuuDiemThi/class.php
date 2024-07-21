<?php 
class TraCuuDiemThi extends Module
{
	function TraCuuDiemThi($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::is_login())
		{
			require_once 'forms/list.php';
			$this->add_form(new ListTraCuuDiemThiForm());
		}else{
			URL::access_denied();
		}
	}
}
?>
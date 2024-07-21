<?php
class DieuHanhThi extends Module
{
	function DieuHanhThi($row)
	{
		Module::Module($row);		
		if(User::can_admin()){
			require_once 'db.php';
			require_once 'forms/list.php';
			$this->add_form(new DieuHanhThiForm);	
		}else{
			System::access_denied();
		}
	}
}
?>
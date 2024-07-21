<?php
/******************************
WRITTEN BY minhtc
******************************/
class Personal extends Module
{
	function Personal($row)
	{
		Module::Module($row);
		if(!User::is_login()){
			//Url::redirect('dang-nhap');
		}else{
			require_once 'db.php';
			require_once 'forms/list.php';
			$this->add_form(new PersonalForm);	
		}
	}
}
?>

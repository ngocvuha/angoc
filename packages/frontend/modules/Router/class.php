<?php 
class Router extends Module
{
	function Router($row)
	{
		Module::Module($row);
		if(User::is_login()){
			require_once 'db.php';
			require_once 'forms/list.php';	
		}else{
			Url::redirect('dang-nhap');
		}
		$this->add_form(new RouterForm($row));
	}
}
?>
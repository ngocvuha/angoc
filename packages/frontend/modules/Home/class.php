<?php 
class Home extends Module
{
	function Home($row)
	{
		Module::Module($row);
		if($this->check_login()){
			
		}else{
			require_once 'db.php';
			require_once 'forms/list.php';
			$this->add_form(new HomeForm($row));
		}
	}
	function check_login(){
		return false;
	}
}
?>
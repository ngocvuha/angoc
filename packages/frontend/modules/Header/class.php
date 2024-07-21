<?php 
class Header extends Module
{
	function Header($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new HeaderForm($row));
	}
}
?>
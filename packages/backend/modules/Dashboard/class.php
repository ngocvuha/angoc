<?php
class Dashboard extends Module
{
	function Dashboard($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new DashboardForm());
	}
}
?>

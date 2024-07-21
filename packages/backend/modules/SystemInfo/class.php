<?php 
class SystemInfo extends Module
{
	function SystemInfo($row)
	{
		if(User::can_admin(MODULE_SYSTEMINFO,ANY_CATEGORY))
		{
			Module::Module($row);
			require_once 'forms/list.php';
			$this->add_form(new SystemInfoForm());		
		}
		else
		{
			Url::access_denied();
		}	
	}
}
?>
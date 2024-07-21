<?php
class SystemCleaner extends Module
{
	function SystemCleaner($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY))
		{
			require_once 'forms/list.php';
			$this->add_form(new SystemCleanerForm());
		}else{
			Url::access_denied();
		}
	}
}
?>
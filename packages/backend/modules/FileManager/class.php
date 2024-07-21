<?php 
// 	Written by 	: Minh Duc
// 	Date		: 26/07/2009
//	Fucntion	: File Manager System
//	Plugin		: tinyMCE editor
class FileManager extends Module
{
	function FileManager($row)
	{
		if(User::can_admin(MODULE_FILEMANAGER,ANY_CATEGORY))
		{
			Module::Module($row);
			require_once 'db.php';
			require_once 'forms/view.php';
			$this->add_form(new FileManagerForm());
		}
		else
		{
			Url::access_denied();
		}	
	}
}
?>
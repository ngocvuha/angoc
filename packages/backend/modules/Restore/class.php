<?php
class Restore extends Module
{
	function Restore($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_admin(false,ANY_CATEGORY))
		{
			if(Url::get('cmd')=='delete' and $id=Url::get('id') and file_exists($id)){
				@unlink($id);
				Url::redirect_current();
			}
			require_once 'forms/restore.php';
			$this->add_form(new RestoreForm());		
		}
		else
		{
			Url::access_denied();
		}	
	}
}
?>

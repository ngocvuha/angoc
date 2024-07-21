<?php
class ManageHelper extends Module
{
	function ManageHelper($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view())
		{
			switch(Url::get('cmd'))
			{
				case 'add':
				case 'edit':
					$this->edit_cmd();
					break;	
				case 'delete':
					$this->delete_cmd();
					break;	
				default:
					$this->list_cmd();
					break;
			}
		}
		else
		{
			Url::access_denied();
		}
	}
	function delete_cmd(){
		if($items=Url::get('selected_ids') and is_array($items) and sizeof($items)>0 and User::can_delete())
		{
			if($ids=implode(',',$items)){
				DB::delete('helper','id IN ('.$ids.')');
			}
		}
		Url::redirect_current();
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListManageHelperForm());
	}
	function edit_cmd()
	{
		if(User::can_edit(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditManageHelperForm());
		}	
		else
		{
			Url::access_denied();
		}
	}
}
?>

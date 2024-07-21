<?php 
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY VUONGIGALONG
******************************/
class MODULESETTING extends Module
{
	function MODULESETTING($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view())
		{
			switch(URL::get('cmd'))
			{
			case 'delete':
				if(is_array(URL::get('selected_ids')) and sizeof(URL::get('selected_ids'))>0 and User::can_delete())
				{
					foreach(URL::get('selected_ids') as $id)
					{
						$this->delete_module_setting($id);
					}
					Url::redirect_current(array('module_id'));
				}
				break;
			case 'edit':
				if(User::can_edit() and Url::check('id'))
				{
					require_once 'forms/edit.php';
					$this->add_form(new EditModuleSettingForm());
				}
				else
				{
					Url::redirect_current();
				}
				break;
			case 'add':
				if(User::can_add())
				{
					require_once 'forms/edit.php';
					$this->add_form(new EditModuleSettingForm());
				}
				else
				{
					Url::redirect_current();
				}
				break;
			default: 
				require_once 'forms/list.php';
				$this->add_form(new ListModuleSettingForm());
				break;
			}
		}
		else
		{
			URL::access_denied();
		}
	}
	function delete_module_setting($id)
	{
		if($row = DB::select('module_setting',$id)){
			DB::delete_id('module_setting', $id);
			DB::delete('block_setting', 'setting_id="'.$id.'"');
		}
	}
}
?>
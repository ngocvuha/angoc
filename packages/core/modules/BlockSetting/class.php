<?php 
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY VUONGIGALONG
******************************/
class BlockSetting extends Module
{
	function BlockSetting($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view())
		{
			switch(URL::get('cmd'))
			{
			case 'copy_setting':
				if($block=DB::select('block',URL::sget('block_id')))
				{
					if($settings = BlockSettingDB::select_all_block_setting(URL::sget('copy_setting_id')))
					{
						foreach($settings as $setting)
						{
							if($old_setting = BlockSettingDB::select_block_setting(URL::get('block_id'),$setting['id']))
							{
								BlockSettingDB::update_block_setting($setting['value'],URL::get('block_id'),$setting['id']);
							}
							else
							{
								BlockSettingDB::insert_block_setting($setting['value'],URL::get('block_id'),$setting['id']);								
							}
						}
					}
					require_once 'packages/core/includes/portal/update_page.php';
					update_page($block['page_id']);
				}
				URL::redirect_current(array('block_id'));
				break;
			default: 
				require_once 'forms/list.php';
				$this->add_form(new ListBlockSettingForm());
				break;
			}
		}
		else
		{
			URL::access_denied();
		}
	}
}
?>
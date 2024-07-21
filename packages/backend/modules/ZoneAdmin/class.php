<?php 
class ZoneAdmin extends Module
{
	function ZoneAdmin($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(!Url::iget('parent_id')) Url::redirect_current(array('parent_id'=>23));
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(URL::get('cmd'))
			{
				case 'duplicate':
					$this->duplicate();	exit();
				case 'delete':				
					$this->delete_cmd();
					break;
				case 'move_up':
				case 'move_down':
					$this->move_cmd();
					break;
				default: 
					$this->list_cmd();
					break;
			}
		}
		else
		{
			URL::access_denied();
		}
	}
	function duplicate(){
		if($parent_id=Url::iget('parent_id') and $name=Url::nget('name') and $zone=DB::select('zone','name="'.$name.'" and '.IDStructure::direct_child_cond(DB::structure_id('zone',$parent_id))))
		{
			echo 'true'; exit();
		}
		echo 'false'; exit();
	}
	function export_cache()
	{
		$zones = ZoneAdminDB::get_zone(IDStructure::child_cond(ID_ROOT).' and structure_id<>'.ID_ROOT);
		$dir = 'cache/tables/zone.cache.php';
		File::export_file($dir,'items',$zones);
	}
	function delete_cmd()
	{
		if(is_array(URL::get('selected_ids')) and sizeof(URL::get('selected_ids'))>0 and User::can_delete(false,ANY_CATEGORY))
		{
			foreach(URL::get('selected_ids') as $id)
			{
				if($id and $category=DB::exists_id('zone',$id))
				{
					DB::delete_id('zone',$id);
				}	
			}
			ZoneAdmin::export_cache();	
			Url::redirect_current(array('parent_id'));
		}
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListZoneAdminForm());
	}
	function move_cmd()
	{
		if(User::can_edit(false,ANY_CATEGORY)and Url::check('id')and $category=DB::exists_id('zone',$_REQUEST['id']))
		{
			if($category['structure_id']!=ID_ROOT)
			{
				require_once 'packages/core/includes/system/si_database.php';
				si_move_position('zone',' and 1');
				ZoneAdmin::export_cache();
			}
			Url::redirect_current(array('parent_id'));
		}
		else
		{
			Url::redirect_current(array('parent_id'));
		}
	}	
}
?>
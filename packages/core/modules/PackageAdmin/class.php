<?php 
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY VUONGIGALONG
******************************/
class PackageAdmin extends Module
{
	function PackageAdmin($row)
	{
		if(User::can_view())
		{
			if(
				(URL::check(array('cmd'=>'move_up')) or URL::check(array('cmd'=>'move_down'))) 
				and Url::check('id') 
				and User::can_edit()
				and $category=DB::exists_id('package',Url::nget('id')))
			{
				if($category['structure_id']!=ID_ROOT)
				{
					require_once 'packages/core/includes/system/si_database.php';
					si_move_position('package');
				}
				Url::redirect_current();
			}
			else
			if(URL::get('cmd')=='delete' and is_array(URL::get('selected_ids')) and sizeof(URL::get('selected_ids'))>0 and User::can_delete())
			{
				foreach(Url::get('selected_ids') as $id)
				{
					$this->delete($id);
				}
				Url::redirect_current(array('name','title_1'));
			}
			else
			{
				Module::Module($row);
				require_once 'db.php';
				switch(URL::get('cmd'))
				{
					case 'edit':
					case 'add':
						require_once 'forms/edit.php';
						$this->add_form(new EditPackageAdminForm());break;
					default: 
						require_once 'forms/list.php';
						$this->add_form(new ListPackageAdminForm());
						break;
				}
			}
		}
		else
		{
			URL::access_denied();
		}
	}
	function delete($id)
	{
		if($package = DB::select('package',$id)){
			$packages = DB::fetch_all('
				SELECT 
					id 
				FROM
					package
				WHERE
					'.IDStructure::child_cond($package['structure_id']).'
				ORDER BY
					structure_id DESC
			');
			foreach($packages as $package)
			{
				$this->delete_package($package['id']);
			}
		}
	}
	function delete_package($id)
	{
		if($row = DB::select('package',$id)){
			DB::query('
				DELETE FROM
					block_setting
				USING
					block, block_setting, module
				WHERE
					module_id=module.id
					AND block_id=block.id
					AND module.package_id="'.$id.'"'
			);
			DB::query('
				DELETE FROM
					block
				USING
					block, module
				WHERE
					module_id=module.id
					AND module.package_id="'.$id.'"'
			);
			DB::query('
				DELETE FROM
					privilege_module
				USING
					privilege_module, module
				WHERE
					module_id = module.id
					AND module.package_id="'.$id.'"'
			);
			DB::query('
				DELETE FROM
					module
				WHERE
					package_id="'.$id.'"'
			);
			DB::query('
				DELETE FROM
					block_setting
				USING
					block_setting, block, page
				WHERE
					block_id=block.id
					AND page_id = page.id
					AND page.package_id="'.$id.'"'
			);
			DB::query('
				DELETE FROM
					block
				USING
					block, page
				WHERE
					page_id=page.id
					AND page.package_id="'.$id.'"'
			);
			DB::query('
				DELETE FROM
					page
				WHERE
					page.package_id="'.$id.'"'
			);
			
			DB::query('
				DELETE FROM
					privilege_module
				USING
					privilege_module, privilege
				WHERE
					privilege_id = privilege.id
					AND privilege.package_id="'.$id.'"'
			);
			DB::query('
				DELETE FROM
					privilege
				WHERE
					privilege.package_id="'.$id.'"'
			);
			DB::delete('package_word', 'package_id='.$id); 
			DB::delete_id('package', $id);
		}
	}
}
?>
<?php
class EditPackageAdminForm extends Form
{
	function EditPackageAdminForm()
	{
		Form::Form('EditPackageAdminForm');
		if(URL::get('cmd')=='edit')
		{
			$this->add('id',new IDType(true,'object_not_exists','package'));
		}
		$this->add('title_1',new TextType(true,'please_enter_title',0,255)); 
		$this->add('name',new TextType(true,'please_enter_name',0,255)); 
	}
	function on_submit()
	{
		if($this->check())
		{
			$new_row = array('name','title_1');
			if(URL::get('cmd')=='edit' and $id=Url::nget('id') and $row=DB::exists_id('package',$id)){
				DB::update_id('package', $new_row, $id);
				if($row['structure_id']!=ID_ROOT)
				{
					if(Url::check(array('parent_id')))
					{
						$parent = DB::select('package',Url::get('parent_id'));
						if(bccomp($parent['structure_id'],$this->old_value['structure_id']))
						{
							require_once 'packages/core/includes/system/si_database.php';
							if(!si_move('package',$row['structure_id'],$parent['structure_id']))
							{
								$this->error('parent_id','invalid_parent');
							}
						}
						else
						{
							$this->error('parent_id','this_package_is_duplicate_package_parent');
							return false;
						}
					}
				}
			}else{
				require_once 'packages/core/includes/system/si_database.php';
				$id = DB::insert('package', $new_row+array('structure_id'=>si_child('package',structure_id('package',$_REQUEST['parent_id']))));
			}
			Url::redirect_current();
		}
	}	
	function draw()
	{	
		if(URL::get('cmd')=='edit' and $row=DB::select('package',URL::sget('id')))
		{
			foreach($row as $key=>$value)
			{
				if(is_string($value) and !isset($_POST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
			require_once 'packages/core/includes/system/si_database.php';
			$edit_mode=true;
		}else{
			$edit_mode=false;
		}
		DB::query('
			select 
				id,
				structure_id
				,name 
				,title_'.Portal::language().' as title
			from 
			 	package
			order by structure_id
		');
		$parents = DB::fetch_all();
		$this->parse_layout('edit',array(
			'parent_id_list'=>String::get_list($parents),
			'parent_id'=>($edit_mode?si_parent_id('package',$row['structure_id']):1)
		));
	}
}
?>
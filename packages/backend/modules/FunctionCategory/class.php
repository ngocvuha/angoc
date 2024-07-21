<?php 
class FunctionCategory extends Module
{
	function FunctionCategory($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(URL::get('cmd'))
			{			
			case 'delete':				
				$this->delete_cmd();
				break;
			case 'edit':				
				$this->edit_cmd();
				break;
			case 'add':				
				$this->add_cmd();
				break;
			case 'move_up':
			case 'move_down':
				$this->move_cmd();
				break;
			case 'check_droppable':
				$this->check_droppable();
				exit();
			case 'change_parent':
				$this->change_parent();
				break;
			case 'move_position':
				$this->move_position();
				break;
			default: 
				$this->list_cmd();
			}
		}
		else
		{
			URL::access_denied();
		}
	}	
	function export_cache()
	{
		if(User::can_view(false,ANY_CATEGORY))
		{
			$categogies = FunctionCategoryDB::get_categories();
			$path = 'cache/tables/function.cache.php';
			File::export_file($path,'categories',$categogies);
		}
	}
	function move_position(){
		if(User::can_edit() and $move_structure_id=Url::get('move_structure_id') and $move_position=Url::get('move_position') and $structure_id=Url::get('structure_id') and $to_position=Url::get('to_position')){
			require_once 'packages/core/includes/system/si_database.php';
			if(IDStructure::parent($move_structure_id)==IDStructure::parent($structure_id)){
				if($move_position<$to_position){
					$_REQUEST['cmd']='move_down';
					$n=abs($move_position-$to_position);
				}else{
					$_REQUEST['cmd']='move_up';
					$n=abs($move_position-$to_position-1);
				}
				for($i=0;$i<$n;$i++){
					//System::debug($_REQUEST);
					//si_move_position('tinhnang');
				}
			}else{
				
			}
		}
		Url::redirect_current();
	}
	function change_parent(){
		if(User::can_edit() and $move_structure_id=Url::get('move_structure_id') and $droppable_structure_id=Url::get('droppable_structure_id')){
			require_once 'packages/core/includes/system/si_database.php';
			si_move('tinhnang',$move_structure_id, $droppable_structure_id);
		}
		Url::redirect_current();
	}
	function check_droppable(){
		if(User::can_edit() and $move_structure_id=Url::get('move_structure_id') and $droppable_structure_id=Url::get('droppable_structure_id')){
			if(IDStructure::is_child($droppable_structure_id,$move_structure_id) or IDStructure::parent($move_structure_id)==$droppable_structure_id){
				echo 'false'; exit();
			}
		}
		echo 'true';
	}
	function add_cmd()
	{
		if(User::can_add(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditFunctionCategoryForm());
		}
		else
		{
			Url::redirect_current();
		}
	}
	function delete_cmd()
	{
		if($items=Url::get('selected_ids') and is_array($items) and sizeof($items)>0 and User::can_delete())
		{
			if($ids=implode(',',$items)){
				DB::delete('tinhnang','id IN ('.$ids.')');
			}
			FunctionCategory::export_cache();
		}
		Url::redirect_current();
	}
	function edit_cmd()
	{
		if(Url::iget('id') and $category=DB::fetch('select id,structure_id from tinhnang where id='.Url::iget('id')) and User::can_edit(false,$category['structure_id']))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditFunctionCategoryForm());
		}
		else
		{
			Url::redirect_current();
		}
	}
	function list_cmd()
	{
		if(User::can_view(false,ANY_CATEGORY))
		{
			require_once 'forms/list.php';
			$this->add_form(new ListFunctionCategoryForm());
		}	
		else
		{
			Url::access_denied();
		}
	}
	function move_cmd()
	{
		if(User::can_edit(false,ANY_CATEGORY) and Url::check('id') and $category=DB::exists_id('tinhnang',$_REQUEST['id']))
		{
			if($category['structure_id']!=ID_ROOT)
			{
				require_once 'packages/core/includes/system/si_database.php';
				si_move_position('tinhnang');
				FunctionCategory::export_cache();
				Url::redirect_current(array('move_id'=>Url::iget('id')));
			}
		}
		Url::redirect_current();
	}
}
?>
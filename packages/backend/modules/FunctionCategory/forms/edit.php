<?php
class EditFunctionCategoryForm extends Form
{
	function EditFunctionCategoryForm()
	{
		Form::Form('EditFunctionCategoryForm');
		if(URL::get('cmd')=='edit')
		{
			$this->add('id',new IDType(true,'object_not_exists','tinhnang'));
		}
		$this->add('name',new TextType(true,'please_enter_name',0,255));
	}
	function on_submit()
	{
		if($this->check() and URL::get('confirm_edit'))
		{
			if(URL::get('cmd')=='edit')
			{
				$this->old_value = DB::select('tinhnang','id='.Url::iget('id'));
			}
			$this->save_item();
			FunctionCategory::export_cache();
			Url::redirect_current();
		}
	}	
	function draw()
	{
		$this->init_edit_mode();
		require_once 'packages/core/includes/system/si_database.php';
		$parents = DB::select_all('tinhnang',false,'structure_id');
		$this->parse_layout('edit',
			($this->edit_mode?$this->init_value:array())+
			array(
			'status_list'=>Portal::get_status(),
			'parent_id_list'=>String::get_list(FunctionCategoryDB::check_categories($parents)),
			'parent_id'=>($this->edit_mode?si_parent_id('tinhnang',$this->init_value['structure_id']):1),
			'm_id_list'=>array(''=>'')+String::get_list($this->get_module())
			)
		);
	}
	function get_module(){
		return DB::fetch_all('select id,name from module where privilege=1 order by name');
	}
	function save_item()
	{
		$new_row = array(
			'name',
			'url',
			'status',
			'm_id'
		);
		if(URL::get('cmd')=='edit' and $this->id=Url::iget('id'))
		{
			if($this->old_value['status']<>Url::nget('status')){
				DB::query('update tinhnang set status="'.Url::get('status').'" where '.IDStructure::child_cond($this->old_value['structure_id']).' and id<>'.$this->id);
			}
			DB::update_id('tinhnang', $new_row,$this->id);
			if($this->old_value['structure_id']!=ID_ROOT)
			{
				if (Url::check(array('parent_id')))
				{
					$parent = DB::select('tinhnang',$_REQUEST['parent_id']);					
					if($parent['structure_id']==$this->old_value['structure_id'])
					{
						$this->error('id','invalid_parent');
					}
					else
					{
						require_once 'packages/core/includes/system/si_database.php';
						if(!si_move('tinhnang',$this->old_value['structure_id'],$parent['structure_id']))
						{
							$this->error('id','invalid_parent');
						}
					}
				}
			}
		}
		else
		{
			require_once 'packages/core/includes/system/si_database.php';
			if(isset($_REQUEST['parent_id']))
			{	
				$this->id = DB::insert('tinhnang', $new_row+array('structure_id'=>si_child('tinhnang',structure_id('tinhnang',$_REQUEST['parent_id']))));			
			}
			else
			{
				$this->id = DB::insert('tinhnang', $new_row+array('structure_id'=>ID_ROOT));		
			}				
		}
		save_log($this->id);
	}
	function init_edit_mode()
	{
		if(URL::get('cmd')=='edit' and $this->init_value= DB::exists_id('tinhnang',Url::iget('id')))
		{		
			foreach($this->init_value as $key=>$value)
			{
				if(is_string($value) and !isset($_REQUEST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
			$this->edit_mode = true;
		}
		else
		{
			$this->edit_mode = false;
		}
	}
}
?>
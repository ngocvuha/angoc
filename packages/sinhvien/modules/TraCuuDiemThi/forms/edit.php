<?php
class EditQuanLyLopForm extends Form
{
	function EditQuanLyLopForm()
	{
		Form::Form('EditQuanLyLopForm');
		if(URL::get('cmd')=='edit')
		{
			$this->add('id',new IDType(true,'object_not_exists','tblLopNienChe'));
		}
		$this->add('name',new TextType(true,'please_enter_name',0,255));
	}
	function on_submit()
	{
		if($this->check() and URL::get('confirm_edit'))
		{
			if(URL::get('cmd')=='edit')
			{
				$this->old_value = DB::select('tblLopNienChe','id='.Url::iget('id'));
			}
			$this->save_item();
			QuanLyLop::export_cache();
			Url::redirect_current();
		}
	}	
	function draw()
	{
		$this->init_edit_mode();
		require_once 'packages/core/includes/system/si_database.php';
		$parents = DB::select_all('tblLopNienChe',false,'structure_id');
		$this->parse_layout('edit',
			($this->edit_mode?$this->init_value:array())+
			array(
			'status_list'=>Portal::get_status(),
			'parent_id_list'=>String::get_list(QuanLyLopDB::check_categories($parents)),
			'parent_id'=>($this->edit_mode?si_parent_id('tinhnang',$this->init_value['structure_id']):1)
			)
		);
	}
	function save_item()
	{
		$new_row = array(
			'name',
			'status'
		);
		if(URL::get('cmd')=='edit' and $this->id=Url::iget('id'))
		{
			if($this->old_value['status']<>Url::nget('status')){
				DB::query('update tblLopNienChe set status="'.Url::nget('status').'" where '.IDStructure::child_cond($this->old_value['structure_id']).' and id<>'.$this->id);
			}
			DB::update_id('tblLopNienChe', $new_row,$this->id);
			if($this->old_value['structure_id']!=ID_ROOT)
			{
				if (Url::check(array('parent_id')))
				{
					$parent = DB::select('tblLopNienChe',$_REQUEST['parent_id']);					
					if($parent['structure_id']==$this->old_value['structure_id'])
					{
						$this->error('id','invalid_parent');
					}
					else
					{
						require_once 'packages/core/includes/system/si_database.php';
						if(!si_move('tblLopNienChe',$this->old_value['structure_id'],$parent['structure_id']))
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
				$this->id = DB::insert('tblLopNienChe', $new_row+array('structure_id'=>si_child('tblLopNienChe',structure_id('tblLopNienChe',$_REQUEST['parent_id']))));			
			}
			else
			{
				$this->id = DB::insert('tblLopNienChe', $new_row+array('structure_id'=>ID_ROOT));		
			}				
		}
		save_log($this->id);
	}
	function init_edit_mode()
	{
		if(URL::get('cmd')=='edit' and $this->init_value= DB::exists_id('tblLopNienChe',Url::iget('id')))
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
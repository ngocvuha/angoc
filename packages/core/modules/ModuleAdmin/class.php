<?php 
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY VUONGIGALONG
******************************/
class ModuleAdmin extends Module
{
	function ModuleAdmin($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'packages/core/includes/portal/make_configuration.php';
		if(User::can_edit())
		{
			/* Xóa block(là vùng mà module hiển thị) */
			if(Url::check(array('cmd'=>'delete_block')))
			{
				DB::delete('block_setting','block_id=\''.Url::get('block_id').'\'');
				DB::delete('block','id=\''.URL::get('block_id').'\'');
				Url::redirect_current(array('cmd'=>'edit','id'=>Url::nget('module_id')));
			}
			else /* Xóa module */
			if(Url::get('cmd')=='delete' and is_array(Url::get('selected_ids')) and sizeof(Url::get('selected_ids'))>0 and User::can_delete())
			{
				foreach(Url::get('selected_ids') as $id)
				{
					$this->delete_module($id);
				}
				make_module_cache();
				Url::redirect_current(array('page_no','name','title_1','package_id'));
			}
			else /* Xóa ảnh đại diện của module */
			if(Url::get('cmd')=='delete_image'){
				$this->delete_image();
			}
			else
			{
				switch(URL::get('cmd'))
				{
					/* Thêm, Sửa module */
					case 'edit':
					case 'add':
						require_once 'forms/edit.php';
						$this->add_form(new EditModuleAdminForm());break;
					/* Danh sách module */
					default:
						require_once 'forms/list.php';
						$this->add_form(new ListModuleAdminForm());
						break;
				}
			}
		}
		else
		{
			URL::access_denied();
		}
	}
	/* Xóa ảnh đại diện của module */
	function delete_image(){
		if($id=Url::get('id') and $module=DB::select('module','id='.$id)){
			if($module['image_url'] and file_exists($module['image_url'])){
				DB::update_id('module',array('image_url'=>''),$id);
				@unlink($module['image_url']);
			}
			Url::redirect_current(array('cmd'=>'edit','id'));
		}
	}
	/* Xóa module có id là $id */
	function delete_module($id){
		if($row=DB::select('module',$id)){
			DB::query('
				DELETE FROM
					block_setting
				USING
					block, block_setting
				WHERE
					block_id=block.id
					AND module_id=\''.$id.'\'
			');
			DB::delete('privilege_module','module_id=\''.$id.'\'');
			DB::delete('block', 'module_id='.$id); 
			DB::delete_id('module', $id);
		}
	}
}
?>
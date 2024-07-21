<?php
class EditModuleAdminForm extends Form
{
	function EditModuleAdminForm()
	{
		Form::Form('EditModuleAdminForm');
		if(URL::get('cmd')=='edit')
		{
			$this->add('id',new IDType(true,'object_not_exists','module'));
		}
		$this->add('title_1',new TextType(true,'please_enter_title',0,255)); 
		$this->add('name',new TextType(true,'please_enter_name',0,255)); 
	}
	function on_submit()
	{
		if($this->check())
		{
			require_once 'packages/core/includes/portal/package.php';
			require_once 'packages/core/includes/utils/upload_file.php';
			$rows = array(
				'package_id',
				'title_1',
				'name',
				'privilege',
				'fun_extend',
				'path'=>get_package_path(URL::get('package_id')).'modules/'.URL::get('name').'/'
			);
			$dir='data/module';
			$image_url_error = update_upload_file('image_url', $dir);
			if($image_url_error){
				$this->error('image_url',$image_url_error);
				return false;
			}
			if(Url::get('image_url')!=''){
				$rows = array_merge($rows,array('image_url'=>Url::get('image_url')));
			}
			if(URL::get('cmd')=='edit' and $id = Url::nget('id') and $module=DB::exists_id('module',$id))
			{
				if(isset($rows['image_url']) and file_exists($rows['image_url']) and $module['image_url'] and file_exists($module['image_url'])){
					@unlink($module['image_url']);
				}
				DB::update_id('module', $rows, $id);
				require_once 'packages/core/includes/portal/update_page.php';
				$pages = DB::fetch_all('select page_id as id from block where module_id=\''.$id.'\'');
				foreach($pages as $page_id=>$page)
				{
					update_page($page_id);
				}
			}
			else
			{
				$id = DB::insert('module', $rows);
			}
			make_module_cache();
			Url::redirect_current();
		}
	}	
	function draw()
	{
		if(URL::get('cmd')=='edit' and $row=DB::select('module',URL::sget('id')))
		{
			foreach($row as $key=>$value)
			{
				if(is_string($value) and !isset($_POST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
			$edit_mode = true;
		}
		else
		{
			$edit_mode = false;
		}
		DB::query('
			select
				id, package.name as name
			from
				package
		');
		$package_id_list = String::get_list(DB::fetch_all());
		$using_pages=DB::fetch_all('
			SELECT
				block.id, block.region, page.name
			FROM
				page
				INNER JOIN block ON block.page_id = page.id
			WHERE
				module_id=\''.URL::nget('id').'\'
			ORDER BY 
				page.name
		');
		$this->parse_layout('edit',
			($edit_mode?$row:array('type'=>URL::get('type')))+
			array(
			'package_id_list'=>$package_id_list, 
			'using_pages'=>$using_pages
		));
	}
}
?>
<?php
class EditPageAdminForm extends Form
{
	function EditPageAdminForm()
	{
		Form::Form('EditPageAdminForm');
		if(URL::get('cmd')=='edit')
		{
			$this->add('id',new IDType(true,'object_not_exists','page'));
		}
		$this->add('title_1',new TextType(true,'please_enter_title',0,255)); 
		$this->add('name',new TextType(true,'please_enter_name',0,255)); 
	}
	function on_submit()
	{
		if($this->check())
		{
			$new_row =array(
				'title_1','name','package_id','cachable','layout','theme'
			);
			if(Url::get('hide')) $hide=1;
			else $hide=0;
			$new_row += array('hide'=>$hide);
			if(URL::get('cmd')=='edit' and $id = Url::nget('id') and $page=DB::exists_id('page',$id))
			{
				if(DB::select('page','name="'.Url::nget('name').'" and id<>'.$id)){
					$this->error('name','this_name_is_exists');
					return false;
				}
				DB::update_id('page',$new_row,$id);
				require_once 'packages/core/includes/portal/update_page.php';
				update_page($id);
			}
			else
			{
				if(DB::select('page','name="'.Url::nget('name').'"')){
					$this->error('name','this_name_is_exists');
					return false;
				}
				$id = DB::insert('page', $new_row);
			}
			Url::redirect_current(array('page_no','just_edited_id'=>$id));
		}
	}	
	function draw()
	{
		if(URL::get('cmd')=='edit' and $row=DB::select('page',URL::nget('id')))
		{
			foreach($row as $key=>$value)
			{
				if(is_string($value) and !Url::get($key))
				{
					$_REQUEST[$key] = $value;
				}
			}
		}
		DB::query('
			SELECT
				id,name,structure_id
			FROM
				package
			ORDER BY
				structure_id
		');
		$package_id_list = String::get_list(DB::fetch_all());
		
		$this->parse_layout('edit',array(
			'package_id_list'=>$package_id_list, 
			'layout_list'=>$this->get_all_layouts(),
			'theme_list'=>array('web'=>'PC','mobile'=>'Mobile','smartphone'=>'Smartphone')
		));
	}
	function get_all_layouts()
	{
		require_once 'packages/core/includes/portal/package.php';
		global $packages;
		$layouts = array();
		foreach($packages as $package)
		{
			if(is_dir($package['path'].'layouts'))
			{
				$dir = opendir($package['path'].'layouts');
				while($file = readdir($dir))
				{
					if($file != '.' and $file != '..' and is_file($package['path'].'layouts/'.$file))
					{
						$layouts[$package['path'].'layouts/'.$file] = $package['name'].'/'.substr($file, 0, strrpos($file,'.'));
					}
				}
				closedir($dir);
			}
		}
		return $layouts;
	}
}
?>
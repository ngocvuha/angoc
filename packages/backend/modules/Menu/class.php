<?php
class Menu extends Module
{
	static $category=array();
	function Menu($row)
	{
		Module::Module($row);
		if(User::is_login())
		{
			require_once 'db.php';
			require_once 'forms/list.php';
			Menu::$category=$this->get_category();
			$this->add_form(new MenuForm());
		}else{
			Url::access_denied();
		}	
	}
	function get_category(){
		$dir='cache/tables/function.cache.php';
		if(file_exists($dir)){
			require_once $dir;
			if(!isset($categories) or !is_array($categories) or !sizeof($categories)){
				$categories=MenuDB::get_function();
			}
		}else{
			$categories=MenuDB::get_function();
		}		
		$privilege_ids=MenuDB::get_account_privilege();
		$menu = array();
		foreach($privilege_ids as $key=>$value){
			$dir = 'cache/menu/m_'.$key.'.cache.php';
			if(file_exists($dir)){
				require_once $dir;
				$menu+=$items;
			}
		}
		if($categories){
			$page = Url::get('page');
			foreach($categories as $key=>$value){
				if(!$value['url']) $categories[$key]['url']='javascript:void(0)';
				if(!Url::get('active_structure_id') and str_replace('.html','',$value['url'])==$page){
					if(IDStructure::level($value['structure_id'])>1)
					$_REQUEST['active_structure_id']=IDStructure::parent($value['structure_id'],1);
					else
					$_REQUEST['active_structure_id']=$value['structure_id'];
				}
				if(!User::is_admin() and !isset($menu[$key])){
					unset($categories[$key]);
				}
			}
			//$categories=String::array2tree($categories,'childs');
		}
		//System::debug($categories);
		return $categories;
	}
}
?>

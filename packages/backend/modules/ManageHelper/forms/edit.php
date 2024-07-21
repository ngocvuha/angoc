<?php
class EditManageHelperForm extends Form
{
	function EditManageHelperForm()
	{
		Form::Form('EditManageHelperForm');
		$this->link_js('lib/js/tinymce/jscripts/tiny_mce/tiny_mce.js');
		$this->languages = System::get_language();
		$this->default_language=Portal::get_setting('default_language');
		$this->add('name_'.$this->default_language,new TextType(true,'please_enter_name',0,255));
		$this->add('category_id',new TextType(true,'please_choose_category',0,11));
	}
	function save_item()
	{
		$rows = array();
		$languages = $this->languages;
		foreach($languages as $language)
		{
			$rows += array('name_'.$language['id']=>Url::get('name_'.$language['id'],1)); 
			$rows += array('description_'.$language['id']=>Url::get('description_'.$language['id'],1)); 
		}
		require_once 'packages/core/includes/utils/vn_code.php';
		$rows += array(
			'category_id'
		);			
		return ($rows);
	}	
	function on_submit()
	{
		if($this->check())
		{
			$rows = $this->save_item();
			if(!$this->is_error())
			{
				if(Url::get('cmd')=='edit' and $id=Url::iget('id') and $item = DB::exists_id('helper',$id))
				{
					DB::update_id('helper',$rows,$id);
				}
				else
				{
					$id = DB::insert('helper',$rows);
				}
				Url::redirect_current();
			}
		}
	}
	function draw()
	{
		$this->map=array();
		if(Url::get('cmd')=='edit' and $id=Url::iget('id') and $item = DB::exists_id('helper',$id))
		{
			foreach($item as $key=>$value)
			{
				if(is_string($value) and !isset($_REQUEST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
		}
		//System::debug(Menu::$category);
		$this->map['category_id_list'] = array(''=>'Tính năng hệ thống')+String::get_list(Menu::$category);
		$this->map['languages']=$this->languages;
		$this->parse_layout('edit',$this->map);
	}

}

?>


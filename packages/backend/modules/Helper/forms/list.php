<?php
class HelperForm extends Form
{
	function HelperForm()
	{
		Form::Form('HelperForm');
		$this->link_css('templates/admin/css/helper.css');
	}
	function draw()
	{
		$this->map=array();
		$this->map['menu']=String::array2tree(Menu::$category,'childs');
		$this->map['total']=sizeof($this->map['menu']);
		//$this->map['items']=HelperDB::get_item(1);
		//System::debug($this->map['menu']);
		$this->parse_layout('list',$this->map);
	}
}
?>
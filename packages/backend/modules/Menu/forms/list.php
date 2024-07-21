<?php
class MenuForm extends Form
{
	function MenuForm()
	{
		Form::Form('MenuForm');
		$this->link_js('lib/js/jquery/jquery.js');
		$this->link_js('lib/js/jquery/jqueryui.js');		
		$this->link_js('packages/backend/includes/js/quick_menu.js');
		$this->link_js('lib/js/jquery/ui/jquery.ui.tabs.js');
		$this->link_css('templates/admin/css/jquery_base/jquery.ui.core.css');
		$this->link_css('templates/admin/css/jquery_base/jquery.ui.tabs.css');
		$this->link_css('templates/admin/css/jquery_base/jquery.ui.datepicker.css');
		$this->link_css('templates/admin/css/jquery_base/jquery.ui.dialog.css');
		$this->link_css('templates/admin/css/jquery_base/jquery.ui.resizable.css');
		$this->link_css('templates/admin/css/jquery_base/jquery.ui.button.css');
		$this->link_css('templates/admin/css/jquery_base/jquery.ui.theme.css');
		$this->link_css('templates/admin/css/menu.css');
		$this->link_css('templates/admin/css/cms.css');
	}
	function draw()
	{
		$this->parse_layout('list',array('items'=>String::array2tree(Menu::$category,'childs')));
	}
}
?>
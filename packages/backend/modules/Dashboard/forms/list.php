<?php
class DashboardForm extends Form
{
	function DashboardForm()
	{
		Form::Form('DashboardForm');
		$this->link_css('templates/admin/css/dashboard.css');
	}
	function draw()
	{
		$this->parse_layout('list');
	}
}
?>

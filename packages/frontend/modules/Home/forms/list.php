<?php
class HomeForm extends Form
{
	function HomeForm($row)
	{
		Form::Form('HomeForm');
	}
	function draw()
	{
		$this->parse_layout('list');
	}
}
?>
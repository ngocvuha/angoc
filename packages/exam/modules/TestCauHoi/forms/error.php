<?php
class ThiErrorForm extends Form
{
	function ThiErrorForm()
	{
		Form::Form('ThiErrorForm');
	}
	function draw()
	{
		$this->parse_layout('error');
	}
}
?>

<?php
class ThiWaitForm extends Form
{
	function ThiWaitForm()
	{
		Form::Form('ThiWaitForm');
	}
	function draw()
	{
		$this->map=Session::get('thi');
		$this->parse_layout('wait',$this->map);
	}
}
?>

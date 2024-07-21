<?php
class PersonalForm extends Form
{
	function PersonalForm()
	{
		Form::Form('PersonalForm');
	}
	function on_submit(){
	}
	function draw()
	{
		$this->map = Session::get('personal');
		$this->parse_layout('list',$this->map);
	}
}
?>

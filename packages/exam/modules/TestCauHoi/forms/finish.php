<?php
class ThiFinishForm extends Form
{
	function ThiFinishForm()
	{
		Form::Form('ThiFinishForm');
	}
	function draw()
	{
		$this->map = Session::get('thi');
		$this->map = ThiDB::get_bai_thi($this->map['IDTSDuThi']);
		$this->parse_layout('finish',$this->map);
	}
}
?>

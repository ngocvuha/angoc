<?php
class RouterForm extends Form
{
	function HeaderForm($row)
	{
		Form::Form('HeaderForm');
	}
	function draw()
	{
		$this->map = array();
		//check phong thi
		$user_id = Session::get('user_id');
		if($phongthi = RouterDB::checkThi($user_id)){
			$this->map['PhongThi'] = $phongthi;
		}
		$this->parse_layout('list',$this->map);
	}
}
?>
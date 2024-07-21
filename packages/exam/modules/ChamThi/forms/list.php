<?php
class ListChamThiForm extends Form
{
	function ListChamThiForm()
	{
		Form::Form('ListChamThiForm');
	}
	function on_submit(){
		
	}
	function draw()
	{
		$this->map = Session::get('ChamThi');
		if($this->map['items'] = ChamThiDB::get_items()){
			$this->map['total'] = count($this->map['items']);
			foreach($this->map['items'] as $k=>$v){
				$this->map['items'][$k]['NoiDungCauHoi'] = $this->fixImage($this->map['items'][$k]['NoiDungCauHoi']);
			}
			$this->parse_layout('list',$this->map);		
		}
	}
	function fixImage($content){
		return preg_replace('/src="([^"]+)"/','src="'.WEBQUANLY.'/$1"',$content);
	}
}
?>

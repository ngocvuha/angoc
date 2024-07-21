<?php
class ListThiForm extends Form
{
	function ListThiForm()
	{
		Form::Form('ListThiForm');
	}
	function draw()
	{
		$this->map=array();
		$questions = MSDB::fetch_all('select ID,CAST(NoiDungCauHoi as TEXT) as NoiDungCauHoi,IDCachHoi from tblCauHoi');
		if($questions){
			foreach($questions as $k=>$v){
				if($v['IDCachHoi']==1){
					$questions[$k]['answers'] = $this->get_answer($k);
				}
				if($v['IDCachHoi']==3){
					$questions[$k]['NoiDungCauHoi'] = preg_replace('/\[([0-9])\]/','<input style="text-align:center" name="answer['.$k.'][\\1]">',$questions[$k]['NoiDungCauHoi']);
				}
			}
			//System::debug($questions);
			$this->map['items'] = $questions;
			$this->parse_layout('list',$this->map);
		}		
	}
	function get_answer($id)
	{
		return $answer = MSDB::fetch_all('select ID,CAST(NoiDungTraLoi as TEXT) as NoiDungTraLoi from tblTraLoi WHERE IDCauHoi='.$id);
	}
}
?>

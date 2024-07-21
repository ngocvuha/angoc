<?php
class ListEditCauHoi extends Form
{
	function ListEditCauHoi()
	{
		Form::Form('ListEditCauHoi');
		$this->link_css('templates/admin/css/helper.css');
	}
	function draw()
	{
		$this->map=array();
		$this->map['items'] = array();
		if($IDLoaiCauHoi = Url::iget('LoaiCauHoi')){
			$Ma = DB::fetch("select Ma from tblLoaiCauhoi WHERE ID=".$IDLoaiCauHoi,'Ma');
			$LoaiCauHois = DB::fetch_all('SELECT ID as id FROM tblLoaiCauhoi WHERE Ma like \''.$Ma.'%\'');
			$ids = '0';
			foreach($LoaiCauHois as $k=>$v){
				$ids .= ','.$k;
			}
			$questions = DB::fetch_all('select ID,CAST(NoiDungCauHoi as TEXT) as NoiDungCauHoi,IDCachHoi from tblCauHoi WHERE IDLoaiCauHoi in ('.$ids.')');
			if($questions){
				foreach($questions as $k=>$v){
					if($v['IDCachHoi']==3){
						$questions[$k]['answers'] = $this->get_answer($k);
					}
					if($v['IDCachHoi']==3){
						$questions[$k]['NoiDungCauHoi'] = preg_replace('/\[([0-9])\]/','<input style="text-align:center" name="answer['.$k.'][\\1]">',$questions[$k]['NoiDungCauHoi']);
					}
				}
				$this->map['items'] = $questions;
			}
		}
		$sql = '
			SELECT
				tblLoaiCauhoi.ID as LoaiCauHoi,tblLoaiCauhoi.Ma as ID,CAST(tblLoaiCauhoi.Ten AS TEXT) as name
			FROM
				tblLoaiCauhoi
			ORDER BY Ma
		';
		$lch = DB::fetch_all($sql);
		$menu = array();		
		foreach($lch as $k=>$v){
			if(strlen($k)==3){
				$menu[$k]=$v;
			}else{
				$level = explode('.',$k);
				$c = count($level);
				$str = '$menu';
				$key = '';$f=true;
				for($i=0;$i<$c-1;$i++){
					if($f){
						$f=false;
						$key .= $level[$i];
					}else{
						$key .= '.'.$level[$i];
					}
					$str .= '["'.$key.'"]["childs"]';
				}
				$str .= '[$k]=$v;';
				eval($str);
			}
		}
		$this->map['menu'] = $menu;
		$this->parse_layout('list',$this->map);
	}
	function get_answer($id)
	{
		return $answer = DB::fetch_all('select ID,CAST(NoiDungTraLoi as TEXT) as NoiDungTraLoi from tblTraLoi WHERE IDCauHoi='.$id);
	}
}
?>

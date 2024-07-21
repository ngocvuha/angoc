<?php
class ThiTestForm extends Form
{
	function ThiTestForm()
	{
		Form::Form('ThiTestForm');		
	}
	function on_submit(){
		
	}	
	function is_matching($arr1,$arr2){
		foreach($arr2 as $k=>$v){
			if(!isset($arr1[$v-1]) or ($arr1[$v-1]!=$k+1)) return false;
		}
		return true;
	}
	function draw()
	{
		//if(!User::is_admin()){ echo 'Thông cảm! Đang sửa chữa'; return;}
		$this->map=array();
		$questions = $this->get_cau_hoi();
		require_once 'packages/core/includes/utils/vn_code.php';
		if($questions){
			$temp_matching = array();
			$index = 0;
			foreach($questions as $k=>$v){
				$index++;
				
				//Cau hoi cha-con
				if($v['IDCauHoiCha']==-1){					
					$questions[$k]['childs'] = $this->getChildQ($k);
					foreach($questions[$k]['childs'] as $chaID=>$cha){
						$questions[$k]['childs'][$chaID]['NoiDungCauHoi'] = $this->fixImage($cha['NoiDungCauHoi']);
						$questions[$k]['childs'][$chaID]['answers'] = $this->get_answer($chaID,false);
						foreach($questions[$k]['childs'][$chaID]['answers'] as $_k=>$_v){
							$questions[$k]['childs'][$chaID]['answers'][$_k]['NoiDungTraLoi'] = $this->fixImage($_v['NoiDungTraLoi']);
						}
					}
				}
					
				$questions[$k]['NoiDungCauHoi'] = encodeToUtf8($questions[$k]['NoiDungCauHoi'],'utf-8');
				$questions[$k]['NoiDungCauHoi'] = $this->fixImage($questions[$k]['NoiDungCauHoi']);
				$questions[$k]['NoiDungCauHoi'] = $this->fixVideo($questions[$k]['NoiDungCauHoi'],$index);
				if($v['IDCachHoi']==MULTICHOICE){
					$questions[$k]['answers'] = $this->get_answer($k,$v['DaoPhuongAn']);
					foreach($questions[$k]['answers'] as $_k=>$_v){
						$questions[$k]['answers'][$_k]['NoiDungTraLoi'] = $this->fixImage($_v['NoiDungTraLoi']);
					}
				}
				if($v['IDCachHoi']==SHORTANSWER){
					
				}
				if($v['IDCachHoi']==MATCHING){
					$answer = $this->get_answer_matching($k);
					if($answer){
						$answer = $this->fixImage($answer['NoiDungTraLoi']);
						$answers = explode('|',$answer);						
						if($answers){
							$left = $right = array();
							$i=0;
							$select = '<select type="matching" q="'.$k.'"><option value="0">-- Chọn đáp án --</option>';
							$Rindex=array(1=>'a',2=>'b',3=>'c',4=>'d',5=>'e',6=>'f');
							foreach($answers as $_k=>$_v){
								if($_v!=''){
									if($_k%2){
										$right[$i]['v'] = $_v;
										$right[$i++]['i'] = $i;
										$select .= '<option value="'.$i.'">'.$Rindex[$i].'</option>';
									}else{
										$left[] = $_v;
									}
								}
							}
							$select .= '</select>';
							shuffle($right);
							foreach($right as $_k=>$_v){
								$temp_matching[$k][$_k] = $_v['i'];
								$right[$_k] = $_v['v'];
							}
							$questions[$k]['matching'] = array();
							foreach($left as $_k=>$_v){
								$questions[$k]['matching'][$_k+1] = array('index'=>$_k+1,'left'=>$_v,'right'=>$right[$_k],'select'=>$select);
							}
						}
					}
				}
				if($v['IDCachHoi']==FILLBLANK){
					$questions[$k]['NoiDungCauHoi'] = preg_replace('/_/','<input class="expandable" onchange="is_answer('.$k.')" placeholder="____________" name="answer['.$k.'][\\1]">',$questions[$k]['NoiDungCauHoi']);
				}
			}
			Session::set('matching',$temp_matching);
			$this->map['items'] = $questions;
			$this->parse_layout('thi',$this->map);
		}
	}
	function fixImage($content){
		return preg_replace('/src="([^"]+)"/','src="'.WEBQUANLY.'/$1"',$content);
	}
	function fixVideo($content,$index){
		$content = str_replace('~/','',$content);
		$content = preg_replace('/\[Audio\]([^\[]+)\[\/Audio\]/','<audio id="audio-'.$index.'" src="'.WEBQUANLY.'/$1"></audio><button type="button" btn="audio" target="'.$index.'">Play</button>',$content);
		$content = preg_replace('/\[Video\]([^\[]+)\[\/Video\]/','<video id="video-'.$index.'" src="'.WEBQUANLY.'/$1"></video>',$content);
		return $content;
	}
	function _fixImage($content){
		return strtr($content,array(WEBQUANLY.'/'=>''));
	}
	function get_bai_thi($IDTSDuThi){
		$sql = "SELECT ID,CAST(XauCauHoi AS TEXT) as XauCauHoi from tblDSDuThi where ID = '".$IDTSDuThi."'";
		return DB::fetch($sql);
	}
	function getChildQ($id){
		$sql = "SELECT
					tblCauHoi.ID,tblCauHoi.IDCauHoiCha,tblCauHoi.Ten,CAST(tblCauHoi.NoiDungCauHoi as text) as NoiDungCauHoi,tblCauHoi.Diem,tblCauHoi.IDCachHoi,tblCauHoi.IDLoaiCauHoi,tblCauHoi.DaoPhuongAn,
					tblCauHoi.MultiAnswer,CAST(tblLoaiCauHoi.Ten as text) as LoaiCauHoi
				FROM
					tblCauHoi
					inner join tblLoaiCauHoi on tblLoaiCauHoi.id = tblCauHoi.IDLoaiCauHoi
				WHERE
					IDCauHoiCha = '".$id."'
				ORDER BY tblCauHoi.ID";
		return DB::fetch_all($sql);
	}
	function get_cau_hoi(){
		$sql = "SELECT
					tblCauHoi.ID,tblCauHoi.IDCauHoiCha,tblCauHoi.Ten,CAST(tblCauHoi.NoiDungCauHoi as text) as NoiDungCauHoi,tblCauHoi.Diem,tblCauHoi.IDCachHoi,tblCauHoi.IDLoaiCauHoi,tblCauHoi.DaoPhuongAn,
					tblCauHoi.MultiAnswer,CAST(tblLoaiCauHoi.Ten as text) as LoaiCauHoi
				FROM
					tblCauHoi
					inner join tblLoaiCauHoi on tblLoaiCauHoi.id = tblCauHoi.IDLoaiCauHoi
				WHERE
					tblLoaiCauHoi.Ma like '014%'
					and IDCachHoi != '".MATCHING."'
					and IDCauHoiCha<1
				ORDER BY tblLoaiCauHoi.Ma,tblCauHoi.NoiDungCauHoi
				";
		return DB::fetch_all($sql);
	}
	function get_answer($id,$DaoPhuongAn)
	{
		$extra = $DaoPhuongAn?' order by NEWID()':'';
		return $answer = DB::fetch_all('select ID,Diem,CAST(NoiDungTraLoi AS TEXT) AS NoiDungTraLoi from tblTraLoi WHERE Diem>0 and IDCauHoi='.$id.$extra);
	}
	function get_answer_matching($id)
	{
		return $answer = DB::fetch('select ID,CAST(NoiDungTraLoi AS TEXT) AS NoiDungTraLoi from tblTraLoi WHERE IDCauHoi='.$id);
	}
}
?>
<?php
class EditPhanCongChamThiForm extends Form
{
	function EditPhanCongChamThiForm()
	{
		Form::Form('EditPhanCongChamThiForm');
	}
	function isMark($PhongThi){
		$sql = "
			SELECT
				tblWriting.id
			FROM
				tblWriting
				inner join tblDSDuThi on tblDSDuThi.ID = tblWriting.IDDSDuThi
				inner join tblWriting_ChamThi on tblWriting_ChamThi.WritingID = tblWriting.ID
			WHERE
				tblDSDuThi.IDPhongThi = '".$PhongThi."' and tblWriting_ChamThi.Diem>-1
		";
		return DB::fetch($sql);
	}
	function getMax(&$arr,$except=-1){
		$max = -1;
		$index = -1;
		$temp = $arr;
		if($except!=-1){
			unset($temp[$except]);
		}
		//debug($temp);
		$arrMax = array();
		foreach($temp as $k=>$v){
			if($max<$v['UuTien']){
				$max = $v['UuTien'];
				$arrMax = array();
				$arrMax[$k] = $v;
			}elseif($max==$v['UuTien']){
				$arrMax[$k] = $v;
			}
		}		
		$index = array_rand($arrMax);
		$arr[$index]['UuTien']--;
		return $index;
	}
	function on_submit()
	{
		if(Url::get('cmd')=='edit' and $id = Url::iget('id') and $item = DB::exists_id('tblphongthi',$id) and !$this->isMark($id))
		{
			$users = Url::get('user');
			if($users){
				//Tao danh sach nguoi cham thi
				foreach($users as $k=>$v){
					$v['IDPhongThi'] = $id;
					if($v['Password']!='**********'){
						$v['Password'] = User::encode_password($v['Password']);
					}else{
						unset($v['Password']);
					}
					if($ChamThiID = intval($v['id'])){
						unset($v['id']);
						DB::update_id('tblChamThi',$v,$ChamThiID);
					}else{
						unset($v['id']);
						$v['Locked'] = 0;
						$users[$k]['id'] = DB::insert('tblChamThi',$v);
					}
					$users[$k]['UuTien'] = 10;
				}
				shuffle($users);
				
				//Chia bai vao cac tui
				$sql = "
						SELECT
							tblWriting.*
						from
							tblWriting
							inner join tblDSDuThi on tblDSDuThi.ID = tblWriting.IDDSDuThi
						where
							tblDSDuThi.IDPhongThi = ".$id."
						order by NEWID()
					";
				$exams = DB::fetch_all($sql);				
				if($exams){
					//Tinh so tui thi
					$number_exam = count($exams);
					$min_exam_per_block = Url::iget('tuithi');
					if(!$min_exam_per_block) $min_exam_per_block = 30;
					$number_block = floor($number_exam/$min_exam_per_block);
					if(!$number_block) $number_block = 1;
					
					//Chia bai thi vao cac tui thi
					$TuiThi = array();
					shuffle($exams);
					$index = 0;
					while($number_exam>0){
						for($i=1;$i<=$number_block;$i++){
							$TuiThi[$i][] = $exams[$index];
							$index++;
							$number_exam--;
							if($number_exam<=0) break;
						}
					}
					//Chia cap nguoi cham cho cac tui thi
					DB::delete('tblWriting_ChamThi',"PhongThiID=".$id);
					foreach($TuiThi as $k=>$v){
						$u1 = $this->getMax($users);
						$u2 = $this->getMax($users,$u1);
						foreach($v as $_k=>$_v){
							$row = array(
								'UserID'=>$users[$u1]['id'],
								'WritingID'=>$_v['id'],
								'PhongThiID'=>$id,
								'Diem'=>-1
							);
							DB::insert('tblWriting_ChamThi',$row);
							$row = array(
								'UserID'=>$users[$u2]['id'],
								'WritingID'=>$_v['id'],
								'PhongThiID'=>$id,
								'Diem'=>-1
							);
							DB::insert('tblWriting_ChamThi',$row);
						}
					}
				}
			}
		}
		Url::redirect_current();
	}
	function so_bai_thi($phongthi){
		$sql = "
			SELECT
				count(tblWriting.ID) as total
			FROM
				tblWriting
				inner join tblDSDuThi on tblDSDuThi.ID = tblWriting.IDDSDuThi
			WHERE
				tblDSDuThi.IDPhongThi = '".$phongthi."'
		";
		return DB::fetch($sql,'total');
	}
	function draw()
	{
		$this->map=array();
		if(Url::get('cmd')=='edit' and $id=Url::iget('id') and $phongthi = DB::exists_id('tblphongthi',$id))
		{
			if($this->isMark($id)){
				echo '<center><h2>Giáo viên đã chấm bài. Bạn không thể sửa</h2></center>';
			}else{
				$phongthi['T_BatDau'] = date('d/m/Y H:i',$phongthi['T_BatDau']);
				$phongthi['T_KetThuc'] = date('d/m/Y H:i',$phongthi['T_KetThuc']);
				$phongthi['TongSoBai'] = $this->so_bai_thi($id);
				$this->map = $phongthi;
				$sql = '
					select
						tblChamThi.*
					from
						tblChamThi
					where IDPhongThi = '.$id;
				$users_str = '';
				if($users = DB::fetch_all($sql)){
					$this->map['users'] = $users;
				}			
				$this->parse_layout('edit',$this->map);
			}
		}else{
			echo '<center><h2>Phòng thi không tồn tại</h2></center>';
		}
	}
}
?>

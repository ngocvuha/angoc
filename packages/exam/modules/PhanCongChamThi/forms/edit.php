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
				tblDSDuThi.IDPhongThi = '".$PhongThi."'
				and tblWriting.Diem>0
		";
		return DB::fetch($sql);
	}
	function getMax(&$arr){
		$max = -1;
		$index = -1;
		$temp = $arr;
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
			//System::debug($users);exit();
			if($users){				
				//Tao danh sach nguoi cham thi
				$pairs = array();
				foreach($users as $k=>$v){
					$empty = true;
					foreach($v as $_k=>$_v){
						if(!$_v['IDUser']){
							break;
						}
						$empty = false;
						
						$_v['IDPhongThi'] = $id;
						if($_v['Password'] && ($_v['Password']!='**********')){
							$_v['Password'] = User::encode_password($_v['Password']);
						}else{
							unset($_v['Password']);
						}
						if(0 and ($ChamThiID = intval($_v['id']))){
							unset($_v['id']);
							DB::update_id('tblChamThi',$_v,$ChamThiID);
						}else{
							$sql = "
								SELECT
									id
								FROM
									tblChamThi
								WHERE
									IDUser = '".$_v['IDUser']."'
									and IDPhongThi = ".$id."
							";
							if($ChamThiID = DB::fetch($sql,'id')){
								
							}else{
								unset($_v['id']);
								$_v['Locked'] = 0;
								$ChamThiID = DB::insert('tblChamThi',$_v);
							}
							$users[$k][$_k]['id'] = $ChamThiID;
						}
					}
					if($empty){
						unset($users[$k]);
					}else{
						$users[$k]['UuTien'] = 1000;
					}
				}
				shuffle($users);
				//System::debug($users); exit();
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
					//Duyệt túi thi
					foreach($TuiThi as $k=>$v){
						$pair_id = $this->getMax($users);
						//Duyệt bài thi trong túi thi
						$index = 1;
						foreach($v as $_k=>$_v){
							$phach = $k;
							if($users[$pair_id][1]['id']){
								$row = array(
									'UserID'=>$users[$pair_id][1]['id'],
									'WritingID'=>$_v['id'],
									'PhongThiID'=>$id,
									'Diem'=>-1
								);
								DB::insert('tblWriting_ChamThi',$row);
								$phach .= '-'.$users[$pair_id][1]['id'];
							}
							if(isset($users[$pair_id][2]['id'])){
								$row = array(
									'UserID'=>$users[$pair_id][2]['id'],
									'WritingID'=>$_v['id'],
									'PhongThiID'=>$id,
									'Diem'=>-1
								);
								DB::insert('tblWriting_ChamThi',$row);
								$phach .= '-'.$users[$pair_id][2]['id'];
							}
							$phach .= '-'.$index;							
							DB::update_id('tblWriting',array('Phach'=>$phach),$_v['id']);
							$index++;
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
				echo '<center><h2>Phòng này đã phân người chấm</h2></center>';
			}else{
				DB::delete('tblWriting_ChamThi',"PhongThiID=".$id);
				DB::delete('tblChamThi',"IDPhongThi=".$id);
				
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

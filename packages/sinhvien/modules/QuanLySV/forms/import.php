<?php
class ImportQuanLySVForm extends Form
{
	function ImportQuanLySVForm()
	{
		Form::Form('ImportQuanLySVForm');
	}
	function draw()
	{
		/*$items = DB::fetch_all("select * from account where type='SV'");
		if($items){
			foreach($items as $k=>$v){
				if($v['GioiTinh']==1){
					$r['GioiTinh'] = 0;
				}else{
					$r['GioiTinh'] = 1;
				}
				//DB::update('account',$r,"id='".$v['id']."'");
			}
		}*/
		$this->map=array();
		$this->parse_layout('import');
	}
	function extractName($name){
		if($name){
			$arr = explode(' ',$name);
			$return = array();
			$count = count($arr);
			$return['Ten'] = $arr[$count-1];
			unset($arr[$count-1]);
			$return['HoDem'] = implode($arr,' ');
			return $return;
		}
		return false;
	}
	function on_submit()
	{
		set_time_limit(0);
		require_once 'packages/core/includes/utils/upload_file.php';
		require_once 'packages/core/includes/system/si_database.php';
		$upload_error = update_upload_file('xls', 'data', Portal::get_setting('max_file_size_media'), Portal::get_setting('filetype_media'));
		if(!$upload_error){
			//Insert Group
			if($Nhom = Url::nget('Nhom')){
				if($item = DB::fetch("select id from tblNhom where Ten = '".$Nhom."'")){
					$group = $item['id'];
				}else{
					DB::insert('tblNhom',array('Ten'=>$Nhom));
					$item = DB::fetch("select id from tblNhom where Ten = '".$Nhom."'");
					$group = $item['id'];
				}				
			}else{
				$group = '';
			}
			
			$inputFileName = Url::get('xls');
			require_once 'lib/php/Classes/PHPExcel/IOFactory.php';
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
			
			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();
			
			$arr = array();
			for ($row = 2; $row <= $highestRow; $row++) {
				//  Read a row of data into an array
				$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL, TRUE, FALSE);
				$date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($sheet->getCellByColumnAndRow(5, $row)->getValue()));
				$rowData[0][5] = $date;
				$arr[$row-2] = $rowData[0];
			}
			
			//System::debug($arr);exit();
			if($arr){
				unlink($inputFileName);
				foreach($arr as $k=>$v){
					if(!$v[9]) continue;
					$row = array(
						'create_date'=>time(),
						'type'=>'SV',
						'is_active'=>1,
						'is_block'=>0,
						'cache_privilege'=>''
					);
					$row['id'] = $v[9];
					$row['MaSV'] = $v[0];
					$row['Cmt'] = $v[1];
					$row['password'] = User::encode_password($v[10]);
					$row['HoDem'] = $v[2];
					$row['Ten'] = $v[3];
					//$row += $this->extractName($v[2]);
					$row['NgaySinh'] = $v[5];
					$row['QueQuan'] = $v[6];
					$row['GioiTinh'] = ($v[4]=='Nữ')?1:0;
					$lop_id = $this->addLop($v[7]);
					if($lop_id){
						$row['tblLopNienChe_id'] = $lop_id;						
						//System::debug($row); exit();
						if($item = DB::fetch("select id from account where id = '".$row['id']."'")){
							DB::update('account',$row,"id='".$item['id']."'");
						}else{
							DB::insert('account', $row);
						}
						if($group){
							if(!DB::fetch("select id from tblNhomAccount where NhomID = '".$group."' and AccountID = '".$row['id']."'"))
								DB::insert('tblNhomAccount',array('NhomID'=>$group,'AccountID'=>$row['id']));
						}
					}
				}
			}
		}
	}
	function addLop($name){
		$lop = array('name'=>$name,'status'=>'SHOW','structure_id' => si_child('tblLopNienChe',ID_ROOT));
		if($row = DB::fetch("select id from tblLopNienChe where name = '".$name."'")){
			return $row['id'];
		}
		DB::insert('tblLopNienChe',$lop);
		$row = DB::fetch("select id from tblLopNienChe where name = '".$name."'");
		return $row['id'];
	}
}
?>

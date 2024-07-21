<?php
class EditBangDiemForm extends Form
{
	function EditBangDiemForm()
	{
		Form::Form('EditBangDiemForm');
		$this->link_js('lib/js/tinymce/jscripts/tiny_mce/tiny_mce.js');
		$this->link_js('lib/js/jquery/jquery.datetimepicker.full.min.js');
		$this->link_css('templates/admin/css/jquery.datetimepicker.css');
		$this->add('Ten',new TextType(true,'please_enter_name',1,250));
		$this->add('IDCauTrucDeThi',new IDType(true,'please_select_exam','tblCauTrucDeThi'));
		$this->add('IDQuanLyThi',new IDType(true,'please_select_supervisory','account'));
	}
	function draw()
	{
		$this->map=array();
		$arr = array('1'=>'YES','0'=>'NO');
		$imgs = array();
		if(Url::get('cmd')=='view' and $id=Url::iget('id') and $news = DB::exists_id('tblphongthi',$id))
		{
			$this->map = $news;
			$sql = "select
						account.id,account.HoDem,account.Ten,account.NgaySinh,account.GioiTinh,account.Cmt,
						tblLopNienChe.name,account.MaSV,account.QueQuan,
						tbldsduthi.Diem,tbldsduthi.SoBaoDanh,tbldsduthi.TrangThai,tbldsduthi.TongDiemTraLoi,tbldsduthi.TongDiem
					from
						account
						inner join tbldsduthi on account.id = tbldsduthi.NguoiDung
						inner join tblLopNienChe on tblLopNienChe.id = account.tblLopNienChe_id
					where
						IDPhongThi = ".$news['id']."
					order by tbldsduthi.id
				";
			$this->map['items'] = DB::fetch_all($sql);
			//Export excel
			require_once ROOT_PATH.'packages/core/includes/utils/vn_code.php';
			$dir = 'upload/export/excel';
			//export danh sach thi
			$filename = convert_utf8_to_url_rewrite($news['Ten']);
			$file = $dir.'/'.$filename.'.xlsx';
			$this->map['path_xlsx'] = $file;
			$this->export($file,$this->map['items'],$news);
			
			//export bang diem
			$filename = convert_utf8_to_url_rewrite($news['Ten']).'_bangdiem_t10';
			$file = $dir.'/'.$filename.'.xlsx';
			$this->map['bangdiem_t10_xlsx'] = $file;
			$bangdiem = array();
			foreach($this->map['items'] as $k=>$v){
				if($v['TrangThai']==4){
					$bangdiem[$k] = $v;
				}
			}
			$this->export($file,$bangdiem,$news);
			//export bang tong diem
			$filename = convert_utf8_to_url_rewrite($news['Ten']).'_bangdiem_total';
			$file = $dir.'/'.$filename.'.xlsx';
			$this->map['bangdiem_total_xlsx'] = $file;
			$bangdiem = array();
			foreach($this->map['items'] as $k=>$v){
				if($v['TrangThai']==4){
					$bangdiem[$k] = $v;
					$bangdiem[$k]['Diem'] = $v['TongDiemTraLoi'];
				}
			}
			$this->export($file,$bangdiem,$news);
			
		}else{
			
		}
		$this->parse_layout('edit',$this->map);
	}
	function export($file,$rows,$item){
		//ini_set('display_errors',1);
		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
		require_once ROOT_PATH.'lib/php/Classes/PHPExcel/IOFactory.php';		
		
		$template = 'cache/bangdiem_tmp.xlsx';
		$objPHPExcelReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel = $objPHPExcelReader->load($template);
		$objPHPExcel->getActiveSheet()->setCellValue('A6','Phòng thi '.$item['Ten']);
		
		$baseRow = 10;
		$r = 0;
		foreach($rows as $k => $dataRow) {
			$row = $baseRow + $r;
			$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
			
			$GioiTinh = $dataRow['GioiTinh']==1?'Nữ':'Nam';
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $r+1)
										  ->setCellValue('B'.$row, $dataRow['Cmt'])
										  ->setCellValue('C'.$row, $dataRow['id'])
										  ->setCellValue('D'.$row, $dataRow['HoDem'])
										  ->setCellValue('E'.$row, $dataRow['Ten'])
										  ->setCellValue('F'.$row, $dataRow['name'])
										  ->setCellValue('G'.$row, $GioiTinh)
										  ->setCellValue('H'.$row, Date_time::to_common_date(substr($dataRow['NgaySinh'],0,10)))
										  ->setCellValue('I'.$row, $dataRow['QueQuan'])
										  ->setCellValue('J'.$row, $dataRow['Diem']);
			$r++;
		}
		$objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
		$objWriter->save($file);
	}
}
?>

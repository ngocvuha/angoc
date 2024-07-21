<?php
class ThiTestForm extends Form
{
	function ThiTestForm()
	{
		Form::Form('ThiTestForm');		
	}
	function on_submit(){
		$ThongTinThiSinh = Session::get('thi');
		if($answers = Url::get('answer')){			
			$bai_thi = $this->get_bai_thi($ThongTinThiSinh['IDTSDuThi']);
			$questions = DB::fetch_all('select * from tblCauHoi where id in ('.$bai_thi['XauCauHoi'].')');
			$ids = '0'; $total = 0; $totalQ = 0;
			foreach($questions as $k=>$v){
				$questions[$k]['answers'] = array();				
				$ids .=','.$k;
				if($v['IDCachHoi']==WRITING){
					$total += $v['Diem'];
				}
			}
			$dapans = DB::fetch_all('select ID,Diem,IDCauHoi,CAST(NoiDungTraLoi as text) as NoiDungTraLoi from tblTraLoi WHERE IDCauHoi in ('.$ids.')');
			foreach($dapans as $k=>$v){
				switch($questions[$v['IDCauHoi']]['IDCachHoi']){
					case FILLBLANK:
					case SHORTANSWER:
					case MATCHING: $questions[$v['IDCauHoi']]['answers'] = $v;break;
					case MULTICHOICE: $questions[$v['IDCauHoi']]['answers'][$k] = $v; break;
				}
				$total += $v['Diem'];
			}
			$diem = 0;
			$matching = Session::get('matching');
			foreach($questions as $k=>$v){				
				if(isset($answers[$k])){
					if($v['IDCachHoi']==MULTICHOICE){
						if($v['MultiAnswer']){
							$d_check = 0;
							foreach($answers[$k] as $_k=>$_v){
								if(isset($questions[$k]['answers'][$_v])){
									$d_check += $questions[$k]['answers'][$_v]['Diem'];
								}
							}
							if($d_check==$v['Diem']){
								$diem += $v['Diem'];
							}
						}else{
							$diem += $questions[$k]['answers'][$answers[$k]]['Diem'];
						}
					}
					if($v['IDCachHoi']==FILLBLANK){
						$kq = explode('|',$questions[$k]['answers']['NoiDungTraLoi']);
						$t = 0;
						$so_cau_tra_loi = count($kq);
						foreach($kq as $_k=>$_v){
							$_v = strtolower($_v);
							if(isset($answers[$k][$_k]) and $_v==strtolower(trim($answers[$k][$_k]))){
								$diem += $questions[$k]['answers']['Diem']/$so_cau_tra_loi;
							}
						}
					}
					if($v['IDCachHoi']==WRITING){
						$file = $this->save_pdf($answers[$k]);
						$writing = array(
							'IDDSDuThi'=>$ThongTinThiSinh['IDTSDuThi'],
							'IDCauHoi'=>$k,
							'Diem'=>0,
							'path'=>$file
						);
						if($writing_answer = DB::fetch("select * from tblWriting where path = '".$file."'")){
							DB::update_id('tblWriting',$writing,$writing_answer['id']);
						}else{
							DB::insert('tblWriting',$writing);
						}
					}
					if($v['IDCachHoi']==MATCHING and $answers[$k]){
						$arr1 = explode('|',$answers[$k]);
						$r = $this->is_matching($arr1,$matching[$k]);
						if($r){
							$diem += $questions[$k]['answers']['Diem'];
						}
					}
					
					if($v['IDCachHoi']==SHORTANSWER and $answers[$k]){
						if($answers[$k]==$questions[$k]['answers']){
							$diem += $v['Diem'];
						}
					}
				}
			}
			$XauTraLoi = '$answers = '.var_export($answers,true).';';
			if(time() - $ThongTinThiSinh['T_BatDau'] > 20){
				ThiDB::update(array('T_KetThuc'=>time(),'TongDiemTraLoi'=>$diem,'TongDiem'=>$total,'Diem'=>round($diem*40/$total)/4,'XauTraLoi'=>$XauTraLoi,'TrangThai'=>4));
			}else{
				ThiDB::update(array('TrangThai'=>0));
			}
			Url::redirect_current();
		}else{
			if(time() - $ThongTinThiSinh['T_BatDau'] > 20){
				ThiDB::update(array('T_KetThuc'=>time(),'TongDiemTraLoi'=>0,'TongDiem'=>0,'Diem'=>0,'XauTraLoi'=>'','TrangThai'=>4));
			}else{
				Url::redirect_current();
			}
		}
	}
	function save_pdf($html){
		require_once('lib/php/tcpdf/tcpdf_include.php');
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Hnmu');
		$pdf->SetTitle('Hnmu Exam online');
		$pdf->SetSubject('Pdf');
		$pdf->SetKeywords('PDF, hnmu, test online');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'HNMU Exam Online', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
		$pdf->setFooterData(array(0,64,0), array(0,64,128));

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set default font subsetting mode
		$pdf->setFontSubsetting(true);
		$pdf->SetFont('courier', '', 10);
		$pdf->AddPage();
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

		// ---------------------------------------------------------

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$TS = Session::get('thi');
		$folder = 'upload/data/writing/'.$TS['IDPhongThi'];
		if(!file_exists($folder) ){
			mkdir($folder);
		}
		$file_name = $folder.'/'.md5($TS['NguoiDung'].$TS['IDPhongThi']).'.pdf';
		$pdf->Output($file_name, 'F');
		return $file_name;
	}
	function is_matching($arr1,$arr2){
		foreach($arr2 as $k=>$v){
			if(!isset($arr1[$v-1]) or ($arr1[$v-1]!=$k+1)) return false;
		}
		return true;
	}
	function draw()
	{
		$this->map=array();
		$this->map = Session::get('thi');
		$bai_thi = $this->get_bai_thi($this->map['IDTSDuThi']);
		$questions = $this->get_cau_hoi($bai_thi['XauCauHoi']);
		require_once 'packages/core/includes/utils/vn_code.php';
		if($questions){
			$temp_matching = array();
			$index = 0;
			foreach($questions as $k=>$v){
				$index++;
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
		//return $content;
		return preg_replace('/src="\/Upload\/([^"]+)"/','src="'.WEBQUANLY.'/Upload/$1"',$content);
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
	function get_cau_hoi($ids){
		$sql = "SELECT
					tblCauHoi.ID,tblCauHoi.IDCauHoiCha,tblCauHoi.Ten,tblCauHoi.NoiDungCauHoi,tblCauHoi.Diem,tblCauHoi.IDCachHoi,tblCauHoi.IDLoaiCauHoi,tblCauHoi.DaoPhuongAn,
					tblCauHoi.MultiAnswer,CAST(tblLoaiCauHoi.Ten as text) as LoaiCauHoi
				FROM
					tblCauHoi
					inner join tblLoaiCauHoi on tblLoaiCauHoi.id = tblCauHoi.IDLoaiCauHoi
				WHERE
					tblCauHoi.id in (".$ids.")
				ORDER BY CHARINDEX(','+CONVERT(varchar,tblCauHoi.id)+',', ',".$ids.",')";
		return DB::fetch_all($sql);
	}
	function get_answer($id,$DaoPhuongAn)
	{
		$extra = $DaoPhuongAn?' order by NEWID()':'';
		return $answer = DB::fetch_all('select ID,CAST(NoiDungTraLoi AS TEXT) AS NoiDungTraLoi from tblTraLoi WHERE IDCauHoi='.$id.$extra);
	}
	function get_answer_matching($id)
	{
		return $answer = DB::fetch('select ID,CAST(NoiDungTraLoi AS TEXT) AS NoiDungTraLoi from tblTraLoi WHERE IDCauHoi='.$id);
	}
}
?>
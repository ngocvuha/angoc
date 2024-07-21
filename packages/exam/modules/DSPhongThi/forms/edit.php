<?php
class EditDSPhongThiForm extends Form
{
	function EditDSPhongThiForm()
	{
		Form::Form('EditDSPhongThiForm');
		$this->link_js('lib/js/tinymce/jscripts/tiny_mce/tiny_mce.js');
		$this->link_js('lib/js/jquery/jquery.datetimepicker.full.min.js');
		$this->link_css('templates/admin/css/jquery.datetimepicker.css');
		$this->add('Ten',new TextType(true,'please_enter_name',1,250));
		$this->add('IDCauTrucDeThi',new IDType(true,'please_select_exam','tblCauTrucDeThi'));
		$this->add('IDQuanLyThi',new IDType(true,'please_select_supervisory','account'));
	}
	function strptime($date, $format) { 
		$masks = array( 
		  '%d' => '(?P<d>[0-9]{2})', 
		  '%m' => '(?P<m>[0-9]{2})', 
		  '%Y' => '(?P<Y>[0-9]{4})', 
		  '%H' => '(?P<H>[0-9]{2})', 
		  '%M' => '(?P<M>[0-9]{2})', 
		  '%S' => '(?P<S>[0-9]{2})', 
		); 

		$rexep = "#".strtr(preg_quote($format), $masks)."#"; 
		if(!preg_match($rexep, $date, $out)) 
		  return false; 

		$ret = array( 
		  "tm_sec"  => isset($out['S'])?(int) $out['S']:0,
		  "tm_min"  => isset($out['M'])?(int) $out['M']:0,
		  "tm_hour" => isset($out['H'])?(int) $out['H']:0,
		  "tm_mday" => isset($out['d'])?(int) $out['d']:0,
		  "tm_mon"  => isset($out['m'])?$out['m']:0,
		  "tm_year" => (isset($out['Y']) && ($out['Y'] > 1900)) ? $out['Y'] : 0
		); 
		return $ret; 
	  } 
	function _time($time){
		$date = $this->strptime($time, '%d/%m/%Y %H:%M');
		$time = strtotime($date['tm_mon'].'/'.$date['tm_mday'].'/'.$date['tm_year'])+$date['tm_hour']*3600+$date['tm_min']*60;
		return $time;
	}
	function save_item()
	{
		require_once 'packages/core/includes/utils/vn_code.php';
		require_once 'packages/core/includes/utils/search.php';
		
		$rows = array(
			'Ten'
			,'TrangThai'=>1
			,'Locked'=>Url::iget('Locked')
			,'T_BatDau'=>$this->_time(Url::get('T_BatDau'))
			,'T_KetThuc'=>$this->_time(Url::get('T_KetThuc'))
			,'IDQuanLyThi'
			,'IDCauTrucDeThi'
			,'GhiChu'
		);
		return ($rows);
	}
	function on_submit()
	{
	}
	function draw()
	{
		$this->map=array();
		$arr = array('1'=>'YES','0'=>'NO');
		$imgs = array();
		if(Url::get('cmd')=='view' and $id=Url::iget('id') and $news = DB::exists_id('tblphongthi',$id))
		{
			$news['T_BatDau'] = date('d/m/Y H:i',$news['T_BatDau']);
			$news['T_KetThuc'] = date('d/m/Y H:i',$news['T_KetThuc']);			
			$news['DeThi'] = DB::fetch("select id,Ten from tblCauTrucDeThi where id = ".$news['IDCauTrucDeThi'],'Ten');
			$news['GiamThi'] = DB::fetch("select account.id,account.HoDem+' '+account.Ten as name from account where id='".$news['IDQuanLyThi']."'",'name');
			$this->map = $news;
			$sql = "select
						account.id,account.HoDem,account.Ten,account.MaSV,
						tbldsduthi.id as BaiThi,tbldsduthi.Diem
					from
						account
						inner join tbldsduthi on account.id = tbldsduthi.NguoiDung
						inner join tblLopNienChe on tblLopNienChe.id = account.tblLopNienChe_id
					where
						IDPhongThi = ".$news['id']."
						and TrangThai = 4
					order by tblLopNienChe.id
				";
			$this->map['items'] = DB::fetch_all($sql);
			$this->map['items_size'] = count($this->map['items']);
			$this->parse_layout('edit',$this->map);
		}
	}
}
?>

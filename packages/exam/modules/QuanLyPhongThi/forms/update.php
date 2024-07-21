<?php
class UpdateQuanLyPhongThiForm extends Form
{
	function UpdateQuanLyPhongThiForm()
	{
		Form::Form('UpdateQuanLyPhongThiForm');
		$this->link_js('lib/js/tinymce/jscripts/tiny_mce/tiny_mce.js');
		$this->link_js('lib/js/jquery/jquery.datetimepicker.full.min.js');
		$this->link_css('templates/admin/css/jquery.datetimepicker.css');
		$this->languages = System::get_language();
		$this->default_language=Portal::get_setting('default_language');
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
			'T_BatDau'=>$this->_time(Url::get('T_BatDau')),
			'T_KetThuc'=>$this->_time(Url::get('T_KetThuc'))
		);
		return ($rows);
	}
	function on_submit()
	{
		if(User::can_moderator())
		{
			$rows = $this->save_item();
			if(Url::get('cmd')=='update' and $id = Url::iget('id') and $item = DB::exists_id('tblphongthi',$id))
			{
				DB::update_id('tblphongthi',$rows,$id);
			}
			Url::redirect_current();
		}
	}
	function draw()
	{
		$this->map=array();
		$arr = array('1'=>'YES','0'=>'NO');
		$imgs = array();
		if(Url::get('cmd')=='update' and $id=Url::iget('id') and $news = DB::exists_id('tblphongthi',$id))
		{
			$_REQUEST['T_BatDau'] = date('d/m/Y H:i',$news['T_BatDau']);
			$_REQUEST['T_KetThuc'] = date('d/m/Y H:i',$news['T_KetThuc']);			
			$this->map = $news;
			
			$sql = "select
				account.id,account.HoDem+' '+account.Ten as name
			from
				account
				inner join account_privilege on account_privilege.account_id = account.id
			where
				account.type = 'USER' and account_privilege.privilege_id = 3 and account.id = '".$news['IDQuanLyThi']."'
			";
			$this->map['QuanLyThi'] = DB::fetch($sql,'name');
			
			$sql = 'select
							id,Ten as name
						from
							tblCauTrucDeThi
						where id = '.$news['IDCauTrucDeThi'].'
					';
			
			$this->map['CauTrucDeThi'] = DB::fetch($sql,'name');
			
			if(!Url::get('status')) $_REQUEST['status']='SHOW';
			$this->parse_layout('update',$this->map);

		}
	}
}
?>

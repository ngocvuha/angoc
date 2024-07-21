<?php
class EditQuanLyPhongThiForm extends Form
{
	function EditQuanLyPhongThiForm()
	{
		Form::Form('EditQuanLyPhongThiForm');
		$this->link_js('lib/js/tinymce/jscripts/tiny_mce/tiny_mce.js');
		$this->link_js('lib/js/jquery/jquery.datetimepicker.full.min.js');
		$this->link_css('templates/admin/css/jquery.datetimepicker.css');
		$this->languages = System::get_language();
		$this->default_language=Portal::get_setting('default_language');
		$this->add('Ten',new TextType(true,'please_enter_name',0,250)); 
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
		if($this->check())
		{
			$rows = $this->save_item();
			if(Url::get('cmd')=='edit' and $id = Url::iget('id') and $item = DB::exists_id('tblphongthi',$id))
			{
				DB::update_id('tblphongthi',$rows,$id);
			}else{				
				DB::insert('tblphongthi',$rows);
				$id = DB::fetch('select Max(id) as id from tblphongthi','id');
			}
			if($id){
				if($ts = Url::get('danhsachduthi') and is_array($ts)){
					$row = array('TrangThai'=>0,'IDPhongThi'=>$id);
					$selected = "'0'";
					foreach($ts as $v){
						$selected .= ",'".$v."'";
						if(!DB::fetch('select id from tbldsduthi where NguoiDung = \''.$v.'\' and IDPhongThi = '.$id)){
							$user = DB::fetch("select id,MaSV from account where id = '".$v."'");
							if($user){
								$row['SoBaoDanh'] = $user['MaSV'];
								$row['NguoiDung'] = $v;
								DB::insert('tbldsduthi',$row);
							}
						}
					}
					DB::delete('tbldsduthi',"NguoiDung not in (".$selected.") and IDPhongThi='".$id."'");
				}else{
					DB::delete('tbldsduthi',"IDPhongThi='".$id."'");
				}
			}
			if(Url::get('action')=='continue'){
				Url::redirect_current(array('cmd'=>Url::get('cmd')));
			}
			Url::redirect_current();
		}
	}
	function draw()
	{
		$this->map=array();
		$arr = array('1'=>'YES','0'=>'NO');
		$imgs = array();
		if(Url::get('cmd')=='edit' and $id=Url::iget('id') and $news = DB::exists_id('tblphongthi',$id))
		{
			$news['T_BatDau'] = date('d/m/Y H:i',$news['T_BatDau']);
			$news['T_KetThuc'] = date('d/m/Y H:i',$news['T_KetThuc']);			
			foreach($news as $key=>$value)
			{
				if(!isset($_REQUEST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
			$this->map = $news;
			$sql = "select
						account.id,account.HoDem,account.Ten,tblLopNienChe.name,account.MaSV
					from
						account
						inner join tbldsduthi on account.id = tbldsduthi.NguoiDung
						inner join tblLopNienChe on tblLopNienChe.id = account.tblLopNienChe_id
					where
						IDPhongThi = ".$news['id']."
					order by tblLopNienChe.id
				";
			$this->map['items'] = DB::fetch_all($sql);
			$this->map['items_size'] = count($this->map['items']);
		}else{
			$this->map['items_size'] = 10;
			$this->map['GhiChu'] = '';
		}
		$sql = "select
						account.id,account.HoDem+' '+account.Ten as name
					from
						account
						inner join account_privilege on account_privilege.account_id = account.id
					where
						account.type = 'USER' and account_privilege.privilege_id = 3
				";
		$this->map['IDQuanLyThi_list'] = String::get_list(DB::fetch_all($sql));
		
		$sql = 'select
						id,Ten as name
					from
						tblCauTrucDeThi
				';
		
		$this->map['IDCauTrucDeThi_list'] = String::get_list(DB::fetch_all($sql));
		
		if(!Url::get('status')) $_REQUEST['status']='SHOW';
		$this->parse_layout('edit',$this->map);
	}
}
?>

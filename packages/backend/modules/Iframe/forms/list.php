<?php
class IframeForm extends Form
{
	function IframeForm()
	{
		Form::Form('IframeForm');
	}
	function draw()
	{
		$srv=WEBQUANLY;
		if(strpos($srv,'localhost')){
			//$srv = 'http://localhost:8082';
			$srv = 'http://testonline.dhcd.edu.vn:8081';
		}
		$array = array(
			'qlch'=>$srv.'/QLCauHoi/QLCauHoi.aspx',
			'dmch'=>$srv.'/QLCauHoi/LoaiCauHoi.aspx',
			'ctdt'=>$srv.'/QLCauHoi/QLCauTrucDeThi.aspx',
			'ipch'=>$srv.'/QLCauHoi/ImportCauHoi.aspx',
			'dkct'=>$srv.'/QLThi/DieuHanhThi.aspx',
			'gst'=>$srv.'/QLThi/DieuHanhThi.aspx',
			'bd'=>$srv.'/BaoCao/BangDiem.aspx',
			'tckqcn'=>$srv.'/BaoCao/TraCuuKetQuaCaNhan.aspx',
			'ikqcn'=>$srv.'/BaoCao/InKetQuaCaNhan.aspx',
			'ekqtpt'=>$srv.'/BaoCao/ExportKetQuaTheoPhongThi.aspx',
			'tkkqtdt'=>$srv.'/BaoCao/TKKetQuaTheoDeThi.aspx',
			'tkkqtpt'=>$srv.'/BaoCao/TKKetQuaTheoPhongThi.aspx',
			'tkkqttg'=>$srv.'/BaoCao/TKKetQuaTheoThoiGian.aspx'
		);
		if($cmd = Url::get('type') and isset($array[$cmd])){
			$this->map['url'] = $array[$cmd].'?user_id='.Session::get('user_id');
			$this->parse_layout('list',$this->map);
		}		
	}
}
?>

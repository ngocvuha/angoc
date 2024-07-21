<?php
class TestCauHoiDB{
	static function checkThi($phongthi){
		$sql = "
			select 
				tblDSDuThi.ID,tblDSDuThi.NguoiDung,tblDSDuThi.SoBaoDanh,tblDSDuThi.TrangThai,tblDSDuThi.IDPhongThi,
				tblDSDuThi.T_BatDau,tblDSDuThi.T_KetThuc,
				tblDSDuThi.T_BatDau,CAST(XauCauHoi AS TEXT) AS XauCauHoi,
				tblPhongThi.NgayThi,tblPhongThi.Ten,tblPhongThi.IDCauTrucDeThi,tblCauTrucDeThi.Ten as MonThi,
				tblCauTrucDeThi.ThoiGianLamBai,tblPhongThi.T_BatDau as P_BatDau,tblPhongThi.T_KetThuc as P_KetThuc
			from 
				tblDSDuThi
				inner join tblPhongThi on tblPhongThi.ID = tblDSDuThi.IDPhongThi
				inner join tblCauTrucDeThi on tblCauTrucDeThi.id = tblPhongThi.IDCauTrucDeThi
			WHERE
				tblPhongThi.T_BatDau < ".time()."
				and tblPhongThi.T_KetThuc > ".time()."
				and tblDSDuThi.NguoiDung = '".User::id()."'
				and tblPhongThi.ID = '".$phongthi."'
		";
		return DB::fetch($sql);
	}
	static function get_bai_thi($IDTSDuThi){
		return DB::fetch('
			select 
				ID,NguoiDung,SoBaoDanh,TrangThai,IDPhongThi,T_BatDau,T_KetThuc,Diem,TongDiem,TongDiemTraLoi,
				CAST(XauCauHoi AS TEXT) AS XauCauHoi 
			from 
				tblDSDuThi
			WHERE
				ID = '.$IDTSDuThi.'
		');
	}
	static function get_status(){
		$ThongTinThiSinh = Session::get('thi');
		$IDTSDuThi = $ThongTinThiSinh['IDTSDuThi'];
		return DB::fetch('select TrangThai from tblDSDuThi where id = '.$IDTSDuThi,'TrangThai');
	}
	static function update($row){
		$ThongTinThiSinh = Session::get('thi');
		if($ThongTinThiSinh){
			DB::update_id("tblDSDuThi",$row,$ThongTinThiSinh['IDTSDuThi']);
			foreach($row as $k=>$v){
				$ThongTinThiSinh[$k] = $v;
			}
			Session::set('thi',$ThongTinThiSinh);
		}
	}
}
?>
<?php
class PhucTraDB{
	static function checkPhucTra($phongPhucTra){
		$sql = "
			select 
				tblDSDuThi.ID,tblDSDuThi.NguoiDung,tblDSDuThi.SoBaoDanh,tblDSDuThi.TrangThai,tblDSDuThi.IDPhongPhucTra,
				tblDSDuThi.T_BatDau,tblDSDuThi.T_KetThuc,tblDSDuThi.AccessCode,tblDSDuThi.IP,
				tblDSDuThi.T_BatDau,CAST(XauCauHoi AS TEXT) AS XauCauHoi,
				tblPhongPhucTra.NgayPhucTra,tblPhongPhucTra.Ten,tblPhongPhucTra.IDCauTrucDePhucTra,tblCauTrucDeThi.Ten as MonPhucTra,
				tblCauTrucDeThi.ThoiGianLamBai,tblPhongPhucTra.T_BatDau as P_BatDau,tblPhongPhucTra.T_KetThuc as P_KetThuc
			from 
				tblDSDuThi
				inner join tblPhongPhucTra on tblPhongPhucTra.ID = tblDSDuThi.IDPhongPhucTra
				inner join tblCauTrucDeThi on tblCauTrucDeThi.id = tblPhongPhucTra.IDCauTrucDePhucTra
			WHERE
				tblPhongPhucTra.T_BatDau < ".time()."
				and tblPhongPhucTra.T_KetThuc > ".time()."
				and tblDSDuThi.NguoiDung = '".User::id()."'
				and tblPhongPhucTra.ID = '".$phongPhucTra."'
				and tblPhongPhucTra.Locked = 0
		";
		return DB::fetch($sql);
	}
	static function getPhucTra($IDTSDuPhucTra){
		$sql = "
			select 
				tblDSDuThi.ID,tblDSDuThi.NguoiDung,tblDSDuThi.SoBaoDanh,tblDSDuThi.TrangThai,tblDSDuThi.IDPhongPhucTra,
				tblDSDuThi.T_BatDau,tblDSDuThi.T_KetThuc,MatchingStore,
				tblDSDuThi.T_BatDau,CAST(XauCauHoi AS TEXT) AS XauCauHoi,
				tblPhongPhucTra.NgayPhucTra,tblPhongPhucTra.Ten,tblPhongPhucTra.IDCauTrucDePhucTra,tblCauTrucDeThi.Ten as MonPhucTra,
				tblCauTrucDeThi.ThoiGianLamBai,tblPhongPhucTra.T_BatDau as P_BatDau,tblPhongPhucTra.T_KetThuc as P_KetThuc
			from 
				tblDSDuThi
				inner join tblPhongPhucTra on tblPhongPhucTra.ID = tblDSDuThi.IDPhongPhucTra
				inner join tblCauTrucDeThi on tblCauTrucDeThi.id = tblPhongPhucTra.IDCauTrucDePhucTra
			WHERE
				tblDSDuThi.ID = ".$IDTSDuPhucTra."
		";
		return DB::fetch($sql);
	}
	static function get_bai_PhucTra($IDTSDuPhucTra){
		return DB::fetch('
			select 
				ID,NguoiDung,SoBaoDanh,TrangThai,IDPhongPhucTra,T_BatDau,T_KetThuc,Diem,TongDiem,TongDiemTraLoi,
				DiemLyThuyet,TongDiemLyThuyet,SoCauThucHanh,TongCauThucHanh,
				CAST(XauCauHoi AS TEXT) AS XauCauHoi 
			from 
				tblDSDuThi
			WHERE
				ID = '.$IDTSDuPhucTra.'
		');
	}
	static function get_status(){
		$ThongTinPhucTraSinh = Session::get('PhucTra');
		$IDTSDuPhucTra = $ThongTinPhucTraSinh['IDTSDuPhucTra'];
		return DB::fetch('select TrangThai from tblDSDuThi where id = '.$IDTSDuPhucTra,'TrangThai');
	}
	static function update($row){
		$ThongTinPhucTraSinh = Session::get('PhucTra');
		if($ThongTinPhucTraSinh){
			DB::update_id("tblDSDuThi",$row,$ThongTinPhucTraSinh['IDTSDuPhucTra']);
			foreach($row as $k=>$v){
				$ThongTinPhucTraSinh[$k] = $v;
			}
			Session::set('PhucTra',$ThongTinPhucTraSinh);
		}
	}
}
?>
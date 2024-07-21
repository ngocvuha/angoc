<?php
class RouterDB{
	function checkThi($sv){
		return DB::fetch_all("
			select 
				tblDSDuThi.ID,
				tblPhongThi.NgayThi,tblPhongThi.Ten,tblPhongThi.IDCauTrucDeThi,tblCauTrucDeThi.Ten as MonThi,
				tblCauTrucDeThi.ThoiGianLamBai,tblPhongThi.ID as PhongThiID
			from 
				tblDSDuThi
				inner join tblPhongThi on tblPhongThi.ID = tblDSDuThi.IDPhongThi
				inner join tblCauTrucDeThi on tblCauTrucDeThi.id = tblPhongThi.IDCauTrucDeThi
			WHERE
				tblPhongThi.T_BatDau < ".time()."
				and tblPhongThi.T_KetThuc > ".time()."
				and tblDSDuThi.NguoiDung = '".$sv."'
				and tblDSDuThi.TrangThai != 4
				and tblPhongThi.Locked = 0
		");
	}
}
?>
<?php
class DieuHanhThiDB{
	function getPhongThi(){
		$sql = "
			SELECT
				id,Ten,T_BatDau,T_KetThuc
			FROM
				tblPhongThi
			WhERE
				IDQuanLyThi = '".User::id()."'
				and T_BatDau <= '".time()."'
				and T_KetThuc >= '".(time()-3600)."'
		";
		return DB::fetch_all($sql);
	}
	function PhongThi($id){
		$sql = "
			SELECT
				id,Ten,T_BatDau,T_KetThuc
			FROM
				tblPhongThi
			WhERE
				IDQuanLyThi = '".User::id()."'
				and T_BatDau <= '".time()."'
				and T_KetThuc >= '".(time()-3600)."'
				and id = ".$id."
		";
		return DB::fetch($sql);
	}
	//replace(convert(NVARCHAR, account.NgaySinh, 105), ' ', '/') as NgaySinh
	function getThiSinh($PhongThi){
		$sql = "
			SELECT
				tblDSDuThi.ID as id,SoBaoDanh,TrangThai,T_BatDau,T_KetThuc,Diem,
				account.HoDem,account.Ten,
				account.NgaySinh
			FROM
				tblDSDuThi
				inner join account on account.id = tblDSDuThi.NguoiDung
			WhERE
				IDPhongThi = ".$PhongThi."
			ORDER BY
				tblDSDuThi.ID
		";
		return DB::fetch_all($sql);
	}
}
?>
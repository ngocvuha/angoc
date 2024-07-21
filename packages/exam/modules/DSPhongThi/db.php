<?php
class DSPhongThiDB
{
	function get_total_item($cond)
	{
		return DB::fetch(
			'SELECT 
				count(*) as total 
			FROM 
				tblphongthi
			WHERE 
				'.$cond
		,'total');
	}
	function get_items($cond,$order_by,$item_per_page)
	{
		$page = page_no();
		$from = ($page-1)*$item_per_page;
		$to = $page*$item_per_page-1;
		$items = DB::fetch_all('
			select * from ( SELECT
				ROW_NUMBER() OVER ('.$order_by.') AS \'RowNumber\',
				tblphongthi.id,tblphongthi.Ten,tblphongthi.T_BatDau,tblphongthi.T_KetThuc,tblphongthi.NgayThi,CAST(tblphongthi.GhiChu as text) as GhiChu,tblCauTrucDeThi.Ten as IDCauTrucDeThi,
				tblphongthi.TrangThai,
				account.HoDem,account.Ten as GiamThi
			FROM
				tblphongthi
				left outer join account on account.id = tblphongthi.IDQuanLyThi
				left outer join tblCauTrucDeThi on tblCauTrucDeThi.id = tblphongthi.IDCauTrucDeThi
			WHERE
				'.$cond.') as sub
			WHERE RowNumber BETWEEN '.$from.' AND '.$to.'
		');
		return ($items);
	}	
}
?>

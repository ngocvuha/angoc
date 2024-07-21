<?php
class ChamThiDB
{
	function get_total_item($cond)
	{

	}
	function get_items()
	{
		$items = DB::fetch_all("
			SELECT
				tblWriting_ChamThi.id,tblWriting.ID as WritingID,tblWriting.path,tblWriting.Phach,
				tblWriting_ChamThi.Diem,tblCauHoi.Ten,tblCauHoi.Diem as TMark,tblCauHoi.GhiChu,
				CAST(tblCauHoi.NoiDungCauHoi as TEXT) as NoiDungCauHoi
			FROM
				tblWriting_ChamThi
				inner join tblWriting on tblWriting_ChamThi.WritingID = tblWriting.ID
				inner join tblCauHoi on tblCauHoi.ID = tblWriting.IDCauHoi
			WHERE
				tblWriting_ChamThi.UserID = '".ChamThi::$id['id']."'
			ORDER BY
				tblWriting.IDCauHoi
		");
		return $items;
	}	
}
?>

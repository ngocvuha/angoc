<?php
class QuanLySVDB{
	function get_items($cond,$order_by,$item_per_page){
		$page = page_no();
		$from = ($page-1)*$item_per_page;
		$to = $page*$item_per_page-1;
		return DB::fetch_all('
			select * from (
				SELECT
					ROW_NUMBER() OVER ('.$order_by.') AS \'RowNumber\',
					account.id,account.email,account.create_date,account.last_online_time,account.HoDem,account.Ten,account.MaSV,
					CASE WHEN account.is_active=1 THEN 1 ELSE 2 END  as is_active,
					CASE WHEN account.is_block=1 THEN 1 ELSE 2 END as is_block,
					tblLopNienChe.name as LopNienChe
				FROM
					account
					INNER JOIN tblLopNienChe ON account.tblLopNienChe_id=tblLopNienChe.id
				WHERE
					'.$cond.'
				) as sub
			WHERE RowNumber BETWEEN '.$from.' AND '.$to.'
		');
	}
	function get_total_item($cond){
		return DB::fetch('
			SELECT
				count(*) as total
			FROM
				account
			WHERE
				'.$cond.'
		','total');
	}
	function get_user($user_id){
		return DB::fetch('
			SELECT
				account.id
			FROM
				account
				INNER JOIN tblLopNienChe ON account.tblLopNienChe_id=tblLopNienChe.id
			WHERE
				account.id=\''.$user_id.'\'
		');
	}
}
?>
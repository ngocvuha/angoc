<?php
class ManageHelperDB
{
	function get_total_item($cond)
	{
		return DB::fetch(
			'select 
				count(*) as acount 
			from 
				helper 
				INNER JOIN tinhnang on helper.category_id = tinhnang.id
			where 
				'.$cond.'
				'
			,'acount');
	}
	function get_items($cond,$order_by,$item_per_page)
	{
		return DB::fetch_all('
			SELECT
				helper.*
				,helper.name_'.Portal::language().' as name
				,tinhnang.name as category_name
			FROM
				helper 
				INNER JOIN tinhnang on helper.category_id = tinhnang.id
			WHERE
				'.$cond.'
			'.$order_by.'
		');
	}	
}
?>

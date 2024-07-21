<?php
class HelperDB
{
	function get_item($cond){
		return DB::fetch('
			SELECT
				helper.*
				,helper.name_'.Portal::language().' as name
				,helper.description_'.Portal::language().' as description
			FROM
				helper 
				INNER JOIN tinhnang on helper.category_id = tinhnang.id
			WHERE
				'.$cond.'
		');
	}
}
?>

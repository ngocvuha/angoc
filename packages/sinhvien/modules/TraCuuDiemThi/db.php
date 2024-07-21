<?php
class TraCuuDiemThiDB
{	
	function check_categories($categories)
	{
		foreach($categories as $id=>$category)
		{
			if(!User::can_view(false,$category['structure_id']))
			{
				unset($categories[$id]);
			}
		}
		return $categories;
	}
	function get_categories()
	{
		return DB::fetch_all('
			SELECT
				tblLopNienChe.*,
				helper.id as helper_id
			FROM
				tblLopNienChe
				LEFT OUTER JOIN helper on helper.category_id = tblLopNienChe.id
			WHERE
				tblLopNienChe.structure_id<>'.ID_ROOT.'
			ORDER BY
				tblLopNienChe.structure_id
		');
	}
}
?>
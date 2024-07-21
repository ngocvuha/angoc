<?php
class FunctionCategoryDB
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
				tinhnang.*,
				helper.id as helper_id
			FROM
				tinhnang
				LEFT OUTER JOIN helper on helper.category_id = tinhnang.id
			WHERE
				tinhnang.structure_id<>'.ID_ROOT.'
			ORDER BY
				tinhnang.structure_id
		');
	}
}
?>
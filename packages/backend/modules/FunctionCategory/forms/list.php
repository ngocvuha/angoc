<?php
class ListFunctionCategoryForm extends Form
{
	function ListFunctionCategoryForm()
	{
		Form::Form('ListFunctionCategoryForm');
	}
	function draw()
	{
		$items=DB::select_all('tinhnang',false,'structure_id');
		require_once 'packages/core/includes/utils/category.php';
		category_indent($items);
		//$items=String::array2tree($items,'childs');
		$this->parse_layout('list',array(
				'items'=>$items,
			)
		);
	}	
}
?>
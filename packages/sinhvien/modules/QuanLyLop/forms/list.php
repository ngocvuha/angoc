<?php
class ListQuanLyLopForm extends Form
{
	function ListQuanLyLopForm()
	{
		Form::Form('ListQuanLyLopForm');
	}
	function draw()
	{
		$items=DB::select_all('tblLopNienChe',false,'structure_id');
		require_once 'packages/core/includes/utils/category.php';
		category_indent($items);
		$this->parse_layout('list',array(
				'items'=>$items,
			)
		);
	}	
}
?>
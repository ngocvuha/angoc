<?php
class ListPackageAdminForm extends Form
{
	function ListPackageAdminForm()
	{
		Form::Form('ListPackageAdminForm');
	}
	function on_submit()
	{
		if(URL::get('confirm'))
		{
			foreach(URL::get('selected_ids') as $id)
			{
			}
			require_once 'detail.php';
			foreach(URL::get('selected_ids') as $id)
			{
				PackageAdminForm::delete($this,$id);
				if($this->is_error())
				{
					return;
				}
			}
			Url::redirect_current(array(
			'name'=>isset($_GET['name'])?$_GET['name']:'', 
			  ));
		}
	}
	function get_cond(){
		$cond = '1=1';
		if(Url::get('search_name')){
			$cond.=' and package.name LIKE "%'.Url::get('search_name').'%"';
		}
		if(Url::get('search_title_1')){
			$cond.=' and package.title_1 LIKE "%'.Url::get('search_title_1').'%"';
		}
		return $cond;
	}
	function draw()
	{
		$cond = $this->get_cond();
		DB::query('
			select 
				package.id
				,package.structure_id
				,package.name 
				,package.title_1 as title
			from 
			 	package
			where
				'.$cond.'
			order by
				package.structure_id
		');
		$items = DB::fetch_all();
		require_once 'packages/core/includes/utils/category.php';
		category_indent($items);
		$this->parse_layout('list',array(
				'items'=>$items,
				'total'=>sizeof($items)
			)
		);
	}
}
?>
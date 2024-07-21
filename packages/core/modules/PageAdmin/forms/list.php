<?php
class ListPageAdminForm extends Form
{
	function ListPageAdminForm()
	{
		Form::Form('ListPageAdminForm');
	}
	function draw()
	{
		$cond=PageAdmin::get_cond();
		// order by
		$order_field=array('page.name','page.title_1','package.name');
		$order_default='page.name';
		$item_per_page = Module::$current->get_setting('item_per_page',2500);
		$sql='
			SELECT 
				count(*) as total
			FROM
				page
				INNER JOIN package on package.id=page.package_id  
			WHERE
				'.$cond.'
		';
		$total = DB::fetch($sql,'total');
		require_once 'packages/core/includes/utils/paging.php';
		$paging = paging($total,$item_per_page,array('package_id'));
		$items = PageAdminDB::get_page($cond,$order_field,$order_default,$item_per_page);
		foreach($items as $id=>$item)
		{
			$items[$id]['href'] = Url::build('edit_page',array('id'=>$item['id']));
		}
		$sql='
			select
				id,name,structure_id
			from
				package
			order by
				structure_id
		';
		$packages = DB::fetch_all($sql);
		$i=1;
		foreach ($items as $key=>$value)
		{
			$items[$key]['i']=$i++;
		}
		$this->parse_layout('list',array(
				'items'=>$items,
				'paging'=>$paging,
				'total'=>$total,
				'package_id_list'=>array(''=>'')+String::get_list($packages)  
			)
		);
	}
}
?>
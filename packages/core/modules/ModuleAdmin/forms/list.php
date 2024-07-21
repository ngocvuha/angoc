<?php
class ListModuleAdminForm extends Form
{
	function ListModuleAdminForm()
	{
		Form::Form('ListModuleAdminForm');
	}
	function get_cond(){
		$cond = '1=1';
		if(Url::get('package_id')){
			$cond.=' and '.IDStructure::child_cond(DB::structure_id('package',Url::get('package_id')));
		}
		if(Url::get('search_name')){
			$cond.=" and module.name LIKE '%".Url::get('search_name')."%'";
		}
		if(Url::get('search_title_1')){
			$cond.=" and module.title_1 LIKE '%".Url::get('search_title_1')."%'";
		}
		return $cond;
	}
	function draw()
	{
		$cond=$this->get_cond();
		// order by
		$order_field=array('module.name','module.title_1','package.name');
		$order_default='module.name';
		$item_per_page = Module::$current->get_setting('item_per_page',50);
		$sql='
			SELECT
				count(*) as total
			FROM
				module
				LEFT OUTER JOIN package on package.id=module.package_id 
			WHERE
				'.$cond.'
		';
		$total = DB::fetch($sql,'total');
		require_once 'packages/core/includes/utils/paging.php';
		$paging = paging($total,$item_per_page);
		DB::query('
			SELECT 
				module.id
				,module.name
				,module.title_'.Portal::language().' as title
				,package.name as package_id 
				,module.image_url
				,module.privilege
				,module.fun_extend
			FROM 
			 	module
				INNER JOIN package on package.id=module.package_id 
			WHERE
				'.$cond.'
			'.String::order_by_sql($order_field,$order_default).'
		');
		$items = DB::fetch_all();
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
			if (Url::check('page_id'))
			{
				$items[$key]['href']=Url::build('edit_page',array('module_id'=>$value['id'],'id'=>$_REQUEST['page_id'],'region','after','replace','href','container_id'));
			}
			else 
			{
				$items[$key]['href']=Url::build_current(array('cmd'=>'edit','package_id','name','id'=>$value['id']));
			}
			$items[$key]['page_name']=DB::fetch('select page.name from block inner join page on page.id=block.page_id where module_id='.$items[$key]['id'].'','name');
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
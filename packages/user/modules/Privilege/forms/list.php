<?php
class ListPrivilegeForm extends Form
{
	function ListPrivilegeForm()
	{
		Form::Form('ListPrivilegeForm');
	}
	function draw()
	{
		$this->map=array();
		$cond=$this->get_condition();
		// order by
		$order_field=array('privilege.name');
		$order_default='privilege.name';
		$item_per_page = Url::get('item_per_page',50);
		$this->map['total'] = PrivilegeDB::count_function_privilege($cond);
		require_once 'packages/core/includes/utils/paging.php';
		$this->map['paging'] = paging($this->map['total'],$item_per_page,array('order_by','search_privilege'));
		$this->map['items']=PrivilegeDB::get_function_privilege($cond,String::order_by_sql($order_field,$order_default),$item_per_page);
		$this->parse_layout('list',$this->map);
	}
	function get_condition()
	{
		$cond = '1=1';
		// account
		if(Url::get('search_privilege')){
			$cond.= " and privilege.name LIKE '%".Url::get('search_privilege')."%'";
		}
		return $cond;
	}
}
?>
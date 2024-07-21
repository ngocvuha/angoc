<?php
class ListModeratorForm extends Form
{
	function ListModeratorForm()
	{
		Form::Form('ListModeratorForm');
	}
	function draw()
	{
		$this->map=array();
		$cond=$this->get_condition();
		// order by
		$order_field=array('account_privilege.id');
		$order_default='account_privilege.id';
		$item_per_page = Url::get('item_per_page',50);
		$this->map['total'] = sizeof(ModeratorDB::get_total_item($cond));
		require_once 'packages/core/includes/utils/paging.php';
		$this->map['paging'] = paging($this->map['total'],$item_per_page,array('order_by','search_id','search_privilege'));
		$this->map['items'] = ModeratorDB::get_items($cond,String::order_by_sql($order_field,$order_default),$item_per_page);
		$this->map['search_privilege_list']=array(''=>'')+String::get_list(ModeratorDB::get_privilege());
		//System::debug(ModeratorDB::get_items($this->cond, $this->item_per_page));
		$this->parse_layout('list',$this->map);
	}
	function get_condition()
	{
		$cond = '1=1';
		// account
		if(Url::get('search_id')){
			$cond.= ' and account_privilege.account_id LIKE \'%'.Url::get('search_id').'%\'';
		}
		// privilege
		if(Url::get('search_privilege')){
			$cond.= ' and privilege.id='.Url::get('search_privilege');
		}
		return $cond;
	}
}
?>
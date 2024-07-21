<?php
class ListManageHelperForm extends Form
{
	function ListManageHelperForm()
	{
		Form::Form('ListManageHelperForm');
	}
	function draw()
	{
		$this->map=array();
		$cond=$this->get_condition();
		// order by
		$order_field=array('helper.name_'.Portal::get_setting('default_language'),'tinhnang.name_'.Portal::get_setting('default_language'));
		$order_default='tinhnang.structure_id';
		require_once 'packages/core/includes/utils/paging.php';
		$item_per_page = Url::get('item_per_page',50);
		$this->map['total'] = ManageHelperDB::get_total_item($cond);
		$this->map['paging'] = paging($this->map['total'],$item_per_page,array('order_by','search_name','category_id','search_id_f','search_id_t'));
		$this->map['items'] = ManageHelperDB::get_items($cond,String::order_by_sql($order_field,$order_default),$item_per_page);		
		$this->map['category_id'] = Menu::$category;		
		$this->parse_layout('list',$this->map);
	}
	function get_condition()
	{
		$cond = '1=1';
		// name
		if(Url::get('search_name')){
			$cond.= ' and helper.name_'.Portal::get_setting('default_language').' LIKE "%'.Url::get('search_name').'%"';
		}
		// category_id
		if($category_id=Url::get('category_id') and DB::exists_id('tinhnang',$category_id)){
			$cond.= ' and '.IDStructure::child_cond(DB::structure_id('tinhnang',$category_id));
		}
		// id
		if(Url::get('search_id_f')){
			$cond.= ' and helper.id>='.Url::iget('search_id_f');
		}
		if(Url::get('search_id_t')){
			$cond.= ' and helper.id<='.Url::iget('search_id_t');
		}
		return $cond;
	}
}
?>

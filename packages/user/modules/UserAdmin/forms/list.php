<?php
class ListUserAdminForm extends Form
{
	function ListUserAdminForm()
	{
		Form::Form('ListUserAdminForm');
	}
	function draw()
	{
		$this->map=array();
		$cond=$this->get_condition().' and account.type=\'USER\' and account.id!=\'admin\'';
		// order by
		$order_field=array('account.id','account.email','account.is_active','account.is_block','account.create_date','account.last_online_time');
		$order_default='account.id';
		$item_per_page = Url::get('item_per_page',50);
		$this->map['total'] = UserAdminDB::get_total_item($cond);
		require_once 'packages/core/includes/utils/paging.php';
		$this->map['paging'] = paging($this->map['total'],$item_per_page,array('order_by','search_id','search_email','search_is_active','search_is_block','search_create_date_f','search_create_date_t','search_last_online_time_f','search_last_online_time_t'));
		$this->map['items'] = UserAdminDB::get_items($cond,String::order_by_sql($order_field,$order_default),$item_per_page);
		$this->map['yesno']=array('0'=>'','1'=>Portal::language('yes'),'2'=>Portal::language('no'));
		$this->map['search_is_active_list']=$this->map['search_is_block_list']=$this->map['yesno'];
		$this->parse_layout('list',$this->map);
	}
	function get_condition()
	{
		$cond = '1=1';
		// account
		if(Url::get('search_id')){
			$cond.= ' and account.id LIKE \'%'.Url::get('search_id').'%\'';
		}
		// email
		if(Url::get('search_email')){
			$cond.= ' and account.email LIKE \'%'.Url::get('search_email').'%\'';
		}
		// is_active
		if(Url::get('search_is_active')==1){
			$cond.= ' and account.is_active';
		}elseif(Url::get('search_is_active')==2){
			$cond.= ' and !account.is_active';
		}
		// is_block
		if(Url::get('search_is_block')==1){
			$cond.= ' and account.is_block';
		}elseif(Url::get('search_is_block')==2){
			$cond.= ' and !account.is_block';
		}
		// create_date
		if($time=Url::get('search_create_date_f')){
			$cond.= ' and account.create_date>='.Date_Time::to_time($time);
		}
		if($time=Url::get('search_create_date_t')){
			$cond.= ' and account.create_date<='.Date_Time::to_time($time);
		}
		// last_online_time
		if($time=Url::get('search_last_online_time_f')){
			$cond.= ' and account.time>='.Date_Time::to_time($time);
		}
		if($time=Url::get('search_last_online_time_t')){
			$cond.= ' and account.time<='.Date_Time::to_time($time);
		}
		return $cond;
	}
}
?>

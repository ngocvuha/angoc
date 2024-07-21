<?php
class ListQuanLySVForm extends Form
{
	function ListQuanLySVForm()
	{
		Form::Form('ListQuanLySVForm');
	}
	function draw()
	{
		//
		/*for($i=1;$i<20;$i++){
			$row = array(
				'id'=>'gv'.$i,
				'password'=>User::encode_password('123456'),
				'type'=>'SV',
				'HoDem'=>'Giao Vien',
				'Ten'=>$i,
				'GioiTinh'=>1,
				'tblLopNienChe_id'=>41,
				'MaSV'=>'gv'.$i,
				'is_active'=>1,
				'is_block'=>0,
				'cache_privilege'=>''
			);
			DB::insert('account',$row);
		}*/
		
		$this->map=array();
		$cond=$this->get_condition().' and account.type=\'SV\' and account.id!=\'admin\'';
		// order by
		$order_field=array('account.id','account.email','account.is_active','account.is_block','account.create_date','account.last_online_time');
		$order_default='account.id';
		$item_per_page = Url::get('item_per_page',50);
		$this->map['total'] = QuanLySVDB::get_total_item($cond);
		require_once 'packages/core/includes/utils/paging.php';
		$this->map['paging'] = paging($this->map['total'],$item_per_page,array('order_by','search_id','search_email','search_is_active','search_is_block','search_create_date_f','search_create_date_t','search_last_online_time_f','search_last_online_time_t'));
		$this->map['items'] = QuanLySVDB::get_items($cond,String::order_by_sql($order_field,$order_default),$item_per_page);
		$this->map['yesno']=array('0'=>'','1'=>Portal::language('yes'),'2'=>Portal::language('no'));
		$this->map['search_is_active_list']=$this->map['search_is_block_list']=$this->map['yesno'];
		$this->map['tblLopNienChe_list']=array(''=>'')+String::get_list(DB::select_all('tblLopNienChe'));
		$this->parse_layout('list',$this->map);
	}
	function get_condition()
	{
		$cond = '1=1';
		// account
		if(Url::get('search_MaSV')){
			$cond.= " and (account.MaSV) LIKE '%".Url::get('search_MaSV')."%'";
		}
		// email
		if(Url::get('search_email')){
			$cond.= ' and account.email LIKE \'%'.Url::get('search_email').'%\'';
		}
		// email
		if($tblLopNienChe = Url::iget('tblLopNienChe')){
			$cond.= " and account.tblLopNienChe_id = '".$tblLopNienChe."'";
		}
		// is_active
		if(Url::get('search_is_active')==1){
			$cond.= ' and account.is_active=1';
		}elseif(Url::get('search_is_active')==2){
			$cond.= ' and account.is_active=0';
		}
		// is_block
		if(Url::get('search_is_block')==1){
			$cond.= ' and account.is_block=1';
		}elseif(Url::get('search_is_block')==2){
			$cond.= ' and account.is_block=0';
		}
		// create_date
		if($time=Url::get('search_create_date_f')){
			$cond.= ' and account.create_date>='.Date_Time::to_time($time);
		}
		if($time=Url::get('search_create_date_t')){
			$cond.= ' and account.create_date<='.(Date_Time::to_time($time)+86400);
		}
		// last_online_time
		if($time=Url::get('search_last_online_time_f')){
			$cond.= ' and account.time>='.Date_Time::to_time($time);
		}
		if($time=Url::get('search_last_online_time_t')){
			$cond.= ' and account.time<='.(Date_Time::to_time($time)+86400);
		}
		return $cond;
	}
}
?>

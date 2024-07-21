<?php
class ListDSPhongThiForm extends Form
{
	function ListDSPhongThiForm()
	{
		Form::Form('ListDSPhongThiForm');
	}
	function on_submit(){
		
	}
	function draw()
	{
		$this->map = array();
		$cond=$this->get_condition();
		// order by
		$order_field=array('tblphongthi.Ten','tblphongthi.T_BatDau');
		$order_default='tblphongthi.id desc';
		require_once 'packages/core/includes/utils/paging.php';
		$this->map['status'] = array(
			1=>'Chưa Thi',2=>'Đang Thi',3=>'Đã Thi'
		);
		$item_per_page = Url::get('item_per_page',20);
		$this->map['total'] = DSPhongThiDB::get_total_item($cond);
		$this->map['paging'] = paging($this->map['total'],$item_per_page,array('order_by','search_name','search_status','search_time_f','search_time_t','item_per_page'));
		$this->map['items'] = DSPhongThiDB::get_items($cond,String::order_by_sql($order_field,$order_default),$item_per_page);
		$this->map['search_status_list'] = array(''=>'')+$this->map['status'];
		$this->map['index'] = (page_no()-1)*$item_per_page+1;
		
		if($this->map['items']){
			foreach($this->map['items'] as $k=>$v){
				$users = DB::fetch_all("select id,TrangThai from tblDSDuThi where IDPhongThi=".$k);
				$this->map['items'][$k]['TongSoThiSinh'] = count($users);
				$this->map['items'][$k]['DaThi'] = 0;
				foreach($users as $user){
					if($user['TrangThai']==4){
						$this->map['items'][$k]['DaThi']++;
					}
				}
			}
		}
		$this->parse_layout('list',$this->map);
	}
	function get_condition()
	{
		$cond = '1=1';
		// name
		if(Url::get('search_name')){
			$cond.= ' and tblphongthi.Ten LIKE \'%'.Url::get('search_name').'%\'';
		}
		// status
		if(Url::get('search_status')){
			$cond.= ' and tblphongthi.TrangThai=\''.Url::get('search_status').'\'';
		}
		// time
		if($time=Url::get('search_time_f')){
			$cond.= ' and tblphongthi.NgayThi>=\''.Date_Time::to_sql_date($time).'\'';
		}
		if($time=Url::get('search_time_t')){
			$cond.= ' and tblphongthi.NgayThi<=\''.Date_Time::to_sql_date($time).'\'';
		}
		//echo $cond;
		return $cond;
	}
}
?>

<?php
class ListPhanCongChamThiForm extends Form
{
	function ListPhanCongChamThiForm()
	{
		Form::Form('ListPhanCongChamThiForm');
	}
	function on_submit(){
		
	}
	function draw()
	{
		//update cau hoi
		$items = DB::fetch_all('select id,NoiDungCauHoi from tblCauHoi');
		foreach($items as $id=>$item){
			//DB::update_id('tblCauHoi',array('NoiDungCauHoi_2'=>$item['NoiDungCauHoi']),$id);
		}
		
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
		$this->map['total'] = PhanCongChamThiDB::get_total_item($cond);
		$this->map['paging'] = paging($this->map['total'],$item_per_page,array('order_by','search_name','search_status','search_time_f','search_time_t','item_per_page'));
		$this->map['items'] = PhanCongChamThiDB::get_items($cond,String::order_by_sql($order_field,$order_default),$item_per_page);
		$this->map['search_status_list'] = array(''=>'')+$this->map['status'];
		$this->map['index'] = (page_no()-1)*$item_per_page+1;
		if($event_id=Url::iget('event_id') and DB::exists_id('event',$event_id)){
			$this->map['event'] = true;
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

<?php
class QuanLyPhongThi extends Module
{
	function QuanLyPhongThi($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(Url::get('cmd'))
			{
				case 'add':
				case 'edit':
					$this->edit_cmd();
					break;
				case 'update':
					$this->update_cmd();
					break;
				case 'delete':
					$this->delete_cmd();
					break;
				case 'get_ts':
					$this->get_ts();
					break;
				case 'get_lop':
					$this->get_lop();
					break;
				case 'get_nhom':
					$this->get_nhom();
					break;
				default:
					$this->list_cmd();
					break;
			}
		}else{
			Url::access_denied();
		}
	}
	function get_nhom(){
		$term = $_GET["term"];
		$sql = "select
						id,Ten
					from
						tblNhom
					where
						Ten like '%".$term."%'
					ORDER BY Ten
				";
		$lop_list = DB::fetch_all($sql);

		$result = array();
		foreach ($lop_list as $k=>$v) {
			$company = array('label'=>$v['Ten'],'value'=>$k);
			array_push( $result, $company );
		}
		echo json_encode( $result );
		exit();
	}
	function get_lop(){
		$term = $_GET[ "term" ];
		$sql = "select
						id,name
					from
						tblLopNienChe
					where
						status = 'SHOW' and name like '%".$term."%'
					order by tblLopNienChe.structure_id
				";
		$lop_list = DB::fetch_all($sql);

		$result = array();
		foreach ($lop_list as $k=>$v) {
			$company = array('label'=>$v['name'],'value'=>$k);
			array_push( $result, $company );
		}
		echo json_encode( $result );
	}
	function delete_cmd(){
		if($items=Url::get('selected_ids') and is_array($items) and sizeof($items)>0 and User::can_delete())
		{
			if($ids=implode(',',$items)){
				DB::delete('tbldsduthi','IDPhongThi IN ('.$ids.')');
				DB::delete('tblphongthi','ID IN ('.$ids.')');
				DB::delete('tblChamThi','IDPhongThi IN ('.$ids.')');
			}
		}
		Url::redirect_current();
	}
	function update_cmd(){
		if(User::can_moderator()){
			require_once 'forms/update.php';
			$this->add_form(new UpdateQuanLyPhongThiForm());
		}
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListQuanLyPhongThiForm());
	}
	function edit_cmd()
	{
		if(User::can_edit(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditQuanLyPhongThiForm());
		}else{
			Url::access_denied();
		}
	}
	function get_ts(){
		$lop = Url::iget('lop');
		$nhom = Url::iget('nhom');
		if($lop){
			$cond = " and tblLopNienChe.id = ".$lop."";
			$inner = '';
		}
		if($nhom){
			$cond = " and tblNhomAccount.NhomID = ".$nhom."";
			$inner = 'inner join tblNhomAccount on tblNhomAccount.AccountID = account.id';
		}
		$sql = "select
					account.id,account.HoDem,account.Ten,tblLopNienChe.name,account.MaSV
				from
					account
					inner join tblLopNienChe on tblLopNienChe.id = account.tblLopNienChe_id
					".$inner."
				where
					account.type = 'SV'".$cond."
			";
		$ts = DB::fetch_all($sql);
		if($ts){
			$arr = array('size'=>count($ts),'content'=>'');
			foreach($ts as $k=>$v){
				$arr['content'] .= '<option value="'.$k.'">'.$v['MaSV'].' - '.$v['HoDem'].' '.$v['Ten'].'</option>';
			}
			echo json_encode($arr);
		}		
		exit();
	}
}
?>

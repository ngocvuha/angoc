<?php
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY vuonggialong
******************************/
class SI
{
	//Cac ham thao tac voi IDStructure
	//Tra ve structure_id cua ban ghi co ma so $id trong bang $table
	//$table: Ten bang can tim
	//$id: id can tim
	
	// Tra ve id cua ban ghi trong bang $table co $structure_id
	function si_id($table,$structure_id)
	{
		$row=DB::select($table,'structure_id="'.$structure_id.'"');
		return $row['id'];
	}
	// Tra ve structure_id cua ban ghi trong bang $table co $structure_id
	function structure_id($table,$id)
	{
		$row=DB::select($table,'id="'.$id.'"');
		return $row['structure_id'];
	}
	//Tra ve id cua ban ghi co $structure_id trong bang $table
	//Khong nen lam dung ham nay 
	//$table: Ten bang can tim
	//$structure_id: structure_id can tim
	function si_parent($table,$structure_id, $extra='')
	{
		$arr=explode('.',$structure_id);
		unset($arr[sizeof($arr)-1]);
		$parent_structure_id=implode('.',$arr);
		if($structure_id==ID_ROOT){
			$parent_structure_id=ID_ROOT;
		}
		$row = DB::select($table,'structure_id="'.$parent_structure_id.'"');
		return $row;
	}
	function si_parent_id($table,$structure_id, $extra='')
	{
		$row = SI::si_parent($table,$structure_id, $extra);
		return $row['id'];
	}
	//doi ban ghi tu cho $structure_id cu sang structure_id moi dong thoi doi luon cac ban ghi con
	//$table: Ten bang can chuyen
	//$structure_id: structure_id can chuyen
	//$new_id: structure_id moi
	//$extra_cond: Dieu kien bo sung trong cau lenh select
	function si_change($table,$structure_id, $new_id, $extra_cond='')
	{
		if($structure_id != $new_id)
		{
			// Lấy tất cả các con của $structure_id kể cả $structure_id
			$old=DB::select_all($table,IDStructure::child_cond($structure_id),$table.'.structure_id');
			// Lấy độ dài của $structure_id
			$oldlen=strlen($structure_id);
			foreach($old as $k=>$v){
				$new_structure_id=$new_id.substr($v['structure_id'],$oldlen);
				DB::update_id($table,array('structure_id'=>$new_structure_id),$k);
			}
		}
	}
	function si_move($table, $structure_id, $parent_id, $extra_cond='')
	{
		if(IDStructure::parent($structure_id)!=$parent_id)
		{
			if(!IDStructure::is_child($parent_id, $structure_id))
			{
				$new_id=SI::si_child($table,$parent_id, $extra_cond);
				SI::si_change($table,$structure_id, $new_id, $extra_cond);
				return $new_id;
			}else{
				return false;
			}
		}else{
			return $structure_id;
		}
	}
	//Tra ve structure_id con của $structure_id trong bảng $table
	//$table: ten bang can tim
	//$structure_id: can tinh 
	//$extra_cond: Dieu kien bo sung trong cau lenh select
	function si_child($table,$structure_id,$extra_cond = '')
	{
		//Lay tat cac cac id con truc tiep cua $id
		$rows = DB::select_all($table,IDStructure::direct_child_cond($structure_id).$extra_cond,$table.'.structure_id desc');
		if($rows){
			$end=array_shift($rows);
			$arr=explode('.',$end['structure_id']);
			$arr[sizeof($arr)-1]+=1;
			return implode('.',$arr);
		}else{
			return $structure_id.'.1';
		}
	}
	function si_move_position($table,$extra='')
	{
		require_once 'packages/core/includes/system/si_database.php';
		$parent = SI::si_parent($table,$_REQUEST['id'],$extra);
		$category=DB::exists_id($table,$_REQUEST['id']);
		if(Url::check(array('cmd'=>'move_up')))
		{
			$move[0]='<';
			$move[1]='desc';
		}
		else
		{
			$move[0]='>';
			$move[1]='asc';
		}
		if(DB::query('
			select *
			from `'.$table.'`
			where '.IDStructure::direct_child_cond($parent['structure_id']).'
				and structure_id'.$move[0].$category['structure_id'].'
				'.$extra.'
			order by structure_id '.$move[1]))
		{
			if($row=DB::fetch())
			{
				$si = SI::si_child($table,$parent['structure_id'],$extra);
				SI::si_change($table,$category['structure_id'],$si,$extra);
				SI::si_change($table,$row['structure_id'],$category['structure_id'],$extra);
				SI::si_change($table,$si,$row['structure_id'],$extra);
			}
		}
	}
}
?>
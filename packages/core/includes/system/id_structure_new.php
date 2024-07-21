<?php
define('ID_ROOT', "1"); // structure_id goc
class IDStructure
{
	/* Trả về mảng các con của $structure_id trong bảng $table
	*/
	function have_child($table,$structure_id, $extra_cond='', $database=false)
	{
		return DB::select($table,IDStructure::child_cond($structure_id, true).$extra_cond);
	}
	/* Trả về $structure_id cha của $structure_id
	*/
 	function parent($structure_id)
	{
		if($structure_id==ID_ROOT){
			return false;
		}else{
			$arr=explode('.',$structure_id);
			$count=sizeof($arr);
			unset($arr[$count-1]);
			return implode('.',$arr);
		}
	}
	/* Trả về level của $structure_id
	*/
	function level($structure_id)
	{
		return sizeof(explode('.',$structure_id));
	}

	/* Trả về $structure_id kế sau $structure_id
	*/
	function next($structure_id)
	{
		if($structure_id==ID_ROOT){
			return false;
		}else{
			$arr=explode('.',$structure_id);
			$count=sizeof($arr);
			$arr[$count-1]+=1;
			if(!($arr[$count-1]%10)){
				$arr[$count-1]+=1;
			}
			return implode('.',$arr);
		}
	}
	/* Kiểm tra $structure_id có phải là con của $parent_id không
	** $structure_id: structure_id con
	** $parent_id: structure_id cha
	*/
	function is_child($structure_id, $parent_id)
	{
		// level của con phải lơn hơn level của cha
		$check=true;
		if(IDStructure::level($structure_id) <= IDStructure::level($parent_id)){
			$check=false;
		}else{
			$arr_child=explode('.',$structure_id);
			$arr_parent=explode('.',$parent_id);
			for($i=0;$i<sizeof($arr_parent);$i++){
				if($arr_child[$i]!=$arr_parent[$i]) $check = false;
			}
		}
		return $check;
	}
	// Trả về điều kiện truy vấn lấy ra từ gốc tới $structure_id
	function path_cond($structure_id)
	{
		$cond='(';
		$arr=explode('.',$structure_id);
		$id='';
		for($i=0;$i<sizeof($arr);$i++){
			$id.=($i!=0?'.':'').$arr[$i];
			$cond.=($i!=0?' or ':'').'structure_id="'.$id.'"';
		}
		$cond.=')';
		return $cond;
	}
	/* Trả về tất cả các con của $structure_id
	** $except_me: có loại trừ chính $structure_id này không (true là có, mặc định là false)
	** $extra: là tên bẳng (cần trong trường hợp xử lý >=2 bảng cùng có trường structure_id)
	*/
	function child_cond($structure_id, $except_me=false,$extra = '')
	{	
		if($except_me)
		{
			return '('.$extra.'`structure_id` LIKE "'.$structure_id.'.%")';
		}
		else
		{
			return '('.$extra.'`structure_id` LIKE "'.$structure_id.'.%" or '.$extra.'`structure_id`="'.$structure_id.'")';
		}
	}
	/* Trả về biểu thức điều kiện lấy ra các con trực tiếp của $structure_id (trực tiếp nghĩa là có level=level($structure_id)+1)
	** $structure_id: là structure_id cha cần lấy các con trực tiếp
	*/
	function direct_child_cond($structure_id, $child_level=1)
	{
		$level = IDStructure::level($structure_id);
		return '('.IDStructure::child_cond($structure_id, true).' and structure_id NOT LIKE "'.$structure_id.'.%.%")';
	}
}
?>
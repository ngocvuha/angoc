<?php
/*----------------------------------------------------------------------------------
Lop IDStructure
Tap hop cac ham xu ly voi cac bang co structure_id, la mot so mo ta cap do, vi tri cua ban ghi trong cay phan cap
Author:
Vuong Gia Long
18/4/2005
Editor:
Trinh Cong Minh
2012
----------------------------------------------------------------------------------*/
define('ID_BASE', 100.0);//So ban ghi toi da o cung mot cap thuoc mot goc
define('ID_MAX_LEVEL', 9);//So level toi da
define('ID_ROOT', "1000000000000000000");//ID goc

//Tap hop cac ham thao tac voi cac bang co ID co cau truc cay
class IDStructure
{
	function have_child($table,$structure_id, $extra_cond='', $database=false)
	{
		if(isset($structure_id) and $structure_id)
			return DB::select($table,IDStructure::child_cond($structure_id, true).$extra_cond);
		else
			return 0;
	}
	//Tra ve structure_id cha cua $structure_id
	//$structure_id: structure_id can tinh
 	function parent($structure_id,$level_parent=false)
	{
		if(!isset($structure_id) or $structure_id==ID_ROOT) return 0;
		$level=IDStructure::level($structure_id);
		if($level==$level_parent) return $structure_id;
		$structure_id=bcadd($structure_id,0,0);
		if($level_parent===false) $level_parent = $level-1;
		if($level_parent > $level)	return false;
		while($level>$level_parent){
			$structure_id{$level*2-1}='0';
			$structure_id{$level*2}='0';
			$level--;
		}
		return bcadd($structure_id,0,0);
	}
	//Tra ve level cua $structure_id
	//$structure_id: structure_id can tinh
	function level($structure_id)
	{
		$level = 0;
		if(isset($structure_id) and $structure_id>=ID_ROOT)
		{
			$i = 0;
			$st = '_'.bcadd($structure_id,0);
			//$st = '_'.number_format($structure_id,0,'','');
			while(substr($st,$level*2,2)!='00')
			{
				$level++;
				if($level==10){
					break;
				}
			}
			$level--;
		}
		return $level;
	}
	//Tra ve structure_id ke sau cua $structure_id
	//$structure_id: structure_id can tinh
	function next($structure_id)
	{
		if(isset($structure_id) and $structure_id)
			return bcadd($structure_id,bcpow(ID_BASE,ID_MAX_LEVEL - IDStructure::level($structure_id),0),0);
		else
			return 0;
	}
	//Kiem tra $structure_id co phai la con cua $parent_id khong
	//$structure_id: structure_id con
	//$parent_id: structure_id cha
	function is_child($structure_id, $parent_id)
	{
		if(isset($structure_id) and isset($parent_id) and $structure_id and $parent_id)
			return $structure_id > $parent_id and $structure_id < IDStructure::next($parent_id);
		else
			return 0;
	}
	//Tra ve dieu kien de truy van ra duong dan cua idstruture, tu con den cha
	function path_cond($structure_id)
	{
		if(isset($structure_id) and $structure_id){
			$path = $structure_id;
			while($structure_id=IDStructure::parent($structure_id))
			{
				$path .= ','.$structure_id;
			}
			return '(FIND_IN_SET(structure_id,"0,'.$path.'")>0)';
		}else{
			return 0;
		}
	}
	//Tra ve bieu thuc dieu kien truy van tat ca con cua $id
	//$structure_id: can tinh dieu kien
	//$except_me: co loai tru chinh $structure_id nay khong
	
	function child_cond($structure_id, $except_me = false,$extra = '')
	{
		if(isset($structure_id) and $structure_id){
			if($except_me)
				return '('.$extra.'structure_id > '.$structure_id.' and '.$extra.'structure_id < '.IDStructure::next($structure_id).')';
			else
				return '('.$extra.'structure_id >= '.$structure_id.' and '.$extra.'structure_id < '.IDStructure::next($structure_id).')';
		}else{
			return 0;
		}
	}
	//Tra ve bieu thuc dieu kien truy van tat ca con truc tiep cua $id (truc tiep nghia la co level = level ($structure_id)-1)
	//$structure_id: can tinh dieu kien
	function direct_child_cond($structure_id, $child_level=1)
	{
		if(isset($structure_id) and $structure_id){
			$level = IDStructure::level($structure_id);
			$child_offset = bcadd(bcpow(ID_BASE, ID_MAX_LEVEL-($level+$child_level),0),0,0);
			return '('.IDStructure::child_cond($structure_id, true).' and (structure_id % '.$child_offset.'=0)) ';
		}else{
			return 0;
		}
	}
}
?>
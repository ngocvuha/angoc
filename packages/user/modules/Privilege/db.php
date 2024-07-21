<?php
class PrivilegeDB{
	function get_function($cond,$privilege_id=0){
		if($privilege_id){
			$id=$privilege_id;
		}elseif(Url::get('id')){
			$id=Url::nget('id');
		}else{
			$id=0;
		}
		if($id){
			$privilege_module = DB::fetch_all('select privilege_module.*,privilege_module.module_id as id from privilege_module where privilege_id='.$id);
			$function=array();
			$dir = 'cache/menu/m_'.$id.'.cache.php';
			if(file_exists($dir)){
				require_once $dir;
				$function=$items;
			}
		}
		//System::debug($function);
		$sql = '
			SELECT
				tinhnang.*
			FROM
				tinhnang
			WHERE
				'.$cond.'
			ORDER BY
				tinhnang.structure_id
		';
		$items = DB::fetch_all($sql);
		//System::debug($items);
		foreach($items as $key=>$value){
			if(isset($privilege_module[$value['m_id']])){
				$items[$key]['view']=$privilege_module[$value['m_id']]['view'];
				$items[$key]['view_detail']=$privilege_module[$value['m_id']]['view_detail'];
				$items[$key]['add']=$privilege_module[$value['m_id']]['add'];
				$items[$key]['edit']=$privilege_module[$value['m_id']]['edit'];
				$items[$key]['delete']=$privilege_module[$value['m_id']]['delete'];
				$items[$key]['special']=$privilege_module[$value['m_id']]['special'];
				$items[$key]['reserve']=$privilege_module[$value['m_id']]['reserve'];
				$items[$key]['admin']=$privilege_module[$value['m_id']]['admin'];
			}else{
				if(isset($function[$key])) $items[$key]['view']=1;else 
				$items[$key]['view']=0;
				$items[$key]['view_detail']=0;
				$items[$key]['add']=0;
				$items[$key]['edit']=0;
				$items[$key]['delete']=0;
				$items[$key]['special']=0;
				$items[$key]['reserve']=0;
				$items[$key]['admin']=0;
			}
		}
		return $items;
	}
	function get_function_extend($cond){
		$sql = '
			SELECT
				module.id
				,module.title_'.Portal::language().' as title
				,module.name
			FROM
				module
				LEFT OUTER JOIN privilege_module ON module.id=privilege_module.module_id
			WHERE
				'.$cond.'
			ORDER BY
				module.title_1
		';
		$items = DB::fetch_all($sql);
		$privilege_module = array();
		if(Url::get('cmd')=='grant' and $id=Url::nget('id')){
			$privilege_module = DB::fetch_all('select privilege_module.*,privilege_module.module_id as id from privilege_module where privilege_id='.$id);
		}
		foreach($items as $key=>$value){
			if(isset($privilege_module[$value['id']])){
				$items[$key]['view']=$privilege_module[$value['id']]['view'];
				$items[$key]['view_detail']=$privilege_module[$value['id']]['view_detail'];
				$items[$key]['add']=$privilege_module[$value['id']]['add'];
				$items[$key]['edit']=$privilege_module[$value['id']]['edit'];
				$items[$key]['delete']=$privilege_module[$value['id']]['delete'];
				$items[$key]['special']=$privilege_module[$value['id']]['special'];
				$items[$key]['reserve']=$privilege_module[$value['id']]['reserve'];
				$items[$key]['admin']=$privilege_module[$value['id']]['admin'];
			}else{
				$items[$key]['view']=0;
				$items[$key]['view_detail']=0;
				$items[$key]['add']=0;
				$items[$key]['edit']=0;
				$items[$key]['delete']=0;
				$items[$key]['special']=0;
				$items[$key]['reserve']=0;
				$items[$key]['admin']=0;
			}
		}
		return $items;
	}
	function get_menu($cond){
		$sql = '
			SELECT
				tinhnang.id
			FROM
				tinhnang
				INNER JOIN module ON tinhnang.m_id=module.id
				INNER JOIN privilege_module ON module.id=privilege_module.module_id
			WHERE
				'.$cond.'
			ORDER BY
				tinhnang.structure_id
		';
		return $items = DB::fetch_all($sql);
	}
	function count_function_privilege($cond){
		return DB::fetch('
			SELECT 
				count(*) as total
			FROM 
			 	privilege
			WHERE
				'.$cond.'
		','total');
	}
	function get_function_privilege($cond,$order_by,$item_per_page){
		$page = page_no();
		$from = ($page-1)*$item_per_page;
		$to = $page*$item_per_page-1;
		$items = DB::fetch_all("
			select * from (
				SELECT
					ROW_NUMBER() OVER (".$order_by.") AS RowNumber,
					privilege.id,privilege.name
				FROM
					privilege
				WHERE
					".$cond.") as sub
			WHERE RowNumber BETWEEN ".$from." AND ".$to."
		");
		return $items;
	}
}
?>
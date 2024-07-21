<?php
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY vuonggialong
******************************/		
	function paging($totalitem, $itemperpage, $params=array(),$page_title='',$anchor='' , $numpageshow=5, $page_name='page_no', $page_label='')
	{
		$st = '';
		$new_row=array();
		if($params and is_array($params))
		{
			foreach($params as $key=>$value)
			{
				if(is_numeric($key)){
					if(Url::get($value)){
						$new_row[$value]=Url::get($value);
					}
				}else{
					$new_row[$key]=$value;
				}
			}
		}
		$page_title=$page_title?$page_title:Portal::$page['name'];
		$totalpage = ceil($totalitem/$itemperpage);
		if ($totalpage<2)
		{
			return;
		}
		$currentpage=page_no($page_name);
		$currentpage=round($currentpage);
		if($currentpage<=0 ||$currentpage>$totalpage)
		{
			$currentpage=1;
		}
		if($currentpage>($numpageshow/2))
		{
			$startpage = $currentpage-floor($numpageshow/2);
			if($totalpage-$startpage<$numpageshow)
			{
				$startpage=$totalpage-$numpageshow+1;
			}
		}
		else
		{
			$startpage=1;
		}
		if($startpage<1)
		{
			$startpage=1;
		}
		$st .= '<ul class="pagination">';
		if($page_label){
			$st.='<li class="paging-label">'.$page_label.' </li>';
		}
		//link to first
		if($startpage>1)
		{
			$st .= '<li><a href="'.Url::build($page_title,$new_row+array($page_name=>1),$anchor).'" rel="1" class="first ui-corner-tl ui-corner-bl fg-button ui-button ui-state-default"> |« </a></li>';
			
		}
		//Link den trang truoc
		if($currentpage>$startpage)
		{
			$st .= '<li><a href="'.Url::build($page_title,$new_row+array($page_name=>$currentpage-1),$anchor).'" rel="4" class="previous fg-button ui-button ui-state-default"> « </a></li>';
		}
		//Danh sach cac trang
		for($i=$startpage; $i<=$startpage+$numpageshow-1 and $i<=$totalpage; $i++)
		{
			if($i==$currentpage)
			{
				$st .= '<li class="active"><a>'.$i.'</a></li>';
			}else {
				$st .= '<li><a href="'.Url::build($page_title,$new_row+array($page_name=>$i),$anchor).'">'.$i.'</a></li>';
			}
		}
		//Trang sau
		if($currentpage<$totalpage)
		{
			$st .= '<li><a href="'.Url::build($page_title,$new_row+array($page_name=>$currentpage+1),$anchor).'"> » </a></li>';
		}
		if($i<=$totalpage)
		{
			$st .= '<li><a href="'.Url::build($page_title,$new_row+array($page_name=>$totalpage),$anchor).'"> »| </a></li>';
		}		
		$st .= '</ul>';
		return $st;
	}
	function page_ajax($totalitem,$itemperpage,$params=array(),$numpageshow = 10,$page_name = 'page_no',$page_label = '')
	{
		$ref = '';
		if($params)
		{
			if(is_array($params))
			{
				foreach($params as $key=>$value)
				{
					if(is_numeric($key)){
						if(Url::get($value)){
							$ref .= '&'.$value.'='.Url::get($value);
						}
					}else{
						$ref .= '&'.$key.'='.$value;
					}
				}
			}else
			{
				$ref = '&'.$params;
			}
		}
		$st = '';
		$totalpage = ceil($totalitem/$itemperpage);
		if ($totalpage<2)
		{
			return $st;
		}
		$st .= '<div class="paging-bound">';
		$currentpage=page_no($page_name);
		if($currentpage<=0 ||$currentpage>$totalpage)
		{
			$currentpage=1;
		}
		$st .= '<span class="paging-label">'.$page_label.' </span>';
	
		$startpage = $currentpage - floor($numpageshow/2);
		if($startpage < 1) 
		{
			$startpage  = 1;
		}
		$endpage = $startpage+ $numpageshow-1;
		if($endpage > $totalpage)
		{
			$endpage = $totalpage;
			if(($endpage -$numpageshow) > 1)
			{
				$startpage = $endpage -$numpageshow+1;
			}
		}
		if($startpage == 2){ $startpage = 1; }
		if($endpage == ($totalpage-1)){ $endpage = $totalpage; }
		if($currentpage > $startpage)
		{
			$st.= '<A class="paging-normal" onclick=\'ajaxForm("page_no='.($currentpage-1).$ref.'",'.Module::$current->data['id'].',"module_'.Module::$current->data['id'].'")\'>&laquo; '.Portal::language('preview_page').'</a>';
		}
		if($startpage > 2)
		{
			$st.= '<span id="1" onclick=\'ajaxForm("page_no=1'.$ref.'",'.Module::$current->data['id'].',"module_'.Module::$current->data['id'].'")\' class="paging-active">1....</span>';
		}
		for($i = $startpage; $i<= $endpage; $i++)
		{
			if($i==$currentpage)
			{
				
				$st.= '<span id="'.$i.'" onclick=\'ajaxForm("page_no='.$i.$ref.'",'.Module::$current->data['id'].',"module_'.Module::$current->data['id'].'")\' class="paging-active">'.$i.'</span>';
			}else
			{
				$st.= '<span id="'.$i.'" onclick=\'ajaxForm("page_no='.$i.$ref.'",'.Module::$current->data['id'].',"module_'.Module::$current->data['id'].'")\' class="paging-normal">'.$i.'</span>';
			}
		}
		if($endpage < ($totalpage - 1))
		{
			$st.= '<span id="'.$totalpage.'" onclick=\'ajaxForm("page_no='.$totalpage.$ref.'",'.Module::$current->data['id'].',"module_'.Module::$current->data['id'].'")\' class="paging-active">....'.$totalpage.'</span>';
		}
		if($currentpage < $endpage)
		{
			$st.='<A class="paging-normal" onclick=\'ajaxForm("page_no='.($currentpage+1).$ref.'",'.Module::$current->data['id'].',"module_'.Module::$current->data['id'].'")\'>'.Portal::language('next_page').' &raquo;</a>';
		}
		$st.='</div>';
		return $st;
	}
	function page_no($page_name='page_no')
	{
		if(Url::get($page_name) and Url::get($page_name)>0)
		{
			return intval(Url::get($page_name));	
		}else
		{
			return 1;
		}
		
	}
?>
<?php
class FooterForm extends Form
{
	function FooterForm()
	{
		Form::Form('FooterForm');
	}
	function draw()
	{
		$information_query_in_page='';		
		$total_query=0;
		$page_gen_time=number_format((microtime(true)-Portal::$page_start_time),4);
		if(DEBUG==1)
		{			
			$str='';
			if(isset($GLOBALS['information_query']) and count($GLOBALS['information_query'])>0)
			{
				foreach($GLOBALS['information_query'] as $key=>$value)
				{
					if($value['name']){
						$str.='<div style="font-weight:bold">Module '.$value['name'].' có '.$value['number_queries'].' truy vấn (thời gian: '.$value['timer'].'s).</div>';
						$query='';
						if(is_array($value['query']) and count($value['query'])>0)
						{
							foreach($value['query'] as $key_query=>$value_query)
							{
								$query.='<div style="color:red; padding:4px 20px; font-weight:normal;">'.$value_query.'</div>';
							}
						}
						$total_query+=$value['number_queries'];
						$str.=$query;
					}
				}
			}
			$information_query_in_page=$str;
		}
		$this->parse_layout('footer', array(
			'content'=>Portal::get_setting('footer_information_'.Portal::language()),
			'information_query_in_page'=>$information_query_in_page,
			'total_query'=>$total_query,
			'page_gen_time'=>$page_gen_time,
			'link_structure_page'=>Url::build('edit_page',array('id'=>Portal::$page['id']))
		));
	}
}
?>

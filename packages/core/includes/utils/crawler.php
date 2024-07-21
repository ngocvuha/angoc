<?php
class Feed
{
	static $html = '';
	static $items = array();
	function check_link($url,$host='')
	{
		if((strpos($url,'http://')===false) and (preg_match_all('/http:\/\/(.*)\.([a-z]+)\//',$host,$matches,PREG_SET_ORDER)))
		{
			$url = $matches[0][0].$url;
		}
		return $url;
	}
	function get_site($cond = 1)
	{
		return DB::fetch_all('
			SELECT
				site.*
			FROM
				site 
			WHERE
				'.$cond.'
			ORDER BY	
				site.id DESC
		');
	}
	function get_pattern($site_id)
	{
		return DB::fetch_all('
			SELECT
				*
			FROM
				site_structure
			WHERE
				site_id='.$site_id.'		
			ORDER BY
				id desc	
		');
	}
	function format_link($source,$format=false)
	{
		if($format)
		{
			$source = str_replace(' ','%20',$source);	
		}
		else
		{
			if(strrpos($source,'?')===true)
			{
				$source = substr($source,0,strrpos($source,'?'));
			}
			$source = str_replace(' ','',$source);	
		}
		return $source;
	}
	function save($sour,$dest)
	{
		$sour = Feed::format_link($sour,true);
		if(!@copy($sour,$dest)){
			$dest = '';
			//echo 'Copy image failed...<br />Source: '.$sour.'<br /><a href="'.Url::build_current().'">Click here to back!</a>';
		}
	}
	function parse_row($link,$pattern,$site)
	{
		$html = file_get_html($link);
		$item = array();
		if(isset($site['image_url']) and $site['image_url'])
		{
			$item['image_url'] = $site['image_url'];
		}
		$row = array();
		if($pattern)
		{
			require_once 'packages/core/includes/utils/vn_code.php';
			require_once 'packages/core/includes/utils/search.php';
			foreach($pattern as $key=>$value)
			{
				$element_delete = $value['element_delete'];
				if($value['extra']!="")
				{
					$detail_pattern = $value['extra'];
				}
				else
				{
					$detail_pattern = $value['element'].'['.$value['attribute'].'='.$value['value'].']';
				}
				foreach($html->find($detail_pattern) as $element)
				{
					if($value['type'] == 'IMG' or $value['type'] == 'FILE')
					{		
						if($value['type'] == 'IMG')
						{
							$source = $element->getAttribute('src');
						}
						else
						{
							$source = $element->getAttribute('href');
						}						
						$dest = 'upload/'.substr(PORTAL_ID,1).'/content/'.substr($source,strrpos($source,'/')+1);						
						Feed::save($source,$dest);
						$item[$value['field_name']] = $dest;
					}
					else
					{
						if($element_delete){
							$arr = explode(',',$element_delete);
							for($i=0;$i<count($arr);$i++){
								foreach($element->find($arr[$i]) as $e){
									$e->outertext='';
								}
							}
						}
						if($value['field_name']=='name' or $value['field_name']=='name_1' or $value['field_name']=='brief' or $value['field_name']=='brief_1'){
							$item[$value['field_name']] = $element->plaintext;
						}else{
							$item[$value['field_name']] = $element->innertext;
						}
					}
					break;
				}
			}
			if(isset($item['name_1']))
			{
				$name = $item['name_1'];
			}
			if(isset($item['name']))
			{
				$name = $item['name'];
			}
			if(isset($name))
			{
				$row = $item;
				$name_id = convert_utf8_to_url_rewrite($name);
				if(!DB::fetch('select name_id from '.$site['table_name'].' where name_id="'.$name_id.'" and portal_id="'.PORTAL_ID.'"'))
				{
					// thay duong dan anh trong noi dung
					if(isset($item['description_1']) and $item['description_1']){
						$item['description_1']=str_replace($site['image_content_1'],$site['image_content_2'],$item['description_1']);
					}
					$item['keywords']=extend_search_keywords(convert_utf8_to_telex($name));
					$item['name_1']=str_replace('	','',trim($name));
					$item+= array(
						'name_id'=>$name_id,
						'category_id'=>$site['category_id'],
						'table'=>$site['table_name']
					);
					Feed::$items[] = $item;
					//DB::insert($site['table_name'],$item);
					Feed::$html .= Feed::draw_html($row);
				}
			}
		}
	}
	function draw_html($item)
	{
		$html = '<li>';
				if(isset($item['name']) or isset($item['name_1']))
				{
					$html .= isset($item['name'])?$item['name']:$item['name_1'];
				}
		$html .='</li>';
		return $html;
	}
	function get_data($site,$pattern)
	{
		Feed::$html = '';
		//$html = file_get_html($site['url']);
		$html = file_get_contents($site['url']);
		$hd = $site['begin'];
		$ft = $site['end'];
		
		if(!($bg = strpos($html,$hd))) $bg = 0;
		if(!($end = strpos($html,$ft))) $end = strlen($html);
		$html = substr($html,$bg+strlen($hd),$end-$bg-strlen($hd));
		$html = str_get_html($html);
		
		$host = $site['host'];
		$pattern_bound = $site['pattern_bound'];
		$pattern_link = $site['extra'];
		$pattern_img = $site['image_pattern'];
		foreach($html->find($pattern_bound) as $item)
		{
			foreach($item->find($pattern_link) as $link){
				$link = Feed::check_link($link->getAttribute('href'),$host);
			}
			if(Feed::check_url($link)){
				$items = $item->find($pattern_img);
				if($items and count($items)){
					foreach($items as $img){
						$image_url=$img->src;
					}
					$source = Feed::check_link($image_url,$site['host']);
					$dest = 'upload/'.substr(PORTAL_ID,1).'/content/'.substr($source,strrpos($source,'/')+1);
					Feed::save($source,$dest);
					$site['image_url'] = $dest;
				}else{
					$site['image_url'] = '';
				}
				Feed::parse_row($link,$pattern,$site);
			}
		}
		return Feed::$html;
	}
	function check_url($url=NULL){
		if($url == NULL) return false;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);//lay code tra ve cua http
		curl_close($ch);
		return ($httpcode>=200 && $httpcode<300);
	}
}
?>
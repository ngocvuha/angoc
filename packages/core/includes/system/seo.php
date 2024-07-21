<?php
//Lop SEO
//Cac ham lien quan toi seo
class Seo
{
	static $extra_meta = '';
	function fb($title,$description,$image){
		Seo::$extra_meta = '<meta property="og:title" content="'.strip_tags($title).'"/>';
		Seo::$extra_meta .= '<meta property="og:description" content="'.strip_tags($description).'"/>';
		if(strpos($image,'http://')===false){
			$image = 'http://'.$_SERVER['SERVER_NAME'].'/'.$image;
		}
		Seo::$extra_meta .= '<meta property="og:image" content="'.$image.'"/>';
	}
	// Tạo sitemap.xml
	function make_sitemap_xml(){
		$category = Seo::get_category();
		if($category){
			// Bắt đầu
			$xml_content = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
			// Trang chính
			$xml_content .= '
	<url>
		<loc>http://'.$_SERVER['HTTP_HOST'].'</loc>
		<image:image>
			<image:loc>http://'.$_SERVER['HTTP_HOST'].'/'.Portal::template('frontend').'images/logo.png</image:loc> 
		</image:image>
		<lastmod>'.date('Y-m-d').'</lastmod>
		<changefreq>always</changefreq>
		<priority>1.0</priority>
	</url>';
			// Danh mục
			foreach($category as $key=>$value){
				if(isset($value['url']) and $value['url']){
					$url='http://'.$_SERVER['HTTP_HOST'].'/'.$value['url'];
				}else{
					if($value['type']=='MEDIA'){
						$url='http://'.$_SERVER['HTTP_HOST'].'/'.Url::build('video',array('name_id'=>$value['name_id']));
					}elseif($value['type']=='NEWS'){
						$url='http://'.$_SERVER['HTTP_HOST'].'/'.Url::build($value['name_id']);
					}else{
						$url='http://'.$_SERVER['HTTP_HOST'].'/'.Url::build(Seo::page_url($value['type']),array('name_id'=>$value['name_id']));
					}
				}
				if(isset($value['image_url']) and file_exists($value['image_url'])){
					$image_url = 'http://'.$_SERVER['HTTP_HOST'].'/'.$value['image_url'];
				}else $image_url = '';
				$priority=(isset($value['priority']) and $value['priority'])?$value['priority']:'0.9';
				$xml_content .= '
	<url>
		<loc>'.$url.'</loc>'.($image_url?'
		<image:image><image:loc>'.$image_url.'</image:loc></image:image>':'').'
		<lastmod>'.date('Y-m-d').'</lastmod>
		<changefreq>hourly</changefreq>
		<priority>'.$priority.'</priority>
	</url>';
			}
			// Tin tức
			$items=Seo::get_items('news');
			foreach($items as $key=>$value){
				$url='http://'.$_SERVER['HTTP_HOST'].'/'.Url::build($value['category_name'],array('name_id'=>$value['name_id']));
				if(isset($value['image_url']) and file_exists($value['image_url'])){
					$image_url = 'http://'.$_SERVER['HTTP_HOST'].'/'.$value['image_url'];
				}else $image_url = '';
				$priority='0.8';
				$xml_content .= '
	<url>
		<loc>'.$url.'</loc>'.($image_url?'
		<image:image><image:loc>'.$image_url.'</image:loc></image:image>':'').'
		<lastmod>'.date('Y-m-d').'</lastmod>
		<changefreq>weekly</changefreq>
		<priority>'.$priority.'</priority>
	</url>';
			}
			// Video
			$items=Seo::get_items('media');
			foreach($items as $key=>$value){
				$url='http://'.$_SERVER['HTTP_HOST'].'/'.Url::build(Seo::page_url($value['type']),array('category_name'=>$value['category_name'],'name_id'=>$value['name_id']));
				if(isset($value['image_url']) and file_exists($value['image_url'])){
					$image_url = 'http://'.$_SERVER['HTTP_HOST'].'/'.$value['image_url'];
				}else $image_url = '';
				$priority='0.8';
				$xml_content .= '
	<url>
		<loc>'.$url.'</loc>'.($image_url?'
		<image:image><image:loc>'.$image_url.'</image:loc></image:image>':'').'
		<lastmod>'.date('Y-m-d').'</lastmod>
		<changefreq>weekly</changefreq>
		<priority>'.$priority.'</priority>
	</url>';
			}
			// Kết thúc
			$xml_content .= '
</urlset>';
			$path = 'sitemap.xml';
			$handler = fopen($path,'w+');
			fwrite($handler,$xml_content);
			fclose($handler);
		}
	}
	/* get cache category */
	function get_category()
	{
		$sql = '
			SELECT
				category.id
				,category.image_url
				,category.time
				,category.name_id
				,category.url
				,category.type
				,0.9 as priority
			FROM
				category
			WHERE
				category.status<>"HIDE" and structure_id<>'.ID_ROOT.' and (category.type="NEWS" or category.type="MEDIA")
			ORDER BY 
				category.position,category.structure_id
		';
		$items = DB::fetch_all($sql);
		return $items;
	}
	/* get items */
	function get_items($table)
	{
		$sql = '
			SELECT
				'.$table.'.id,
				'.$table.'.image_url,
				'.$table.'.time,
				'.$table.'.name_id,
				category.name_id as category_name,
				category.type
			FROM
				'.$table.'
				INNER JOIN category ON '.$table.'.category_id=category.id
			WHERE
				'.$table.'.status<>"HIDE"
			ORDER BY 
				'.$table.'.position DESC,'.$table.'.time DESC,'.$table.'.id DESC
			LIMIT
				0,100
		';
		$items = DB::fetch_all($sql);
		return $items;
	}
	function page_url($type){
		$page=array(
			'NEWS'=>'tin-tuc',
			'PRODUCT'=>'san-pham',
			'PHOTO'=>'thu-vien-anh',
			'MEDIA'=>'video'
		);
		return $page[$type];
	}
	function addlink($content){
		$arr = array();
		return strtr($content,$arr);
	}
}
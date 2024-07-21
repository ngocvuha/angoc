<?php
class NewsFunction
{
	/* Xóa ảnh liên quan thỏa mãn $cond
	** Xóa file ảnh của tin đang xóa
	*/
	function delete_news_image($cond){
		$items=DB::fetch_all('
			SELECT
				news_image.*
			FROM
				news_image
				INNER JOIN news ON news_image.item_id=news.id
			WHERE
				'.$cond.'
		');
		if($items){
			foreach($items as $item){
				if(isset($item['image_url']) and file_exists($item['image_url'])){
					@unlink($item['image_url']);
				}
				DB::delete_id('news_image',$item['id']);
			}
		}
	}
	/* Xóa tin thảo mãn điều kiện $cond
	** Đồng thời xóa comment, ảnh liên quan, các file liên quan
	*/
	function delete_news($cond){
		$items=DB::fetch_all('
			SELECT
				news.*
			FROM
				news
				INNER JOIN category ON news.category_id=category.id
			WHERE
				'.$cond.'
		');
		if($items){
			foreach($items as $item){
				// Xóa comment
				DB::delete('comment','comment.type="NEWS" and comment.item_id='.$item['id']);
				// Xóa ảnh liên quan
				NewsFunction::delete_news_image('news_image.item_id='.$item['id']);
				// Xóa các file liên quan
				if(isset($item['image_url']) and file_exists($item['image_url'])) @unlink($item['image_url']);
				if(isset($item['small_thumb_url']) and file_exists($item['small_thumb_url'])) @unlink($item['small_thumb_url']);
				if(isset($item['slide_image_url']) and file_exists($item['slide_image_url'])) @unlink($item['slide_image_url']);
				if(isset($item['file']) and file_exists($item['file'])) @unlink($item['file']);
				// Xóa tin
				DB::delete_id('news',$item['id']);
			}
		}
	}
	/* Xóa danh mục thỏa mãn $cond
	** Đồng thời xóa các tin thuộc danh mục đang xóa
	*/
	function delete_news_category($cond){
		$items=DB::fetch_all('
			SELECT
				category.id,category.structure_id
			FROM
				category
			WHERE
				'.$cond.'
		');
		if($items){
			foreach($items as $item){
				NewsFunction::delete_news(IDStructure::child_cond($item['structure_id']));
			}
			$query='
				DELETE FROM
					category
				WHERE
					'.$cond.'
			';
			DB::query($query);
		}
	}
}
?>
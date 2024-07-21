<?php
class MediaFunction
{
	/* Xóa photo/media liên quan thỏa mãn $cond
	*/
	function delete_image_related($cond){
		$items=DB::fetch_all('
			SELECT
				media_image_related.*
			FROM
				media_image_related
				INNER JOIN media ON media_image_related.item_id=media.id
			WHERE
				'.$cond.'
		');
		if($items){
			foreach($items as $item){
				if(isset($item['image_url']) and file_exists($item['image_url'])){
					@unlink($item['image_url']);
				}
				DB::delete_id('media_image_related',$item['id']);
			}
		}
	}
	function delete_media($cond,$type='PHOTO'){
		$items=DB::fetch_all('
			SELECT
				media.*
			FROM
				media
				INNER JOIN category ON media.category_id=category.id
			WHERE
				'.$cond.'
		');
		if($items){
			foreach($items as $item){
				DB::delete('comment','comment.type="'.$type.'" and comment.item_id='.$item['id']);
				// Xóa photo/media liên quan
				MediaFunction::delete_image_related('media_image_related.item_id='.$item['id']);
				if(isset($item['image_url']) and file_exists($item['image_url'])) @unlink($item['image_url']);
				if(isset($item['url']) and file_exists($item['url'])) @unlink($item['url']);
				if(isset($item['small_thumb_url']) and file_exists($item['small_thumb_url'])) @unlink($item['small_thumb_url']);
				DB::delete_id('media',$item['id']);
			}
		}
	}
	function delete_media_category($cond){
		$items=DB::fetch_all('
			SELECT
				category.id,category.structure_id,category.type
			FROM
				category
			WHERE
				'.$cond.'
		');
		if($items){
			foreach($items as $item){
				MediaFunction::delete_media(IDStructure::child_cond($item['structure_id']),$item['type']);
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
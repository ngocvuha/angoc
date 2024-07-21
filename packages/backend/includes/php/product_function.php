<?php
class ProductFunction
{
	/* Xóa ảnh sản phẩm liên quan lưu trong bảng product_image
	*/
	function delete_product_image($cond){
		$items=DB::fetch_all('
			SELECT
				product_image.*
			FROM
				product_image
				INNER JOIN product ON product_image.item_id=product.id
			WHERE
				'.$cond.'
		');
		if($items){
			foreach($items as $item){
				if(isset($item['image_url']) and file_exists($item['image_url'])) @unlink($item['image_url']);
				DB::delete_id('product_image',$item['id']);
			}
		}
	}
	/* Xóa sản phẩm
	*/
	function delete_product($cond){
		$items=DB::fetch_all('
			SELECT
				product.*
			FROM
				product
				INNER JOIN category ON product.category_id=category.id
			WHERE
				'.$cond.'
		');
		if($items){
			foreach($items as $item){
				// Xóa bình luận của sản phẩm
				DB::delete('comment','comment.type="PRODUCT" and comment.item_id='.$item['id']);
				// Xóa thuộc tính sản phẩm
				DB::delete('product_attribute','product_id='.$item['id']);
				// Xóa nhóm giá của sản phẩm
				DB::delete('product_group_price','product_id='.$item['id']);
				// Xóa nhóm giá theo số lượng sản phẩm
				DB::delete('product_tier_price','product_id='.$item['id']);
				// // Xóa ảnh liên quan của sản phẩm
				ProductFunction::delete_product_image('product_image.item_id='.$item['id']);
				// Xóa file của sản phẩm
				if(isset($item['video']) and file_exists($item['video'])) @unlink($item['video']);
				if(isset($item['image_url']) and file_exists($item['image_url'])) @unlink($item['image_url']);
				if(isset($item['thumb_url']) and file_exists($item['thumb_url'])) @unlink($item['thumb_url']);
				if(isset($item['small_image_url']) and file_exists($item['small_image_url'])) @unlink($item['small_image_url']);
				if(isset($item['file']) and file_exists($item['file'])) @unlink($item['file']);
				// Xóa sản phẩm
				DB::delete_id('product',$item['id']);
			}
		}
	}
	/* Xóa danh mục sản phẩm
	*/
	function delete_product_category($cond){
		$items=DB::fetch_all('
			SELECT
				category.id,category.structure_id,category.image_url
			FROM
				category
			WHERE
				'.$cond.'
		');
		if($items){
			foreach($items as $item){
				// Xóa sản phẩm thuộc danh mục
				ProductFunction::delete_product(IDStructure::child_cond($item['structure_id']));
				// Xóa ảnh đại diện của danh mục
				if($item['image_url'] and file_exists($item['image_url'])){
					@unlink($item['image_url']);
				}
				// Xóa thuộc tính của danh mục
				if($cate_attr=DB::select_all('category_attribute','category_id='.$item['id'])){
					foreach($cate_attr as $attr){
						// Xóa giá trị của thuộc tính
						DB::delete('attribute_value','attribute_id='.$attr['attribute_id']);
						// Xóa thuộc tính
						DB::delete_id('attribute',$attr['attribute_id']);
					}
					// Xóa thuộc tính gắn với danh mục
					DB::delete('category_attribute','category_id='.$item['id']);
				}
			}
			// Xóa danh mục
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
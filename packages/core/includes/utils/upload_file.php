<?php
function update_upload_file($field, $dir, $max_size='2*1024*1024', $type='png|jpg|jpeg|gif|ico|bmp|svg|jpe|tif|tiff|ai|drw|psd|raw|flv|swf|mp4|avi|mkv|mov|mpeg|mpg|ogm|ogv|ogx|rm|webm|wmv|doc|docx|xls|xlsx|txt|pdf|ppt|pptx', $time=false)
{
	if(!isset($max_size) or !$max_size){
		$max_size='2*1024*1024';
	}
	if(!isset($type) or !$type){
		$type='png|jpg|jpeg|gif|ico|bmp|svg|jpe|tif|tiff|ai|drw|psd|raw|flv|swf|mp4|avi|mkv|mov|mpeg|mpg|ogm|ogv|ogx|rm|webm|wmv|doc|docx|xls|xlsx|txt|pdf|ppt|pptx';
	}
	$error_message = '';
	if($file_name = $_FILES[$field]['name']){
		require_once 'packages/core/includes/utils/vn_code.php';
		if(isset($_FILES[$field]))
		{
			if(!is_dir('upload/'.$dir))
			{
				@mkdir('upload/'.$dir,0755,true);
			}
			$file_name=convert_utf8_to_url_rewrite($file_name);
			if(file_exists('upload/'.$dir.'/'.$file_name))
			{				
				$new_name = 'upload/'.$dir.'/'.($time?$time:time()).'_'.$file_name;
			}
			else
			{
				require_once 'packages/core/includes/utils/vn_code.php';
				$new_name = 'upload/'.$dir.'/'.$file_name;
			}
			$extend = strtolower(file_extension($file_name));
			$type = array_flip(explode('|',strtolower($type)));
			if(isset($type[$extend]))
			{
				eval('$max_size='.$max_size.';');
				if($_FILES[$field]['size'] <= $max_size){
					if(move_uploaded_file($_FILES[$field]['tmp_name'],$new_name)){
						$_REQUEST[$field] = $new_name;
					}
				}
				else
				{
					$error_message = Portal::language('file_size_too_large');
				}
			}
			else
			{
				$error_message = Portal::language('invalid_file_type');
			}
		}
		return $error_message;
	}
}
function asido_watermark($image, $new_image, $logo){
	require_once 'lib/php/asido/class.asido.php';
	asido::driver('gd');
	$i1 = asido::image($image,$new_image);
	asido::watermark($i1, $logo, ASIDO_WATERMARK_MIDDLE_CENTER, ASIDO_WATERMARK_SCALABLE_ENABLED, 0.2);
	$i1->save(ASIDO_OVERWRITE_ENABLED);
}
function asido_resize($image,$new_image,$new_width=0,$new_height=0)
{
	require_once ROOT_PATH.'lib/php/asido/class.asido.php';
	Asido::driver('gd');
	$i1 = Asido::image($image,$new_image);
	//asido::resize($i1, $new_width, $new_height); // resize theo tỷ lệ
	Asido::Fit($i1, $new_width, $new_height); // resize theo tỷ lên, nhưng nếu kích thước ảnh thực nhỏ hơn kích thước mới thì không resite
	$i1->save(ASIDO_OVERWRITE_ENABLED);
}
function multi_upload_file($field, $dir, $max_size='2*1024*1024', $type='png|jpg|jpeg|gif|ico|bmp|svg|jpe|tif|tiff|ai|drw|psd|raw|flv|swf|mp4|avi|mkv|mov|mpeg|mpg|ogm|ogv|ogx|rm|webm|wmv|doc|docx|xls|xlsx|txt|pdf|ppt|pptx', $time=false, $thumbnail=false)
{
	if(isset($_FILES[$field]))
	{		
		if(!isset($max_size) or !$max_size){
			$max_size='2*1024*1024';
		}
		if(!isset($type) or !$type){
			$type='png|jpg|jpeg|gif|ico|bmp|svg|jpe|tif|tiff|ai|drw|psd|raw|flv|swf|mp4|avi|mkv|mov|mpeg|mpg|ogm|ogv|ogx|rm|webm|wmv|doc|docx|xls|xlsx|txt|pdf|ppt|pptx';
		}
		if(!is_dir('upload/'.$dir))
		{
			@mkdir('upload/'.$dir,0755,true);
		}
		$new_name = array();
		require_once 'packages/core/includes/utils/vn_code.php';		
		foreach($_FILES[$field]['name'] as $k=>$value)
		{
			if($value)
			{
				$value = convert_utf8_to_url_rewrite($value);
				if(file_exists('upload/'.$dir.'/'.$value))
				{				
					$new_name[$k+1]['value'] = 'upload/'.$dir.'/'.($time?$time:time()).'_'.$value;
				}
				else
				{
					$new_name[$k+1]['value'] = 'upload/'.$dir.'/'.$value;
				}
				$new_name[$k+1]['name'] = clear_file_extension($value);
				eval('$max_size='.$max_size.';');				
				if(preg_match('/\.('.$type.')$/i',strtolower($value),$matches) and filesize($_FILES[$field]['tmp_name'][$k])< $max_size)
				{
					if(!move_uploaded_file($_FILES[$field]['tmp_name'][$k],$new_name[$k+1]['value']))
					{
						$new_name[$k+1]['name'] = '';
						$new_name[$k+1]['value'] = '';
					}elseif($thumbnail){
						if(file_exists('upload/'.$dir.'/thumb_'.$value)){
							$thumb = 'upload/'.$dir.'/thumb_'.($time?$time:time()).'_'.$value;
						}else{
							$thumb = 'upload/'.$dir.'/thumb_'.$value;
						}
						asido_resize($new_name[$k+1]['value'],$thumb,300,300);
					}
				}else{
					$new_name[$k+1]['name'] = '';
					$new_name[$k+1]['value'] = '';
				}
			}
		}
		$_REQUEST[$field] = $new_name;
		return $new_name;
	}
}
function file_extension($filename)
{
	$path_info = pathinfo($filename);
	return $path_info['extension'];
}
function clear_file_extension($filename){
	$filename = explode('.',$filename);
	unset($filename[sizeof($filename)-1]);
	$filename=implode('.',$filename);
	return $filename;
}
?>
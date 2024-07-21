<?php
class File
{
	function export_file($file=false,$variable='items',$content=''){
		$return=false;
		if(isset($file) and $file){
			$folder=dirname($file);
			if(!is_dir($folder)) @mkdir($folder,0755,true);
			$content = '<?php $'.$variable.' = '.var_export($content,true).';?>';
			$handler = fopen($file,'w+');
			if(fwrite($handler,$content)){
				$return=true;
			}
			fclose($handler);
		}
		return $return;
	}
	// kiểm tra file không tồn tại hoặc thời gian sửa file lần cuối lớn hơn duration thì trả về TRUE ngược lại trả về FALSE
	function check_filemtime($filename,$duration=3600){
		if(!file_exists($filename) or time()-filemtime($filename) >= $duration)
			return true;
		else
			return false;
	}
	function getfilesize($bytes) {
		if ($bytes >= 1099511627776) {
			$return = round($bytes / 1024 / 1024 / 1024 / 1024, 2);
			$suffix = "TB";
		} elseif ($bytes >= 1073741824) {
			$return = round($bytes / 1024 / 1024 / 1024, 2);
			$suffix = "GB";
		} elseif ($bytes >= 1048576) {
			$return = round($bytes / 1024 / 1024, 2);
			$suffix = "MB";
		} elseif ($bytes >= 1024) {
			$return = round($bytes / 1024, 2);
			$suffix = "KB";
		} else {
			$return = $bytes;
			$suffix = "Byte";
		}
		if ($return == 1) {
			$return .= " " . $suffix;
		} else {
			$return .= " " . $suffix . "s";
		}
		return $return;
	}
}
?>
<?php
class RestoreForm extends Form
{
	function RestoreForm()
	{
		Form::Form('RestoreForm');
	}	
	function read_file($file)
	{
		return @file_get_contents($file);
	}	
	function restore($file)
	{
		if($file)
		{
			$f = fopen('temp.sql' , 'w+');
			if(!$f) {
				echo "Error While Restoring Database";
				return;
			}
			$zip = new ZipArchive;
			if ($zip->open('backup/sql/'.$file) === TRUE) {
				$symbol = '/*@^_^@*/';
				$sql = $zip->getFromName(str_replace('.zip','.sql',$file));
				$zip->close();
				fwrite($f , $sql);
				fclose($f);
				$sqls = explode($symbol,$sql);
				foreach($sqls as $com){
					if(trim($com)){
						DB::query($com);
					}
				}
				@unlink('temp.sql');
				echo "<script>alert('Khôi phục dữ liệu thành công');window.location.href='restore.html'</script>";
			}else{
				die('failed');
			}
		}
	}
	function on_submit()
	{
		if(Url::get('cmd')=='restore' and $id=Url::get('selected_id') and file_exists('backup/sql/'.$id))
		{
			set_time_limit(0);
			$this->restore($id);
		}
	}
	function draw()
	{
		$this->map=array();
		require_once 'packages/core/includes/utils/dir.php';
		$this->map['path'] = 'backup/sql';
		$this->map['items'] = get_files_in_dir($this->map['path'],'file','','');
		foreach($this->map['items'] as $key=>$value){
			if(substr($value,-4)!='.zip'){
				unset($this->map['items'][$key]);
			}
		}
		$this->parse_layout('restore',$this->map);
	}
}
?>

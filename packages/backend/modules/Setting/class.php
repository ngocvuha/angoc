<?php 
class Setting extends Module
{
	function Setting($row)
	{
		Module::Module($row);
		if(User::can_view())
		{
			switch(Url::get('cmd'))
			{
				case 'unlink':
					$this->delete_file();
					break;	
				default:
					require_once 'forms/account_setting.php';
					$this->add_form(new AccountSettingForm());			
					break;	
			}
		}
		else
		{
			Url::access_denied();
		}	
	}
	function make_cache(){
		$dir = 'cache/config/';
		if(!is_dir($dir)){
			mkdir($dir,0755,true);
		}
		$path = $dir.'config.php';
		$config = DB::fetch_all('SELECT name as id,value,hide FROM setting');		
		$content = '<?php $config = '.var_export($config,true).';?>';
		$handler = fopen($path,'w+');
		fwrite($handler,$content);
		fclose($handler);
	}
	function delete_file()
	{
		if(Url::get('link') and file_exists(Url::get('link')) and User::can_delete(false,ANY_CATEGORY))
		{
			@unlink(Url::get('link'));
			if(Url::get('name')) DB::update('setting',array('value'=>''),'name="'.Url::nget('name').'"');
		}
		Url::redirect_current();
	}
}
?>
<?php
class AccountSettingForm extends Form
{
	function AccountSettingForm()
	{
		Form::Form('AccountSettingForm');
		$this->link_js('lib/js/tinymce/jscripts/tiny_mce/tiny_mce.js');
	}
	function on_submit()
	{
		if($_REQUEST){
			foreach($_REQUEST as $key=>$value)
			{
				if(preg_match('/config_(.*)/',$key,$matches)){
					if($item=DB::select('setting',"name='".$matches[1]."'")){
						if($item['value']!=$value){
							DB::update('setting',array('value'=>$value),"name='".$matches[1]."'");
						}
					}else{
						DB::insert('setting',array('name'=>$matches[1],'value'=>$value));
					}
					DB::update('setting',array('hide'=>0),"name='".$matches[1]."'");
				}
				if(preg_match('/hide_(.*)/',$key,$matches)){
					if($item=DB::select('setting','name="'.$matches[1].'"')){
						DB::update('setting',array('hide'=>$value),"name='".$matches[1]."'");
					}
				}
			}
		}
		if($_FILES)
		{
			require_once 'packages/core/includes/utils/upload_file.php';
			$dir = 'config';
			foreach($_FILES as $key=>$value)
			{
				if(preg_match('/config_(.*)/',$key,$matches)){
					if($value['name']){
						$field_error = update_upload_file($key, $dir);
						if($field_error){
							$this->error($key,$field_error);
							return false;
						}
						$field_name=substr($key,7);
						if($item = DB::select('setting',"name='".$field_name."'")){
							DB::update_id('setting',array('value'=>Url::get($key)),$item['id']);
							if($item['value'] and file_exists($item['value']) and $item['value']!=Url::get($key)){
								@unlink($item['value']);
							}
						}else{
							DB::insert('setting',array('name'=>$field_name,'value'=>Url::get($key)));
						}
					}
					DB::update('setting',array('hide'=>0),'name="'.$matches[1].'"');
				}
				if(preg_match('/hide_(.*)/',$key,$matches)){
					if($item=DB::select('setting',"name='".$matches[1]."'")){
						DB::update('setting',array('hide'=>$value),"name='".$matches[1]."'");
					}
				}
			}
		}
		// make cache
		Setting::make_cache();
		if(!$this->is_error()){
			Url::redirect_current();
		}
	}
	function draw()
	{
		$languages = System::get_language();
		$dir = 'cache/config/config.php';
		if(file_exists($dir)){
			require $dir;
		}else{
			$config = DB::fetch_all('SELECT name as id,value,hide FROM setting');
		}
		if($config)
		{
			foreach($config as $key=>$value)
			{
				$_REQUEST['config_'.$key] = $value['value'];
				$_REQUEST['hide_'.$key] = $value['hide'];
			}
		}
		$arr = array(0=>'NO',1=>'YES');
		$comment_type = array(0=>'NO',1=>'Facebook',2=>'System');
		$show_mark = array(
			0=>'Thang điểm 10',
			1=>'Tổng điểm'
		);
		require_once 'packages/core/includes/utils/dir.php';
		$templates_frontend = array(''=>'')+get_files_in_dir('templates','dir','','');
		$templates_admin = array(''=>'')+get_files_in_dir('templates','dir','','');
		$this->parse_layout('account_setting',array(
			'default_language'=>Portal::get_setting('default_language',1)
			,'languages'=>$languages
			,'config_templates_frontend_list'=>$templates_frontend
			,'config_templates_admin_list'=>$templates_admin
			,'config_web_block_list'=>$arr
			,'config_use_log_list'=>$arr
			,'config_received_notification_from_contact_list'=>$arr
			,'config_received_notification_from_order_list'=>$arr
			,'config_send_mail_to_customer_when_order_list'=>$arr
			,'config_default_editor_list'=>$arr
			,'config_tier_price_list'=>$arr
			,'config_news_thumb_auto_list'=>$arr
			,'config_use_cache_list'=>$arr
			,'config_news_comment_type_list'=>$comment_type
			,'config_show_mark_list'=>$show_mark
		));
	}
}
?>
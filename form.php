<?php
date_default_timezone_set('Asia/Saigon');
define('ROOT_PATH', strtr(dirname( __FILE__ ) ."/",array('\\'=>'/')));
require_once ROOT_PATH.'packages/core/includes/system/config.php';
if(URL::get('block_id') and $block = DB::select('block',"id='".URL::nget('block_id')."'"))
{
	$block_settings = String::get_list(DB::fetch_all('select setting_id as id, value as name from block_setting where block_id=\''.$block['id'].'\''),'name');
	$settings = String::get_list(DB::fetch_all('select id, default_value as name from module_setting where module_id=\''.$block['module_id'].'\''),'name');
	foreach($settings as $setting_id=>$value)
	{
		if(!isset($block_setting[$setting_id]))
		{
			$block_setting[$setting_id] = $value;
		}
	}
	$blocks = array(
		$block['id'] => $block + array (
			'settings' => $block_settings,
			'module' => DB::fetch('select id, name, path, type, use_dblclick,package_id from module where id=\''.$block['module_id'].'\'')
		)
	);
	require_once $blocks[$block['id']]['module']['path'].'class.php';
	$blocks[$block['id']]['object'] = new $blocks[$block['id']]['module']['name']($blocks[$block['id']]);
	if(URL::get('form_block_id')==$block['id'])
	{
		$blocks[$block['id']]['object']->submit();
	}
	//require_once ROOT_PATH.'packages/core/includes/utils/draw.php';
	//require_once 'packages/portal/includes/portal/header.php';
	$blocks[$block['id']]['object']->on_draw();
	//require_once 'packages/portal/includes/portal/footer.php';
}
DB::close();
?>
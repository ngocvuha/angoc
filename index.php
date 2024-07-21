<?php
	date_default_timezone_set('Asia/Saigon');	
	define('ROOT_PATH', strtr(dirname( __FILE__ ) ."/",array('\\'=>'/')));	
	require_once ROOT_PATH.'packages/core/includes/system/config.php';
	if($user = Url::nget('__user_id__')){Session::set('user_id',$user);}
	Portal::run();
?>

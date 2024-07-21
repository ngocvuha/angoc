<?php
	date_default_timezone_set('Asia/Saigon');
	define( 'ROOT_PATH', strtr(dirname( __FILE__ ) ."/",array('\\'=>'/')));
	require_once ROOT_PATH.'packages/core/includes/system/config.php';
	if(Url::get('cmd')=='set_confirm_code'){
		$code=String::simpleRandString();
		Session::set('confirm_code',$code);
		echo $code; exit();
	}
?>
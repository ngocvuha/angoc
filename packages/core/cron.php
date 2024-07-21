<?php
date_default_timezone_set('Asia/Saigon');
define('ROOT_PATH', strtr(dirname( __FILE__ ) ."/",array('\\'=>'/')));
require_once ROOT_PATH.'packages/core/includes/system/config.php';
System::run_cronjob();
?>
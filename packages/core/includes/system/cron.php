<?php
date_default_timezone_set('Asia/Saigon');
define('ROOT_PATH', strtr(dirname( __FILE__ ) ."/",array('\\'=>'/')));
require_once ROOT_PATH.'packages/core/includes/system/config.php';
$file = ROOT_PATH.'log/cron.txt';
file_put_contents($file,'auto run at '.date('d/m/y H:i',time())."\n",FILE_APPEND);
System::run_cronjob();
?>
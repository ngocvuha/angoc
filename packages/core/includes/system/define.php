<?php
	define('DEBUG',0);
	define('BASE','http://'.$_SERVER['HTTP_HOST'].'/');
	define('DEVELOPER',true);
	define('ALLOW_FILE_TYPE','png|jpg|jpeg|gif|pdf|doc|docx|xls|xlsx|swf|flv');
	define('ALLOW_FILE_SIZE',20*1024*1024);
	define('USE_CACHE',0);
	define('CURRENTTIME',time());
	define('THEME','web');
	
	define('MULTICHOICE',3);
	define('MATCHING',4);
	define('FILLBLANK',5);
	define('SHORTANSWER',6);
	define('WRITING',7);
	define('WEBQUANLY','http://'.$_SERVER["SERVER_NAME"].':8081');
?>
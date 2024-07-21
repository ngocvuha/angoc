<?php
	$txt = file_get_contents('ids.txt');
	$arr = explode(',',$txt);
	//asort($arr);
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
?>
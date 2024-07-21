<?php
	function get($name){
		return isset($_REQUEST[$name])?$_REQUEST[$name]:'';
	}
	if($url = get('url')){
		echo file_get_contents($url);
	}
?>
<?php
class Cookie
{
	static function delete($name)
	{
		setcookie ($name, "", time() - 3600);
	}
	static function get($name)
	{
		if (isset($_COOKIE[$name])){
			return $_COOKIE[$name];
		}
		return false;
	}
	static function set($name,$value,$expire=false,$path=false,$domain=false,$secure=false)
	{
		setcookie ($name, $value, $expire, $path, $domain, $secure);
	}
}
?>
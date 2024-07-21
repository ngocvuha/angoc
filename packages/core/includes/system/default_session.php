<?php
class Session
{
	static $name;
	static $init_vars;
	static $expire=43200;
	static function start()
	{
		session_start();
		if (!isset($_SESSION['CREATED'])) {
			$_SESSION['CREATED'] = time();
		} else if (time() - $_SESSION['CREATED'] > 12*3600) {
			// session started more than 12 hours ago
			session_regenerate_id(true);    // change session ID for the current session an invalidate old session ID
			$_SESSION['CREATED'] = time();  // update creation time
		}
		if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > Session::$expire)) {
			// last request was more than 30 minutes ago
			session_unset();     // unset $_SESSION variable for the run-time 
			session_destroy();   // destroy session data in storage
		}
		$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	}
	static function end()
	{
	}
	static function destroy()
	{
		session_destroy();
	}
	static function name($name = false)
	{
		if($name)
		{
			Session::$name = $name;
		}
		return Session::$name;
	}
	static function delete($name, $field=false)
	{
		if($field)
		{
			unset($_SESSION[$name][$field]);
		}
		else
		{
			unset($_SESSION[$name]);
		}
	}
	static function get($name, $field=false)
	{
		if(isset($_SESSION[$name]))
		{
			if($field)
			{
				if(isset($_SESSION[$name][$field]))
				{
					return $_SESSION[$name][$field];
				}
				return false;
			}
			return $_SESSION[$name];
		}
	}
	static function set($name,$value)
	{
		$_SESSION[$name] = $value;
	}
	static function is_set($name, $field=false)
	{
		if($field)
		{
			return isset($_SESSION[$name]) and isset($_SESSION[$name][$field]);
		}
		return isset($_SESSION[$name]);
	}
}
Session::start();
?>
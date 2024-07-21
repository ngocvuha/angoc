<?php
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY vuonggialong
******************************/

class Url
{
	var  $root = false;
	function build($page=false,$params=array(),$anchor=false)
	{
		if(!$page) return 'http://'.$_SERVER['HTTP_HOST'];
		$request_string = '?page='.$page;
		if($params){
			if($params){
				foreach($params as $param=>$value){
					if(is_numeric($param) and $value)
					{
						$request_string .= '&'.$value.'='.(Url::get($value));
					}elseif($value){
						$request_string .= '&'.$param.'='.($value);
					}
				}
			}
		}
		return $request_string.$anchor;
	}
	function build_current($params=array(),$anchor=false)
	{
		return URL::build(Portal::$page['name'],$params,$anchor);
	}
	function redirect_url($url=false)
	{
		if($url){
			$url='/'.$url;
		}
		header('Location:'.str_replace('&','&','http://'.$_SERVER['HTTP_HOST'].$url));
		System::halt();
	}
	function redirect($page=false,$params=false,$anchor=false)
	{
		if(!$page and !$params)
		{
			Url::redirect_url();
		}
		else
		{
			Url::redirect_url(Url::build($page,$params,$anchor));
		}
	}
	function redirect_current($params=array(),$anchor=false)
	{
		URL::redirect(Portal::$page['name'],$params,$anchor);
	}
	function check($params)
	{
		if(!is_array($params))
		{
			$params=array(0=>$params);
		}
		foreach($params as $param=>$value)
		{
			if(is_numeric($param))
			{
				if(!isset($_REQUEST[$value]))
				{
					return false;
				}
			}
			else
			{
				if(!isset($_REQUEST[$param]))
				{
					return false;
				}
				else
				{
					if($_REQUEST[$param]!=$value)
					{
						return false;
					}
				}
			}
		}
		return true;
	}
	function access_denied()
	{
		if(Portal::$page['name']!='trang-chu')
		{
			Url::redirect();
		}
		else
		{
			System::halt();
		}
	}
	function get_value($name,$default='')
	{
		if (isset($_REQUEST[$name]) and $_REQUEST[$name]!="")
		{
			return $_REQUEST[$name];
		}
		else
		if (isset($_POST[$name]) and $_POST[$name]!="")
		{
			return $_POST[$name];
		}
		else
		if(isset($_GET[$name]) and $_GET[$name])
		{
			return $_GET[$name];
		}
		return $default;
	}
	static function get($name,$default='')
	{
		if(isset($_REQUEST[$name])){
			return $_REQUEST[$name];
		}
		return $default;
		/*if(isset($_REQUEST[$name]) and $_REQUEST[$name]!="")
		{
			return Url::get_value($name,$default='');
		}
		else
		{
			return $default;
		}*/
	}
	function sget($name,$default='')
	{
		return strtr(URL::get($name, $default),array('"'=>'\\"'));
	}
	function nget($name,$default='')
	{
		return addslashes(URL::sget($name));
	}
	function iget($name,$default=''){
		return intval(Url::sget($name,$default));
	}
	function jget($name,$default='')
	{
		return String::string2js(URL::get($name, $default));
	}
}
?>
<?php
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY vuonggialong
******************************/
class Type
{
	var $required = false;
	var $error = false;
	var $message = false;
	var $name = false;
	function Type($required=false, $message='error')
	{
		$this->required=$required;
		$this->message = $message;
	}
	function check($value)
	{
		$this->error = false;
		if($this->required and $value=='')
		{
			$this->error = $this->message;
		}
		return !$this->error;
	}
	function to_js_data($name, $word)
	{
		return '{"name":"'.$name.'","message":"'.addslashes($word).'","type":"text","require":'.($this->required?1:0).',"min":0,"max":255}';
	}
	//
	function get_message()
	{
		return Portal::language($this->message);
	}
}
//Lop kieu du lieu Text
class TextType extends Type
{
	var $min_len = 0;
	var $max_len = 0;
	function TextType($required=false, $messages=false, $min_len, $max_len)
	{
		Type::Type($required, $messages);
		$this->min_len = $min_len;
		$this->max_len = $max_len;
	}
	function to_js_data($name, $word)
	{
		return '{"name":"'.$name.'","message":"'
		.addslashes($word).'","type":"text","require":'
		.($this->required?1:0).',"min":'
		.$this->min_len.',"max":'
		.$this->max_len.'}';
	}
	function check($value)
	{
		if(Type::check($value) && $value!='' )
		{
			$len=strlen($value);
			if($len<$this->min_len)
			{
				$this->error = $this->message;
			}
			else
			if($len>$this->max_len)
			{
				$this->error = $this->message;
			}
		}
		return !$this->error;
	}
}
class SelectType extends TextType
{
	function SelectType($required=false, $messages=false, $values)
	{
		TextType::TextType($required, $messages,0,1000);
		$this->values = $values;
	}
	function to_js_data($name, $word)
	{
		return '{"name":"'.$name.'","message":"'.addslashes($word).'","type":"text","require":'.($this->required?1:0).',"min":'.$this->min_len.',"max":'.$this->max_len.'}';
	}
	function check($value)
	{
		if(Type::check($value))
		{
			if(!in_array($value,array_keys($this->values)))
			{
				$this->error = $this->message;
			}
		}
		return !$this->error;
	}
}

//Lop kieu ten 
class NameType extends TextType
{
	function NameType($required=true, $messages=false,$min=2, $max=50)
	{
		TextType::TextType($required, $messages, $min, $max);
	}
	function to_js_data($name, $word)
	{
		return '{"name":"'.$name.'","message":"'.addslashes($word).'","type":"name","require":'.($this->required?1:0).',"min":'.$this->min_len.',"max":'.$this->max_len.'}';
	}
	function check($value)
	{
		if(TextType::check($value) && $value!='')
		{
			if(preg_match('/[^A-Za-z0-9_-]/',$value))
			{
				$this->error = $this->message;
			}
		}
		return !$this->error;
	}
}
//Lop kieu password
class PasswordType extends TextType
{
	function PasswordType($required=true, $messages=false, $min=0, $max=32)
	{
		TextType::TextType($required, $messages, $min, $max);
	}
}
class RetypePasswordType extends PasswordType
{
	function RetypePasswordType($required=true, $messages=false, $min=0, $max=32)
	{
		PasswordType::PasswordType($required, $messages, $min, $max);
	}
	function check($value)
	{
		if(PasswordType::check($value) && $value!='')
		{
			if(URL::get('password') and URL::get('password')!=$value)
			{
				$this->error = $this->message;
			}
		}
		return !$this->error;
	}
}
//Lop kieu username
class UsernameType extends NameType
{
	function UsernameType($required=true, $messages=false)
	{
		NameType::NameType($required, $messages,2, 64);
	}
	function check($value)
	{
		return NameType::check($value);
	}
}
//Lop kieu email
class EmailType extends TextType
{
	function EmailType($required=true, $messages=false)
	{
		TextType::TextType($required, $messages, 5, 150);
	}
	function to_js_data($name, $word)
	{
		return '{"name":"'.$name.'","message":"'.addslashes($word).'","type":"email","require":'.($this->required?1:0).',"min":'.$this->min_len.',"max":'.$this->max_len.'}';
	}
	function check($value)
	{
		if(TextType::check($value) && $value!='')
		{
			//khai bao mot so mau de kiem tra
			
			if(!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$",$value) )
			{
				$this->error = $this->message;
			}
		}
		return !$this->error;
	}
}
//Lop kieu ngay thang
class DateType extends TextType
{
	var $min = '1/1/1900';
	var $max = '1/1/2030';
	function DateType($required=false, $messages=false,$min= '1/1/1900',$max = '1/1/2030')
	{
		TextType::TextType($required, $messages,6,15);
		$this->min = $min;
		$this->max = $max;
	}
	function to_js_data($name, $word)
	{
		return '{"name":"'.$name.'","message":"'.addslashes($word).'","type":"date","require":'.($this->required?1:0).'}';
	}
	function check($value)
	{
		if(TextType::check($value) && $value!='')
		{
			$params = explode('/',$value);
			if(sizeof($params)!=3 or !ctype_digit($params[0])or !ctype_digit($params[1])or !ctype_digit($params[2])
				or $params[0]<1 or $params[1]<1 or $params[2]<1800
				or $params[0]>31 or $params[1]>12 or $params[2]>2800
			)
			{
				$this->error = $this->message;
			}
		}
		return !$this->error;
	}
}
class PhoneType extends TextType
{
	function PhoneType($required=false, $messages=false,$min=6,$max=11)
	{
		TextType::TextType($required, $messages,$min,$max);
	}
	function to_js_data($name, $word)
	{
		return '{"name":"'.$name.'","message":"'.addslashes($word).'","type":"phone","require":'.($this->required?1:0).',"min":6,"max":11}';
	}
	function check($value)
	{
		if(TextType::check($value) && $value!='')
		{
			if(preg_match('/[^0-9_, ]/',$value))
			{
				$this->error = $this->message;
			}
		}
		return !$this->error;
	}
}
//Lop kieu so thuc
class FloatType extends Type
{
	var $min = 0;
	var $max = 0;
	function FloatType($required=false, $messages=false, $min=0, $max=1000000000)
	{
		
		Type::Type($required, $messages);
		$this->min = $min;
		$this->max = $max;
	}
	function to_js_data($name, $word)
	{
		return '{"name":"'.$name.'","message":"'.addslashes($word).'","type":"float","require":'.($this->required?1:0).',"min":'.$this->min.',"max":'.$this->max.'}';
	}
	function check($value)
	{
		$value=str_replace(',','',$value);
		if(Type::check($value) && $value!='')
		{
			if(!is_numeric($value) or $value<$this->min or $value>$this->max or preg_match('/[^0-9\.-]/',$value))
			{
				$this->error = $this->message;
			}
		}
		return !$this->error;
	}
}
//Lop kieu so nguyen
class IntType extends FloatType
{
	function IntType($required=false, $messages=false, $min=0, $max=9999)
	{
		FloatType::FloatType($required, $messages, $min, $max);
	}
	function to_js_data($name, $word)
	{
		return '{"name":"'.$name.'","message":"'.addslashes($word).'","type":"int","require":'.($this->required?1:0).',"min":'.$this->min.',"max":'.$this->max.'}';
	}
	function check($value)
	{
		$value=str_replace(',','',$value);
		if(FloatType::check($value) && $value!='')
		{
			if(floor($value)<>$value or preg_match('/[^0-9-]/',$value))
			{
				$this->error = $this->message;
			}
		}
		return !$this->error;
	}
}
//Lop kieu id gan voi 1 bang
class IDType extends NameType
{
	var $table = false;
	function IDType($required=false, $messages=false, $table='')
	{
		NameType::NameType($required, $messages,1,50);
		$this->table=$table;
	}
	function to_js_data($name, $word)
	{
		return '{"name":"'.$name.'","message":"'.addslashes($word).'","type":"name","require":'.($this->required?1:0).',"min":'.$this->min_len.',"max":'.$this->max_len.'}';
	}
	function check($value)
	{
		$value=str_replace(',','',$value);
		if($value!='')
		{
			if(!DB::select($this->table,'id=\''.$value.'\''))
			{
				$this->error = $this->message;
			}
		}
		return !$this->error;
	}
}
class UniqueType extends Type
{
	var $table = false;
	var $field = false;
	function UniqueType($messages=false, $table, $field)
	{
		Type::Type(true, $messages, 0, 999999);
		$this->table=$table;
		$this->field=$field;
	}
	function check($value)
	{
		if(Type::check($value) && $value!='')
		{
			$cond = '';
			if (isset($_REQUEST['id']) && $_REQUEST['id'])
			{
				$cond = 'id != "'.$_REQUEST['id'].'" and ';
			}
			if(DB::exists('select id from '.$this->table.' where '.$cond.' '.$this->field.'="'.DB::escape($value).'"'))
			{
				$this->error = $this->message;
			}
			else
			{
				return !$this->error;
			}
		}
	}
}
?>
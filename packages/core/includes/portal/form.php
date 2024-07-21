<?php
class Form
{
	static $current = false;
	var $name = false;
	var $inputs = array();
	var $errors = false;
	var $error_messages = false;
	var $is_submit = false;
	var $count = 1;
	static $form_count = 1;
	static $css_count = 1;
	function Form($name=false)
	{
		$this->name=$name;
	}
	function on_submit()
	{
	}
	function is_submit()
	{
		if(!$this->is_submit)
		{
			$this->is_submit = 1;
			if(isset(Module::$current))
			{
				if(isset($_REQUEST['form_block_id']))
				{
					if($_REQUEST['form_block_id']==Module::block_id())
					{
						if($this->inputs)
						{
							$this->is_submit = 2;
							foreach($this->inputs as $name=>$types)
							{
								if(!strpos($name,'.') and !isset($_REQUEST[$name]))
								{
									$this->is_submit = 1;
									break;
								}
							}
						}
					}
				}
			}
		}
		return $this->is_submit == 2;
	}
	function add($name, $type)
	{
		$this->inputs[$name][] = $type;
	}
	function link_css($file_name)
	{
		$folder=Portal::get_setting('templates_frontend').'/cache_css/';
		$css=$folder.'page_'.Url::get('page','trang-chu').'.css';
		if(file_exists($css) and Portal::get_setting('use_cache',0)){
			if(strpos(Portal::$css_header,'<link rel="stylesheet" href="'.$css.'" type="text/css" />')===false){
				Portal::$css_header = '<link rel="stylesheet" href="'.BASE.$css.'" type="text/css" />'."\n";
			}
		}elseif(file_exists($file_name) and strpos(Portal::$css_header,'<link rel="stylesheet" href="'.$file_name.'" type="text/css" />')===false){
			Portal::$css_header .= '<link rel="stylesheet" href="'.BASE.$file_name.'" type="text/css" />'."\n";
		}
		// Tạo file cache css cho page
		/*if(!is_dir($folder)){
			@mkdir($folder,0777,true);
		}*/
		$p1='/^templates/';
		preg_match($p1,$file_name,$matches);
		if($matches){
			$ar=explode('/',$file_name);
			$temp=$ar[0].'/'.$ar[1];
		}else $temp='';
		$content=System::css_compress(@file_get_contents($file_name),$temp);
		if(!file_exists($css)){
			$handler = fopen($css,'w+');
			fwrite($handler,$content);
			fclose($handler);
		}else{
			if(Form::$css_count==1) @file_put_contents($css,'');
			$handler = fopen($css,'w+');
			fwrite($handler,$content);
			fclose($handler);
		}
		Form::$css_count++;
	}
	function link_js($file_name)
	{
		if(strpos(Portal::$js_header,'<script type="text/javascript" src="'.BASE.$file_name.'"></script>')===false)
		{
			Portal::$js_header .= '<script type="text/javascript" src="'.BASE.$file_name.'"></script>'."\n";
		}
	}
	function auto_refresh($time)
	{
		Portal::$extra_header .= '<meta http-equiv="Refresh" content="'.$time.'">';
	}
	function get_messages()
	{
		$this->error_messages=false;
		if($this->errors)
		{
			foreach($this->errors as $name=>$types)
			{
				foreach($types as $type)
				{
					$this->error_messages[$name][]=$type->get_message();
				}
			}
		}
		return $this->error_messages;
	}
	function check($exclude=array())
	{
		if($this->is_submit())
		{
			$this->errors = false;
			if($this->inputs)
			{
				foreach ($this->inputs as $name=>$types)
				{
					foreach($types as $type)
					{
						if(!in_array($name,$exclude))
						{
							if(!strpos($name,'.'))
							{
								if(!$type->check(Url::get($name)))
								{
									$this->errors[$name][] = $type;
								}
							}
							else
							{
								$names = explode('.',$name);
								$table = 'mi_'.$names[0];
								$field = $names[1];
								if(isset($_REQUEST[$table]))
								{
									if(is_array($_REQUEST[$table]))
									{
										foreach($_REQUEST[$table] as $key=>$record)
										{
											if(isset($record[$field]))
											{
												if(!$type->check($record[$field]))
												{
													$this->errors[$table.'['.$key.']['.$field.']'][] = $type;
												}
											}
											else
											{
												if(!$type->check(''))
												{
													$this->errors[$table.'['.$key.']['.$field.']'][] = $type;
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
			$this->get_messages();
			if(!$this->errors)
			{
				foreach ($this->inputs as $name=>$types)
				{
					foreach($types as $type)
					{
						if(get_class($type)=='floattype' or get_class($type)=='inttype')
						{
							if(!strpos($name,'.'))
							{
								$_REQUEST[$name] = str_replace(',','',$_REQUEST[$name]);
							}
							else
							{
								$names = explode('.',$name);
								$table = $names[0];
								$field = $names[1];
								if(isset($_REQUEST['mi_'.$table]))
								{
									if(is_array($_REQUEST['mi_'.$table]))
									{
										foreach($_REQUEST['mi_'.$table] as $key=>$record)
										{
											if(isset($record[$field]))
											{
												$_REQUEST['mi_'.$table][$key][$field] = str_replace(',','',$record[$field]);
											}
										}
									}
								}
							}
						}
					}
				}
			}
			return !$this->errors;
		}
		else
		{
			return false;
		}
	}
	function is_error()
	{
		return $this->errors<>false or $this->error_messages<>false;
	}
	function error($name, $message)
	{
		$this->error_messages[$name][]=Portal::language($message);
	}
	//In ra cac thong bao loi neu co
	function error_messages()
	{
		$this->count = Form::$form_count;
		Form::$form_count++;
		if(!$this->error_messages)
		{
			$show = ' display:none;"';
		}
		else
		{
			$show = '';
		}
		$notify=Portal::language('notify_errors');
		$txt = '<script type="text/javascript">var error_name=new Array();</script><fieldset style="margin:0 0 5px 0;border:1px solid #CDCDCD;'.$show.'" id="error_messages_'.$this->count.'"><table style="margin-top:5px;" bgcolor="#FFFFF2"><tr valign="top">';
		$txt .= '<td nowrap="nowrap"><div style="font-weight:bold;color:#FF0000;">'.$notify.'</div><div align="center"><img src="skins/default/images/icon/warning.gif"></div></td>';
		$txt.='<td style=""font-family:Arial, Helvetica, sans-serif;color:#000000;"" width="100%" id="error_messages_content'.$this->count.'" >';
		if($this->error_messages)
		{
			$i=0;
			foreach ($this->error_messages as $name=>$error_messages)
			{
				foreach($error_messages as $error_message)
				{
					if(trim($this->name))
					{
						$txt .= '<li style="margin-left:20px;"><a href="javascript:void(0)" onclick="var pos=jQuery(\'#'.$name.'\').offset(); window.scrollTo(pos.left,pos.top);jQuery(\'#'.$name.'\').focus();return false;" title="&#7844;n v&#224;o &#273;&#226;y &#273;&#7875; xem v&#7883; tr&#237; x&#7843;y ra l&#7895;i">'.$error_message.'</a><script type="text/javascript">error_name['.$i.']="'.$name.'";</script>';
						$i++;
					}
					else
					{
						$txt .= '<li style="margin-left:20px;">'.$error_message;
					}
					$txt .= '<br />';
				}
			}
		}
		$txt .= '</td></tr></table></fieldset>';
		return $txt;
	}
	//In ra cac thong bao loi neu co
	function ext_error_messages($form_name)
	{
		$this->count = Form::$form_count;
		Form::$form_count++;
		if($this->error_messages)
		{

			foreach ($this->error_messages as $name=>$error_messages)
			{
				foreach($error_messages as $error_message)
				{
					echo $form_name.'.findById(\''.$name.'\').markInvalid(\''.addslashes($error_message).'\');';
				}
			}

		}
		return $txt;
	}
	function parse_layout($name, $params=array())
	{
		$dir = ROOT_PATH.'cache/modules/'.Module::$current->data['module']['name'];
		$cache_file_name = $dir.'/'.$name.'.php';
		$file_name = Module::$current->data['module']['path'].'layouts/'.$name.'.php';
		if(!USE_CACHE || !file_exists($cache_file_name) or (($cache_time=@filemtime($cache_file_name)) and (@filemtime($cache_file_name)<@filemtime($file_name))))
		{
			require_once 'packages/core/includes/portal/generate_layout.php';
			$generate_layout = new GenerateLayout(file_get_contents($file_name));
			$text = $generate_layout->generate_text($generate_layout->synchronize());
			if(!is_dir($dir))
			{
				@mkdir($dir);
			}
			if($file = @fopen($cache_file_name,'w+'))
			{
				fwrite($file,$text);
				fclose($file);
			}
			$this->map = $params;
			$this->map['parse_layout'] = $text;
		}else{
			$this->map = $params;
			$this->map['parse_layout'] = file_get_contents($cache_file_name);
		}
		Module::invoke_event('ONPARSELAYOUT',Module::$current,$this->map);
		eval('?>'.$this->map['parse_layout'].'<?php ');
	}
	
	function draw()
	{
		
	}
	//Gan lai $current
	//Goi ham draw()
	function on_draw()
	{
		$last_form = &Form::$current;
		Form::$current = &$this;
		$this->draw();
		Form::$current=&$last_form;
	}
}
Form::$current=&System::$false;
?>
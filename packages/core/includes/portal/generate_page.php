<?php
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY vuonggialong
******************************/
require_once 'page_layout.php';

class GeneratePage
{
	var $regions = array();
	var $modules = array();
	var $blocks = array();
	function GeneratePage($row)
	{
		$this->data = $row;
		$dir = 'cache/languages/language_'.Portal::language().'.php';
		if(file_exists($dir)) require_once $dir;
	}
	function generate($return =false)
	{
		$code = '';
		$code .= $this->generate_text();
		$cache_file=ROOT_PATH.'cache/pages/'.$this->data['name'].'.cache.php';
		
		if($fp = @fopen($cache_file, 'w+'))
		{
			fwrite ($fp, $code );
			fclose($fp);
			if($return)
			{
				ob_start();
			}
			require_once $cache_file;
			if($return)
			{
				$st = ob_get_contents();
				ob_end_clean();
				return $st;
			}
		}else{
			eval('?>'.$code.'<?php ');
		}
	}
	function generate_text()
	{
		$code='<?php
Module::invoke_event(\'ONLOAD\',System::$false,System::$false);
global $blocks;
$blocks = ';
		$this->blocks = DB::select_all('block','page_id = '.$this->data['id'],'container_id,position asc,id');
		foreach($this->blocks as $id=>$block)
		{
			$this->blocks[$id]['settings'] = String::get_list(DB::fetch_all('select setting_id as id, value as name from block_setting where block_id=\''.$id.'\''),'name');						
			$settings = String::get_list(DB::fetch_all('select id, default_value as name from module_setting where module_id=\''.$block['module_id'].'\''),'name');
			foreach($settings as $setting_id=>$value)
			{
				if(!isset($this->blocks[$id]['settings'][$setting_id]))
				{
					$this->blocks[$id]['settings'][$setting_id] = $value;
				}
			}
			$this->blocks[$id]['module'] = DB::fetch('select id, name, path, type, action_module_id, use_dblclick'.(($this->blocks[$id]['container_id'] != 0)?',layout,code':'').',package_id from module where id=\''.$block['module_id'].'\'');
		}
		$code .= var_export($this->blocks,true).';
		Portal::$page = '.var_export($this->data,true).';
		foreach($blocks as $id=>$block)
		{
			require_once $block[\'module\'][\'path\'].\'class.php\';
			$blocks[$id][\'object\'] = new $block[\'module\'][\'name\']($block);
			if(URL::get(\'form_block_id\')==$id)
			{
				$blocks[$id][\'object\']->submit();
			}
		}
		require_once \'packages/core/includes/utils/draw.php\';
		?>';
		$filename = ROOT_PATH.'packages/core/includes/portal/header.php';
		$fp = fopen($filename, 'r');
		$code .= fread($fp,filesize($filename));
		fclose($fp);
		$text = file_get_contents($this->data['layout']);
		while(($pos=strpos($text,'[[|'))!==false)
		{
			$code .= substr($text, 0,  $pos);
			$text = substr($text, $pos+3,  strlen($text)-$pos-3);
			if(preg_match('/([^\|]*)/',$text, $match))
			{
				if(isset($match[1]))
				{
					$code .= $this->generate_region($match[1]);
				}
				if(($pos = strpos($text,'|]]',0))!==false)
				{
					$text = substr($text, $pos+3,  strlen($text)-$pos-3);
				}
			}
			else
			{
				break;
			}
		}
		$code .= $text;
		
		$filename = ROOT_PATH.'packages/core/includes/portal/footer.php';
		$fp = fopen($filename, 'r');
		$code .= fread($fp,filesize($filename));
		$code .= '
<?php Module::invoke_event(\'ONUNLOAD\',System::$false,System::$false);?>';
		fclose($fp);
		
		return $code;
	}
	function generate_region($region)
	{
		$code = '';
		foreach($this->blocks as $id=>$block)
		{			
			if($block['region']==$region and $block['container_id'] == 0)
			{
					$code .= '
<?php $blocks['.$id.'][\'object\']->on_draw();?>';
			}
		}
		return $code;
	}
	function generate_module_html($block_id,$module)
	{
		$module_data = DB::select('module',$module['id']);
		$code = '
		<?php 
		$blocks['.$block_id.'][\'object\'] = new Module($blocks['.$block_id.']);
		Module::$current=&$blocks['.$block_id.'][\'object\'];
		Module::invoke_event(\'ONDRAW\',$blocks['.$block_id.'][\'object\'],System::$false);';
		$results = $this->convert_language($module['id'],$module_data['layout']);
		$code .= '
?>'.$results.'<?php
		Module::invoke_event(\'ONDRAW\',$blocks['.$block_id.'][\'object\'],System::$false);';
		$code .= '
		Module::$current=&System::$false;
?>';
		
		return $code;
	}
	function generate_module_content($block_id, $module)
	{
		$module_data = DB::select('module',$module['id']);
		$code = '';
		$code = '
		<?php 
		$blocks['.$block_id.'][\'object\'] = new Module($blocks['.$block_id.']);
		Module::$current = &$blocks['.$block_id.'][\'object\'];
		';
				/*require_once 'packages/core/includes/utils/content.php';
				if($params = get_content_params($content_id))
				{
					
					$block_params = DB::fetch_all('select name as id,value from block_setting where block_id="'.$block_id.'"');
					$search = array();
					$replace = array();
					foreach($params as $param=>$type)
					{
						$search[] = '[[-'.$param.($type['type']?':'.$type['type']:'').'-]]';
						$param = str_replace(' ','_',$param);
						$replace[] = isset($block_params[$param])?$block_params[$param]['value']:'';
					}
					$row['code'] = str_replace($search, $replace, $row['code']);
					$row['layout'] = str_replace($search, $replace, $row['layout']);
				}*/
				
				require_once 'packages/core/includes/portal/generate_layout.php';
				$generate_layout = new GenerateLayout($module_data['layout']);
				$layout = str_replace('$this->map','$map',$generate_layout->generate_text($generate_layout->synchronize())); 
				//if(!$row['is_cached'])
				$results = $this->convert_language($module['id'],$layout);
				$code.=' 
					$map = array(\'content_name\'=>\''.$module['name'].'\');$ok=true;'.$module_data['code'].' 
					if($ok){
				Module::invoke_event(\'ONDRAW\',$blocks['.$block_id.'][\'object\'],System::$false);';
				$code.='?>'.$results.'<?php 
				Module::invoke_event(\'ONENDDRAW\',$blocks['.$block_id.'][\'object\'],System::$false);';
				$code.=' }';
				$code .= '
		Module::$current=&System::$false;
?>';
			
		return $code;
	}
	function convert_language($module_id, $layout)
	{
		return preg_replace('/\[\[\.(\w+)\.\]\]/','<?php echo Portal::language(\'\\1\');?>',$layout);
	}
}
?>
<?php
class ListPackageWordForm extends Form
{
	function ListPackageWordForm()
	{
		$languages = System::get_language();
		$this->languages = $languages;
		Form::Form('ListPackageWordForm');
	}
	function on_submit()
	{
		if(URL::get('records'))
		{
			foreach(URL::get('records') as $id=>$record)
			{
				if($record['id'])
				{
					$record['time'] = (isset($record['time']) and $record['time'])?Date_Time::to_time($record['time']):''; 
					$record['package_id'] = (isset($record['package_id']) and $record['package_id'])?DB::fetch('select id from package where 
						name="'.addslashes($record['package_id']).'" ','id'):array();
					if(!DB::fetch('select id from word where BINARY id="'.$record['id'].'"'))
					{
						DB::insert('word',$record);
					}
					else
					{
						DB::update('word',$record,'(BINARY id="'.$record['id'].'")');
					}
				}
			}
			if(URL::get('module_id') and $module = DB::select('module','id="'.URL::get('module_id').'"'))
			{
				require_once 'packages/core/includes/utils/dir.php';
				empty_all_dir(ROOT_PATH.'cache/modules/'.$module['name']);
			}
			Portal::make_word_cache();
			URL::redirect_current(array('module_id','block_id'));
		}
	}
	function get_cond(){
		$cond = '1';
		if(Url::get('package_id')){
			$cond.=' and '.IDStructure::child_cond(DB::structure_id('package',Url::get('package_id')));
		}
		if(Url::get('search_by_id')){
			$cond.=' and word.id LIKE "%'.Url::get('search_by_id').'%"';
		}
		return $cond;
	}
	function draw()
	{
		$cond = $this->get_cond();
		// order by
		$order_field=array('word.id','package.name');
		$order_default='word.id';
		if(URL::get('module_id') and $module=DB::select('module','id="'.URL::get('module_id').'"'))
		{
			$words = $this->get_undefined_word(URL::get('module_id'));
			$cond .= ' and (BINARY `word`.id in ("'.join(array_keys($words),'","').'"))';
		}
		$addition = '';
		$params_paging=array('order_by','search_by_id','package_id');
		foreach($this->languages as $id=>$language)
		{
			$cond .= URL::get('search_by_value_'.$id)?' and `word`.value_'.$id.' LIKE "%'.URL::get('search_by_value_'.$id).'%"':'';
			$order_field=array_merge($order_field,array('word.value_'.$id));
			$params_paging=array_merge($params_paging,array('search_by_value_'.$id));
			$addition = $addition.',`word`.`value_'.$id.'`';
		}
		$item_per_page = Module::$current->get_setting('item_per_page',50);
		DB::query('
			select
				count(*) as acount
			from 
			 	`word`
				left outer join `package` on `package`.id=`word`.`package_id`
			where
				'.$cond.'
			limit 0,1
		');
		$count = DB::fetch();
		require_once 'packages/core/includes/utils/paging.php';
		$paging = paging($count['acount'],$item_per_page,$params_paging);
		DB::query('
			select 
				`word`.id
				,IF(`word`.`time`>0,FROM_UNIXTIME(`word`.`time`,"%d/%m/%Y"),"") as time 
				'.$addition.'
				,`package`.name as package_id 
			from 
			 	`word`
				left outer join `package` on `package`.id=`word`.`package_id`
			where
				'.$cond.'
			'.String::order_by_sql($order_field,$order_default).'
			limit
				'.((page_no()-1)*$item_per_page).','.$item_per_page.'
		');
		$items = DB::fetch_all();
		$packages = DB::fetch_all('
			select
				id,name,structure_id
			from 
				package 
			order by 
				structure_id
		'); 
		$i=1;
		foreach ($items as $key=>$value)
		{
			$items[$key]['i']=$i++;
		}
		$new_items = array();
		if(isset($module) and isset($words) and !(URL::get('search_by_id') or URL::get('search_by_time')or URL::get('search_by_value_1')or URL::get('search_by_value_2'))and URL::get('cmd')!='delete')
		{
			$package = DB::select('package',$module['package_id']);
			
			foreach($words as $word_id=>$word)
			{
				if(!isset($items[$word_id]))
				{
					$new_items[$word_id] = array(
						'id'=>$word_id,
					);
					foreach($this->languages as $language)
					{
						$new_items[$word_id]['value_'.$language['id']] = ucfirst(str_replace('_',' ',$word_id));
					}
					$new_items[$word_id] += array(
						'package_id'=>$package['name'],
						'time'=>date('d/m/Y'),
					);
				}
			}
		}
		$this->parse_layout('list',
			array(
				'module_name'=>isset($module)?$module['name']:'',
				'items'=>$items,
				'total'=>$count['acount'],
				'new_items'=>$new_items,
				'paging'=>$paging,
				'package_id_list'=>array(''=>'')+String::get_list($packages),
				'languages'=>$this->languages
			)
		);
	}
	function get_undefined_word($module_id)
	{
		$words = array();
		if($module_id)
		{
			$module = DB::select('module',$module_id);
			$package = DB::select('package',$module['package_id']);
			if($module['name'] == 'HTML' and URL::get('block_id') and $html = Module::get_setting('html',false,URL::get('block_id')))
			{
				$words=$this->get_words(false,$words,$module['id'],$package['structure_id'],$html);
				$words=$this->get_form_words(false,$words,$module['id'],$package['structure_id'],$html);
			}
			if(URL::get('block_id') and $cache = Module::get_setting('cache',false,URL::get('block_id')))
			{
				$words=$this->get_words(false,$words,$module['id'],$package['structure_id'],$cache);
				$words=$this->get_form_words(false,$words,$module['id'],$package['structure_id'],$cache);
			}
			if(($module['name'] == 'Frame' or $module['name'] == 'Content') and URL::get('block_id') and $title = Module::get_setting('title',false,URL::get('block_id')) and !strpos($title,'\''))
			{
				$text = ucfirst(str_replace('_',' ',$title));
				$word_text = array();
				foreach($this->languages as $language)
				{
					if($language['id']!=1)
					{
						$word_text+=array($language['id']=>$text);
					}
				}
				$this->add_word($words,$title,$word_text,$package['structure_id']);
			}
			if($module['type'] == '' or $module['type'] == 'SERVICE')
			{
				require_once 'packages/core/includes/portal/package.php';
				$path = ROOT_PATH.get_package_path($module['package_id']).'modules/'.$module['name'].'/layouts';
				if(is_dir($path) and $dir = opendir($path))
				{
					while($file = readdir($dir))
					{
						if($file!='.' and $file!='..' and !is_dir($path.'/'.$file))
						{
							$words=$this->get_words($path.'/'.$file,$words,$module['id'],$package['structure_id']);
						}
					}
					closedir($dir);
				}
				$path = ROOT_PATH.get_package_path($module['package_id']).'modules/'.$module['name'].'/forms';
				if(is_dir($path) and $dir = opendir($path))
				{
					while($file = readdir($dir))
					{
						if($file!='.' and $file!='..')
						{
							$words=$this->get_form_words($path.'/'.$file,$words,$module['id'],$package['structure_id']);
						}
					}
					closedir($dir);
				}
			}
			else
			{
				$words=$this->get_words(false,$words,$module['id'],$package['structure_id'],$module['layout']);
				$words=$this->get_form_words(false,$words,$module['id'],$package['structure_id'],$module['code']);
			}
		}
		return $words;
	}
	function get_words($file, $words, $module_id, $structure_id, $st = '')
	{
		if($file)
		{
			$f = fopen($file,'r');
			while(!feof($f))
			{
				$st .= fread($f,1000);
			}
			fclose($f);
		}
		if(preg_match_all('/\[\[\.(\w+)\.\]\]/',$st,$found_words))
		{
			foreach($found_words[1] as $word)
			{
				if(!isset($words[$word]))
				{
					$text = ucfirst(str_replace('_',' ',$word));
					$word_text = array();
					foreach($this->languages as $language)
					{
						if($language['id']!=1)
						{
							$word_text+=array($language['id']=>$text);
						}
					}
					$this->add_word($words,$word,$word_text,$structure_id);
				}
			}
		}
		return $words;
	}
    function get_form_words($file, $words, $module_id, $structure_id, $st = '')
	{
		if($file and is_file($file) and file_exists($file))
		{
			$f = fopen($file,'r');
			while(!feof($f))
			{
				$st .= fread($f,1000);
			}
			fclose($f);
			if(preg_match_all('/Type\(\w+,\'(\w+)\'/',$st,$found_words))
			{
	
				foreach($found_words[1] as $word)
				{
					if(!isset($last_words[$word]))
					{
						$text = ucfirst(str_replace('_',' ',$word));
						$word_text = array();
						foreach($this->languages as $language)
						{
							if($language['id']!=1)
							{
								$word_text+=array($language['id']=>$text);
							}
						}
						$this->add_word($words,$word,$word_text,$structure_id);
					}
				}
			}
			if(preg_match_all('/error\(\'\w+\',\s*\'(\w+)\'/',$st,$found_words))
			{
				foreach($found_words[1] as $word)
				{
					if(!isset($last_words[$word]))
					{
						$text = ucfirst(str_replace('_',' ',$word));
						$word_text = array();
						foreach($this->languages as $language)
						{
							if($language['id']!=1)
							{
								$word_text+=array($language['id']=>$text);
							}
						}
						$this->add_word($words,$word,$word_text,$structure_id);
					}
				}
			}
			if(preg_match_all('/Portal::language\(\'(\w+)\'/i',$st,$found_words))
			{
	
				foreach($found_words[1] as $word)
				{
					if(!isset($last_words[$word]))
					{
						$text = ucfirst(str_replace('_',' ',$word));
						$word_text = array();
						foreach($this->languages as $language)
						{
							if($language['id']!=1)
							{
								$word_text+=array($language['id']=>$text);
							}
						}
						$this->add_word($words,$word,$word_text,$structure_id);
					}
				}
			}
		}
		return $words;

	}
	function add_word(&$words,$word,$word_text,$structure_id)
	{
		if(!isset($words[$word]))
		{
			if($package_word = DB::fetch('select word.*, package.name as package_name from word inner join package on (BINARY package.id=package_id) where (BINARY word.id="'.addslashes($word).'") and '.IDStructure::path_cond($structure_id).' order by structure_id desc'))
			{
				foreach($this->languages as $language)
				{
					$word_text[$language['id']] = $package_word['value_'.$language['id']];
				}
				$words[$word] = $word_text + array('private'=>0, 'package_name'=>$package_word['package_name']);
			}
			else
			{
				$words[$word] = $word_text + array('private'=>1);
			}
		}
	}
}
?>
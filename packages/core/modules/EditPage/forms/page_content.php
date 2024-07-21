<?php
class PageContentForm extends Form
{
	function PageContentForm()
	{
		Form::Form('pageContentForm');
		$this->link_js('lib/js/jquery/jquery.js');
		$this->link_js('lib/js/jquery/jqueryui.js');
		$this->link_css('lib/js/jquery/ui/themes/base/jquery.ui.all.css');
		$this->link_css('templates/admin/css/system.css');
		$this->link_css('templates/admin/css/style.css');
	}
	function draw_list($region, $items)
	{
		$i = 0;
		$last = false;
		foreach ($items as $key=>$item)
		{
			unset($this->all_blocks[$key]);
			if($i)
			{
				if($i>1)
				{
					$last['move_up'] = '<a href="'.Url::build_current(array('block_id'=>$last['id'],'move'=>'up','container_id')).'"><img src="templates/admin/images/buttons/up_arrow.gif" title="Lên trên" alt="Lên trên"></a>';
				}
				$last['move_down'] = '<a href="'.Url::build_current(array('block_id'=>$last['id'],'move'=>'down','container_id')).'"><img src="templates/admin/images/buttons/down_arrow.gif" title="Xuống dưới" alt="Xuống dưới"></a>';
			}
			$i++;
			$items[$key]['href']=Url::build('block_setting',array('block_id'=>$item['id']));
			$last = &$items[$key];
		}
		if($i>1)
		{
			$items[$key]['move_up']='<a href="'.Url::build('edit_page',array('id','block_id'=>$item['id'],'move'=>'up','container_id')).'"><img src="templates/admin/images/buttons/up_arrow.gif" title="Lên trên" alt="Lên trên"></a>';
		}
		foreach($items as $id=>$item)
		{
			$items[$id]['regions'] = $this->get_item_regions($item);
		}
		$layout = new Layout('list_block',array('items'=>$items,'name'=>$region));
		ob_start();
		$layout->show();
		$text = ob_get_contents();
		ob_end_clean();
		return $text;
	}
	function draw()
	{
		$this->all_blocks = DB::fetch_all('
			select 
				block.id, 
				block.module_id, 
				block.page_id, 
				block.container_id, 
				block.region, 
				block.position, 
				block.name as block_name, 
				module.name, 
				module.path, 
				\'\' as move_up, 
				\'\' as move_down 
			from 
				block 
				inner join module on module.id=module_id 
			where 
				page_id='.$_REQUEST['id'].' 
			order by 
				position 
		');
		$this->get_layout();
		ob_start();
		$this->layout->pure_show();
		$regions = ob_get_contents();
		ob_end_clean();
		$this->get_new_modules();
		$this->get_packages();
		$this->parse_layout('page_content', $this->page+array(
			'package_id_list'=>$this->package_id_list,
			'layout_list'=>$this->get_all_layouts(),
			'regions'=>$regions,
			'new_modules'=>$this->new_modules,
			'packages'=>$this->packages
		));
	}
	function get_layout()
	{
		require_once 'packages/core/includes/portal/layout.php';
		$this->page_id = $_REQUEST['id'];
		DB::query('
			select 
				page.*,
				title_'.Portal::language().' as title
			from
				page
			where
				id='.$this->page_id
		);
		$this->page = DB::fetch();
	
		$this->layout_text = file_get_contents($this->page['layout']);
		
		$this->get_regions();
		$this->layout = new Layout(false, $this->regions, $this->layout_text.($this->all_blocks?'<p><h1>Undefined region modules</h1>[[|undefined_regions|]]</p>':''));
		$_REQUEST['layout'] = $this->page['layout'];
	}
	function get_regions()
	{
		$this->regions = array();
		if(
			preg_match_all('/\[\[\|([^\|]+)\|\]\]/i', $this->layout_text, $region_matchs,PREG_SET_ORDER))
		{		
			foreach($region_matchs as $region)
			{
				$modules = DB::fetch_all('
					select 
						block.id, 
						block.module_id, 
						block.page_id, 
						block.container_id, 
						block.region, 
						block.position, 
						block.name as block_name, 
						module.name,
						module.image_url,
						module.path, 
						\'\' as move_up, 
						\'\' as move_down 
					from 
						block 
						inner join module on module.id=module_id 
					where 
						page_id='.$this->page_id.' 
						and region=\''.$region[1].'\'
						and container_id=0 
					order by 
						position
				');
				$this->regions[$region[1]] = $this->draw_list($region[1], $modules);
			}
		}
		$this->regions['undefined_regions'] = $this->draw_list('undefined_regions', $this->all_blocks);
	}
	function get_packages()
	{
		$this->packages = DB::fetch_all('select * from package order by structure_id');
		$this->package_id_list = String::get_list($this->packages);
		
		foreach($this->packages as $package)
		{
			$this->packages[$package['id']]['modules'] = array();
		}
		$modules = DB::fetch_all('select id, name,package_id from module order by name');
		foreach($modules as $module)
		{
			if(isset($this->packages[$module['package_id']]))
			{
				$this->packages[$module['package_id']]['modules'][$module['id']] = $module;
			}
		}
	}
	function get_new_modules()
	{
		DB::query("
			select
				*
			from 
				module
			where 
				name like 'Footer' 
				or name like 'Header' 
				or name like 'ColumnLayout' 
				or name like 'Frame' 
				or name like 'HTML'
				or name like 'Advertisment'
				or name like 'Survey'
				or name like 'WebLink'
				or name like 'Visitors'
				or name like 'TagList'
				or name like 'SupportOnline'
				or name like 'Breadcrumb'
				or name like 'MenuTop'
				or name like 'HomeUtility'
			order by 
				name
		");
		$this->new_modules = DB::fetch_all();
	}
	function get_item_regions($item)
	{
		if(!is_dir($item['path'].'layouts'))
		{
			return '';
		}
		$dir = opendir($item['path'].'layouts');
		$regions = array();
		$layout = '';
		while($file=readdir($dir))
		{
			if(is_file($item['path'].'layouts/'.$file))
			{
				if($file == 'layout.php')
				{
					$current_module = &Module::$current;
					$row = DB::select('block',$item['id']);
					$row['settings'] = String::get_list(DB::fetch_all("select setting_id as id, value as name from block_setting where block_id='".$item['id']."'"),'name');
					$row['module'] = DB::select('module',$row['module_id']);
					$object = new Module($row);
					ob_start();
					eval('?>'.file_get_contents($item['path'].'layouts/'.$file).'<?php ');
					$layout = ob_get_clean();
					Module::$current = &$current_module;
					$text = $layout;
				}
				else
				{
					$text = file_get_contents($item['path'].'layouts/'.$file);
				}
				//System::debug($text);
				if(preg_match_all('/\[\[--([^\-\]]+)--\]\]/i', $text, $patterns))
				{
					foreach($patterns[1] as $pattern)
					{
						if(!isset($regions[$pattern]))
						{
							$modules = DB::fetch_all("
								select 
									block.*, 
									module.name, 
									module.image_url, 
									module.path, 
									'' as move_up, 
									'' as move_down 
								from 
									block 
									inner join module on module.id=module_id 
								where 
									page_id=".$this->page_id."
									and region='".$pattern."' 
									and container_id=".$item['id']."
								order by 
									position
							");
							$regions[$pattern] = '';
							$regions[$pattern] .= '<div style="background-color:#fff; padding:10px;" class="item-region" region="'.$pattern.'" container_id="'.$item['id'].'">
								  <div style="text-transform:uppercase;text-align:left;">&nbsp;&nbsp;::&nbsp;&nbsp;&nbsp;<b>'.$pattern.'</b>&nbsp;&nbsp;&nbsp;&nbsp;::</div><div style="border:1px solid #ccc; padding:5px;">';
							$i=1;
							$total_module=sizeof($modules);
							foreach($modules as $module)
							{
								unset($this->all_blocks[$module['id']]);
								$move_up=$move_down='';
								if($i)
								{
									if($i>1){
										$move_up = '<a href="'.Url::build_current(array('block_id'=>$module['id'],'move'=>'up','container_id'=>$item['id'])).'"><img src="templates/admin/images/buttons/up_arrow.gif" title="Lên trên" alt="Lên trên"></a>';
									}
									if($i<$total_module){
										$move_down = '<a href="'.Url::build_current(array('block_id'=>$module['id'],'move'=>'down','container_id'=>$item['id'])).'"><img src="templates/admin/images/buttons/down_arrow.gif" title="Xuống dưới" alt="Xuống dưới"></a>';
									}
								}
								$i++;
								$href = Url::build('block_setting',array('block_id'=>$module['id']));
								$regions[$pattern] .= '<div class="module-item">
															<div align="center">
															  <a href="'.$href.'" class="new-module" module_name="'.$module['name'].'" block_id="'.$module['id'].'" region_current="'.$module['region'].'">'.(($module['image_url'] and file_exists($module['image_url']))?'<img src="'.$module['image_url'].'" />':'<div align="left"><strong>'.$module['name'].'</strong></div>').'</a>
														  </div>
														  <div class="controls clrfix" style="position:absolute; top:2px; right:2px;">
															  <a style="float:left; padding-right:10px;" href="'.URL::build_current(array('cmd'=>'delete','id'=>$module['id'])).'"><strong><img src="templates/admin/images/buttons/delete.gif" width="12" height="12" border="0" ></strong></a>
															  <a style="float:left; padding-right:10px;" href="'.URL::build('package_word',array('module_id'=>$module['module_id'])).'" target="_blank"><strong><img src="templates/admin/images/buttons/language.jpg" width="17" border="0" title="Ngôn ngữ" alt="Ngôn ngữ" ></strong></a>
															  <div style="float:left; width:30px; text-align:left;">
																  <strong>'.$move_up.'</strong>
																  <strong>'.$move_down.'</strong>
															  </div>
														  </div>
														</div>';
								$regions[$pattern] .= '<div>'.$this->get_item_regions($module).'</div>';
								
							}
							$regions[$pattern] .= '<div align="left" style="padding:5px;">[ <a href="'.Url::build('module',array('page_id'=>$_REQUEST['id'],'container_id'=>$item['id'])).'&region='.$pattern.'"><img src="templates/admin/images/buttons/add.jpg" title="Thêm module" alt="Thêm module" /></a> ]</div>
								</div></div>';
						}
					}
				}
			}
		}
		
		closedir($dir);
		if($layout)
		{
			foreach($regions as $name=>$value)
			{
				$layout = str_replace('[[--'.$name.'--]]',$value,$layout);
			}
		}
		else
		{
			$layout = join('',$regions);
		}
		return $layout;
	}
	function get_all_layouts()
	{
		require_once 'packages/core/includes/portal/package.php';
		global $packages;
		$layouts = array();
		foreach($packages as $package)
		{
			if(is_dir($package['path'].'layouts'))
			{
				$dir = opendir($package['path'].'layouts');
				while($file = readdir($dir))
				{
					if($file != '.' and $file != '..' and is_file($package['path'].'layouts/'.$file))
					{
						$layouts[$package['path'].'layouts/'.$file] = $package['name'].'/'.substr($file, 0, strrpos($file,'.'));
					}
				}
				closedir($dir);
			}
		}
		return $layouts;
	}
}
?>
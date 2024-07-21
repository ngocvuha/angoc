<?php
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY VUONGIGALONG
EDIT BY MINHTC
******************************/
class EditPage extends Module
{
	function EditPage($row)
	{
		Module::Module($row);
		require_once 'db.php';
		require_once 'packages/core/includes/portal/update_page.php';
		if(User::can_admin())
		{
			require_once 'packages/core/includes/portal/page_layout.php';
			if(Url::check(array('cmd'=>'change_layout','id','new_layout'))) // thay đổi layout
			{
				EditPageDB::update_page_layout($_REQUEST['new_layout'],URL::get('id'));
				
				update_page(URL::get('id'));
				if(URL::check('href'))
				{
					URL::redirect_url(URL::get('href'));
				}
				else
				{
					Url::redirect_current(array('id'=>URL::get('id')));
				}
			}
			else // xóa một module
			if(Url::check(array('cmd'=>'delete','id')) and $block=DB::select('block',$_REQUEST['id']))
			{
				$this->delete_sub_blocks($_REQUEST['id']);
				update_page($block['page_id']);
				if(URL::check('href'))
				{
					URL::redirect_url(URL::get('href'));
				}
				else
				{
					Url::redirect_current(array('id'=>$block['page_id']));
				}
			}
			else // di chuyển module trong một region sang một region khác
			if(Url::check(array('cmd'=>'move_block','id','block_id','region')) and DB::select('block',$_REQUEST['block_id']))
			{
				$page = DB::select('page',$_REQUEST['id']);
				
				if(URL::get('container_id') and $block = DB::select('block',URL::get('container_id')) and $module = DB::select('module',$block['module_id']))
				{
					if($this->is_parent_block($_REQUEST['block_id'],$block))
					{
						Url::redirect_current(array('id'));
					}
					$layout='';
					$layout_text = $this->regions_to_layout_text(PageLayout::get_module_regions($module));
					
				}
				else
				{
					$layout=$page['layout'];
					$layout_text = false;
				}
				$layout = new PageLayout($layout, $layout_text);
				
				if($position = $layout->get_next_position('page','block', $_REQUEST['id'],$_REQUEST['region'],URL::get('container_id')?' and container_id='.$_REQUEST['container_id']:false))
				{
					EditPageDB::update_block($_REQUEST['region'], $position,URL::get('container_id'),$_REQUEST['block_id']);
					
					update_page($_REQUEST['id']);
				}
				Url::redirect_current(array('id'));
			}
			else // thay đổi vị trí các module trong một region
			if(Url::check(array('move','block_id')))
			{
				$block=DB::select('block',$_REQUEST['block_id']);
				PageLayout::move('page','block',$_REQUEST['block_id'],$_REQUEST['move'],URL::get('container_id')?' and container_id='.$_REQUEST['container_id']:false);
				update_page($block['page_id']);
				if(URL::check('href'))
				{
					URL::redirect_url(URL::get('href'));
				}
				else
				{
					Url::redirect_current(array('id'=>$block['page_id']));
				}
			}
			else
			{
				if(Url::check(array('module_id','region'))) // di chuyển module từ ngoài vào một region
				{
					$page = DB::select('page',$_REQUEST['id']);
					if(URL::get('container_id') and $block = DB::select('block',URL::get('container_id')) and $module = DB::select('module',$block['module_id']))
					{
						$layout = '';
						$layout_text = $this->regions_to_layout_text(PageLayout::get_module_regions($module));
					}
					else
					{
						$layout=$page['layout'];
						$layout_text = false;
					}
		
					$layout = new PageLayout($layout, $layout_text);
					
					
					if(URL::check('after') and $after = DB::select('block',URL::get('after')))
					{
						EditPageDB::increment_all_after_block_position($after['page_id'],$after['region'],$after['position'],$after['container_id']);
						$position = $after['position']+1;
						if(URL::check('replace'))
						{
							DB::delete('block_setting', 'block_id='.URL::get('after'));
							DB::delete_id('block',URL::get('after'));
						}
					}
					else
					{
						$position = $layout->get_next_position('page','block', $_REQUEST['id'],$_REQUEST['region'],URL::get('container_id')?' and container_id='.$_REQUEST['container_id']:false);
					}
					
					if($position)
					{
						DB::insert('block', array('region'=>$_REQUEST['region'], 'position'=>$position,'page_id'=>$_REQUEST['id'],'module_id'=>$_REQUEST['module_id'],'container_id'=>URL::get('container_id',0)));
						update_page($_REQUEST['id']);
					}
					if(URL::check('href'))
					{
						URL::redirect_url(URL::get('href'));
					}
					else
					{
						Url::redirect_current(array('id'));
					}
				}
				else
				{
					if(URL::check('id') and DB::select('page',URL::get('id')))
					{
						require_once 'forms/page_content.php';
						$this->add_form(new PageContentForm());
					}
					else
					{
						Url::redirect_current(array('id'));
					}
				}
			}
		}
		else
		{
			Url::access_denied();
		}
	}
	function regions_to_layout_text($regions)
	{
		$layout = '';
		foreach($regions as $region)
		{
			$layout .= '[[|'.$region.'|]]';
		}
		return $layout;
	}
	function delete_sub_blocks($id)
	{
		
		$blocks = EditPageDB::select_all_block_in_container($id);
		
		foreach($blocks as $block)
		{
			$this->delete_sub_blocks($block['id']);
		}
		DB::delete('block_setting', "block_id='".$id."'");
		DB::delete_id('block',$id);
	}
	function is_parent_block($block_id, $child)
	{
		if($child['id'] == $block_id)
		{
			return true;
		}
		if($child['container_id'])
		{
			return $this->is_parent_block($block_id, DB::select('block',$child['container_id']));
		}
	}
}			
			
?>
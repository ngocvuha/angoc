<?php
class CloneLib
{
	static function clone_page($page)
	{
		$old_page_id = $page['id'];
		unset($page['id']);
		if($new_page_id=DB::insert('page', $page))
		{
			if($blocks = DB::fetch_all('select * from block where page_id='.$old_page_id.' order by container_id'))
			{
				$match_blocks = array();
				foreach($blocks as $old_block_id=>$block)
				{
					if($block['container_id'] and isset($match_blocks[$block['container_id']]))
					{
						$block['container_id'] = $match_blocks[$block['container_id']];
					}
					unset($block['id']);
					$block['page_id'] = $new_page_id;
					if($new_block_id=DB::insert('block',$block))
					{
						$match_blocks[$old_block_id] = $new_block_id;
						DB::query('insert block_setting(block_id, value, setting_id) select '.$new_block_id.',value, setting_id from block_setting where block_id='.$old_block_id);
					}
				}
			}
			return true;
		}
	}
	function copy_folder($dir_name,$copy_to)
	{
		if(!is_dir($copy_to))
		{
			mkdir($copy_to);
			if(is_dir($dir_name))
			{
				$dir_handle = opendir($dir_name);
				while($file = readdir($dir_handle))
				{ 
					if ($file != "." && $file != ".." && $file!='items' && $file!='upload')
					{
						if (!is_dir($dir_name."/".$file))
						{
							copy($dir_name."/".$file,$copy_to."/".$file);
						}
						else 
						{
							CloneLib::copy_folder($dir_name."/".$file,$copy_to."/".$file); 
						} 
					}
				}
				
			}
		}
	}
	static function unclone_page($page)
	{
		if($blocks = DB::fetch_all('select * from block where page_id='.$page['id']))
		{
			foreach($blocks as $block_id=>$block)
			{
				DB::delete('block_setting','block_id='.$block_id);
				DB::delete('block','id='.$block_id);
			}
		}
		DB::delete('page','id='.$page['id']);
	}
}
?>
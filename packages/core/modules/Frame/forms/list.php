<?php
class FrameForm extends Form
{
	function FrameForm()
	{
		Form::Form('FrameForm');
		if(Module::get_setting('frame_skin_template'))
		{
			$this->link_css(Module::get_setting('frame_skin_template').'/style.css');
		}
	}
	function draw()
	{
		if(Module::get_setting('frame_template') and file_exists(Module::get_setting('frame_template').'/layout.php'))
		{
			$frame_code = file_get_contents(Module::get_setting('frame_template').'/layout.php');
		}
		else
		{
			$frame_code = '{{-content-}}';
		}
		if(Module::get_setting('title_category')){
			if(Url::get('category_id') and $category = DB::fetch('select id,structure_id,name_'.Portal::language().' as name,name_id from category where id="'.Url::iget('category_id').'"')){
				$title = $category['name'];
			}else
			if(Url::get('category_name') and $category = DB::fetch('select id,structure_id,name_'.Portal::language().' as name,name_id from category where name_id="'.Url::sget('category_name').'"')){
				$title = $category['name'];
			}elseif(Url::get('structure_id') and $category = DB::fetch('select id,structure_id,name_'.Portal::language().' as name,name_id from category where structure_id="'.Url::get('structure_id').'"')){
				$title = $category['name'];
			}else{
				if($title = Module::get_setting('title')){
					$title = Portal::language($title);
				}else{
					$title = '';
				}
			}
		}elseif(Module::get_setting('path_category')){
			if(Url::get('category_name') and $category = DB::fetch('select id,structure_id,type,name_'.Portal::language().' as name,name_id from category where name_id="'.Url::nget('category_name').'"')){
				$page=array(
					'NEWS'=>'tin-tuc',
					'PRODUCT'=>'san-pham',
					'PHOTO'=>'thu-vien-anh',
					'MEDIA'=>'video'
				);
				$title = DB::fetch_all('select id,structure_id,url,type,name_'.Portal::language().' as name,name_id from category where type="'.$category['type'].'" and structure_id<>'.ID_ROOT.' and status<>"HIDE" and '.IDStructure::path_cond($category['structure_id']).' ORDER BY structure_id');
				foreach($title as $key=>$value){
					if(!$value['url']){
						$title[$key]['url']=Url::build($page[$value['type']],array('category_name'=>$value['name_id']));
					}
					$title[$key]['level'] = IDStructure::level($value['structure_id']);
				}
			}else{
				if($title = Module::get_setting('title')){
					$title = Portal::language($title);
				}else{
					$title = '';
				}
			}
		}else{
			if($title = Module::get_setting('title'))
			{
				if(strpos($title,'Portal::'))
				{
					eval('$title="'.$title.'";');
				}else{
					$title=Portal::language($title);
				}
			}else{
				$title = '';
			}
		}
		$frame_code = str_replace(
			array('{{-content-}}','{{-title-}}','{{-path-}}'),
			array(
				'<?php Module::get_sub_regions(\'content\');?>',
				'<?php echo $title;?>',
				'<?php $path=$title;?>'
			),
			$frame_code
		);
		if(Module::get_setting('frame_skin_template') and preg_match('/packages\/(\w+)\/templates\/Frame\/skins\/(\w+)/',Module::get_setting('frame_skin_template'),$patterns))
		{
			//System::debug($patterns);
			$frame_code = '<div class="'.$patterns[1].'-frame-'.$patterns[2].'">'.$frame_code.'</div>';
		}
		eval('?>'.$frame_code.'<?php ');
	}
}
?>
<?php
class DuplicatePageForm extends Form
{
	function DuplicatePageForm()
	{
		Form::Form('duplicatePage');
		$this->add('id',new IDType(true,false,'page'));
		$this->add('name',new TextType(true,'please_enter_name',0,255));
		$this->add('title_1',new TextType(true,'please_enter_title',0,255));
	}
	function on_submit()
	{
		if($this->check())
		{
			if(DB::select('page',"name='".Url::get('name')."' and theme = '".Url::get('theme')."'"))
			{
				$this->error('name','this_name_is_exists');
			}
			else
			{
				if($page = DB::select('page',URL::get('id')))
				{
					require_once 'packages/core/includes/portal/clone.php';
					$page['title_1'] = Url::get('title_1');
					$page['name'] = Url::get('name');
					if(CloneLib::clone_page($page))
					{
						Url::redirect_current();
					}
				}else{
					$this->error('name','page_source_is_not_exists');
				}
			}
		}
	}		
	function draw()
	{
		if(!$page = DB::exists_id('page',URL::get('id'))){
			$page['name']='<b style="color:red;">Trang gốc không tồn tại</b>';
		}
		$this->parse_layout('duplicate',$page+array('theme_list'=>array('web'=>'desktop','mobile'=>'Mobile')));
	}
}
?>
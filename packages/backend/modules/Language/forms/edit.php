<?php
class EditLanguageForm extends Form
{
	function EditLanguageForm()
	{
		Form::Form('EditLanguageForm');
		if(URL::get('cmd')=='edit')
		{
			$this->item = DB::exists_id('language',Url::iget('id'));
		}
		$this->add('code',new TextType(false,'please_enter_code',0,255)); 
		$this->add('name',new TextType(true,'please_enter_name',0,255));
	}
	function on_submit()
	{
		if($this->check())
		{
			$rows = array(
				'code','name','status','position','main'
			);
			/* Luôn luôn phải có ngôn ngữ mặc định */
			if($this->item['main'] and !Url::get('main')){
				$this->error('main','can_not_empty_default_language');
				return false;
			}
			/* Ngôn ngữ mặc định không được ở trạng thái ẩn */
			if($this->item['main'] and !Url::get('status')){
				$this->error('main','can_not_hide_default_language');
				return false;
			}
			/* Up ảnh đại diện của ngôn ngữ */
			require_once 'packages/core/includes/utils/upload_file.php';
			$dir = 'data/language/';
			$error = update_upload_file('icon_url',$dir);
			if($error){
				$this->error('icon_url',$error);
				return false;
			}
			if(Url::get('icon_url')!=''){
				$rows = array_merge($rows,array('icon_url'));
			}
			if(URL::get('cmd')=='edit' and $row=$this->item)
			{
				$id = Url::iget('id');
				if(isset($rows['icon_url']) and file_exists($rows['icon_url']) and isset($row['icon_url']) and file_exists($row['icon_url'])){
					@unlink($row['icon_url']);
				}
				if(DB::update_id('language', $rows, $id)){
					if(Url::get('main')){
						DB::update('language',array('main'=>0),'id!='.$id);
						$this->update_default_language($id);
					}
				}
			}
			else
			{
				require_once 'packages/core/includes/system/si_database.php';
				if($id = DB::insert('language', $rows)){
					if(Url::get('main')){
						DB::update('language',array('main'=>0),'id!='.$id);
						$this->update_default_language($id);
					}
				}
			}
			Language::update_portal_language();
			Language::make_cache_language();
			Url::redirect_current();
		}
	}
	function update_default_language($default_language_id){
		if($item=DB::select('setting','name="default_language"')){
			DB::update_id('setting',array('value'=>$default_language_id),$item['id']);
		}else{
			DB::insert('setting',array('name'=>'default_language','value'=>$default_language_id));
		}
		Session::delete('language_changed');
		@unlink('cache/config/config.php');
	}
	function draw()
	{
		if(URL::get('cmd')=='edit' and $row=$this->item)
		{
			foreach($row as $key=>$value)
			{
				if(is_string($value) and !Url::get($key))
				{
					$_REQUEST[$key] = $value;
				}
			}
		}
		$this->parse_layout('edit');
	}
}
?>
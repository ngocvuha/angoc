<?php
class GrantModeratorForm extends Form
{
	function GrantModeratorForm()
	{
		Form::Form('GrantModeratorForm');
		$this->add('account_id',new TextType(true,'please_enter_account',0,255));
	}
	function on_submit()
	{
		if($this->check())
		{
			if(Url::get('account_id') and !DB::fetch("select * from account where id='".Url::sget('account_id')."'"))
			{
				$this->error('account_id','account_id_not_exist');
				return false;	
			}		
			if(!$privilege_ids = Url::get('privilege_id'))
			{
				$this->error('privilege_id','please_choose_privilege');
				return false;
			}
			ModeratorDB::update_moderator(Url::get('account_id'),$privilege_ids);
			Url::redirect_current();
		}
	}
	function draw()
	{
		$this->map = array();
		$privileges = ModeratorDB::get_privilege();
		if($account=Url::nget('account_id') and $items=ModeratorDB::get_account_privilege($account))
		{
			foreach($items as $key=>$privilege){
				if(isset($privileges[$key])) $privileges[$key]['checked'] = 'checked="checked"';
			}
		}
		$this->map['users']=String::array2suggest(ModeratorDB::get_users());
		$this->map['privilege'] = $privileges;
		$this->parse_layout('select_portal',$this->map);
	}
}
?>
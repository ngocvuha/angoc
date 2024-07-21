<?php
class EditUserAdminForm extends Form
{
	function EditUserAdminForm()
	{
		Form::Form('EditUserAdminForm');
	}
	function on_submit()
	{
		if(URL::get('confirm_edit'))
		{
			$account_new_row = array(
				'create_date'=>time(),
				'is_active'=>URL::get('active'), 
				'is_block'=>URL::get('block'),
				'email'=>URL::get('email'),
				'type'=>'USER',
				'cache_privilege'=>''
			);
			if(URL::get('cmd')=='edit' and $id=Url::nget('account_id'))
			{
				if(Url::get('password')){
					$account_new_row+=array('password'=>User::encode_password(Url::get('password')));
				}
				DB::update('account', $account_new_row,'id=\''.$id.'\'');
			}
			else
			{
				$account_new_row+=array(
					'id'=>Url::nget('account_id'),
					'password'=>User::encode_password(Url::get('password'))
				);
				$id = DB::insert('account', $account_new_row);
			}
			Url::redirect_current();
		}
	}
	function draw()
	{
		if(URL::get('cmd')=='edit' and $account = DB::exists_id('account',URL::nget('account_id')))
		{
			unset($account['password']);
			foreach($account as $key=>$value)
			{
				if(is_string($value) and !isset($_POST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
		}
		$this->parse_layout('edit');
	}
}
?>

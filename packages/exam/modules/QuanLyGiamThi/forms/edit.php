<?php
class EditQuanLyGiamThiForm extends Form
{
	function EditQuanLyGiamThiForm()
	{
		Form::Form('EditQuanLyGiamThiForm');
		if(URL::get('cmd')=='edit')
		{
			$this->add('id',new IDType(true,'object_not_exists','account'));
		}
		else
		{
			$this->add('id',new UniqueType('duplicate_identifier','account','id'));
			$this->add('password',new TextType(false,'invalid_password',0,255)); 
		}
	}
	function on_submit()
	{
		if($this->check() and URL::get('confirm_edit'))
		{			
			$account_new_row = array(
				'create_date'=>time(),
				'is_active'=>URL::iget('active'), 
				'is_block'=>URL::iget('block'),
				'email'=>URL::nget('email'),				
				'type'=>'USER',
				'cache_privilege'=>'',
				'HoDem'=>URL::nget('HoDem'),
				'Ten'=>URL::nget('Ten'),
				'GioiTinh'=>URL::iget('GioiTinh'),
				'NgaySinh'=>URL::nget('NgaySinh'),
				'Cmt'=>URL::nget('Cmt'),
				'QueQuan'=>URL::nget('QueQuan')
			);
			if(URL::get('cmd')=='edit' and $id=Url::nget('id'))
			{
				if(Url::get('password')){
					$account_new_row+=array('password'=>User::encode_password(Url::get('password')));
				}
				DB::update('account', $account_new_row,'id=\''.$id.'\'');
			}else{
				$account_new_row+=array(
					'id'=>Url::nget('id'),
					'password'=>User::encode_password(Url::get('password'))
				);
				DB::insert('account', $account_new_row);
				QuanLyGiamThiDB::update_moderator($account_new_row['id']);
			}
			Url::redirect_current();
		}
	}
	function draw()
	{
		if(URL::get('cmd')=='edit' and $account = DB::exists_id('account',URL::nget('id')))
		{//System::debug($account);
			unset($account['password']);
			foreach($account as $key=>$value)
			{
				if(!isset($_POST[$key]))
				{
					switch($key){
						case 'NgaySinh': $_REQUEST[$key] = Date_time::to_common_date(substr($value,0,10)); break;
						default: $_REQUEST[$key] = $value;
					}
				}
			}
		}
		$this->map['tblLopNienChe']=DB::select_all('tblLopNienChe');
		//System::debug($_REQUEST);
		$this->parse_layout('edit',$this->map+array(
			'GioiTinh_list'=>array(0=>'Nam','1'=>'Nữ',2=>'Không xác định')
		));
	}
}
?>
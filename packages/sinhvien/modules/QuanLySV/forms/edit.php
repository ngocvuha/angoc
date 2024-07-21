<?php
class EditQuanLySVForm extends Form
{
	function EditQuanLySVForm()
	{
		Form::Form('EditQuanLySVForm');
		if(URL::get('cmd')=='edit')
		{
			$this->add('id',new IDType(true,'object_not_exists','account'));
		}else{
			$this->add('password',new TextType(false,'invalid_password',0,255)); 
		}
	}
	function on_submit()
	{
		if($this->check() and URL::get('confirm_edit'))
		{
			require_once 'packages/core/includes/utils/vn_code.php';
			$account_new_row = array(
				'create_date'=>time(),
				'is_active'=>Url::iget('active'), 
				'is_block'=>URL::iget('block'),
				'email'=>URL::nget('email'),				
				'type'=>'SV',
				'cache_privilege'=>'',
				'tblLopNienChe_id'=>URL::iget('tblLopNienChe_id'),
				'HoDem'=>URL::nget('HoDem'),
				'Ten'=>URL::nget('Ten'),
				'GioiTinh'=>URL::iget('GioiTinh'),
				'NgaySinh'=>Date_time::to_sql_date(URL::nget('NgaySinh')),
				'MaSV'=>URL::nget('MaSV'),
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
			}
			Url::redirect_current();
		}
	}
	function draw()
	{
		if(URL::get('cmd')=='edit' and $account = DB::exists_id('account',URL::nget('id')))
		{
			unset($account['password']);
			//System::debug($account);
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
		$this->parse_layout('edit',$this->map+array(
			'GioiTinh_list'=>array(0=>'Nam','1'=>'Nữ',2=>'Không xác định')
		));
	}
}
?>

<?php
class PhanCongChamThi extends Module
{
	function PhanCongChamThi($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(Url::get('cmd'))
			{
				case 'add':
				case 'edit':
					$this->edit_cmd();
					break;	
				case 'get_user':
					$this->get_user();
					break;
				default:
					$this->list_cmd();
					break;
			}
		}
		else
		{
			Url::access_denied();
		}
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListPhanCongChamThiForm());
	}
	function edit_cmd()
	{
		if(User::can_edit(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditPhanCongChamThiForm());
		}	
		else
		{
			Url::access_denied();
		}
	}
	function get_user(){
		if($q = Url::sget('q'))
		{
			$cond = "(account.HoDem+' '+account.Ten) like '%".$q."%' and account.type = 'GT' and account.is_active=1";
			$sql = 'select
						account.*
					from
						account
					where						
						'.$cond.'
					';
			$users = DB::fetch_all($sql);
			if($users){
				echo '[';
				$f = true;
				foreach($users as $user){
					if($f){ $f = false;} else{
						echo ',';
					}
					echo '"'.$user['HoDem'].' '.$user['Ten'].'<<'.$user['id'].'>>"';
				}
				echo ']';
			}
		}
		exit();
	}
}
?>

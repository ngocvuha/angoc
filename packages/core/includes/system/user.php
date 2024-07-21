<?php
define('CURRENT_CATEGORY',1);
define('ANY_CATEGORY',2);
class User
{
	var $groups = array();
	var $privilege = array();
	var $actions = array();
	var $settings = array();
	static $current=false;
	function User($id=false)
	{
		if(!$id)
		{
			if(!$this->data=User::is_login()){
				Session::set('user_id','guest');
			}else{
				if(trim($this->data['cache_privilege'])=='')
				{
					require_once 'packages/core/includes/system/make_user_privilege_cache.php';
					eval(make_user_privilege_cache(Session::get('user_id')));
				}else{
					eval($this->data['cache_privilege']);
				}
			}
		}
	}
	function id()
	{
		if($user=User::is_login())
		{
			return $user['id'];
		}
		return 'guest';
	}
	function login($u,$p){
		$user = DB::fetch("
			select 
				id,email,HoDem,Ten,last_online_time,type,Cmt,tblLopNienChe_id,MaSV,QueQuan,NgaySinh,
				CASE WHEN GioiTinh=1 THEN 'Nữ' ELSE 'Nam' END AS GioiTinh,avatar
			from 
				account
			where 
				account.id='".$u."'
				and password='".User::encode_password($p)."'
				and account.is_active=1
				and account.is_block=0
		");
		if($user){
			Session::set('user_id',$u);
			Session::set('AUTH',User::encode_password($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']));
			Session::set('user_type',$user['type']);
			DB::update('account',array('last_online_time'=>time(),'cache_privilege'=>''),'id=\''.$u.'\'');
			return $user;
		}
		return false;
	}
	static function is_login($cond='1=1')
	{
		if(Session::is_set('user_id') and Session::get('user_id')!='guest' and $user=DB::select('account','id=\''.Session::get('user_id').'\' and '.$cond)){
			return $user;
		}
		return false;
	}
	function is_online($id)
	{
		$row=DB::select('account', 'id=\''.$id.'\' and last_online_time>'.(time()-7200));
		if ($row)
		{
			return true;
		}
		return false;
	}
	function encode_password($password)
	{
		return md5('hn'.$password.'mu');
	}
	function auth()
	{
		return Session::get('AUTH')==User::encode_password($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
	}
	function groups()
	{	
		return $this->groups;
	}
	function is_admin_user()
	{
		return isset($this->groups[3]);
	}
	function is_admin()
	{
		if(isset(User::$current))
		{
			return User::$current->is_admin_user();
		}
	}
	function can_do_action($action,$pos,$module_id=false, $structure_id = 0)
	{
		if(User::is_admin())
		{
			return true;
		}
		if(!$module_id)
		{
			if(isset(Module::$current->data))
			{
				$module_id = Module::$current->data['module']['id'];
			}
			else
			{
				$module_id=false;
			}
		}
		if(!$module_id)
		{
			return;
		}
		if($structure_id)
		{
			if($structure_id==CURRENT_CATEGORY)
			{
				$structure_id=0;
				if(URL::sget('category_id'))
				{
					$structure_id=DB::structure_id('category',URL::sget('category_id'));
				}
				if(!$structure_id)
				{
					$structure_id = ID_ROOT;
				}
			}			
			if(isset(User::$current->actions[$module_id][0]))
			{
				return User::$current->actions[$module_id][0]&(1 << (7-$pos));
			}
			if($structure_id==ANY_CATEGORY)
			{
				//System::debug(User::$current);
				if(isset(User::$current->actions) and isset(User::$current->actions[$module_id]))
				{
					foreach(User::$current->actions[$module_id] as $category_privilege)
					{	
						if($category_privilege&(1 << (7-$pos)))
						{
							return true;
						}
					}
				}
				return false;
			}
			else
			{
				while(1)
				{				
					if(isset(User::$current->actions[$module_id][$structure_id]))
					{
						return User::$current->actions[$module_id][$structure_id]&(1 << (7-$pos));
					}
					else
					if($structure_id <= ID_ROOT)
					{
						break;
					}
					else
					{
						$structure_id = IDStructure::parent($structure_id);
					}
				}
			}
			return false;
		}else{
			return isset(User::$current->actions[$module_id][0]) && (User::$current->actions[$module_id][0]&(1 << (7-$pos)));
		}
	}
	function can_view($module_id=false, $structure_id = 0)
	{
		return USER::can_do_action('view',0,$module_id, $structure_id);
	}
	function can_view_detail($module_id=false, $structure_id = 0)
	{
		return USER::can_do_action('view_detail',1,$module_id, $structure_id);
	}
	function can_add($module_id=false, $structure_id = 0)
	{
		return USER::can_do_action('add',2,$module_id, $structure_id);
	}
	function can_edit($module_id=false, $structure_id = 0)
	{
		return USER::can_do_action('edit',3,$module_id, $structure_id);
	}
	function can_delete($module_id=false, $structure_id = 0)
	{
		return USER::can_do_action('delete',4,$module_id, $structure_id);
	}	
	function can_moderator($module_id=false, $structure_id = 0)
	{
		return USER::can_do_action('moderator',5,$module_id, $structure_id);
	}
	function can_reserve($module_id=false, $structure_id = 0)
	{
		return USER::can_do_action('reserve',6,$module_id, $structure_id);
	}
	function can_admin($module_id=false, $structure_id = 0)
	{
		return USER::can_do_action('admin',7,$module_id, $structure_id);
	}
	function check_categories($categories,$module)
	{
		foreach($categories as $key=>$value)
		{
			if(!User::can_view($module,$value['structure_id']))
			{
				unset($categories[$key]);
			}
		}
		return $categories;
	}
}
User::$current = new User();
if(!Session::is_set('user_id') and isset($_COOKIE['user_id']) and $_COOKIE['user_id'])
{
	setcookie('user_id',"",time()-3600);
}
?>
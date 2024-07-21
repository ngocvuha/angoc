<?php
class GrantPrivilegeForm extends Form
{
	function GrantPrivilegeForm()
	{
		Form::Form('GrantPrivilegeForm');
		$this->add('privilege_id',new TextType(true,'please_enter_privilege',0,255)); 
	}
	function on_submit()
	{
		if($this->check()){
			$module=Url::get('module');
			foreach($module as $key=>$value){
				$module[$key] += array(
					'view'=>0,
					'view_detail'=>0,
					'add'=>0,
					'edit'=>0,
					'delete'=>0,
					'special'=>0,
					'reserve'=>0,
					'admin'=>0
				);
			}
			//System::debug($module);exit();
			if(Url::get('cmd')=='add'){
				DB::insert('privilege',array('name'=>Url::nget('privilege_id')));
				$id = DB::fetch('select id from privilege order by id desc','id');
				foreach($module as $key=>$value){
					DB::insert('privilege_module',$value+array('privilege_id'=>$id,'module_id'=>$key));
				}
			}else{
				if((Url::get('cmd')=='grant' or Url::get('cmd')=='edit') and $id=Url::nget('id') and $privilege=DB::exists_id('privilege',$id)){
					DB::update_id('privilege',array('name'=>Url::nget('privilege_id')),$id);
					DB::delete('privilege_module','privilege_id='.$id);
					foreach($module as $key=>$value){
						DB::insert('privilege_module',$value+array('privilege_id'=>$id,'module_id'=>$key));
					}
				}
			}
			DB::update('account',array('cache_privilege'=>''));
			// make cache tinhnang for current privilege
			//System::debug(Url::get('function'));
			$functions = Url::get('function')+$this->make_cache($id);
			File::export_file('cache/menu/m_'.$id.'.cache.php','items',$functions);
			Url::redirect_current();
		}
	}
	function draw()
	{
		if($current_privilege = DB::select_id('privilege',Url::nget('id'))){
			$_REQUEST['privilege_id']=$current_privilege['name'];
		}
		$cond='1=1';
		if(Url::get('cmd')=='grant' and $privilege_id=Url::nget('id') and $privilege=DB::exists_id('privilege',$privilege_id)){
			$cond.=' and tinhnang.status!=\'HIDE\'';
			$function=PrivilegeDB::get_function($cond);
			//System::debug($function);
			require_once 'packages/core/includes/utils/category.php';
			category_indent($function);
			$function_extend=PrivilegeDB::get_function_extend('module.privilege=1 and module.fun_extend=1');
		}elseif(Url::get('cmd')=='add' or Url::get('cmd')=='edit'){
			$cond.=' and tinhnang.status!=\'HIDE\'';
			$function=PrivilegeDB::get_function($cond);
			require_once 'packages/core/includes/utils/category.php';
			category_indent($function);
			//System::debug($function);
			$function_extend=PrivilegeDB::get_function_extend('module.privilege=1 and module.fun_extend=1');
		}
		//System::debug($function);
		$this->parse_layout('grant',
			array(
				'function'=>$function
				,'function_extend'=>$function_extend
			)
		);
	}
	function make_cache($id){
		$cond="tinhnang.structure_id!='".ID_ROOT."' and privilege_module.privilege_id=".$id;
		if(!User::is_admin()){
			$cond.=" and tinhnang.status!='HIDE'";
		}
		$function=PrivilegeDB::get_menu($cond);
		return $function;
	}
}
?>
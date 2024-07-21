<?php
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY vuonggialong
******************************/

function make_user_privilege_cache($id)
{
	$sql = '	
		SELECT
			privilege_module.module_id as id,
			privilege_module.module_id,
			account_privilege.portal_id,
			CASE WHEN sum(privilege_module.[view])>0 THEN 1 ELSE 0 END as [view],
			CASE WHEN sum(privilege_module.view_detail)>0 THEN 1 ELSE 0 END as view_detail,
			CASE WHEN sum(privilege_module.[add])>0 THEN 1 ELSE 0 END as [add],
			CASE WHEN sum(privilege_module.[edit])>0 THEN 1 ELSE 0 END as [edit],
			CASE WHEN sum(privilege_module.[delete])>0 THEN 1 ELSE 0 END as [delete],
			CASE WHEN sum(privilege_module.special)>0 THEN 1 ELSE 0 END as special,
			CASE WHEN sum(privilege_module.admin)>0 THEN 1 ELSE 0 END as admin,
			CASE WHEN sum(privilege_module.reserve)>0 THEN 1 ELSE 0 END as reserve
		FROM
			account_privilege
			INNER JOIN account ON account_privilege.account_id=account.id
			INNER JOIN privilege_module ON account_privilege.privilege_id=privilege_module.privilege_id 
		WHERE 
			account_privilege.account_id=\''.$id.'\' or account_privilege.account_id=\'guest\'
		GROUP BY
			privilege_module.module_id, account_privilege.portal_id
	';
	$user_actions = DB::fetch_all($sql);
	if($user_actions){
		//System::debug($user_actions);
		$actions = array();
		foreach($user_actions as $user_action)
		{
			if($byte_cache = bindec($user_action['view'].$user_action['view_detail'].$user_action['add'].$user_action['edit'].$user_action['delete'].$user_action['special'].$user_action['reserve'].$user_action['admin']))
			{
				$actions[$user_action['module_id']][0]=$byte_cache;
			}
		}
	}
	$groups = DB::fetch_all('
		SELECT
			parent_id as id
		FROM
			account_related
		WHERE	
			child_id=\''.$id.'\'
	');
	$code = '$this->groups='.var_export($groups,true).';'.
		'$this->actions='.var_export($actions,true).';';
	DB::update('account',array('cache_privilege'=>$code),'id=\''.$id.'\'');
	return $code;
}
?>
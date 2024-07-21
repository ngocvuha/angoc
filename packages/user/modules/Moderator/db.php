<?php
class ModeratorDB{
	function update_moderator($user_id, $privilege_ids)
	{
		$row = array(
			'account_id'=>$user_id
		);
		DB::delete('account_privilege',"account_id='".$user_id."'");
		foreach($privilege_ids as $privilege_id){
			$row['privilege_id'] = $privilege_id;
			DB::insert('account_privilege',$row);
		}
		DB::update('account',array('cache_privilege'=>''),'id=\''.$user_id.'\'');
	}
	function get_privilege()
	{
		return DB::fetch_all('
			select 
				id,name as title,\'\' as checked
			from 
				privilege
			order by
				name
		');
	}
	function get_account_privilege($acount){
		$item = DB::fetch_all('
			SELECT 
				privilege.id
			FROM
				account_privilege
				INNER JOIN privilege on account_privilege.privilege_id = privilege.id
			WHERE
				account_privilege.account_id = \''.$acount.'\'
		');
		return $item;
	}
	function get_users()
	{
		return DB::fetch_all('
			SELECT
				account.*
			FROM
				account
		');
	}
	function get_total_item($cond)
	{
		return DB::fetch_all('
			SELECT
				account_privilege.account_id as id
			FROM 
			 	account_privilege
				inner join privilege on account_privilege.privilege_id=privilege.id	
			WHERE
				'.$cond.'
			GROUP BY
				account_privilege.account_id
		');
	}
	function get_items($cond,$order_by, $item_per_page)
	{
		return DB::fetch_all('
			SELECT 
				account_privilege.account_id as id,
				account_privilege.account_id,
				privilege.name as title
			FROM 
			 	account_privilege
				inner join privilege on account_privilege.privilege_id=privilege.id	
			WHERE 
				'.$cond.'
		');
		
	}
}
?>
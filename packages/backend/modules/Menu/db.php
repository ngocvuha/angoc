<?php
class MenuDB{
	function get_account_privilege(){
		return DB::fetch_all('
			SELECT
				account_privilege.privilege_id as id
			FROM
				account_privilege
			WHERE
				account_privilege.account_id=\''.User::id().'\'
		');
	}
	function get_function()
	{
		return DB::fetch_all('
			SELECT
				tinhnang.*
			FROM
				tinhnang
			WHERE
				tinhnang.structure_id!='.ID_ROOT.'
			ORDER BY
				tinhnang.structure_id
		');
	}
}
?>

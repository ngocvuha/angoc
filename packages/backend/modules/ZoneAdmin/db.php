<?php
class ZoneAdminDB
{
	function get_zone($cond='')
	{		
		return DB::fetch_all('
			SELECT
				zone.*
			FROM
				zone
			WHERE
				'.$cond.'
			ORDER BY
				structure_id			
		');		
	}	
}
?>
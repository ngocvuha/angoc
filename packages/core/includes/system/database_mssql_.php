<?php
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY vuonggialong
******************************/
class DB 
{
	static $db_connect_id=false;				// connection id of this database
	static $db_result=false;				// current result of an query
	static $db_cache_tables = array();
	static $db_exists_db = array();
	static $db_select_all_db = array();
	static $db_num_queries = 0;
	var $num_queries = 0;		// number of queries was done
	function DB($sqlserver, $sqluser, $sqlpassword, $dbname)
	{
		DB::$db_connect_id = @mssql_connect($sqlserver, $sqluser, $sqlpassword);
		if (isset(DB::$db_connect_id) and DB::$db_connect_id)
		{
			if (!$dbselect = @mssql_select_db($dbname))
			{
				@mssql_close(DB::$db_connect_id);
				DB::$db_connect_id = $dbselect;
			}else{
				$table_db=mssql_query('select 1 from page');
				if($table_db===false){
					die('Error: Database is not install');
				}
			}
		}
		if(!DB::$db_connect_id)
		{
			die('Error: Could not connect to the database');
		}
		sqlsrv_query (DB::$db_connect_id,"set character_set_client='utf8'");
		sqlsrv_query (DB::$db_connect_id,"set character_set_results='utf8'"); 
		sqlsrv_query (DB::$db_connect_id,"set collation_connection='utf8_general_ci'");
		return DB::$db_connect_id;
	}
	static function register_cache($table, $id_name='id', $order=' order by id asc')
	{
		DB::$db_cache_tables[$table]=array('id_name'=>$id_name, 'order'=>$order);
		if(!file_exists(ROOT_PATH.'cache/tables/'.$table.'.cache.php'))
		{
			require_once 'packages/core/includes/system/make_table_cache.php';
			make_table_cache($table);
		}
		else
		{
			require_once ROOT_PATH.'cache/tables/'.$table.'.cache.php';
		}
	}
	static function count($table, $condition=false)
	{
		return DB::fetch('select count(*) as total from '.$table.''.($condition?' where '.$condition:''),'total');
	}
	//Lay ra mot ban ghi trong bang $table thoa man dieu kien $condition
	//Neu bang duoc cache thi lay tu cache, neu khong query tu CSDL
	static function select($table, $condition)
	{
		if($result = DB::select_id($table, $condition))
		{
			return $result;
		}
		else
		{
			return DB::exists('select top 1 * from '.$table.' where '.$condition.'');
		}
	}
	static function select_id($table, $condition)
	{
		if($condition and !preg_match('/[^a-zA-Z0-9_#-\.]/',$condition))
		{
			if(isset(DB::$db_cache_tables[$table]))
			{
				$id=$condition;
				$cache_var = 'cache_'.$table;
				global $$cache_var;
				$cached = isset($$cache_var);
				if(!$cached)
				{
					DB::refresh_cache($table);
				}
				$data = &$$cache_var;
				if(isset($data[$id]))
				{
					return $data[$id];
				}
			}
			else 
			{
				return DB::exists_id($table,$condition);
			}
		}
		else
		{
			return false;
		}
	}
	//Lay ra tat ca cac ban ghi trong bang $table thoa man dieu kien $condition sap xep theo thu tu $order
	//Neu bang duoc cache thi lay tu cache, neu khong query tu CSDL
	static function select_all($table, $condition=false, $order = false)
	{
		if(isset(DB::$db_select_all_db[$table]) and !$order and !$condition)
		{
			return DB::$db_select_all_db[$table];
		}
		else
		if(isset($GLOBALS['cache_'.$table]) and !$order and !$condition)
		{
			return $GLOBALS['cache_'.$table];
		}
		else
		{
			if($order)
			{
				$order = ' order by '.$order;
			}
			if($condition)
			{
				$condition = ' where '.$condition;
			}
			DB::query('select * from '.$table.' '.$condition.' '.$order);
			$rows = DB::fetch_all();
			if(sizeof($rows)<10)
			{
				DB::$db_select_all_db[$table] = $rows;
			}
			return $rows;
		}
	}
	// function close
	// Close SQL connection
	// should be called at very end of all scripts
	// ------------------------------------------------------------------------------------------

	static function close()
	{
		if (isset(DB::$db_connect_id) and DB::$db_connect_id)
		{
			if (isset(DB::$db_result) and DB::$db_result)
			{
				@mssql_free_result(DB::$db_result);
			}

			$result = mssql_close(DB::$db_connect_id);

			return $result;
		}
		else
		{
			return false;
		}

	}
	// function query
	// Run an sql command
	// Parameters:
	//		$query:		the command to run
	// ------------------------------------------------------------------------------------------

	static function query($query)
	{
		//echo DB::$db_num_queries.'.'.$query.'<br>';
		// Clear old query result
		DB::$db_result=false;
		if (!empty($query))
		{
			$start_time=microtime(true);
			if(!(DB::$db_result = @mssql_query($query, DB::$db_connect_id)))
			{
				require_once 'packages/core/includes/utils/error.php';
				if(defined('DEBUG'))
				{
					echo '<p><font face="Courier New,Courier" size=3><b>'.mssql_get_last_message(DB::$db_connect_id).'</b></font><br>';
					echo DBG_GetBacktrace().'</b>';
				}
				else
				{
					DB::insert('log',
						array(
							'module_id'=>1387,
							'user_id'=>Session::get('user_id'),
							'time'=>time(),
							'type'=>'MSSQL',
							'description'=>DBG_GetBacktrace(),
							'title'=>mssql_get_last_message(DB::$db_connect_id)
						)
					);
				}
			}
			DB::$db_num_queries++;
		}
		if((!class_exists('Module') or isset(Module::$current->data)))
		{
			if(class_exists('Module'))
			{
				$module_id = Module::$current->data['id'];
				$GLOBALS['information_query'][$module_id]['name']=Module::$current->data['module']['name'].(Module::$current->data['name']?'('.Module::$current->data['name'].')':'');
			}
			else
			{
				$module_id = 0;
				$GLOBALS['information_query'][$module_id]['name']='';
			}
			if(isset($GLOBALS['information_query'][$module_id]['number_queries']))
			{
				$GLOBALS['information_query'][$module_id]['number_queries']++;		
			
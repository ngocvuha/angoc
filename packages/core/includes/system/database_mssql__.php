<?php
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY vuonggialong
******************************/
class MSDB 
{
	static $db_connect_id=false;				// connection id of this database
	static $db_result=false;				// current result of an query
	static $db_cache_tables = array();
	static $db_exists_db = array();
	static $db_select_all_db = array();
	static $db_num_queries = 0;
	var $num_queries = 0;		// number of queries was done
	function MSDB($sqlserver, $sqluser, $sqlpassword, $dbname)
	{
		MSDB::$db_connect_id = @mssql_connect($sqlserver, $sqluser, $sqlpassword);
		if (isset(MSDB::$db_connect_id) and MSDB::$db_connect_id)
		{
			if (!$dbselect = @mssql_select_db($dbname))
			{
				@mssql_close(MSDB::$db_connect_id);
				MSDB::$db_connect_id = $dbselect;
			}
		}
		if(!MSDB::$db_connect_id)
		{
			die('Error: Could not connect to the database');
		}
		return MSDB::$db_connect_id;
	}
	static function register_cache($table, $id_name='id', $order=' order by id asc')
	{
		MSDB::$db_cache_tables[$table]=array('id_name'=>$id_name, 'order'=>$order);
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
		return MSDB::fetch('select count(*) as total from '.$table.''.($condition?' where '.$condition:''),'total');
	}
	//Lay ra mot ban ghi trong bang $table thoa man dieu kien $condition
	//Neu bang duoc cache thi lay tu cache, neu khong query tu CSDL
	static function select($table, $condition)
	{
		if($result = MSDB::select_id($table, $condition))
		{
			return $result;
		}
		else
		{
			return MSDB::exists('select top 1 * from '.$table.' where '.$condition.'');
		}
	}
	static function select_id($table, $condition)
	{
		if($condition and !preg_match('/[^a-zA-Z0-9_#-\.]/',$condition))
		{
			if(isset(MSDB::$db_cache_tables[$table]))
			{
				$id=$condition;
				$cache_var = 'cache_'.$table;
				global $$cache_var;
				$cached = isset($$cache_var);
				if(!$cached)
				{
					MSDB::refresh_cache($table);
				}
				$data = &$$cache_var;
				if(isset($data[$id]))
				{
					return $data[$id];
				}
			}
			else 
			{
				return MSDB::exists_id($table,$condition);
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
		if(isset(MSDB::$db_select_all_db[$table]) and !$order and !$condition)
		{
			return MSDB::$db_select_all_db[$table];
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
			MSDB::query('select * from '.$table.' '.$condition.' '.$order);
			$rows = MSDB::fetch_all();
			if(sizeof($rows)<10)
			{
				MSDB::$db_select_all_db[$table] = $rows;
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
		if (isset(MSDB::$db_connect_id) and MSDB::$db_connect_id)
		{
			if (isset(MSDB::$db_result) and MSDB::$db_result)
			{
				@mssql_free_result(MSDB::$db_result);
			}

			$result = mssql_close(MSDB::$db_connect_id);

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
		//echo MSDB::$db_num_queries.'.'.$query.'<br>';
		// Clear old query result
		MSDB::$db_result=false;
		if (!empty($query))
		{
			$start_time=microtime(true);
			if(!(MSDB::$db_result = @mssql_query($query, MSDB::$db_connect_id)))
			{
				require_once 'packages/core/includes/utils/error.php';
				if(defined('DEBUG'))
				{
					echo '<p><font face="Courier New,Courier" size=3><b>'.mssql_get_last_message(DB::$db_connect_id).'</b></font><br>';
					echo DBG_GetBacktrace().'</b>';
				}
				else
				{
					MSDB::insert('log',
						array(
							'module_id'=>1387,
							'user_id'=>Session::get('user_id'),
							'time'=>time(),
							'type'=>'MSSQL',
							'description'=>DBG_GetBacktrace(),
							'title'=>mssql_get_last_message(MSDB::$db_connect_id)
						)
					);
				}
			}
			MSDB::$db_num_queries++;
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
			}
			else
			{
				$GLOBALS['information_query'][$module_id]['number_queries']=1;		
			}
			$GLOBALS['information_query'][$module_id]['timer']=number_format(microtime(true)-$start_time,4);
			$GLOBALS['information_query'][$module_id]['query'][]=$query;	
		}
		return MSDB::$db_result;
	}
	//Tra ve ban ghi query tu CSDL bang lenh SQL $query neu co
	//Neu khong co tra ve false
	//$query: cau lenh SQL se thuc hien
	static function exists($query)
	{
		MSDB::query($query);
		if(MSDB::num_rows()>=1)
		{
			return MSDB::fetch();
		}
		return false;
	}
	//Tra ve ban ghi trong bang $table co id la $id
	//Neu khong co tra ve false
	//$table: bang can truy van
	//$id: ma so ban ghi can lay
	static function exists_id($table,$id)
	{
		if($id)
		{
			if(!isset(MSDB::$db_exists_db[$table][$id]))
			{
				MSDB::$db_exists_db[$table][$id]=MSDB::exists('select top 1 * from '.$table.' where id="'.$id.'"');
			}
			return MSDB::$db_exists_db[$table][$id];
		}
	}
	static function insert($table, $values, $replace=false)
	{
		if($replace)
		{
			$query='replace';
		}
		else
		{
			$query='insert into';
		}
		$query.=' '.$table.'(';
		$i=0;
		if(is_array($values))
		{
			foreach($values as $key=>$value)
			{
				if(($key===0) or is_numeric($key))
				{
					$key=$value;
				}
				if($key)
				{
					if($i<>0)
					{
						$query.=',';
					}
					$query.=''.$key.'';
					$i++;
				}
			}
			$query.=') values(';
			$i=0;
			foreach($values as $key=>$value)
			{
				if(is_numeric($key) or $key===0)
				{
					$value=Url::get($value);
				}
				if($i<>0)
				{
					$query.=',';
				}

				if($value==='NULL')
				{
					$query.='NULL';
				}
				else
				{
					$query.='\''.MSDB::escape($value).'\'';
				}
				$i++;
			}
			$query.=')';
			//echo $query;
			if(MSDB::query($query))
			{
				$id = MSDB::insert_id();		
				if(isset(MSDB::$db_cache_tables[$table]))
				{
					//MSDB::refresh_cache($table);
				}
				return $id;
			}
		}
	}
	static function delete($table, $condition)
	{
		$query='delete from '.$table.' where '.$condition;
		//echo $query;
		if(MSDB::query($query))
		{		
			if(isset(MSDB::$db_cache_tables[$table]))
			{
				//MSDB::refresh_cache($table);
			}		
			return true;
		}
	}
	static function delete_id($table, $id)
	{
		if(MSDB::delete($table, 'id="'.addslashes($id).'"')) return $id;
	}
	static function update($table, $values, $condition)
	{
		$query='update '.$table.' set ';
		$i=0;
		if($values)
		{
			foreach($values as $key=>$value)
			{
				
				if($key===0 or is_numeric($key))
				{
					$key=$value;
					$value=URL::get($value);
				}
				if($i<>0)
				{
					$query.=',';
				}
				if($key)
				{
					if($value=='NULL')
					{
						$query.=''.$key.'=NULL';
					}
					else
					{
						$query.=''.$key.'=\''.MSDB::escape($value).'\'';
					}
					$i++;
				}
			}
			$query.=' where '.$condition;
			if(MSDB::query($query))
			{
				if(isset(MSDB::$db_cache_tables[$table]))
				{
					MSDB::refresh_cache($table);
				}
				return true;
			}
		}
	}
	function refresh_cache()
	{
	
	}
	static function update_id($table, $values, $id)
	{
		if(MSDB::update($table, $values, 'id="'.$id.'"')) return $id;
	}
	static function num_rows($query_id = 0)
	{
		if (!$query_id)
		{
			$query_id = MSDB::$db_result;
		}

		if ($query_id)
		{
			$result = @mssql_num_rows($query_id);

			return $result;
		}
		else
		{
			return false;
		}
	}
	static function affected_rows()
	{

		if (isset(MSDB::$db_connect_id) and MSDB::$db_connect_id)
		{
			$result = @mssql_affected_rows(MSDB::$db_connect_id);

			return $result;
		}
		else
		{
			return false;
		}
	}
	static function fetch($sql = false, $field = false, $default = false)
	{
		if($sql)
		{
			MSDB::query($sql);
		}
		$query_id = MSDB::$db_result;
		if ($query_id)
		{
			if($result = @mssql_fetch_assoc($query_id))
			{
				if($field)
				{
					return $result[$field];
				}
				return $result;
			}
			return $default;
		}
		else
		{
			return false;
		}
	}
	static function fetch_all($sql=false)
	{
		if($sql)
		{
			MSDB::query($sql);
		}
		$query_id = MSDB::$db_result;

		if ($query_id)
		{
			$result=array();
			while($row = @mssql_fetch_assoc($query_id))
			{
				$result[$row['ID']] = $row;
			}

			return $result;
		}
		else
		{
			return false;
		}
	}
	static function fetch_all_array($sql=false)
	{
		if($sql)
		{
			MSDB::query($sql);
		}
		$query_id = MSDB::$db_result;

		if ($query_id)
		{
			$result=array();
			while($row = @mssql_fetch_assoc($query_id))
			{
				$result[] = $row;
			}

			return $result;
		}
		else
		{
			return false;
		}
	}
	static function insert_id()
	{
		if (MSDB::$db_connect_id)
		{
			$result = mssql_insert_id(MSDB::$db_connect_id);
			return $result;
		}
		else
		{
			return false;
		}
	}
	static function error()
	{
		$result['message'] = mssql_error(MSDB::$db_connect_id);
		$result['code'] = mssql_errno(MSDB::$db_connect_id);
		return $result;
	}
	static function escape($sql)
	{
		if(isset($sql) and $sql)
			return String::mssql_real_escape_string($sql);
		return false;
	}
	static function num_queries()
	{
		return MSDB::$db_num_queries;
	}
	// tra ve structure_id cua $id
	static function structure_id($table,$id)
	{
		if($row=MSDB::select($table,'id="'.$id.'"'))
			return $row['structure_id'];
		else
			return 0;
	}	
	
	function exeStoredProc($procName, $paramArray = false, $skip_results = false) {
		// example param array
		// $paramArray = array ('LocationName' => array ('VALUE' => 'the clients host name', 'TYPE' => 'SQLVARCHAR', 'ISOUTPUT' => 'false', 'IS_NULL' =>'false', 'MAXLEN' => '255' ) );
		// each element in the paramArray must idetify a paramiter required by the stored proceedure and can tain an array of settings from that paramiter
		// see http://php.net/manual/en/function.mssql-bind.php for information on the values for these paramiters
		

		// initiate the stored proceedure
		$stmt = mssql_init ( $procName, $this->linkid );
		
		// bind paramiters
		if ($paramArray) {
			foreach ( $paramArray as $paramName => $values ) {
				mssql_bind ( $stmt, $paramName, $values ['VALUE'], $values ['TYPE'], $values ['ISOUTPUT'], $values ['IS_NULL'], $values ['MAXLEN'] );
			}
		}
		
		// execute the stored proceedure
		$results = mssql_execute ( $stmt );
		// if we do not get anu results return false
		if (! $results) {
			return false;
		
		// if we get results then put them in to an array and return it
		} else {
			// define the array to return
			$resultArray = array ();
			
			// loop throught he result set and place each result to the resultArray
			do {
				while ( $row = mssql_fetch_row ( $stmt ) ) {
					$resultArray [] = $row;
				}
			} while ( mssql_next_result ( $stmt ) );
			
			// clean up the statment ready for the next useexec SELLING_GetLocation @LocationName='it-leigh.skilouise.com'
			mssql_free_statement ( $stmt );
			
			//returnt he result array
			return $resultArray;
		}
	}
}
if(file_exists('cache/config/db.php')){
	require_once 'cache/config/db.php';
}
$msdb = new MSDB(MSSQL_SERVER,MSSQL_USER,MSSQL_PASS,MSSQL_DB);
?>
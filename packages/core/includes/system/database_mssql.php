<?php
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
		$connectionInfo = array( "Database"=>$dbname, "UID"=>$sqluser, "PWD"=>$sqlpassword,'ReturnDatesAsStrings'=>true);
		DB::$db_connect_id = sqlsrv_connect( $sqlserver, $connectionInfo);
		if (DB::$db_connect_id)
		{
			$params = array(1, "some data");
			$table_db = sqlsrv_query(DB::$db_connect_id,"select * from page");
			if($table_db===false){
				die( print_r( sqlsrv_errors(), true));
			}
		}else{
			echo "Connection could not be established.<br />";
			die( print_r( sqlsrv_errors(), true));
		}
		return DB::$db_connect_id;
	}
	static function register_cache($table, $id_name='id', $order=' order by id asc')
	{
		DB::$db_cache_tables[$table]=array('id_name'=>$id_name, 'order'=>$order);
		if(!file_exists(ROOT_PATH.'cache/tables/'.$table.'.cache.php'))
		{
			require_once 'packages/core/includes/system/make_table_cache.php';
			make_table_cache($table);
		}else{
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
		}else{
			$user = DB::exists('select top 1 * from '.$table.' where '.$condition.'');
			return $user;
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
				sqlsrv_free_stmt(DB::$db_result);
			}

			$result = sqlsrv_close(DB::$db_connect_id);

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
		//echo $query.'<br>';
		//echo DB::$db_num_queries.'.'.$query.'<br>';
		// Clear old query result
		DB::$db_result=false;
		if (!empty($query))
		{
			$start_time=microtime(true);
			if(!(DB::$db_result = sqlsrv_query(DB::$db_connect_id,$query)))
			{
				require_once 'packages/core/includes/utils/error.php';
				if(defined('DEBUG'))
				{
					echo '<p><font face="Courier New,Courier" size=3><b>'.print_r( sqlsrv_errors()).'</b></font><br>';
					echo DBG_GetBacktrace().'</b>';
				}else{
					DB::insert('log',
						array(
							'module_id'=>1387,
							'user_id'=>Session::get('user_id'),
							'time'=>time(),
							'type'=>'MSSQL',
							'description'=>DBG_GetBacktrace(),
							'title'=>print_r( sqlsrv_errors())
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
			}
			else
			{
				$GLOBALS['information_query'][$module_id]['number_queries']=1;		
			}
			$GLOBALS['information_query'][$module_id]['timer']=number_format(microtime(true)-$start_time,4);
			$GLOBALS['information_query'][$module_id]['query'][]=$query;	
		}
		return DB::$db_result;
	}
	//Tra ve ban ghi query tu CSDL bang lenh SQL $query neu co
	//Neu khong co tra ve false
	//$query: cau lenh SQL se thuc hien
	static function exists($query)
	{
		DB::query($query);
		if(DB::num_rows()>=1)
		{
			return DB::fetch();
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
			if(!isset(DB::$db_exists_db[$table][$id]))
			{
				DB::$db_exists_db[$table][$id]=DB::exists('select top 1 * from '.$table.' where id=\''.$id.'\'');
			}
			return DB::$db_exists_db[$table][$id];
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
					
					$query.='['.$key.']';
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
				}else{
					$query.="'".DB::escape($value)."'";
				}
				$i++;
			}
			$query.=')';
			//echo $query;
			if(DB::query($query))
			{
				$id = DB::insert_id();		
				if(isset(DB::$db_cache_tables[$table]))
				{
					//DB::refresh_cache($table);
				}
				return $id;
			}
		}
	}
	static function delete($table, $condition)
	{
		$query='delete from '.$table.' where '.$condition;
		//echo $query;
		if(DB::query($query))
		{		
			if(isset(DB::$db_cache_tables[$table]))
			{
				//DB::refresh_cache($table);
			}		
			return true;
		}
	}
	static function delete_id($table, $id)
	{
		if(DB::delete($table, "id='".addslashes($id)."'")) return $id;
	}
	static function update($table, $values, $condition=false)
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
					if($value==='NULL')
					{
						$query.=''.$key.'=NULL';
					}else{
						$query.=''.$key.'=\''.DB::escape($value).'\'';
					}
					$i++;
				}
			}
			$query.=$condition?' where '.$condition:'';
			if(DB::query($query))
			{
				if(isset(DB::$db_cache_tables[$table]))
				{
					DB::refresh_cache($table);
				}
				return true;
			}			
		}
		return false;
	}
	function refresh_cache()
	{
	
	}
	static function update_id($table, $values, $id)
	{
		if(DB::update($table, $values, 'id=\''.$id.'\'')){
			return $id;
		}else{
			return false;
		}
	}
	static function num_rows($query_id = 0)
	{
		if (!$query_id)
		{
			$query_id = DB::$db_result;
		}
		if ($query_id)
		{
			$result = sqlsrv_has_rows ($query_id);
			return $result;
		}else{
			return false;
		}
	}
	static function affected_rows()
	{

		if (isset(DB::$db_connect_id) and DB::$db_connect_id)
		{
			$result = sqlsrv_rows_affected(DB::$db_connect_id);

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
			DB::query($sql);
		}
		$query_id = DB::$db_result;
		if ($query_id)
		{
			if($result = sqlsrv_fetch_array($query_id,SQLSRV_FETCH_ASSOC))
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
			DB::query($sql);
		}
		$query_id = DB::$db_result;

		if ($query_id)
		{
			$result=array();
			while($row = sqlsrv_fetch_array($query_id))
			{
				if(!isset($row['id'])){
					$row['id'] = $row['ID'];
					unset($row['ID']);
				}
				$result[$row['id']] = $row;
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
			DB::query($sql);
		}
		$query_id = DB::$db_result;

		if ($query_id)
		{
			$result=array();
			while($row = sqlsrv_fetch_array($query_id))
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
		if (DB::$db_connect_id){
			$result = sqlsrv_query('SELECT identity', DB::$db_connect_id);
			if ($result)
			{
				return mssql_result($result, 0, 0);
			}
		}
		return false;
		/*if (DB::$db_connect_id)
		{
			$result = mssql_insert_id(DB::$db_connect_id);
			return $result;
		}
		else
		{
			return false;
		}*/
	}
	static function error()
	{
		if( ($errors = sqlsrv_errors() ) != null) {
			foreach( $errors as $error ) {
				$result['state'][] = "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
				$result['code'][] = "code: ".$error[ 'code']."<br />";
				$result['message'][] = "message: ".$error[ 'message']."<br />";
			}
		}
		return $result;
	}
	static function escape($sql)
	{
		$sql = (string) $sql;
		if(isset($sql) and $sql!='')
			return String::mssql_real_escape_string($sql);
		return false;
	}
	static function num_queries()
	{
		return DB::$db_num_queries;
	}
	// tra ve structure_id cua $id
	static function structure_id($table,$id)
	{
		if($row=DB::select($table,'id="'.$id.'"'))
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
		$stmt = sqlsrv_prepare ( $procName, $this->linkid );
		
		// bind paramiters
		if ($paramArray) {
			foreach ( $paramArray as $paramName => $values ) {
				mssql_bind ( $stmt, $paramName, $values ['VALUE'], $values ['TYPE'], $values ['ISOUTPUT'], $values ['IS_NULL'], $values ['MAXLEN'] );
			}
		}
		
		// execute the stored proceedure
		$results = sqlsrv_execute ( $stmt );
		// if we do not get anu results return false
		if (! $results) {
			return false;
		
		// if we get results then put them in to an array and return it
		} else {
			// define the array to return
			$resultArray = array ();
			
			// loop throught he result set and place each result to the resultArray
			do {
				while ( $row = sqlsrv_fetch_array  ( $stmt ) ) {
					$resultArray [] = $row;
				}
			} while ( sqlsrv_next_result ( $stmt ) );
			
			// clean up the statment ready for the next useexec SELLING_GetLocation LocationName='it-leigh.skilouise.com'
			sqlsrv_free_stmt ( $stmt );
			
			//returnt he result array
			return $resultArray;
		}
	}
}
if(file_exists('cache/config/db.php')){
	require_once 'cache/config/db.php';
}
$db = new DB(MSSQL_SERVER, MSSQL_USER, MSSQL_PASS, MSSQL_DB);
?>
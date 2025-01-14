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
	// Debug
	var $num_queries = 0;		// number of queries was done
	function DB($sqlserver, $sqluser, $sqlpassword, $dbname)
	{
		DB::$db_connect_id = @mysql_connect($sqlserver, $sqluser, $sqlpassword, true);
		if (isset(DB::$db_connect_id) and DB::$db_connect_id)
		{
			if (!$dbselect = @mysql_select_db($dbname))
			{
				@mysql_close(DB::$db_connect_id);
				DB::$db_connect_id = $dbselect;
			}else{
				$table_db=mysql_query('select 1 from page');
				if($table_db===false){
					die('Error: Database is not install');
				}
			}
		}
		if(!DB::$db_connect_id)
		{
			die('Error: Could not connect to the database');
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
			return DB::exists('select * from '.$table.' where '.$condition.' limit 0,1');
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
				@mysql_free_result(DB::$db_result);
			}

			$result = mysql_close(DB::$db_connect_id);

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
			if(!(DB::$db_result = @mysql_query($query, DB::$db_connect_id)))
			{
				require_once 'packages/core/includes/utils/error.php';
				if(defined('DEBUG'))
				{
					echo '<p><font face="Courier New,Courier" size=3><b>'.mysql_error(DB::$db_connect_id).'</b></font><br>';
					echo DBG_GetBacktrace().'</b>';
				}
				else
				{
					DB::insert('log',
						array(
							'module_id'=>1387,
							'user_id'=>Session::get('user_id'),
							'time'=>time(),
							'type'=>'MYSQL',
							'description'=>DBG_GetBacktrace(),
							'title'=>mysql_error(DB::$db_connect_id)
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
				DB::$db_exists_db[$table][$id]=DB::exists('select * from '.$table.' where id="'.$id.'" limit 0,1');
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
					$query.='\''.DB::escape($value).'\'';
				}
				$i++;
			}
			$query.=')';
			echo $query;
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
		if(DB::delete($table, 'id="'.addslashes($id).'"')) return $id;
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
						$query.=''.$key.'=\''.DB::escape($value).'\'';
					}
					$i++;
				}
			}
			$query.=' where '.$condition;
			if(DB::query($query))
			{
				if(isset(DB::$db_cache_tables[$table]))
				{
					DB::refresh_cache($table);
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
		if(DB::update($table, $values, 'id="'.$id.'"')) return $id;
	}
	static function num_rows($query_id = 0)
	{
		if (!$query_id)
		{
			$query_id = DB::$db_result;
		}

		if ($query_id)
		{
			$result = @mysql_num_rows($query_id);

			return $result;
		}
		else
		{
			return false;
		}
	}
	static function affected_rows()
	{

		if (isset(DB::$db_connect_id) and DB::$db_connect_id)
		{
			$result = @mysql_affected_rows(DB::$db_connect_id);

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
			if($result = @mysql_fetch_assoc($query_id))
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
			while($row = @mysql_fetch_assoc($query_id))
			{
				if(!isset($row['id'])){$row['id'] = $row['ID'];}
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
			while($row = @mysql_fetch_assoc($query_id))
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
		if (DB::$db_connect_id)
		{
			$result = mysql_insert_id(DB::$db_connect_id);
			return $result;
		}
		else
		{
			return false;
		}
	}
	static function error()
	{
		$result['message'] = mysql_error(DB::$db_connect_id);
		$result['code'] = mysql_errno(DB::$db_connect_id);
		return $result;
	}
	static function escape($sql)
	{
		if(isset($sql) and $sql)
			return @mysql_real_escape_string($sql);
		return false;
	}
	static function num_queries()
	{
		return DB::$db_num_queries;
	}
	// tra ve structure_id cua $id
	static function structure_id($table,$id)
	{
		if($row=DB::select($table,"id='".$id."'"))
			return $row['structure_id'];
		else
			return 0;
	}	
	static function update_hit_count($table,$id)
	{
		if(Session::is_set('item_visited'))
		{
			$items=array_flip(explode(',',Session::get('item_visited')));
		}
		else
		{
			$items=array();
		}			
		if(!isset($items[$id]) and $item=DB::select_id($table,intval($id)))
		{
			DB::update_id($table,array('hitcount'=>$item['hitcount']+1),intval($id));
			$items[$id]=$id;			
			Session::set('item_visited', implode(',',array_keys($items)));
			return true;
		}
		return false;
	}
}
if(file_exists('cache/config/db.php')){
	require_once 'cache/config/db.php';
	$db = new DB(MYSQL_SERVER, MYSQL_USER, MYSQL_PASS, MYSQL_DBNAME);
}
?>
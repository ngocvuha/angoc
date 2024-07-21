<?php
/*
 * MS-SQL database class
 * @version 1.6
 *
 * This class provides basic methods for working with a MS-SQL database
 *
 * usage :
 * create obeject from this class
 * $sqlObj = new mssqlClass();
 * 
 * make a connection
 * $sqlObj->connect($host, $user, $password);
 * 
 *  select database
 * $sqlObj->select($dbName);
 * 
 * query the db, check query success, check for results 
 * and place results in an array of objects.
 * 
 * 
 * $resultArray = false;
 * if($sqlObj->query("select * from table")){
 * 	if($sqlObj->numRows() > 0){
 * 		$resultArray = array();
 * 		while($row = $sqlObj->fetchObject(){
 * 			$resultArray[] = $row;
 * 		}
 * 	}else{
 * 		echo "No Results Found";
 * 	}
 * }else{
 * 	echo $sqlObj->getLastErrorMessage(); 
 * }
 * 
 * 
 */

class mssqlClass {
	private $result; // Query result
	private $querycount; // Total queries executed
	private $linkid = false;
	

	/**
	 * method to connect to the database server.
	 **/
	function connect($sqlHost, $sqlUser, $sqlPassword) {
		try {
			$this->linkid = mssql_connect ( $sqlHost, $sqlUser, $sqlPassword );
			if (! $this->linkid) {
				throw new Exception ( "I Could not connect to the SQL server $sqlHost." );
			}
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
	}
	
	/** 
	 * method to select a database.
	 **/
	function select($sqlDatabase) {
		
		try {
			if (! @mssql_select_db ( $sqlDatabase, $this->linkid ))
				throw new Exception ( "I Could not connect to the SQL database : $sqlDatabase." );
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
	}
	
	/**

	 * method to query sql database
	 * take mssql query string
	 * returns false if no results or NULL result is returned by query
	 * if query action is not expected to return results eg delete
	 * returns false on sucess else returns result set
	 *
	 * @param unknown_type $query
	 * @return unknown
	 */
	function query($query) {
		$this->result = mssql_query ( $query, $this->linkid );
		if (! $this->result) {
			return FALSE;
		} else {
			return $this->result;
		}
	}
	function selectTable($table,$cond="1=1"){
		$sql = 'select * from '.$table.' where '.$cond;
		$this->query($sql);
		return $this->fetchObject();
	}
	
	/**
	 * method to return the number of rows affected by query.
	 **/
	function affectedRows() {
		return mssql_rows_affected ( $this->linkid );
	}
	
	/** 
	 * method to determine the number of rows returned by query. 
	 **/
	function numRows() {
		return @mssql_num_rows ( $this->result );
	}
	
	/**
	 * method to return a query result row as an object. 
	 **/
	function fetchObject() {
		return @mssql_fetch_object ( $this->result );
	}
	
	/** 
	 * method to return a query result row 
	 * as an indexed array 
	 **/
	function fetchRow() {
		return @mssql_fetch_row ( $this->result );
	}
	
	/**
	 * method to return a query result row 
	 * as an associative array. 
	 **/
	function fetchArray() {
		return @mssql_fetch_array ( $this->result, MSSQL_ASSOC );
	}
	
	/**
	 * method to return the total number 
	 * queries executed during lifetime of this object.
	 *
	 * @return int
	 **/
	function numQueries() {
		return $this->querycount;
	}
	
	/**
	 * method to save a result set in to the object
	 * 
	 * @param ResultSet $resultSet
	 **/
	private function setResult($resultSet) {
		$this->result = $resultSet;
	}
	
	/**
	 * method to eturn the number of fields in a result set.
	 **/
	function numberFields() {
		return @mssql_num_fields ( $this->result );
	}
	
	/**
	 * method to return a field name given an integer offset. 
	 *
	 * @param int $offset
	 **/
	function fieldName($offset) {
		return @mssql_field_name ( $this->result, $offset );
	}
	
	/**
	 * method to return the last error message from the db sqerver
	 */
	function getLastErrorMessage() {
		return @mssql_get_last_message ();
	}
	
	/**
	 * method to return the results of the last query
	 * in html table
	 *
	 * This method uses the $actions string to pass html code
	 * this is added to the table to enable display of images or links
	 * in the last columb of the table
	 *
	 * if boolian false is passed no html is add to the result table
	 * $startCol sets the col to start displaying 0 being the first
	 *
	 * @param int $startCol
	 * @param string or boolian false $actions
	 * @return unknown
	 */
	function getResultAsTable($startCol, $actions = "") {
		if ($this->numrows () > 0) {
			// Start the table
			$resultHTML = "<table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\"><tr>";
			$resultHTML .= "<td><table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\"><tr>";
			$x = $startCol;
			// Output the table header
			$fieldCount = $this->numberFields ();
			for($i = $x; $i < $fieldCount; $i ++) {
				$rowName = $this->fieldName ( $i );
				$resultHTML .= "<th align=\"left\">$rowName</th>";
			}
			if (! $actions === false) {
				$resultHTML .= "<th align=\"left\">actions</th>";
			}
			$resultHTML .= "</tr>";
			while ( $row = $this->fetchRow () ) {
				$resultHTML .= "<tr>";
				for($i = $x; $i < $fieldCount; $i ++)
					$resultHTML .= "<td align=\"left\">" . htmlentities ( $row [$i] ) . "</td>";
				if (! $actions === false) {
					// Replace VALUE with the correct primary key
					$action = str_replace ( "VALUE", $row [0], $actions );
					$resultHTML .= "<td nowrap align=\"left\">$action</td>";
				}
				$resultHTML .= "</tr>";
			}
			$resultHTML .= "</table></td></tr></table>";
		} else {
			$resultHTML = "";
		}
		return $resultHTML;
	}
	
	/**
	 * method to test if a row conatining $x in the feild $y exists in the given $table
	 * returns unformated result list of instenses of true if exists else returns false
	 * @param string $table
	 * @param string $col
	 * @param string $val
	 * @return
	 * */
	function getRow($table, $col, $val) {
		$this->query ( "SELECT * FROM '$table' WHERE '$col' = '$val'" );
		return $this->result;
	}
	
	/**
	 * method to delete all rows where $col=$val in $table
	 * returns int of number of affected rows or false on fail
	 *
	 * @param string $table
	 * @param string $col
	 * @param string $val
	 * @return none
	 */
	function deleteRow($table, $col, $val) {
		$this->query ( "DELETE FROM '$table' WHERE '$col' = '$val'" );
		return $this->result;
	}
	
	// Misc methods to do some convertions and stuff
	// round or pad to 2 decimal points
	function formatNum($num, $dec = 2) {
		for($x = 0; $x <= 5; $x ++) {
			$num = sprintf ( "%01." . ($dec + $x) . "f", $num );
			return $num;
		}
	}
	
	/**
	 * method to reverse the order of a given date
	 * and fix to mssql date format
	 * so DD/MM/YYYY becomes YYYY-MM-DD
	 *
	 * @param unknown_type $date
	 */
	function revDate($date) {
		// first split the date string @ / int o three parts
		$dateArray = explode ( '/', $date, 3 );
		// then reorder them to YYY/MM/DD
		$revDate = array_reverse ( $dateArray );
		$i = 0;
		foreach ( $revDate as $eliment ) {
			$correctDate .= $eliment;
			if ($i < 2) {
				$correctDate .= "-";
			}
			$i ++;
		}
		
		return $correctDate;
	}
	
	/**
	 * method to revers dates taken from sql database
	 * so YYYY-MM-DD becomes DD/MM/YYYY
	 *
	 * @param unknown_type $date
	 */
	function revSqlDate($date) {
		// first split the date string @ / int o three parts
		$dateArray = explode ( '-', $date, 3 );
		// then reorder them to DD/MM/YYYY
		$revDate = array_reverse ( $dateArray );
		$i = 0;
		foreach ( $revDate as $eliment ) {
			$correctDate .= $eliment;
			if ($i < 2) {
				$correctDate .= "/";
			}
			$i ++;
		}
		
		return $correctDate;
	}
	
	/**
	 * method to deal with the execution of MS SQL stored proceedured
	 * @param $string $procName The name of the proceedure to execute
	 * @param array $paramArray An array containing entries for each paramneeded but the stored proceedure see the exampel in the code below
	 */
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
require_once 'cache/config/db.php';	
$mssqlClass = new mssqlClass();
$mssqlClass->connect(MSSQL_SERVER,MSSQL_USER,MSSQL_PASS);
$mssqlClass->select(MSSQL_DB);
?>

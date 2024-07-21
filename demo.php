<?php
//echo "OK";
phpinfo();
$serverName = "localhost\sqlexpress"; //serverName\instanceName
$connectionInfo = array( "Database"=>"tracnghiem", "UID"=>"sa", "PWD"=>"Dhcd2017");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

?>
<center style="font-size:64px; margin:50px 0; font-weight:bold; color:red">{{ round(60*1000  / 600) }}</center>
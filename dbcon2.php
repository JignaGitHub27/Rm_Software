<?php 
$serverName = "192.168.1.163";
$connectionInfo = array("Database"=>"TRADEZ","UID"=>"sa","PWD"=>"12345");
$con =sqlsrv_connect($serverName,$connectionInfo);

if($con) {
	/*echo "connection established.<br />";*/
}else{
	echo "connection could not be established.<br />";
	die(print_r( sqlsrv_errors(), true));
	
}
?>
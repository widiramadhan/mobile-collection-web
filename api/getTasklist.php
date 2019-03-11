<?php
require_once("../config/connection.php");

class getTasklist{}

/*
$branchID = '1067';//$_GET['branchID'];
$transDate = '180726';
$employeeID = '1067ARO027';//$_GET['employeeID'];
$employeeJobID = '20';//$_GET['employeeJobID'];

$callSP = "{call SP_API_GET_DKHC(?,?,?,?)}"; 
$params = array(array($branchID, SQLSRV_PARAM_IN),array($transDate, SQLSRV_PARAM_IN),array($employeeID, SQLSRV_PARAM_IN),array($employeeJobID , SQLSRV_PARAM_IN));  
$options =  array( "Scrollable" => "buffered" );
$stmt = sqlsrv_query($conn, $callSP, $params, $options) or die( print_r( sqlsrv_errors(), true));
$check=sqlsrv_num_rows($stmt);

$output=array();
while($data=sqlsrv_fetch_array($stmt)){
	$output[] = $data;
}
echo json_encode($output);
sqlsrv_close($conn)
*/

$username = 'BAMBANG.SISWANTO';
$employeeID = '1016REM838';
$branchID = '1016';

$callSP = "{call SP_API_GET_DKHC(?,?,?)}"; 
$params = array(array($username, SQLSRV_PARAM_IN),array($employeeID, SQLSRV_PARAM_IN),array($branchID, SQLSRV_PARAM_IN));  
$options =  array( "Scrollable" => "buffered" );
$stmt = sqlsrv_query($conn, $callSP, $params, $options) or die( print_r( sqlsrv_errors(), true));
$check=sqlsrv_num_rows($stmt);

$output=array();
while($data=sqlsrv_fetch_array($stmt)){
	$output[] = $data;
}
echo json_encode($output);
sqlsrv_close($conn);
?>
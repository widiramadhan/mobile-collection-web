<?php
require_once("../config/connection.php");

class getTasklist{}
$employeeID = $_GET['employeeID'];
$branchID = $_GET['branchID'];

$callSP = "{call SP_API_GET_DKHC(?,?)}"; 
$params = array(array($employeeID, SQLSRV_PARAM_IN),array($branchID, SQLSRV_PARAM_IN));  
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
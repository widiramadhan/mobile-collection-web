<?php
require_once("../config/connection.php");

class getTasklistByID{}

$contractID = $_GET['contractID'];

$callSP = "{call SP_API_GET_DKHC_BY_CONTRACT(?)}"; 
$params = array(array($contractID, SQLSRV_PARAM_IN));  
$options =  array( "Scrollable" => "buffered" );
$stmt = sqlsrv_query($conn, $callSP, $params, $options) or die( print_r( sqlsrv_errors(), true));
$check=sqlsrv_num_rows($stmt);

$output=array();
while($data=sqlsrv_fetch_array($stmt)){
	$output[] = $data;
}
echo json_encode($output);
sqlsrv_close($conn)
?>
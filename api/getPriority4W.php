<?php
require_once("../config/connection.php");

class getPriority4W{}
$branch_id = $_GET['branch_id'];
$pic = $_GET['pic'];
$period = $_GET['period'];

$callSP = "{call SP_API_GET_PRIORITY_4W(?,?,?)}"; 
$params = array(
				array($branch_id, SQLSRV_PARAM_IN),
				array($pic, SQLSRV_PARAM_IN),
				array($period, SQLSRV_PARAM_IN)
				);  
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
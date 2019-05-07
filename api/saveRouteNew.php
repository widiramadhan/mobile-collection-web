<?php 
require_once("../config/connection.php");

$pic = $_POST["pic"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];
$contract_id = $_POST["contract_id"];
$period = $_POST["period"];

$callSp = "{call SP_INSERT_ROUTE_ARO_NEW(?,?,?,?,?)}";
$params = array(			
			array($pic,SQLSRV_PARAM_IN),
			array($lat,SQLSRV_PARAM_IN),
			array($lng,SQLSRV_PARAM_IN),
			array($contract_id,SQLSRV_PARAM_IN),
			array($period,SQLSRV_PARAM_IN)
			);
$exec = sqlsrv_query($conn,$callSp,$params) or die (print_r(sqlsrv_errors(),true));

if($exec){
	$response['result'] = true;
	$response['pesan'] = "Data Route Berhasil upload ke server";
	echo json_encode($response);
}else{
	$response['result'] = false;
	$response['pesan'] = "Data Route gagal upload ke server";
	echo json_encode($response);
}
?>
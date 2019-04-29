<?php 
require_once("../config/connection.php");

$pic = $_POST["pic"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];

$callSp = "{call SP_INSERT_ROUTE_ARO(?,?,?)}";
$params = array(			
			array($pic,SQLSRV_PARAM_IN),
			array($lat,SQLSRV_PARAM_IN),
			array($lng,SQLSRV_PARAM_IN)
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
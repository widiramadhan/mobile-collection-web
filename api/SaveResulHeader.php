<?php
require_once("../config/connection.php");

$contractID = $_POST["contractID"];
$status = $_POST["status"];
$pic = $_POST["pic"];
$savedDate = $_POST["savedDate"];
$period = $_POST["period"];
$branchID = $_POST["branchID"];

$call_sp = "{call SP_INSERT_RESULT_HEADER(?,?,?,?,?,?)}";
$params_sp = array(
				array($contractID,SQLSRV_PARAM_IN),
				array($status,SQLSRV_PARAM_IN),
				array($pic,SQLSRV_PARAM_IN),
				array($savedDate,SQLSRV_PARAM_IN),
				array($period,SQLSRV_PARAM_IN),
				array($branchID,SQLSRV_PARAM_IN)
				);
$exec = sqlsrv_query($conn,$call_sp,$params_sp) or die (print_r(sqlsrv_errors(), true));

if($exec) {
	$response['result'] = true;
	$response['pesan'] = "Data berhasil diupload ke server";
	echo json_encode($response);
} else {
	$response['result'] = false;
	$response['pesan'] = "Data gagal diupload ke server";
	echo json_encode($response);
}
?>
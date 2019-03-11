<?php
require_once("../config/koneksi.php");

$contractID = $_POST["contractID"];
$questionID = $_POST["questionID"];
$answer = $_POST["answer"];
$savedDate = $_POST["savedDate"];
$pic = $_POST["pic"];
$branchID = $_POST["branchID"];

$call = "{call SP_INSERT_RESULT(?,?,?,?,?,?)}"; 
$params = array(   
			  array($contractID, SQLSRV_PARAM_IN),
			  array($questionID, SQLSRV_PARAM_IN),
			  array($answer, SQLSRV_PARAM_IN),
			  array($savedDate, SQLSRV_PARAM_IN),
			  array($pic, SQLSRV_PARAM_IN),
			  array($branchID, SQLSRV_PARAM_IN)
			);  
$stmt = sqlsrv_query( $conn, $call, $params) or die( print_r( sqlsrv_errors(), true));

if($stmt) {
	$response['result'] = true;
	$response['pesan'] = "Data berhasil diupload ke server";
	echo json_encode($response);
} else {
	$response['result'] = false;
	$response['pesan'] = "Data gagal diupload ke server";
	echo json_encode($response);
}
?>
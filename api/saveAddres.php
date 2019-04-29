<?php 
require_once("../config/connection.php");

$contractID = $_POST["contractID"];
$addressType = $_POST["addressType"];
$addressNew = $_POST["addressNew"];
$pic = $_POST["pic"];
$branchID = $_POST["branchID"];

$callSp = "{call SP_INSERT_NEW_ADDRESS(?,?,?,?,?)}";
$params = array(
			array($contractID,SQLSRV_PARAM_IN),
			array($addressType,SQLSRV_PARAM_IN),
			array($addressNew,SQLSRV_PARAM_IN),
			array($pic,SQLSRV_PARAM_IN),
			array($branchID,SQLSRV_PARAM_IN)
			);
$exec = sqlsrv_query($conn, $callSp,$params) or die (print_r(sqlsrv_errors(),true));

if($exec){
	$respone['result'] = true;
	$respone['pesan'] = "Data Alamat Berhasil upload ke server";
	echo json_encode($respone);
}else{
	$respone['result'] = false;
	$respone['pesan'] = "Data Alamat gagal upload ke server";
	echo json_encode($respone);
}
?>
<?php
//session_start();
require_once ('../config/connection.php');

class usr{}

$username=$_POST['username'];
$password=$_POST['password'];
$encrypt= md5($password);

//cek ke db staging username dan password
$callSP = "{call SP_API_LOGIN_CHECK(?,?)}"; 
$params = array(array($username, SQLSRV_PARAM_IN),array($encrypt, SQLSRV_PARAM_IN));  
$options =  array( "Scrollable" => "buffered" );
$stmt = sqlsrv_query($conn, $callSP, $params, $options) or die( print_r( sqlsrv_errors(), true));
$check=sqlsrv_num_rows($stmt);
$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);	

if($check<>0){
	$response = new usr();
	$response->success = 1;
	$response->message = "Selamat datang ".$row['FULLNAME'];
	$response->USERID = $row['USERNAME'];
	$response->USERNAME = $row['USERNAME'];
	$response->FULLNAME = $row['FULLNAME'];
	$response->BRANCH_ID = $row['BRANCHID'];
	$response->EMP_ID = $row['EMP_NO'];
	$response->EMP_JOB_ID = $row['JOB_TITLE_NAME'];
	$response->BRANCH_NAME = $row['OFFICE_NAME'];
	die(json_encode($response));
}else{
	$response = new usr();
	$response->success = 0;
	$response->message = "Username atau password yang anda masukan salah";
	die(json_encode($response));
}
?>
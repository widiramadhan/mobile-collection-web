<?php
//session_start();
require_once ('../config/connection.php');

class usr{}

$username=$_POST['username'];
$password=$_POST['password'];
$encrypt= md5($password);

$response = new usr();
$response->success = 1;
$response->message = "Selamat datang ";
$response->USERID = '';
$response->USERNAME = '';
$response->FULLNAME = '';
$response->BRANCH_ID = '';
$response->EMP_ID = '';
$response->EMP_JOB_ID = '';
$response->BRANCH_NAME = '';
die(json_encode($response));


//cek ke db staging username dan password
/*$callSP = "{call SP_LOGIN_CHECK(?,?,?)}"; 
$params = array(array($username, SQLSRV_PARAM_IN),array($encrypt, SQLSRV_PARAM_IN),array(2, SQLSRV_PARAM_IN));  
$options =  array( "Scrollable" => "buffered" );
$stmt = sqlsrv_query($conn, $callSP, $params, $options) or die( print_r( sqlsrv_errors(), true));
$check=sqlsrv_num_rows($stmt);
$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);	

if($check<>0){
	$response = new usr();
	$response->success = 1;
	$response->message = "Selamat datang ".$row['Name'];
	$response->USERID = $row['M_USER_ID'];
	$response->USERNAME = $row['USERNAME'];
	$response->FULLNAME = $row['Name'];
	$response->BRANCH_ID = $row['BranchID'];
	$response->EMP_ID = $row['EmployeeID'];
	$response->EMP_JOB_ID = $row['EmployeeJobID'];
	$response->BRANCH_NAME = $row['BranchName'];
	die(json_encode($response));
}else{
	//cek ke db MFIN berdasarkan username
	$callSP2 = "{call SP_LOGIN_GET_USERNAME(?)}"; 
	$params2 = array(array($username, SQLSRV_PARAM_IN));  
	$options2 =  array( "Scrollable" => "buffered" );
	$stmt2 = sqlsrv_query($conn, $callSP2, $params2, $options2) or die( print_r( sqlsrv_errors(), true));
	$check2=sqlsrv_num_rows($stmt2);
	$row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);	
	
	$callSP3 = "{call SP_LOGIN_CHECK_USERNAME(?)}"; 
	$params3 = array(array($username, SQLSRV_PARAM_IN));  
	$options3 =  array( "Scrollable" => "buffered" );
	$stmt3 = sqlsrv_query($conn, $callSP3, $params3, $options3) or die( print_r( sqlsrv_errors(), true));
	$check3=sqlsrv_num_rows($stmt3);
	$row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC);	
	
	if($check2<>0){
		if($row3['USERNAME'] <> $row2['LoginID']){
			//insert ke db staging
			$query = "{call SP_LOGIN_INSERT_STAGING(?)}"; 
			$parameter = array(array($username, SQLSRV_PARAM_IN));
			$exec = sqlsrv_query($conn, $query, $parameter) or die( print_r( sqlsrv_errors(), true));
			
			$response = new usr();
			$response->success = 1;
			$response->message = "Welcome ".$row['USERNAME'];
			$response->USERID = $row['M_USER_ID'];
			$response->USERNAME = $row['USERNAME'];
			$response->FULLNAME = $row['Name'];
			$response->BRANCH_ID = $row['BranchID'];
			$response->EMP_ID = $row['EmployeeID'];
			$response->EMP_JOB_ID = $row['EmployeeJobID'];
			$response->BRANCH_NAME = $row['BranchName'];
			die(json_encode($response));
		}else{
			$response = new usr();
			$response->success = 0;
			$response->message = "Username atau password yang anda masukan salah";
			die(json_encode($response));
		}
	}else{
		$response = new usr();
		$response->success = 0;
		$response->message = "Username atau password yang anda masukan salah";
		die(json_encode($response));
	}
}*/
?>
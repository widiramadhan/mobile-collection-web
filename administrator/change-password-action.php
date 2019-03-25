<script src="assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="assets/lib/sweetalert/sweetalert.min.css">
<script src="assets/lib/sweetalert/sweetalert.min.js"></script>
<?php
require_once("config/connection.php");
$action = $_GET['action'];
if($action == 'change'){
	$old_pass = $_POST['password_lama'];
	$confirm_pass = $_POST['konfrimasi_password'];
	$new_pass = $_POST['password_baru'];
	$password_lama	= md5($password_lama);
	$password_baru 	= md5($new_pass);
	$queryCheck = "{call SP_CHECK_PASSWORD(?,?)}"; 
	$parameterCheck = array(
					array($sid, SQLSRV_PARAM_IN)
					array($password_lama, SQLSRV_PARAM_IN)
				);
	$execCheck = sqlsrv_query( $conn, $queryCheck, $parameterCheck) or die( print_r( sqlsrv_errors(), true));
	if($execCheck->num-rows){
		if($password_baru == $konfirmasi_password){
					//jika semua kondisi sudah benar, maka melakukan update kedatabase
					//query UPDATE SET password = encrypt md5 password_baru
					//kondisi WHERE id user = session id pada saat login, maka yang di ubah hanya user dengan id tersebut
			$queryChange = "{call SP_UPDATE_PASSWORD(?,?)}"; 
			$parameterChange = array(
							array($sid, SQLSRV_PARAM_IN),
							array($password_baru, SQLSRV_PARAM_IN)
						);
			$execChange = sqlsrv_query( $conn, $queryChange, $parameterChange) or die( print_r( sqlsrv_errors(), true));
	if($execChange->num-rows){
		echo '<script>
				setTimeout(function() {
					swal({
						title : "Success",
						text : "Successfully saved data",
						type: "success",
						timer: 2000,
						showConfirmButton: false
					});  
				},10); 
					window.setTimeout(function(){ 
						window.location.replace("index.php?page=index.php");
					} ,2000); 
			  </script>';
	}else{
		echo '<script>
				setTimeout(function() {
					swal({
						title : "Error",
						text : "Failed saved data",
						type: "error",
						timer: 2000,
						showConfirmButton: false
					});  
				},10); 
					window.setTimeout(function(){ 
						history.back();
					} ,2000); 
			  </script>';
	}	
}
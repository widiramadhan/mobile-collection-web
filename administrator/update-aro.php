<script src="assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
require_once("../config/connection.php");
$action = $_GET['action'];
if($action == 'update'){
	$nik = $_POST['emp_no'];
	$nama = $_POST['nama'];

	$queryUpdate = "{call SP_UPDATE_NAME_ARO(?,?)}";
	$paramsUpdate = array(
					array ($nik, SQLSRV_PARAM_IN),
					array ($nama, SQLSRV_PARAM_IN));
	$execUpdate = sqlsrv_query( $conn, $queryUpdate, $paramsUpdate) or die( print_r( sqlsrv_errors(), true));
	if($execUpdate){
				echo '<script>
				setTimeout(function() {
					swal({
						title : "Success",
						text : "Successfully Update data",
						type: "success",
						timer: 2000,
						showConfirmButton: false
					});  
				},10); 
					window.setTimeout(function(){ 
						window.location.replace("index.php");
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


?>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<link rel="stylesheet" href="vendors/sweetalert/sweetalert.min.css">
<script src="vendors/sweetalert/sweetalert.min.js"></script>
<?php
require_once("../config/connection.php");
$action = $_GET['action'];
if($action == 'save'){
	$branch = $_POST['branch'];
	$pic = $_POST['pic'];
	$bm = $_POST['bm'];
	
	$queryInsertModel = "{call SP_INSERT_DKHC(?,?,?)}"; 
	$parameterInsertModel = array(
					array($branch, SQLSRV_PARAM_IN),
					array($pic, SQLSRV_PARAM_IN),
					array($bm, SQLSRV_PARAM_IN)
				);
	$execInsertModel = sqlsrv_query( $conn, $queryInsertModel, $parameterInsertModel) or die( print_r( sqlsrv_errors(), true));
	if($execInsertModel){

		echo '<script>
				setTimeout(function() {
					swal({
						title : "Success",
						text : "Successfully to Assign",
						type: "success",
						timer: 2000,
						showConfirmButton: false
					});  
				},10); 
					window.setTimeout(function(){ 
						window.location.replace("index.php?page=collector-assignment");
					} ,2000); 
			  </script>';
	}else{
		echo '<script>
				setTimeout(function() {
					swal({
						title : "Error",
						text : "Failed to Assign",
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
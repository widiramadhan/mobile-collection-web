<script src="assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
require_once("../config/connection.php");
$action = $_GET['action'];
if($action == 'save'){
	$branch = $_POST['branch'];
	$coll_id = $_POST['coll_id'];
	$days = $_POST['days'];
	
	
	$queryInsert = "{call SP_INSERT_ARO_PRIORITY(?,?,?)}"; 
	$parameterInsert = array(
					array($branch, SQLSRV_PARAM_IN),
					array($coll_id, SQLSRV_PARAM_IN),
					array($days, SQLSRV_PARAM_IN)
				);
	$execInsert = sqlsrv_query( $conn, $queryInsert, $parameterInsert) or die( print_r( sqlsrv_errors(), true));
	if($execInsert){
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
						window.location.replace("index.php?page=aro-priority");
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
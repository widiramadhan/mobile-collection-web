<script src="assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
require_once("../config/connection.php");
$action = $_GET['action'];
if ($action == 'save'){
	$col = $_POST['col'];
	$aro = $_POST['aro'];
	$branchid = $_POST['branchid'];
	$selectedAro = count($aro);
	for($x=0;$x<$selectedAro;$x++){
	$queryUpdate = "{call SP_UPDATE_RE_ASIGN_ARO(?,?,?)}"; 
	$parameterUpdate = array(
					array($branchid, SQLSRV_PARAM_IN),
					array($aro[$x], SQLSRV_PARAM_IN),
					array($col, SQLSRV_PARAM_IN)
				);
	$execUpdate = sqlsrv_query( $conn, $queryUpdate, $parameterUpdate) or die( print_r( sqlsrv_errors(), true));
	if($execUpdate){
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
						window.location.replace("index.php?page=reasign-aro");
					} ,2000); 
			  </script>';
	}else{
		echo '<script>
				setTimeout(function() {
					swal({
						title : "Error",
						text : "Please Select Your Check Box",
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
}

?>
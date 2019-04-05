<script src="assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
require_once("../config/connection.php");
$action = $_GET['action'];
if($action == 'insert'){
	$office_name = $_POST['office_name'];
	$address = $_POST['address'];
	$kota = $_POST['kota'];
	$nama_kota = $_POST['nama_kota'];
	$kecamatan = $_POST['kecamatan'];
	$nama_kecamatan = $_POST['nama_kecamatan'];
	$kelurahan = $_POST['kelurahan'];
	$tag = $_POST['tag'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	
	
	$queryInsert = "{call SP_INSERT_BRANCH(?,?,?,?,?,?,?,?,?,?)}"; 
	$parameterInsert = array(
					array($office_name, SQLSRV_PARAM_IN),
					array($address, SQLSRV_PARAM_IN),
					array($kota, SQLSRV_PARAM_IN),
					array($nama_kota, SQLSRV_PARAM_IN),
					array($kecamatan, SQLSRV_PARAM_IN),
					array($nama_kecamatan, SQLSRV_PARAM_IN),
					array($kelurahan, SQLSRV_PARAM_IN),
					array($tag, SQLSRV_PARAM_IN),
					array($lat, SQLSRV_PARAM_IN),
					array($lng, SQLSRV_PARAM_IN)
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
						window.location.replace("index.php?page=branch");
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
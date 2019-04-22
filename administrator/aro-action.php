<script src="assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
require_once("../config/connection.php");
$action = $_GET['action'];
	if($action == 'insert'){
	$branchID = $_POST['branchID'];
	$userid = $_POST['userid'];
	$m_coll_area_id = $_POST['mAreaColID'];
	$selectedId = count($m_coll_area_id);
	$hari = $_POST['days'];
	$selectedDays = count($hari);
	for($x=0;$x<$selectedDays;$x++){
	for($y=0;$y<$selectedId;$y++){

	
	$callInsert = "{call SP_INSERT_DKH_PRIORITY_BY_DAYS(?,?,?,?)}";
	$paramInsert = array(
						array($branchID, SQLSRV_PARAM_IN),
						array($m_coll_area_id[$y], SQLSRV_PARAM_IN),
						array($hari[$x], SQLSRV_PARAM_IN),
						array($userid, SQLSRV_PARAM_IN)
					); 
	$execInsert = sqlsrv_query( $conn, $callInsert, $paramInsert) or die( print_r( sqlsrv_errors(), true));
	if($execInsert){
	
	echo '<script>
				setTimeout(function() {
					swal({
						title : "Success",
						text : "Successfully update data",
						type: "success",
						timer: 2000,
						showConfirmButton: false
					});  
				},10); 
					window.setTimeout(function(){ 
						window.location.replace("index.php?page=aro-priority1");
					} ,2000); 
			  </script>';
	}else{
		echo '<script>
				setTimeout(function() {
					swal({
						title : "Error",
						text : "Failed update data",
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
}


else if($action == 'save'){
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
}else if($action == 'insertNew'){
	$no_array = 0;
	foreach($_POST['branchID'] as $k){
		if(!empty($k)){
			$branchid = $_POST['branchID'][$no_array];
			$colid = $_POST['mAreaColID'][$no_array];
			$days = $_POST['days'][$no_array];
			$kecamatan = $_POST['kecamatan'][$no_array];
			$kelurahan = $_POST['kelurahan'][$no_array];
			$userid = $_POST['userID'][$no_array];
			$priorityid = $_POST['priorityID'][$no_array];
			
			$call = "{call SP_GET_PRIORITY_NUM_ROWS(?,?)}"; 
			$param = array(array($branchid, SQLSRV_PARAM_IN),
						   array($colid, SQLSRV_PARAM_IN)
						   );
			$options =  array( "Scrollable" => "buffered" );
			$ex = sqlsrv_query($conn, $call, $param, $options) or die( print_r( sqlsrv_errors(), true));
					
			$ketemu = sqlsrv_num_rows($ex);
			if($ketemu > 0){
				
						$callUpdate = "{call SP_UPDATE_DKH_PRIORITY_BY_DAYS(?,?)}";
						$paramUpdate  = array(
											array($days, SQLSRV_PARAM_IN),
											array($priorityid, SQLSRV_PARAM_IN)
											); 
						$execUpdate = sqlsrv_query( $conn, $callUpdate, $paramUpdate ) or die( print_r( sqlsrv_errors(), true));
						
						if($execUpdate){
						
						echo '<script>
									setTimeout(function() {
										swal({
											title : "Success",
											text : "Successfully update data",
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
											text : "Failed update data",
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
				
						
				}else{
						$callInsert = "{call SP_INSERT_DKH_PRIORITY_BY_DAYS(?,?,?,?)}";
						$paramInsert = array(
											array($branchid, SQLSRV_PARAM_IN),
											array($colid, SQLSRV_PARAM_IN),
											array($days, SQLSRV_PARAM_IN),
											array($userid, SQLSRV_PARAM_IN)
											); 
						$execInsert = sqlsrv_query( $conn, $callInsert, $paramInsert) or die( print_r( sqlsrv_errors(), true));
						
						if($execInsert){
						
						echo '<script>
									setTimeout(function() {
										swal({
											title : "Success",
											text : "Successfully insert data",
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
											text : "Failed insert data",
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

					//$this->M_insert->insert_looping($branchid, $colid, $keca, $kelu, $days);
					//echo $branchid.", ".$colid.", ".$days."<br>";
				}
				$no_array++;
			}
}	
?>
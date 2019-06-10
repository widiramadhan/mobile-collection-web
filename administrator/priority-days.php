<script src="assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
require_once("../config/connection.php");
$action = $_GET['action'];
	if($action == 'insert'){
		$counter = count($_POST['contract']); /* COUNT THE PASSED ON NAME */
	for($x=0;$x<=$counter; $x++){
		if(!empty($_POST['contract'][$x])){		
			$counter1 = count($_POST['days']); /* COUNT THE PASSED ON NAME */
					for($a=0;$a<=$counter1; $a++){
						if(!empty($_POST['days'][$a])){		
			$contracts = $_POST['contract'][$x];	
			$days = $_POST['days'][$a];
			$branchid = $_POST['branch'];
			
			
		
			
			$call = "{call SP_GET_COLL_PRIORITY_NUM_ROWS(?,?)}"; 
			$param = array(array($branchid, SQLSRV_PARAM_IN),
						   array($contracts, SQLSRV_PARAM_IN)
						   );
			$options =  array( "Scrollable" => "buffered" );
			$ex = sqlsrv_query($conn, $call, $param, $options) or die( print_r( sqlsrv_errors(), true));
					
			$ketemu = sqlsrv_num_rows($ex);
			if($ketemu > 0){
				
						$callUpdate = "{call SP_UPDATE_PRIORITY_CONTRACT_NUMBER(?,?)}";
						$paramUpdate  = array(
											array($days, SQLSRV_PARAM_IN),
											array($contracts, SQLSRV_PARAM_IN)
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
											window.location.replace("index.php?page=aro-priority-contract");
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
						$callInsert = "{call SP_INSERT_CONTRACT_PRIORITY_NUMBER(?,?,?)}";
						$paramInsert = array(
											array($branchid, SQLSRV_PARAM_IN),
											array($contracts, SQLSRV_PARAM_IN),
											array($days, SQLSRV_PARAM_IN)
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
											window.location.replace("index.php?page=aro-priority-contract");
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
				
		}
	}
	}
	}
	
else if($action == 'insert1'){
	$counter = count($_POST['contract']); /* COUNT THE PASSED ON NAME */
	$counter1 = count($_POST['days']); /* COUNT THE PASSED ON NAME */
	for($x=0;$x<=$counter; $x++){
		if(!empty($_POST['contract'][$x])){		
			$counter1 = count($_POST['days']); /* COUNT THE PASSED ON NAME */
					for($a=0;$a<=$counter1; $a++){
						if(!empty($_POST['days'][$a])){		
			$contracts = $_POST['contract'][$x];	
			$days = $_POST['days'][$a];
			$branchid = $_POST['branch'];
			
		
			
			$call = "{call SP_GET_COLL_PRIORITY_NUM_ROWS(?,?)}"; 
			$param = array(array($branchid, SQLSRV_PARAM_IN),
						   array($contracts, SQLSRV_PARAM_IN)
						   );
			$options =  array( "Scrollable" => "buffered" );
			$ex = sqlsrv_query($conn, $call, $param, $options) or die( print_r( sqlsrv_errors(), true));
					
			$ketemu = sqlsrv_num_rows($ex);
			if($ketemu > 0){
				
						$callUpdate = "{call SP_UPDATE_PRIORITY_CONTRACT_NUMBER(?,?)}";
						$paramUpdate  = array(
											array($days, SQLSRV_PARAM_IN),
											array($contracts, SQLSRV_PARAM_IN)
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
											window.location.replace("index.php?page=aro-priority-contract1");
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
						$callInsert = "{call SP_INSERT_CONTRACT_PRIORITY_NUMBER(?,?,?)}";
						$paramInsert = array(
											array($branchid, SQLSRV_PARAM_IN),
											array($contracts, SQLSRV_PARAM_IN),
											array($days, SQLSRV_PARAM_IN)
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
											window.location.replace("index.php?page=aro-priority-contract1");
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
				
		}
	}
	}
}

	
	
	
	
?>
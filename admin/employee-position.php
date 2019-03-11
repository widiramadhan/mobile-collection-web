<link rel="stylesheet" href="vendors/sweetalert/sweetalert.min.css">
<script src="vendors/jquery/jquery.min.js"></script>
<script src="vendors/sweetalert/sweetalert.min.js"></script>
<?php
session_start();
require_once("../config/connection.php");
if(isset($_SESSION['username_cuser'])) {
   $sid=$_SESSION['username_cuser'];
}else{
	$sid="";
}
if(isset($_SESSION['branch_cuser'])) {
	$bid=$_SESSION['branch_cuser'];
}else{
	$bid="";
}
if($sid && $bid){
	echo"<script>window.location='index.php'</script>";
}else if($sid){
	if(isset($_POST['btn_select'])){
		$_SESSION['branch_cuser'] = $_POST['branchid'];
		echo '<script>
			setTimeout(function() {
				swal({
					title : "Login Success",
					text : "Welcome to your dashboard. Redirecting in few seconds.",
					type: "success",
					timer: 2000,
					showConfirmButton: false
				});  
			},10); 
				window.setTimeout(function(){ 
					window.location.replace("index.php");
				} ,3000); 
		  </script>';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mobile Collection - Administrator</title>
    <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/sb-admin.css" rel="stylesheet">
</head>
<body class="bg" style="background-color:#EEE;">
    <div class="container">
		<br><br>
		<center>
			<div class="card" style="width:60%;">
				<div class="card-body">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="text-align:center;">OFFICE</th>
								<th style="text-align:center;">POSITION</th>
								<th style="text-align:center;">ACTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$tsql_callSP = "{call SP_GET_EMPLOYEE_POSITION_BY_USERNAME(?)}"; 
								$params = array(   
											  array($sid, SQLSRV_PARAM_IN)
											);  
								$options =  array( "Scrollable" => "buffered" );
								$stmt = sqlsrv_query( $conn, $tsql_callSP, $params, $options) or die( print_r( sqlsrv_errors(), true)); 
								$check=sqlsrv_num_rows($stmt);
								while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){	
							?>
							<tr>
								<td><?php echo $row['BRANCH_NAME'];?></td>
								<td><?php echo $row['ROLE_NAME'];?></td>
								<td style="text-align:center;">
									<form method="post" action="">
										<input type="hidden" name="branchid" value="<?php echo $row['BRANCHID'];?>">
										<input type="submit" class="btn btn-primary btn-sm" value="Select" name="btn_select">
									</form>
								</td>
							</tr>
							<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</center>
    </div>
<script src="vendors/jquery/jquery.min.js"></script>
<script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendors/jquery-easing/jquery.easing.min.js"></script>
<script src="vendors/sweetalert/sweetalert.min.js"></script>
</body>
</html>
<?php 
}else{
	echo"<script>window.location='index.php'</script>";
}
?>
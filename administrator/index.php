<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too
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
//echo "test -> ".$sid;
if($sid && $bid){
//===== GET LOGIN =====//
$callSPGetLogin = "{call SP_GET_USER_LOGIN(?,?)}"; 
$paramsGetLogin = array(array($sid, SQLSRV_PARAM_IN),array($bid, SQLSRV_PARAM_IN));  
$execGetLogin = sqlsrv_query( $conn, $callSPGetLogin, $paramsGetLogin) or die( print_r( sqlsrv_errors(), true)); 
$data = sqlsrv_fetch_array( $execGetLogin, SQLSRV_FETCH_ASSOC);

$query = "{call SP_GET_AGING_COLLECTED(?)}";
$params = array(array($bid, SQLSRV_PARAM_IN),);  
$execs = sqlsrv_query( $conn, $query, $params) or die( print_r( sqlsrv_errors(), true));
$data1 = sqlsrv_fetch_array( $execs, SQLSRV_FETCH_ASSOC);

//===== END GET LOGIN =====//

$branchType=substr($bid,0,2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Mobile Collection - Administrator</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
  <link href="vendor/datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
	<script src="vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">
	<div id="wrapper">
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
				<div class="sidebar-brand-icon">
					<i class="fa fa-user-circle"></i>
				</div>
				<div class="sidebar-brand-text mx-3">Collection <sup>Administrator</sup></div>
			</a>
			<!--<div class="sidebar-brand-text mx-3" style="color:#FFF;font-weight:bold;margin-top:30px;">
				<sup><?php echo $data['FULLNAME'];?><br>
				<?php echo $data['OFFICE_NAME'];?></sup>
			</div>-->
			<hr class="sidebar-divider my-0">	
			<li class="nav-item">
				<a class="nav-link" href="index.php">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<hr class="sidebar-divider">
			<div class="sidebar-heading">
				Branch Manager
			</div>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=collector-assignment">
					<i class="fa fa-check-square"></i>
					<span>Approval DKH</span>
				</a>
			</li>
			<?php 
			if ($branchType == "15"){
				
			?>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=aro-priority">
					<i class="fa fa-cog"></i>
					<span>ARO Priority</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=aro-activity">
					<i class="fa fa-location-arrow"></i>
					<span>Mapping Aktvitas Aro</span>
				</a>
			</li>
			<?php } ?>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=reasign-aro">
					<i class="fa fa-random" aria-hidden="true"></i>
					<span>Re-Approve ARO</span>
				</a>
			</li>
			<hr class="sidebar-divider">
			<div class="sidebar-heading">
				AR Officer
			</div>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=list-aro">
					<i class="fa fa-users"></i>
					<span>List ARO</span>
				</a>
			</li>
			<li class="nav-item">
			 <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="true" aria-controls="collapseTwo">
					<i class="fa fa-map-marked-alt"></i>
					<span>Tracking ARO</span>
				</a>
			<div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
				<div class="bg-white py-2 collapse-inner rounded">
					<h6 class="collapse-header">Tracking Aro :</h6>
					<a class="collapse-item" href="index.php?page=tracking-collector">Tracking Aro Route</a>
					<a class="collapse-item" href="index.php?page=tracking-aro-status">Tracking Aro Location</a>
				</div>
			</div>
			</li>
			
			<li class="nav-item">
				 <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
					<i class="fa fa-edit"></i>
					<span>Tasklist ARO</span>
				</a>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
				<div class="bg-white py-2 collapse-inner rounded">
					<h6 class="collapse-header">Tasklist Aro :</h6>
					<a class="collapse-item" href="index.php?page=tasklist-summary">Tasklist</a>
					<a class="collapse-item" href="index.php?page=tasklist">Tasklist Aro Per-Bulan</a>
					<a class="collapse-item" href="index.php?page=tasklist-harian">Tasklist Aro Per-Hari</a>
				</div>
			</div>
			</li>
	
			<hr class="sidebar-divider">
			<div class="sidebar-heading">
				Customer
			</div>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=list-customer">
					<i class="fa fa-users"></i>
					<span>List Customer</span>
					<input type="hidden" value="<?php echo $data1['PERIOD'];?>">
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=visit-result">
					<i class="fa fa-th-large"></i>
					<span>Visit Result</span>
				</a>
			</li>
			<hr class="sidebar-divider d-none d-md-block">
		</ul>
		
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>
					<div class="mr-2 d-none d-lg-inline text-gray-800 medium">
					<?php echo $bid;?> - <?php echo $data['OFFICE_NAME'];?>
					</div>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user-circle"></i> &nbsp;
								<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $data['FULLNAME'];?></span> 
								<i class="fa fa-caret-down"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="index.php?page=profile&id=<?php echo $sid;?>">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
									Profile
								</a>
								<a class="dropdown-item" href="index.php?page=change-password&id=<?php echo $sid;?>">
									<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
									Change Password
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php" >
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>
					</ul>
				</nav>
				<div class="container-fluid">
					<?php require_once("content.php"); ?>
				</div>
			</div>
		</div>
    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="assets/js/sb-admin-2.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="assets/js/demo/chart-area-demo.js"></script>
<script src="assets/js/demo/chart-pie-demo.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/demo/datatables-demo.js"></script>
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<script src="vendor/datepicker/js/bootstrap-datepicker.min.js"></script>

</body>

</html>
<?php 
}else{
	echo"<script>window.location='login.php'</script>";
}
?>

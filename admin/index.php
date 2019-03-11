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
//echo "test -> ".$sid;
if($sid && $bid){
//===== GET LOGIN =====//
$callSPGetLogin = "{call SP_GET_USER_LOGIN(?,?)}"; 
$paramsGetLogin = array(array($sid, SQLSRV_PARAM_IN),array($bid, SQLSRV_PARAM_IN));  
$execGetLogin = sqlsrv_query( $conn, $callSPGetLogin, $paramsGetLogin) or die( print_r( sqlsrv_errors(), true)); 
$data = sqlsrv_fetch_array( $execGetLogin, SQLSRV_FETCH_ASSOC);
//===== END GET LOGIN =====//
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<style>
		img {
		  border-radius: 50%;
		}
	</style>
    <title>Mobile Collection - Administrator</title>
    <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendors/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="assets/css/sb-admin.css" rel="stylesheet">
	<link rel="stylesheet" href="vendors/sweetalert/sweetalert.min.css">
</head>
<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
		<a class="navbar-brand mr-1" href="index.php">Mobile Collection</a>
		<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
			<i class="fas fa-bars"></i>
		</button>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user-circle fa-fw"></i> <?php echo $data['FULLNAME'];?>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="#">Profile</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="logout.php">Logout</a>
				</div>
			</li>
		</ul>
    </nav>
    <div id="wrapper">
		<ul class="sidebar navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=profile">
					<b><?php echo $data['FULLNAME'];?></b><br>
					<span style="font-size:12px;"><?php echo $data['JOB_TITLE_NAME'];?></span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=dashboard">
					<i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="nav-item " >
				<a class="nav-link" href="index.php?page=collector-assignment">
					<i class="fa fa-check-square"></i> <span>Approval DKH</span>
				</a>
			</li>
			<li class="nav-item " >
				<a class="nav-link" href="index.php?page=list-aro">
					<i class="fa fa-user"></i> <span>List ARO</span>
				</a>
			</li>
			<li class="nav-item " >
				<a class="nav-link" href="index.php?page=list-aro">
					<i class="fa fa-users"></i> <span>List Customer</span>
				</a>
			</li>
			<li class="nav-item " >
				<a class="nav-link" href="index.php?page=tracking-collector">
					<i class="fas fa-fw fa-map-marked-alt"></i> <span>Tracking Collector</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=tasklist	">
					<i class="fas fa-fw fa-tasks"></i> <span>Tasklist</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=history">
					<i class="fas fa-fw fa-history"></i> <span>History</span>
				</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-fw fa-user"></i> <span>User</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="index.php?page=userlist">User List</a>
				</div>
			</li>
		</ul>

		<div id="content-wrapper" style="background-color:#eee;">
			<div class="container-fluid">
				<div class="right_col" role="main">
					<?php require_once("content.php"); ?>
				</div>
			</div>
		</div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
    </a>

    <script src="vendors/jquery/jquery.min.js"></script>
    <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendors/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/datatables/jquery.dataTables.js"></script>
    <script src="vendors/datatables/dataTables.bootstrap4.js"></script>
    <script src="assets/js/sb-admin.min.js"></script>
    <script src="assets/js/demo/datatables-demo.js"></script>
    <script src="assets/js/demo/chart-area-demo.js"></script>
	<script src="assets/js/demo/chart-bar-demo.js"></script>
	<script src="vendors/sweetalert/sweetalert.min.js"></script>
</body>
</html>
<?php 
}else{
	echo"<script>window.location='login.php'</script>";
}
?>
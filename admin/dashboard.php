<?php
	//total ARO
	$queryARO = "{call SP_GET_ARO(?)}";
	$optionsARO =  array( "Scrollable" => "buffered" );
	$paramsARO = array(array($bid, SQLSRV_PARAM_IN));  
	$execARO = sqlsrv_query( $conn, $queryARO, $paramsARO, $optionsARO) or die( print_r( sqlsrv_errors(), true));
	$numrowsARO = sqlsrv_num_rows($execARO);
?>
<div class="row">
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-primary o-hidden">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fas fa-fw fa-user"></i>
				</div>
				<div class="mr-5">Collector</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="#">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-warning o-hidden">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fas fa-fw fa-map"></i>
				</div>
				<div class="mr-5">Location</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="#">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div>
</div>
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-chart-area"></i>
		Area Chart Example
	</div>
	<div class="card-body">
		<canvas id="myAreaChart" width="100%" height="30"></canvas>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="card mb-3">
			<div class="card-header">
				<i class="fas fa-chart-bar"></i>
				Bar Chart Example
			</div>
			<div class="card-body">
				<canvas id="myBarChart" width="100%" height="50"></canvas>
			</div>
			<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
		</div>
	</div>
</div>
<script src="assets/js/demo/chart-area-demo.js"></script>
<script src="assets/js/demo/chart-bar-demo.js"></script>
<script src="assets/js/demo/chart-pie-demo.js"></script>



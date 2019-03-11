<?php
	//total ARO
	$queryARO = "{call SP_GET_ARO(?)}";
	$optionsARO =  array( "Scrollable" => "buffered" );
	$paramsARO = array(array($bid, SQLSRV_PARAM_IN));  
	$execARO = sqlsrv_query( $conn, $queryARO, $paramsARO, $optionsARO) or die( print_r( sqlsrv_errors(), true));
	$numrowsARO = sqlsrv_num_rows($execARO);
?>
<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">AR Officer in Branch</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numrowsARO;?> AR Officer</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-users fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Approval DKH</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">320 Approval DKH</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-edit fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Customer in BRanch</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">120 Customers</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-user fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Visit Result</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">5 Visit Result</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-th-large fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-7">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Customer Distribution</h6>
			</div>
			<div class="card-body">
				<div class="chart-area">
					<div id="googleMap" style="width:100%;height:100%;"></div>
				</div>
				<hr>
				Persebaran customer pada cabang <?php echo $bid;?>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Customer Distribution</h6>
			</div>
			<div class="card-body">
				<div class="chart-area">
					<canvas id="myAreaChart"></canvas>
				</div>
				<hr>
				Persebaran customer pada cabang <?php echo $bid;?>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDOC4niTnX8QwoxCeEZYjGpOPtKJN3BGQk"></script>
<script type="text/javascript">
$(document).ready(function() {
//$(window).on('load', function(){
	initialize();
});

function initialize() {
  var propertiPeta = {
	center:new google.maps.LatLng("-6.185818","106.909129"),
	zoom:15,
	mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  
  var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
  // membuat Marker
  var marker=new google.maps.Marker({
	  position: new google.maps.LatLng("-6.185818","106.909129"),
	  map: peta,
	  //icon: 'assets/images/marker.png',
	  //title: 'SFI PUSAT'
  });
}
// event jendela di-load  
google.maps.event.addDomListener(window, 'load', initialize);
</script>



<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
if(isset($_POST['submit_col'])){
	if($_POST['col'] == ""){
		echo '<script>
			setTimeout(function() {
				swal({
					title: "Ops.. Something Wrong!",
					text: "Mohon pilih nama collector",
					type: "error"
				}, function() {
					window.location.replace("index.php?page=collector-assignment");
				});
			}, 0);
		</script>';
		$branch = $_POST['branch'];
		$pic = $_POST['col'];
	}else{
		$branch = $_POST['branch'];
		$pic = $_POST['col'];
	}
}else{
	$branch = "";
	$pic = "";
}

?>
<style>
	th{
		text-align:center;
		vertical-align:middle;
		font-size:12px;
	}
	td{
		text-align:center;
		vertical-align:middle;
		font-size:12px;
	}
</style>
<div class="row">
	<div class="col-md-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Select AR Officer</h6>
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="form-group">
						<label>Branch</label>
						<select class="form-control" id="branch" name="branch">
							<?php
								if($data['LEVEL'] == 'SUPER ADMIN'){
									
								}else{
									echo '<option value="'.$data['BRANCHID'].'" selected>'.$data['OFFICE_NAME'].'</option>';
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Collector Name</label>
						<select class="form-control" id="col" name="col">
							<option value="" selected>Pilih Collector</option>
							<?php
								if($data['LEVEL'] == 'SUPER ADMIN'){
									
								}else{
									$callCol = "{call SP_LOV_ARO_BY_BRANCH(?)}"; 
									$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
									$execCol = sqlsrv_query( $conn, $callCol, $paramsCol) or die( print_r( sqlsrv_errors(), true));								
									while($dataCol = sqlsrv_fetch_array($execCol)){
									?>
										<option value="<?php echo $dataCol['EMP_NO'];?>" <?php if($dataCol['EMP_NO'] == $pic){ echo"selected"; }?>><?php echo $dataCol['EMP_NO'].' - '.strtoupper($dataCol['EMP_NAME']);?></option>
									<?php
									}
								}
							?>
						</select>
					</div>
					<div class="pull-right">
						<input type="reset" value="Cancel" class="btn btn-secondary" style="background-color:#AAA;border:none;">
						<input type="submit" value="Submit" class="btn btn-primary" name="submit_col">
					</div>
					<div style="clear:both;"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="card shadow mb-4">
			<div class="card-header">
				<h6 class="m-0 font-weight-bold text-primary">Tracking AR Officer</h6>
			</div>
			<div class="card-body">
				<!--<div class="table-responsive">
					<table class="table table-bordered" style="width:100%;">
						<tr>
							<td style="width:25%;background-color:#EEE;"><b>ARO Name</b></td>
							<td style="width:25%;">Widi Ramadhan</td>
							<td style="width:25%;background-color:#EEE;"><b>Jarak Tempuh</b></td>
							<td style="width:25%;">50 Km</td>
						</tr>
						<tr>
							<td style="width:25%;background-color:#EEE;"><b>Branch</b></td>
							<td>Bekasi</td>
							<td style="width:25%;background-color:#EEE;"><b>Target</b></td>
							<td>10</td>
						</tr>
					</table>
				</div>-->
				<div id="map_tracking" style="width:100%;height:400px;"></div>
			</div>
		</div>
	</div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDOC4niTnX8QwoxCeEZYjGpOPtKJN3BGQk"></script>
<?php
$query = "{call TEST_DELETE_SOON}";  
$exec = sqlsrv_query( $conn, $query) or die( print_r( sqlsrv_errors(), true));
$no=0;
?>
<script>
var geocoder;
var map;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var locations = [
<?php 
	while($data = sqlsrv_fetch_array($exec)){
		$no++;
		
?>
	['Manly Beach', <?php echo $data['LAT'];?>,  <?php echo $data['LNG'];?>, <?php echo $no;?>],
<?php } ?>
];

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();


  var map = new google.maps.Map(document.getElementById('map_tracking'), {
    zoom: 10,
    center: new google.maps.LatLng(-33.92, 151.25),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  directionsDisplay.setMap(map);
  var infowindow = new google.maps.InfoWindow();

  var marker, i;
  var request = {
    travelMode: google.maps.TravelMode.DRIVING
  };
  for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
      }
    })(marker, i));

    if (i == 0) request.origin = marker.getPosition();
    else if (i == locations.length - 1) request.destination = marker.getPosition();
    else {
      if (!request.waypoints) request.waypoints = [];
      request.waypoints.push({
        location: marker.getPosition(),
        stopover: true
      });
    }

  }
  directionsService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(result);
    }
  });
}
google.maps.event.addDomListener(window, "load", initialize);
</script>
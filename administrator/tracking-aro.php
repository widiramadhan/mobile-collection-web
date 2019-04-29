<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
date_default_timezone_set('Asia/Jakarta');
if(isset($_POST['submit_col'])){
	if($_POST['col'] == ""){
		echo '<script>
			setTimeout(function() {
				swal({
					title: "Ops.. Something Wrong!",
					text: "Mohon pilih nama collector",
					type: "error"
				}, function() {
					window.location.replace("index.php?page=tracking-collector");
				});
			}, 0);
		</script>';
		$branch = $_POST['branch'];
		$pic = $_POST['col'];
		$date = $_POST['date'];
	}else{
		$branch = $_POST['branch'];
		$pic = $_POST['col'];
		$date = $_POST['date'];
		
		$query = "{call SP_GET_ROUTE_ARO(?,?)}";  
		$params = array(array($pic, SQLSRV_PARAM_IN),array($date, SQLSRV_PARAM_IN));  
		$options =  array( "Scrollable" => "buffered" );
		$exec = sqlsrv_query( $conn, $query, $params, $options) or die( print_r( sqlsrv_errors(), true));
	}
}else{
	$branch = "";
	$pic = "";
	$date = date("Y-m-d");
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
									$callCol = "{call SP_GET_COLLECTOR_BY_BRANCH(?)}"; 
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
					<div class="form-group">
						<label>Date </label>
						<div class="input-group mb-3">
							<input type="text" name="date" id="date" class="form-control" value="<?php echo $date;?>" autocomplete="off" readonly style="background-color:#FFF;cursor:pointer;">
							<div class="input-group-append">
								<span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="pull-right">
						<input type="reset" value="Cancel" class="btn btn-danger">
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
				<?php
					if(isset($_POST['submit_col'])){
						if(!$_POST['col'] == ""){
							$numrows = sqlsrv_num_rows($exec);	
							if($numrows == 0){
								echo'<div class="row">
										<div class="alert alert-warning alert-dismissible fade show" role="alert" style="width:100%;">
											<i class="fa fa-exclamation-triangle"></i> ARO belum mengunjungi costumer satupun hari ini
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										</div>
									</div>
									<div style="height:400px;width:100%;">
										<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16327777.997882307!2d108.84189317670506!3d-2.4152622231444334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c4c07d7496404b7%3A0xe37b4de71badf485!2sIndonesia!5e0!3m2!1sid!2sid!4v1556436020418!5m2!1sid!2sid" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
									</div>';
							}else{
							?>
								<div id="map_tracking" style="width:100%;height:400px;"></div>
								<br>
								<b>Detail Route</b>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Contract ID</th>
											<th>Result</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$query2 = "{call SP_GET_ROUTE_ARO_DETAIL(?,?)}";  
											$params2 = array(array($pic, SQLSRV_PARAM_IN),array($date, SQLSRV_PARAM_IN));  
											$options =  array( "Scrollable" => "buffered" );
											$exec2 = sqlsrv_query( $conn, $query, $params, $options) or die( print_r( sqlsrv_errors(), true));
											$no=0;
											while($data2=sqlsrv_fetch_array($exec2)){
												$no++;
										?>
										<tr>
											<td><?php echo $no;?></td>
											<td><?php echo $data2['CONTRACT_ID'];?></td>
											<td><?php echo $status;?></td>
											<td><?php echo $data2['CREATE_DATE']->format("d-m-Y H:i:s");?></td>
											<td>
												<a href="" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Detail</a>
											</td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							<?php
							}
						}
					}else{
						echo'<div style="height:400px;width:100%;"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16327777.997882307!2d108.84189317670506!3d-2.4152622231444334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c4c07d7496404b7%3A0xe37b4de71badf485!2sIndonesia!5e0!3m2!1sid!2sid!4v1556436020418!5m2!1sid!2sid" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe></div>';
					}
				?>
			</div>
		</div>
	</div>
</div>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDOC4niTnX8QwoxCeEZYjGpOPtKJN3BGQk"></script>
<script>
$( document ).ready(function() {   
	$('#date').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		endDate: new Date()
	});
});
</script>
<script>
<?php
if(isset($_POST['submit_col'])){
	if(!$_POST['col'] == ""){
		$numrows = sqlsrv_num_rows($exec);
		if(!$numrows == 0){
?>
var geocoder;
var map;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var locations = [
<?php 
	$no=0;
	while($data = sqlsrv_fetch_array($exec)){
		$no++;
		
?>
	['Lokasi <?php echo $no;?>', <?php echo $data['LAT'];?>,  <?php echo $data['LNG'];?>, <?php echo $no;?>],
<?php } ?>
];
<?php  } } } ?>

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
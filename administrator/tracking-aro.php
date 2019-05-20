<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
date_default_timezone_set('Asia/Jakarta'); 
$date = date("Y-m-d");
$tgl= substr($date,0,7);
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
		$tgl = substr($date,0,7);
		
		$query = "{call SP_GET_ROUTE_ARO(?,?)}";  
		$params = array(array($pic, SQLSRV_PARAM_IN),array($date, SQLSRV_PARAM_IN));  
		$options =  array( "Scrollable" => "buffered" );
		$exec = sqlsrv_query( $conn, $query, $params, $options) or die( print_r( sqlsrv_errors(), true));
		
		$query1 = "{call SP_GET_ROUTE_ARO(?,?)}";  
		$params1 = array(array($pic, SQLSRV_PARAM_IN),array($date, SQLSRV_PARAM_IN));  
		$options1 =  array( "Scrollable" => "buffered" );
		$exec1 = sqlsrv_query( $conn, $query1, $params1, $options1) or die( print_r( sqlsrv_errors(), true));
		$dataExec = sqlsrv_fetch_array($exec1);
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
			<div class="card-body" style="padding-bottom:50px">
				<form action="" method="post">
					<div class="form-group">
						<label>Branch</label>
						<select class="form-control" id="branch" name="branch">
							<?php
								/*if($data['LEVEL'] == 'SUPER ADMIN'){
									
								}else{*/
									echo '<option value="'.$data['BRANCHID'].'" selected>'.$data['OFFICE_NAME'].'</option>';
								//}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Collector Name</label>
						<select class="form-control" id="col" name="col">
							<option value="" selected>Pilih Collector</option>
							<?php
								/*if($data['LEVEL'] == 'SUPER ADMIN'){
									
								}else{*/
									$callCol = "{call SP_GET_ARO(?)}"; 
									$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
									$execCol = sqlsrv_query( $conn, $callCol, $paramsCol) or die( print_r( sqlsrv_errors(), true));								
									while($dataCol = sqlsrv_fetch_array($execCol)){
									?>
										<option value="<?php echo $dataCol['EMP_NO'];?>" <?php if($dataCol['EMP_NO'] == $pic){ echo"selected"; }?>><?php echo $dataCol['EMP_NO'].' - '.strtoupper($dataCol['EMP_NAME']);?></option>
									<?php
									}
								//}
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
					<hr><br><br>
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
							/*}else if($numrows == 1){
								echo'<div id="map_tracking2" style="width:100%;height:400px;"></div>';*/
							}else{
								echo'<div id="map_tracking" style="width:100%;height:400px;"></div>';
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
<div class="row">
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">TaskList Detail AR Officer</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered dataTable" style="width:100%;font-size:12px;" id="example" >
						<thead>
							<tr>
								<th style="text-align:center;vertical-align:middle;">No</th>
								<th style="text-align:center;vertical-align:middle;">No Kontrak</th>
								<th style="text-align:center;vertical-align:middle;">Nama Kostumer</th>
								<th style="text-align:center;vertical-align:middle;">Tgl Jatuh Tempo</th>
								<th style="text-align:center;vertical-align:middle;">Total Tagihan</th>
								<th style="text-align:center;vertical-align:middle;">Total Pembayaran</th>
								<th style="text-align:center;vertical-align:middle;">Tgl Janji Bayar</th>
								<th style="text-align:center;vertical-align:middle;">Status</th>
								<th style="text-align:center;vertical-align:middle;width:200px;">Action</th>
							</tr>
						</thead>
						<tbody>
					
							<?php
								$no=0;
								$callDKHC = "{call SP_GET_DKH_ROUTE(?,?,?,?)}"; 
								$options =  array( "Scrollable" => "buffered" );
								$paramsDKHC = array(array($branch, SQLSRV_PARAM_IN),
														 array($pic, SQLSRV_PARAM_IN),
														 array($date, SQLSRV_PARAM_IN), 
														 array(str_replace("-","", $tgl)."01",SQLSRV_PARAM_IN));
								$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC, $options) or die( print_r( sqlsrv_errors(), true));
								while($dataDKHC = sqlsrv_fetch_array($execDKHC)){
									$no++;
									$queryResult = "{call SP_GET_RESULT(?,?)}";
									$paramsResult = array(array($bid, SQLSRV_PARAM_IN),array($dataDKHC['NOMOR_KONTRAK'], SQLSRV_PARAM_IN));  
									$optionsResult =  array( "Scrollable" => "buffered" );
									$execResult = sqlsrv_query( $conn, $queryResult, $paramsResult, $optionsResult) or die( print_r( sqlsrv_errors(), true));
									$numrowsResult=sqlsrv_num_rows($execResult);
									if($numrowsResult <>0){
										while($dataresult = sqlsrv_fetch_array($execResult)){
											$quest = $dataresult['QUESTION'];
											if($quest == "MS_Q20190226172031880"){$meetup = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172302530"){$contactPerson = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172325360"){$hubunganKontak = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172343540"){$addres = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172405297"){$addresQuestion = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172432320"){$addresNew =$dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172447930"){$unit = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172517357"){$customerPay = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172558067"){$latPayLocation = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172603397"){$longPayLocation = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172624710"){$latLocationMeet = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172628683"){$longLocationMeet = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172644783"){$acceptAmount = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172753329"){$imagesPayLocation = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172753330"){$imagesPayMeet = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172810420"){$promiseDate = $dataresult['ANSWER'];}
											if($quest == "MS_Q20190226172818070"){$result = $dataresult['ANSWER'];}
										}	
									}else{
										$meetup="";
										$customerPay="";
										$acceptAmount="";
										$promiseDate="";
									}
							?>
							<tr>
								<td style="text-align:center;vertical-align:middle;"><?php echo $no;?></td>
								<td style="vertical-align:middle;"><?php echo $dataDKHC['NOMOR_KONTRAK'];?></td>
								<td style="text-align:left;vertical-align:middle;"><?php echo $dataDKHC['NAMA_KOSTUMER'];?></td>
								<td style="text-align:center;vertical-align:middle;"><?php  if(is_null($dataDKHC['TANGGAL_JATUH_TEMPO'])){echo"";} else if($dataDKHC['TANGGAL_JATUH_TEMPO']->format('Y-m-d')=='1970-01-01'){echo"";}else echo $dataDKHC['TANGGAL_JATUH_TEMPO']->format('Y-m-d');?></td>
								<td style="text-align:right;vertical-align:middle;">Rp. <?php echo number_format($dataDKHC['TOTAL_TAGIHAN'],0,',','.');?></td>
								<td style="text-align:right;vertical-align:middle;"><?php if($acceptAmount <> "" || $acceptAmount <> NULL){ echo "Rp. ".number_format($acceptAmount,0,',','.');}?></td>
								<td style="text-align:center;vertical-align:middle;">
									<?php 	
										if($meetup == "Ya, bertemu dengan customer"){
											if($promiseDate <> NULL || $promiseDate <> "" || date("Y-m-d", strtotime($promiseDate)) <> "1970-01-01"){
												echo date("Y-m-d", strtotime($promiseDate));
											}
										}else if($meetup == "Tidak, bertemu dengan orang lain"){
											if($promiseDate <> NULL || $promiseDate <> "" || date("Y-m-d", strtotime($promiseDate)) <> "1970-01-01"){
												echo date("Y-m-d", strtotime($promiseDate));
											}
										}
									?>
								</td>
								<td style="text-align:center;vertical-align:middle;">
									<?php
										$disabled = 1;
										if($meetup == "Ya, bertemu dengan customer"){
											if($promiseDate <> NULL || $promiseDate <> "" || date("Y-m-d", strtotime($promiseDate)) <> "1970-01-01"){
												echo'<span class="badge badge-pill badge-success">Janji bayar</span>';
											}else if($customerPay == "Ya"){
												echo'<span class="badge badge-pill badge-primary">Customer membayar</span>';
											}else{
												echo"aaa";
											}
											$disabled=1;
										}else if($meetup == "Tidak, bertemu dengan orang lain"){
											if($promiseDate <> NULL || $promiseDate <> "" || date("Y-m-d", strtotime($promiseDate)) <> "1970-01-01"){
												echo'<span class="badge badge-pill badge-success">Janji bayar</span>';
											}else if($customerPay == "Ya"){
												echo'<span class="badge badge-pill badge-primary">Customer membayar</span>';
											}else{
												echo"aaa";
											}
											$disabled=1;
										}else{
											echo'<span class="badge badge-pill badge-danger">Belum dikunjungi</span>';
											$disabled=0;
										}
									?>
								</td>
								<td style="vertical-align:middle;text-align:center">
									<?php
										if($disabled == 0){
									?>
									<button type="button" class="btn btn-success btn-sm" disabled><i class="fa fa-eye"></i> Detail</button>
									<a href="index.php?page=approve&id=<?php echo $dataDKHC['NOMOR_KONTRAK'];?>" class="btn btn-primary btn-sm"><i class="fa fa-times"></i> Cancel Approve</a>
									<?php
									}else{
									?>
									<a href="index.php?page=result-detail&contractID=<?php echo $dataDKHC['NOMOR_KONTRAK'];?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Detail</a>
									<button type="button" class="btn btn-primary btn-sm" disabled><i class="fa fa-times"></i> Cancel Approve</button>
									<?php
										}
									?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<br>
				
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDOC4niTnX8QwoxCeEZYjGpOPtKJN3BGQk"></script>
<!--<script src="https://maps.google.com/maps/api/js?key=AIzaSyDZqZCbzcSFzRMttT8L8g864uPwR4JnSRU"></script>-->
<script>
$( document ).ready(function() {   
	$('#date').datepicker({
		format: "yyyy-mm-dd",
		changeMonth: true,
        changeYear: true,
		autoclose: true,
		viewMode: "days", 
		minViewMode: "days",
		endDate: new Date()
	});
	$('#example').DataTable({
	"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
	"order": [[ 0, "asc" ]],
	"columnDefs": [ {
	"targets": [0,1],
		"orderable": true
	} ]
});
});
</script>
<script>
<?php
if(isset($_POST['submit_col'])){
	if(!$_POST['col'] == ""){
		$numrows = sqlsrv_num_rows($exec);
		if(!$numrows == 0 || !$numrows == 1){
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
			function initialize() {
			  directionsDisplay = new google.maps.DirectionsRenderer();
			  var map = new google.maps.Map(document.getElementById('map_tracking'), {
				zoom: 15,
				center: new google.maps.LatLng("<?php echo $dataExec['LAT'];?>",  "<?php echo $dataExec['LNG'];?>"),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			  });
			  directionsDisplay.setMap(map);
			  var infowindow = new google.maps.InfoWindow();
			  
			  if(locations.length == 1){
				  var marker;
				  marker = new google.maps.Marker({
					  position: new google.maps.LatLng("<?php echo $dataExec['LAT'];?>",  "<?php echo $dataExec['LNG'];?>"),
					  map: map,
					  title: '<?php echo $dataExec["CONTRACT_ID"];?>'
					});
			  }else{
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

					if (i == 0){
						request.origin = marker.getPosition();
					}else if (i == locations.length - 1) {
						request.destination = marker.getPosition();
					}else {
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
			}
			google.maps.event.addDomListener(window, "load", initialize);
<?php
} } }?>
</script>
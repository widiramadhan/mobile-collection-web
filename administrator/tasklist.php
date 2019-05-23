<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
$total_paid = "0";
$total_promise = "0";
$total_not_meet = "0";
$total_amount = "Rp. 0";
$total_tagihan = "Rp. 0";
$total_jarak = "0 Km";
$tgl = date("Y-m");
$branch = "";
$pic = "";

if(isset($_POST['submit_col'])){

	if($_POST['col'] == ""){
		echo '<script>
			setTimeout(function() {
				swal({
					title: "Ops.. Something Wrong!",
					text: "Mohon pilih nama collector",
					type: "error"
				}, function() {
					window.location.replace("index.php?page=tasklist");
				});
			}, 0);
		</script>';
	}else{
		$branch = $_POST['branch'];
		$pic = $_POST['col'];
		$tgl = $_POST['tgl'];
		
		$callDKHC = "{call DASHBOARD_COUNT_DATA_BY_ARO(?,?,?)}"; 
		$options =  array( "Scrollable" => "buffered" );	
		$paramsDKHC = array(array($_POST['branch'], SQLSRV_PARAM_IN),
							array($_POST['col'],SQLSRV_PARAM_IN),
							array(str_replace("-","", $_POST['tgl'])."01",SQLSRV_PARAM_IN));
		$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC,$options) or die( print_r( sqlsrv_errors(), true));
		$dataDKHC = sqlsrv_fetch_array($execDKHC);
		$numrows = sqlsrv_num_rows($execDKHC);

		if($numrows == 0){
			$total_paid = "0";
			$total_promise = "0";
			$total_not_meet = "0";
			$total_amount = "Rp. 0";
			$total_tagihan = "Rp. 0";
			$total_jarak = "0 Km";	
		}
		else if ($dataDKHC['TOTAL_CUST_VISIT_JANJIBYR']== 0){
			$total_paid = $dataDKHC['TOTAL_CUST_VISIT_BYR'];
			$total_promise = $dataDKHC['TOTAL_CUST_VISIT_JANJIBYR'];
			$total_not_meet = $dataDKHC['TOTAL_CUST_VISIT_NOTPAID'];
			$total_amount = "Rp. ".number_format($dataDKHC['TOTAL_BAYAR'],0,',','.');
			$total_tagihan = "Rp. 0";
			$total_jarak = number_format((float)$dataDKHC['TOTAL_DISTANCE_LOC'],2,'.','')." Km";
			
		}
		else{
			$total_paid = $dataDKHC['TOTAL_CUST_VISIT_BYR'];
			$total_promise = $dataDKHC['TOTAL_CUST_VISIT_JANJIBYR'];
			$total_not_meet = $dataDKHC['TOTAL_CUST_VISIT_NOTPAID'];
			$total_amount = "Rp. ".number_format($dataDKHC['TOTAL_BAYAR'],0,',','.');
			$total_tagihan = "Rp. ".number_format($dataDKHC['TOTAL_TAGIHAN'],0,',','.');
			$total_jarak = number_format((float)$dataDKHC['TOTAL_DISTANCE_LOC'],2,'.','')." Km";
		}
	}
	
}else{
	$callDKHC = "{call DASHBOARD_COUNT_DATA_BY_ARO(?,?,?)}"; 
	$paramsDKHC = array(array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN));  
	$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC) or die( print_r( sqlsrv_errors(), true));	
	
	$branch = "";
	$pic = "";
	$tgl = date("Y-m");
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
						<div class="form-group">
							<label>Date </label>
							<div class="input-group mb-3">
								<input type="text" name="tgl" id="tgl" class="form-control" value="<?php echo $tgl;?>" autocomplete="off" readonly style="background-color:#FFF;cursor:pointer;">
								<div class="input-group-append">
									<span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
					<div class="pull-right">
						<input type="reset" value="Cancel" class="btn btn-danger">
						<input type="submit" value="Submit" class="btn btn-primary" name="submit_col">
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Tasklist Summary AR Officer</h6>
			</div>
			<div class="card-body">
				<table class="table" style="border:none;">
					<tr>
						<td style="text-align:left;width:250px;">Jumlah customer yang membayar</td>
						<td style="text-align:left;width:10px;">:</td>
						<td style="text-align:left;font-weight:bold"><label><?php echo $total_paid;?></label><label>&nbsp;&nbsp;(<?php echo $total_amount;?>)</label></td>
					</tr>
					<tr>
						<td style="text-align:left;">Jumlah customer yang janji bayar</td>
						<td style="text-align:left;">:</td>
						<td style="text-align:left;font-weight:bold"><label><?php echo $total_promise;?></label><label>&nbsp;&nbsp;(<?php echo $total_tagihan;?>)</label></td>
					</tr>
					<tr>
						<td style="text-align:left;">Jumlah customer yang tidak dapat ditemui</td>
						<td style="text-align:left;">:</td>
						<td style="text-align:left;font-weight:bold"><label><?php echo $total_not_meet;?></label></td>
					</tr>
					<tr>
						<td style="text-align:left;">Total amount yang diterima</td>
						<td style="text-align:left;">:</td>
						<td style="text-align:left;font-weight:bold"><label><?php echo $total_amount;?></label></td>
					</tr>
					<tr>
						<td style="text-align:left;">Total Jarak ARO</td>
						<td style="text-align:left;">:</td>
						<td style="text-align:left;font-weight:bold"><label><?php echo $total_jarak;?></label></td>
					</tr>
				</table>
				<hr>
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
								<th style="text-align:center;vertical-align:middle;">Rekonsiliasi</th>
								<th style="text-align:center;vertical-align:middle;">Tgl Janji Bayar</th>
								<th style="text-align:center;vertical-align:middle;">Status</th>
								<th style="text-align:center;vertical-align:middle;width:200px;">Action</th>
							</tr>
						</thead>
						<tbody>
					
							<?php
								$no=0;
								$callDKHC = "{call SP_GET_DKH(?,?,?)}"; 
								$options =  array( "Scrollable" => "buffered" );
								$paramsDKHC = array(array($branch, SQLSRV_PARAM_IN),
														 array($pic, SQLSRV_PARAM_IN),
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
								<td style="text-align:center;vertical-align:middle;width:80px;"><?php  if(is_null($dataDKHC['TANGGAL_JATUH_TEMPO'])){echo"";} else if($dataDKHC['TANGGAL_JATUH_TEMPO']->format('Y-m-d')=='1970-01-01'){echo"";}else echo $dataDKHC['TANGGAL_JATUH_TEMPO']->format('Y-m-d');?></td>
								<td style="text-align:right;vertical-align:middle;width:100px;">Rp. <?php echo number_format($dataDKHC['TOTAL_TAGIHAN'],0,',','.');?></td>
								<td style="text-align:right;vertical-align:middle;width:100px;"><?php if($acceptAmount <> "" || $acceptAmount <> NULL){ echo "Rp. ".number_format($acceptAmount,0,',','.');}?></td>
								<td style="text-align:right;vertical-align:middle;width:100px;">Rp. <?php echo number_format($dataDKHC['TOTAL_RECON'],0,',','.');?></td>
								<td style="text-align:center;vertical-align:middle;width:80px;">
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
									<a href="assign.php?action=reaprove&id=<?php echo $dataDKHC['NOMOR_KONTRAK'];?>" class="btn btn-primary btn-sm" onclick="return confirm('Anda yakin ingin re-approve kontrak ini?');"><i class="fa fa-times"></i> Cancel Approve</a>
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
<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('#tgl').datepicker({
		format: "yyyy-mm",
		changeMonth: true,
        changeYear: true,
		autoclose: true,
		viewMode: "months", 
		minViewMode: "months",
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
} );

$('#selectAll').click(function(e){
    var table= $(e.target).closest('table');
    $('td input:checkbox',table).prop('checked',this.checked);
});


</script>
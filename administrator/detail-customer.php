<?php
require_once("../config/connection.php");
$nik=$_GET['id'];

$sql = "{call SP_GET_CUSTOMER_DETAIL(?,?)}";
$param = array(array($bid, SQLSRV_PARAM_IN),
			   array($nik, SQLSRV_PARAM_IN));
$ex = sqlsrv_query( $conn, $sql, $param) or die( print_r( sqlsrv_errors(), true));
$row = sqlsrv_fetch_array($ex);



$callDKHC = "{call SP_GET_CUSTOMER_DETAIL(?,?)}"; 
$options =  array( "Scrollable" => "buffered" );
$paramsDKHC = array(array($bid, SQLSRV_PARAM_IN),array($nik, SQLSRV_PARAM_IN));  
$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC, $options) or die( print_r( sqlsrv_errors(), true));

$numrows=sqlsrv_num_rows($execDKHC);
if($numrows == 0){
	$disable="disabled";
}else{
	$disable="";
}

$callKostumer = "{call SP_GET_HISTORY_CUSTOMER(?)}"; 
$optionsKostumer =  array( "Scrollable" => "buffered" );
$paramsKostumer = array(array($nik, SQLSRV_PARAM_IN));  
$execKostumer = sqlsrv_query( $conn, $callKostumer, $paramsKostumer, $options) or die( print_r( sqlsrv_errors(), true));
$numrowsKostumer=sqlsrv_num_rows($execKostumer);
if($numrowsKostumer == 0){
	$disable="disabled";
}else{
	$disable="";
}

?>
<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<div class="row">
	<div class="col-md-3">
		<div class="card shadow mb-12">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Profile Customer</h6>
			</div>
			<div class="card-body">
				<center>
					<img src="assets/img/default-user.png" style="border-radius:50%;width:100px;height:100px;"><br><br>
					<span style="color:#000;font-weight:bold;"><?php echo $row['NAMA_KOSTUMER'];?></span><br>
					Customer
				</center>
				<hr>
				<b>Contract Id :</b><br>
				<label><?php echo $row['NOMOR_KONTRAK'];?></label><br>
				<b>Customer Name :</b><br>
				<label><?php echo $row['NAMA_KOSTUMER'];?></label><br>
				<b>Branch :</b><br>
				<label><?php echo $data['OFFICE_NAME'];?></label><br>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="card shadow mb-12">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Data Profile</h6>
			</div>
			<div class="card-body">
				<form method="post" action="">
					<div class="form-group">
						<label>Contract Id</label>
						<input type="text" class="form-control" name="kontrak_id" disabled value="<?php echo $row['NOMOR_KONTRAK'];?>">
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" class="form-control" name="address" disabled value="<?php echo $row['ALAMAT_KTP'];?>">
					</div>
					<div class="form-group">
						<label>No. Handphone</label>
						<input type="text" class="form-control" name="no-handphone" disabled value="<?php echo $row['NOMOR_HANDPHONE'];?>">
					</div>
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input type="text" class="form-control" name="nama" disabled value="<?php echo $row['NAMA_KOSTUMER'];?>">
					</div>
				
				</form>
			</div>
		</div>
	</div>
</div><br>
<div class="row">
<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Customer History</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered dataTable" style="width:100%;font-size:12px;" id="example" >
						<thead>
							<tr>
								<th style="text-align:center;vertical-align:middle;">No</th>
								<th style="text-align:center;vertical-align:middle;">Nama Kolektor</th>
								<th style="text-align:center;vertical-align:middle;">Nomor Kontrak</th>
								<th style="text-align:center;vertical-align:middle;">Nama Kostumer</th>
								<th style="text-align:center;vertical-align:middle;">Tanggal Visit</th>
								<th style="text-align:center;vertical-align:middle;">Total Pembayaran</th>
								<th style="text-align:center;vertical-align:middle;">Tgl Janji Bayar</th>
								<th style="text-align:center;vertical-align:middle;">Status</th>
							</tr>
						</thead>
						<tbody>
					
							<?php
								$no=0;
								while($dataKostumer = sqlsrv_fetch_array($execKostumer)){
									$no++;
									$queryResult = "{call SP_GET_RESULT(?,?)}";
									$paramsResult = array(array($bid, SQLSRV_PARAM_IN),array($nik, SQLSRV_PARAM_IN));  
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
								<td style="text-align:center;vertical-align:middle;" ><?php echo $dataKostumer['EMP_NAME'];?></td>
								<td style="text-align:center;vertical-align:middle;"><?php echo $dataKostumer['NOMOR_KONTRAK'];?></td>
								<td style="text-align:center;vertical-align:middle;"><?php echo $dataKostumer['NAMA_KOSTUMER'];?></td>
								<td style="text-align:center;vertical-align:middle;"><?php  if(is_null($dataKostumer['CREATE_DATE'])){echo"";} else if($dataKostumer['CREATE_DATE']->format('Y-m-d')=='1970-01-01'){echo"";}else echo $dataKostumer['CREATE_DATE']->format('Y-m-d');?></td>
								<td style="text-align:right"><?php if($acceptAmount <> "" || $acceptAmount <> NULL){ echo "Rp. ".number_format($acceptAmount,0,',','.');}?></td>
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
										if($dataKostumer['STATUS']=="2"){
											echo'<span class="badge badge-pill badge-success">Janji bayar</span>';
											}else if($dataKostumer['STATUS'] == "1"){
												echo'<span class="badge badge-pill badge-primary">Customer membayar</span>';
											}
											else if($dataKostumer['STATUS'] == "3"){
												echo'<span class="badge badge-pill badge-warning">Customer tidak membayar</span>';
											}else{
												echo'<span class="badge badge-pill badge-danger">Belum dikunjungi</span>';
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
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
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
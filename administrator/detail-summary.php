<?php
$id=$_GET['id'];
$per=$_GET['per'];
if(isset($_POST['submit_col'])){
		$status=$_POST['status'];
		
		$callDKHC = "{call SP_GET_DKH_SUMMARY_STATUS(?,?,?,?)}"; 
		$options =  array( "Scrollable" => "buffered" );
		$paramsDKHC = array(array($bid, SQLSRV_PARAM_IN),
								 array($id, SQLSRV_PARAM_IN),
								 array($per,SQLSRV_PARAM_IN),
								 array($status,SQLSRV_PARAM_IN));  
		$execAro = sqlsrv_query( $conn, $callDKHC, $paramsDKHC, $options) or die( print_r( sqlsrv_errors(), true));
	
}else{
	$callDKHC = "{call  SP_GET_DKH_SUMMARY_STATUS(?,?,?,?)}"; 
	$paramsDKHC = array(array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN));  
	$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC) or die( print_r( sqlsrv_errors(), true));	
	
	
}

// Turn off all error reporting
error_reporting(0);
			


?>
<div class="row">
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">TaskList Detail AR Officer</h6>
			</div>
			<div class="card-body">
			 <div class="col-md-3">
				<form action="" method="post">
							<div class="form-group">
									<label>Status</label>
									<select  id="status" name="status" width="100px">
									<option value="" disabled>--Pilih Status--</option>
										<option value="1"  >Bayar</option>
										<option value="2" >Janji Bayar</option>
										<option value="3" >Tidak Bertemu</option>
										<option value="ALL" >ALL</option>
									</select>
									<button type="submit" class="btn btn-primary" name="submit_col" onclick="showDiv()">
										 <i class="fa fa-search"></i> 
									
									</div>
				</div>
			
			
					<div class="table-responsive" id="show" >
					<table class="table table-bordered dataTable" style="width:100%;font-size:12px;" id="example1" >
						<thead>
							<tr>
								<th style="text-align:center;vertical-align:middle;">No</th>
								<th style="text-align:center;vertical-align:middle;">No Kontrak</th>
								<th style="text-align:center;vertical-align:middle;">Nama Kostumer</th>
								<th style="text-align:center;vertical-align:middle;width:80px">Tgl Jatuh Tempo</th>
								<th style="text-align:center;vertical-align:middle;width:100px;">Total Tagihan</th>
								<th style="text-align:center;vertical-align:middle;width:100px">Total Pembayaran</th>
								<th style="text-align:center;vertical-align:middle;width:100px">Rekonsiliasi</th>
								<th style="text-align:center;vertical-align:middle;width:80px">Tgl Janji Bayar</th>
								<th style="text-align:center;vertical-align:middle;">Status</th>
								<th style="text-align:center;vertical-align:middle;width:300px;">Action</th>
							</tr>
						</thead>
						<tbody>
					
							<?php
								$no=0;
									$callDKHC = "{call SP_GET_DKH_SUMMARY_STATUS(?,?,?,?)}"; 
									$options =  array( "Scrollable" => "buffered" );
									$paramsDKHC = array(array($bid, SQLSRV_PARAM_IN),
															 array($id, SQLSRV_PARAM_IN),
															 array($per,SQLSRV_PARAM_IN),
															 array($status,SQLSRV_PARAM_IN));  
								 $execAro = sqlsrv_query( $conn, $callDKHC, $paramsDKHC, $options) or die( print_r( sqlsrv_errors(), true));
								while($dataDKHC = sqlsrv_fetch_array($execAro)){
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
								<td style="text-align:right;vertical-align:middle;">Rp. <?php echo number_format($dataDKHC['TOTAL_RECON'],0,',','.');?></td>
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
		$('#example1').DataTable({
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"order": [[ 0, "asc" ]],
		"columnDefs": [ {
		"targets": [0,1],
			"orderable": true
		} ]
	});	
	
	document.getElementById('status').value = "<?php echo $_POST['status'];?>";

} );




</script>
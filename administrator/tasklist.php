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
		
		$callDKHC = "{call SP_GET_DKH(?,?)}"; 
		$paramsDKHC = array(array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN));  
		$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC) or die( print_r( sqlsrv_errors(), true));
		$disable="disabled";
	}else{
		$branch = $_POST['branch'];
		$pic = $_POST['col'];
		
		$callDKHC = "{call SP_GET_DKH(?,?)}"; 
		$options =  array( "Scrollable" => "buffered" );
		$paramsDKHC = array(array($_POST['branch'], SQLSRV_PARAM_IN),array($_POST['col'], SQLSRV_PARAM_IN));  
		$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC, $options) or die( print_r( sqlsrv_errors(), true));
		
		$numrows=sqlsrv_num_rows($execDKHC);
		if($numrows == 0){
			$disable="disabled";
		}else{
			$disable="";
		}
	}
}else{
	$callDKHC = "{call SP_GET_DKH(?,?)}"; 
	$paramsDKHC = array(array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN));  
	$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC) or die( print_r( sqlsrv_errors(), true));	
	
	$branch = "";
	$pic = "";
	$disable="disabled";
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
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Select AR Officer</h6>
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
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
								</div>
								<div class="col-md-4">
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
								</div>
								<div class="col-md-4">
									<input type="submit" value="Submit" class="btn btn-primary" name="submit_col" style="margin-top:30px;">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">TaskList AR OFficer</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered dataTable" style="width:100%;" id="example" >
						<thead>
							<tr>
								<th>No</th>
								<th>No Kontrak</th>
								<th>Nama Kostumer</th>
								<th>Tgl Jatuh Tempo</th>
								<th>Total Tagihan</th>
								<th>Total Pembayaran</th>
								<th>Tgl Janji Bayar</th>
								<th>Status</th>
								<th>Action
								</th>
							</tr>
						</thead>
						<tbody>
					
							<?php
								$no=0;
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
								<td><?php echo $no;?></td>
								<td><?php echo $dataDKHC['NOMOR_KONTRAK'];?></td>
								<td style="text-align:left;"><?php echo $dataDKHC['NAMA_KOSTUMER'];?></td>
								<td><?php  if(is_null($dataDKHC['TANGGAL_JATUH_TEMPO'])){echo"";} else if($dataDKHC['TANGGAL_JATUH_TEMPO']->format('Y-m-d')=='1970-01-01'){echo"";}else echo $dataDKHC['TANGGAL_JATUH_TEMPO']->format('Y-m-d');?></td>
								<td style="text-align:right">Rp. <?php echo number_format($dataDKHC['TOTAL_TAGIHAN'],0,',','.');?></td>
								<td style="text-align:right"><?php if($acceptAmount <> "" || $acceptAmount <> NULL){ echo "Rp. ".number_format($acceptAmount,0,',','.');}?></td>
								<td>
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
								<td>
									<?php
										if($meetup == "Ya, bertemu dengan customer"){
											if($promiseDate <> NULL || $promiseDate <> "" || date("Y-m-d", strtotime($promiseDate)) <> "1970-01-01"){
												echo'<span class="badge badge-pill badge-success">Janji bayar</span>';
											}else if($customerPay == "Ya"){
												echo'<span class="badge badge-pill badge-primary">Customer membayar</span>';
											}else{
												echo"aaa";
											}
										}else if($meetup == "Tidak, bertemu dengan orang lain"){
											if($promiseDate <> NULL || $promiseDate <> "" || date("Y-m-d", strtotime($promiseDate)) <> "1970-01-01"){
												echo'<span class="badge badge-pill badge-success">Janji bayar</span>';
											}else if($customerPay == "Ya"){
												echo'<span class="badge badge-pill badge-primary">Customer membayar</span>';
											}else{
												echo"aaa";
											}
										}else{
											echo'<span class="badge badge-pill badge-danger">Belum dikunjungi</span>';
										}
									?>
								</td>
								  <td style="vertical-align:middle;text-align:center">
								  <a href="index.php?page=approve&id=<?php echo $dataDKHC['NOMOR_KONTRAK'];?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>Cancel Approve</a>
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
} );

$('#selectAll').click(function(e){
    var table= $(e.target).closest('table');
    $('td input:checkbox',table).prop('checked',this.checked);
});
</script>
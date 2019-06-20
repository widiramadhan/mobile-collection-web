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
					window.location.replace("index.php?page=collector-assignment-4w");
				});
			}, 0);
		</script>';
		$branch = $_POST['branch'];
		$pic = $_POST['col'];
		$no_kontrak = $_POST['no_kontrak'];
		$priority_id = $_POST['priority_id'];
		$tgl = date("Y-m-d");
		
		$callDKHC = "{call SP_GET_DKHC_BY_COLLECTOR_PRIROTIY(?,?,?,?)}"; 
		$paramsDKHC = array(array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN));  
		$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC) or die( print_r( sqlsrv_errors(), true));
		$disable="disabled";
	}else{
		$branch = $_POST['branch'];
		$pic = $_POST['col'];
		$tgl = date("Y-m-d");
		
		$callDKHC = "{call SP_GET_DKHC_BY_COLLECTOR_PRIROTIY(?,?,?,?)}"; 
		$options =  array( "Scrollable" => "buffered" );
		$paramsDKHC = array(array($_POST['branch'], SQLSRV_PARAM_IN),array($_POST['col'], SQLSRV_PARAM_IN),array($_POST['no_kontrak'], SQLSRV_PARAM_IN),array($_POST['priority_id'] , SQLSRV_PARAM_IN));  
		$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC, $options) or die( print_r( sqlsrv_errors(), true));
		
		$numrows=sqlsrv_num_rows($execDKHC);
		if($numrows == 0){
			$disable="disabled";
		}else{
			$disable="";
		}
	}
}else{
	$callDKHC = "{call SP_GET_DKHC_BY_COLLECTOR_PRIROTIY(?,?,?,?)}"; 
	$paramsDKHC = array(array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN));  
	$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC) or die( print_r( sqlsrv_errors(), true));	
	
	$branch = "";
	$pic = "";
	$no_kontrak = '';
	$priority_id = '';
	$disable="disabled";
	$tgl = date("Y-m-d");
}

if(isset($_POST['priority_id'])){
	if($_POST['priority_id']=="1"){
		$selected1 = "selected";
		$selected2 = "";
		$selected3 = "";
		$selected4 = "";
		$selected5 = "";
		$selected6 = "";
		$selectedALL = "";
	}else if($_POST['priority_id']=="2"){
		$selected1 = "";
		$selected2 = "selected";
		$selected3 = "";
		$selected4 = "";
		$selected5 = "";
		$selected6 = "";
		$selectedALL = "";
	}else if($_POST['priority_id']=="3"){
		$selected1 = "";
		$selected2 = "";
		$selected3 = "selected";
		$selected4 = "";
		$selected5 = "";
		$selected6 = "";
		$selectedALL = "";
	}
	else if($_POST['priority_id']=="4"){
		$selected1 = "";
		$selected2 = "";
		$selected3 = "";
		$selected4 = "selected";
		$selected5 = "";
		$selected6 = "";
		$selectedALL = "";
	}
	else if($_POST['priority_id']=="5"){
		$selected1 = "";
		$selected2 = "";
		$selected3 = "";
		$selected4 = "";
		$selected5 = "selected";
		$selected6 = "";
		$selectedALL = "";
	}
	else if($_POST['priority_id']=="6"){
		$selected1 = "";
		$selected2 = "";
		$selected3 = "";
		$selected4 = "";
		$selected5 = "";
		$selected6 = "selected";
		$selectedALL = "";
	}else{
		$selected1 = "";
		$selected2 = "";
		$selected3 = "";
		$selected4 = "";
		$selected5 = "";
		$selected6 = "";
		$selectedALL = "selected";
	}
}else{
		$selected1 = "";
		$selected2 = "";
		$selected3 = "";
		$selected4 = "";
		$selected5 = "";
		$selected6 = "";
		$selectedALL = "selected";
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
							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-3">
											<label>Branch</label>
										</div>
										<div class="col-md-6">
											<select class="form-control" id="branch" name="branch">
											<?php
											/*if($data['LEVEL'] == 'SUPER ADMIN'){

											}else{*/
												echo '<option value="'.$data['BRANCHID'].'" selected>'.$data['OFFICE_NAME'].'</option>';
											//}
											?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-2">
									<label>Priority ID</label>
									</div>
									<div class="col-md-6">
									<select class="form-control" id="priority_id" name="priority_id">
										<option value="" <?php echo $selectedALL;?>>All</option>
										<option value="1" <?php echo $selected1;?>>1</option>
										<option value="2" <?php echo $selected2;?>>2</option>
										<option value="3" <?php echo $selected3;?>>3</option>
										<option value="4" <?php echo $selected4;?>>4</option>
										<option value="5" <?php echo $selected5;?>>5</option>
										<option value="6" <?php echo $selected6;?>>6</option>
									</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-3">
									<label>Collector Name</label>
									</div>
									<div class="col-md-6">
									<select class="form-control" id="col" name="col">
										<option value="" selected>Pilih Collector</option>
										<?php
									/*if($data['LEVEL'] == 'SUPER ADMIN'){

									}else{*/
										/*echo '<script>alert("'.$data['BRANCHID'].'")</script>';*/
										$callCol = "{call SP_LOV_ARO_BY_BRANCH(?)}"; 
										//$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
										$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
										$execCol = sqlsrv_query( $conn, $callCol, $paramsCol) or die( print_r( sqlsrv_errors(), true));	
										$numrowsResult=sqlsrv_num_rows($execCol);									
										while($dataCol = sqlsrv_fetch_array($execCol)){
										?>
											<option value="<?php echo $dataCol['EMP_NO'];?>" <?php if($dataCol[ 'EMP_NO']==$pic){ echo "selected"; }?>>
												<?php echo $dataCol['EMP_NO'].' - '.strtoupper($dataCol['EMP_NAME']);?>
											</option>
											<?php

										}
									//}
								?>
									</select>
									</div>
								</div>
							</div>
						</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-2">
											<label>Contract ID</label>
										</div>
										<div class="col-md-6">
									<input type="text" class="form-control" id="no_kontrak" name="no_kontrak" value="">
								</div>
								</div>
							</div>
						</div>
					</div>
					<div class="pull-right">
						<input type="reset" value="Cancel" class="btn btn-danger">
						<input type="submit" value="Search" class="btn btn-primary" name="submit_col">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">List DKH Approval</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<form action="assign.php?action=save" method="post" enctype="multipart/form-data" id="form">
						<table class="table table-bordered dataTable" style="width:100%;" id="example" >
							<thead>
								<tr>
									<th style="vertical-align:middle;text-align:center;padding-left:30px;width:10px" ><input type="checkbox" id="selectAll"></th>
									<th>No Kontrak</th>
									<th>Nama Kostumer</th>
									<th>Alamat</th>
									<th>Kota</th>
									<th>Kelurahan</th>
									<th>Kecamatan</th>
									<th>Zipcode</th>
									<th style="text-align:center;vertical-align:middle;width:100px" >Tgl Jatuh Tempo</th>
									<th>Overdue Days</th>
									<th>Total Tagihan</th>
									<th>Tgl Janji Bayar</th>
									<th>Priority</th>
									<!--<th>Periode</th>-->
								</tr>
							</thead>
							<tbody>
								<?php
									$no=0;
									while($dataDKHC = sqlsrv_fetch_array($execDKHC)){
										$no++;
								?>
								<tr>
									 <td style="vertical-align:middle;text-align:center;"><input type="checkbox" class="aroClass" name="aro[]" id="aro[]" value="<?php echo $dataDKHC['AGING_COLLECTED_ID'];?>">
									<td><?php echo $dataDKHC['NOMOR_KONTRAK'];?></td>
									<td style="text-align:left;"><?php echo $dataDKHC['NAMA_KOSTUMER'];?></td>
									<td style="text-align:left;"><?php echo $dataDKHC['ALAMAT_KTP'];?></td>
									<td style="text-align:left;"><?php echo $dataDKHC['KOTA'];?></td>
									<td style="text-align:left;"><?php echo $dataDKHC['KELURAHAN'];?></td>
									<td style="text-align:left;"><?php echo $dataDKHC['KECAMATAN'];?></td>
									<td style="text-align:left;"><?php echo $dataDKHC['ZIPCODE'];?></td>
									<td><?php echo $dataDKHC['TANGGAL_JATUH_TEMPO']->format('Y-m-d');?></td>
									<td><?php echo $dataDKHC['OVERDUE_DAYS'];?></td>
									<td>Rp. <?php echo number_format($dataDKHC['TOTAL_TAGIHAN'],0,',','.');?></td>
									<td><?php if($dataDKHC['TANGGAL_JANJI_BAYAR']->format('Y-m-d')=='1900-01-01'){echo"";}else if($dataDKHC['TANGGAL_JANJI_BAYAR']==NULL){echo"";}else{echo $dataDKHC['TANGGAL_JANJI_BAYAR']->format('Y-m-d');}?></td>
									<!--<td><?php /* echo $dataDKHC['PERIOD'];*/?></td>-->
									<td style="text-align:left;"><?php echo $dataDKHC['PRIORITY_ID'];?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<br>
						<input type="hidden" id="branch" name="branch" value="<?php echo $branch; ?>" >
						<input type="hidden" id="pic" name="pic" value="<?php echo $pic; ?>">
						<input type="hidden" id="bm" name="bm" value="<?php echo $sid; ?>">
						<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-3">
											<label>Tasklist Date</label>
										</div>
										<div class="col-md-6">
												<div class="input-group mb-3">
													<input type="text" name="tgl" id="tgl" class="form-control" value="<?php echo $tgl;?>" autocomplete="off" readonly style="background-color:#FFF;cursor:pointer;">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar"></i></span>
													</div>
												</div>
										</div> 
										<button type="submit" class="btn btn-primary" style='height:40px;'  <?php echo $disable;?>>APPROVE</button>
									</div>
								</div>
							</div>
							
							
						
						</div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script>
/*$(document).ready(function() {
	$('#example').DataTable({
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"order": [[ 0, "asc" ]],
		"columnDefs": [ {
		"targets": [0,1],
			"orderable": true
		} ]
	});
} );*/
$(document).ready(function() {
	$(function(){
			var checkboxes = $(':checkbox:not(#aro)').click(function(event){
			$('#submitaro').prop("disabled", checkboxes.filter(':checked').length == 0);
		});

		var counterChecked = 0;

		$('body').on('change', 'input[type="checkbox"]', function() {
			this.checked ? counterChecked++ : counterChecked--;
			counterChecked > 0 ? $('#submitaro').prop("disabled", false): $('#submitaro').prop("disabled", true);
		});

		$('#aro').click(function(event) {   
			checkboxes.prop('checked', this.checked);
			$('#submitaro').prop("disabled", !this.checked)
		});
	});
	
	oTableStaticFlow = $('#example').DataTable({
		"lengthMenu": [[-1], ["All"]],
		"aoColumnDefs": [{
			'bSortable': false,
			'aTargets': [0]
		}],
	});
	$('#tgl').datepicker({
		format: "yyyy-mm-dd",
		changeMonth: true,
        changeYear: true,
		autoclose: true,
		viewMode: "days", 
		minViewMode: "days",
		endDate: new Date()
	});
	

	$("#selectAll").click(function () {
		var cells = oTableStaticFlow.column(0).nodes(), // Cells from 1st column
			state = this.checked;

		for (var i = 0; i < cells.length; i += 1) {
			cells[i].querySelector("input[type='checkbox']").checked = state;
		}
	});
} );
</script>	
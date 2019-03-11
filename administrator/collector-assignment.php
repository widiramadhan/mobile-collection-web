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
		
		$callDKHC = "{call SP_GET_DKHC_BY_COLLECTOR(?,?)}"; 
		$paramsDKHC = array(array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN));  
		$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC) or die( print_r( sqlsrv_errors(), true));
		$disable="disabled";
	}else{
		$branch = $_POST['branch'];
		$pic = $_POST['col'];
		
		$callDKHC = "{call SP_GET_DKHC_BY_COLLECTOR(?,?)}"; 
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
	$callDKHC = "{call SP_GET_DKHC_BY_COLLECTOR(?,?)}"; 
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
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">List DKH Approval</h6>
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
								<th>Overdue Days</th>
								<th>Total Tagihan</th>
								<th>Tgl Janji Bayar</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=0;
								while($dataDKHC = sqlsrv_fetch_array($execDKHC)){
									$no++;
							?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $dataDKHC['NOMOR_KONTRAK'];?></td>
								<td style="text-align:left;"><?php echo $dataDKHC['NAMA_KOSTUMER'];?></td>
								<td><?php echo $dataDKHC['TANGGAL_JATUH_TEMPO']->format('Y-m-d');?></td>
								<td><?php echo $dataDKHC['OVERDUE_DAYS'];?></td>
								<td>Rp. <?php echo number_format($dataDKHC['TOTAL_TAGIHAN'],0,',','.');?></td>
								<td><?php if($dataDKHC['TANGGAL_JANJI_BAYAR']->format('Y-m-d')=='1900-01-01'){echo"";}else if($dataDKHC['TANGGAL_JANJI_BAYAR']==NULL){echo"";}else{echo $dataDKHC['TANGGAL_JANJI_BAYAR']->format('Y-m-d');}?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<br>
					<form action="assign.php?action=save" method="post" enctype="multipart/form-data" id="form">
						<input type="hidden" id="branch" name="branch" value="<?php echo $branch; ?>" >
						<input type="hidden" id="pic" name="pic" value="<?php echo $pic; ?>">
						<input type="hidden" id="bm" name="bm" value="<?php echo $sid; ?>">
						<button type="submit" class="btn btn-primary" style="width:100%;" <?php echo $disable;?>>ASSIGN</button>
					</form>
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
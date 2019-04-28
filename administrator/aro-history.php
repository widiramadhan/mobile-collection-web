<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
$branchHistory = $_GET['id'];
$picHistory = $_GET['pic'];
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
		$branch = $_POST['branch'];
		$pic = $_POST['col'];
		
		$callDKHC = "{call DASHBOARD_COUNT_DATA_BY_ARO(?,?,?)}"; 
		$paramsDKHC = array(array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN));  
		$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC) or die( print_r( sqlsrv_errors(), true));
		$disable="disabled";
	}else{
		$branch = $_POST['branch'];
		$pic = $_POST['col'];
		
		$callDKHC = "{call DASHBOARD_COUNT_DATA_BY_ARO(?,?,?)}"; 
		$options =  array( "Scrollable" => "buffered" );	
		$paramsDKHC = array(array($branchHistory, SQLSRV_PARAM_IN),
							array($picHistory,SQLSRV_PARAM_IN),
							array($data1['PERIOD'],SQLSRV_PARAM_IN));
								
		$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC,$options) or die( print_r( sqlsrv_errors(), true));
			
		$numrows=sqlsrv_num_rows($execDKHC);
		if($numrows == 0){
			$disable="disabled";
		}else{
			$disable="";
		}
	}
	
}else{
	$callDKHC = "{call DASHBOARD_COUNT_DATA_BY_ARO(?,?,?)}"; 
	$paramsDKHC = array(array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN));  
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
								<div class="col-md-3">
									<div class="form-group">
										<label>Branch</label>
										<?php
											
													$callCol = "{call SP_LOV_ARO_BY_BRANCH(?)}"; 
													$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
													$execCol = sqlsrv_query( $conn, $callCol, $paramsCol) or die( print_r( sqlsrv_errors(), true));								
													$dataCol = sqlsrv_fetch_array($execCol);
										?>
										<input type="text" id="branch1" name="branch1" disabled style="width:100%;" value="<?php echo $data['OFFICE_NAME'];?>"  >
										<input type="hidden" id="branch" name="branch"  style="width:100%;" value="<?php echo $branchHistory;?>"  >
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Collector Name</label><br>
										<?php
											
													$callCol = "{call SP_LOV_ARO_BY_BRANCH(?)}"; 
													$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
													$execCol = sqlsrv_query( $conn, $callCol, $paramsCol) or die( print_r( sqlsrv_errors(), true));								
													$dataCol = sqlsrv_fetch_array($execCol);
										?>
										<input type="text" id="col1" name="col1" disabled style="width:100%;" value="<?php echo $picHistory;?>"  >
										<input type="hidden" id="col" name="col"  style="width:100%;" value="<?php echo $picHistory;?>"  >
									</div>
								</div>
							 <div class="col-md-3">
									<div class="form-group">
										<label>Collector Name</label>
										<select class="form-control" id="period" name="period">
											<option value="" selected>Period</option>
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
								
								<div class="col-md-3">
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
								<th>Collector Name</th>
								<th>Total DKH</th>
								<th>Total Visit</th>
								<th>Bayar</th>
								<th>Janji Bayar</th>
								<th>Tidak Bayar</th>
								<th>Jarak</th>
								<th>Period</th>
								<th>Date</th>
								<th>Action
								</th>
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
								
								<td style="text-align:left;"><?php echo $dataDKHC['EMP_NAME'];?></td>
								<td style="text-align:right"><?php if($acceptAmount <> "" || $acceptAmount <> NULL){ echo "Rp. ".number_format($acceptAmount,0,',','.');}?></td>
								
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
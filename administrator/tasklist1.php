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
		$paramsDKHC = array(array($_POST['branch'], SQLSRV_PARAM_IN),
							array($_POST['col'],SQLSRV_PARAM_IN),
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
						<input type="submit" value="Submit" class="btn btn-primary" name="submit_col">
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Tasklist Summary</h6>
			</div>
			<div class="card-body">
				<form action="index.php?page=detail-tasklist&id=<?php echo $branch;?>&pic=<?php echo $pic;?>" method="post">
				
				<input type="hidden" value="<?php echo $branch;?>" name="branch1" id="branch1">
				<input type="hidden" value="<?php echo $pic;?>" name="col1" id="col1">
				<?php while($dataDKHC = sqlsrv_fetch_array($execDKHC)){?>
				<b>Customer Bayar : <label><?php echo $dataDKHC['TOTAL_CUST_VISIT_BYR'];?></label></b><br>
				<b>Janji Bayar 	  : <label><?php echo $dataDKHC['TOTAL_CUST_VISIT_JANJIBYR'];?></label></b><br>
				<b>Tidak Bertemu  : <label><?php echo $dataDKHC['TOTAL_CUST_VISIT_NOTPAID'];?></label></b><br>
				<b>Total Jarak    : <label><?php echo $dataDKHC['TOTAL_DISTANCE_LOC'];?></label></b><br>
				
				<?php } ?>
				<button type="submit" class="btn btn-primary" <?php echo $disable;?> style="width:100%;">DETAIL</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Summary TaskList AR OFficer</h6>
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
								<th>Not Paid</th>
								<th>Jarak</th>
								<th>Period</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
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
<?php 
$tgl = date("Y-m");
if(isset($_POST['submit_col'])){
		$tgl = $_POST['tgl'];
		
		$queryAro = "{call SP_GET_TOTAL_TASKLIST_ARO_SUMMARY(?,?)}"; 
		$options =  array( "Scrollable" => "buffered" );	
		$paramsAro = array(array($bid, SQLSRV_PARAM_IN),
							array(str_replace("-","", $_POST['tgl'])."01",SQLSRV_PARAM_IN));
		$execAro = sqlsrv_query( $conn, $queryAro, $paramsAro,$options) or die( print_r( sqlsrv_errors(), true));
	
}else{
	$queryAro = "{call SP_GET_TOTAL_TASKLIST_ARO_SUMMARY(?,?)}"; 
	$paramsAro = array(array('', SQLSRV_PARAM_IN),array('', SQLSRV_PARAM_IN));  
	$execAro = sqlsrv_query( $conn, $queryAro, $paramsAro) or die( print_r( sqlsrv_errors(), true));	
	
	$tgl = date("Y-m");
}
					



	$queryAro = "{call SP_GET_TOTAL_TASKLIST_ARO_SUMMARY(?,?)}";
	$paramsAro = array(array($bid, SQLSRV_PARAM_IN),
				 array(str_replace("-","", $tgl)."01",SQLSRV_PARAM_IN)); 
	$execAro = sqlsrv_query( $conn, $queryAro, $paramsAro) or die( print_r( sqlsrv_errors(), true));
	
?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">List AR Officer in Branch</h6>
	</div>
	<div class="card-body">
			<div class="col-md-3">
				<form action="" method="post">
							<div class="form-group">
									<label>Period </label>
									<div class="input-group mb-3">
										<input type="text" name="tgl" id="tgl" class="form-control" value="<?php echo $tgl;?>" autocomplete="off" readonly style="background-color:#FFF;cursor:pointer;">
										<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar"></i></span>&nbsp;
										<button type="submit" class="btn btn-primary" name="submit_col">
										 <i class="fa fa-search"></i> Search
									</div>
							</div>
				</div>
			</div>
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTables" width="100%" cellspacing="0" style="font-size:12px;">
				<thead>
					<tr>
						<th style="text-align:center;vertical-align:middle;">No</th>
						<th style="text-align:center;vertical-align:middle;">Collector Name</th>
						<th style="text-align:center;vertical-align:middle;">Total Account</th>
						<th style="text-align:center;vertical-align:middle;">Total yang sudah dikunjungi</th>
						<th style="text-align:center;vertical-align:middle;">Target</th>
						<th style="text-align:center;vertical-align:middle;">Total amount yang didapat</th>
						<th style="text-align:center;vertical-align:middle;">Period</th>
						<th style="vertical-align:middle;text-align:center;">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
							$no=0;
							while($dataAro = sqlsrv_fetch_array($execAro)){
							$no++;
						?>
                    <tr>
					    <td style="text-align:center;vertical-align:middle;"><?php echo $no;?></td>
						<td style="text-align:left;vertical-align:middle;"><?php echo $dataAro['EMP_NAME'];?></td>
						<td style="text-align:center;vertical-align:middle;"><?php echo $dataAro['TOTAL'];?></td>
						<td style="text-align:center;vertical-align:middle;"><?php echo $dataAro['TOTAL_VISIT'];?></td>
						<td style="text-align:right;vertical-align:middle;">Rp. <?php echo number_format($dataAro['TOTAL_TAGIHAN'],0,',','.');?></td>
						<td style="text-align:right;vertical-align:middle;">Rp. <?php echo number_format($dataAro['TOTAL_BAYAR'],0,',','.');?></td>
						<td style="text-align:center;vertical-align:middle;"><?php echo $dataAro['PERIOD'];?></td>
					   <td style="vertical-align:middle;text-align:center;">
						<a href="index.php?page=detail-summary&id=<?php echo $dataAro['EmployeeID'];?>&per=<?php echo $dataAro['PERIOD'];?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Detail</a>
					  </td>
                    </tr>
					<?php }?>										
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('#dataTables').DataTable();
	$('#tgl').datepicker({
		format: "yyyy-mm",
		changeMonth: true,
        changeYear: true,
		autoclose: true,
		viewMode: "months", 
		minViewMode: "months",
		endDate: new Date()
	});
} );
</script>
 
	

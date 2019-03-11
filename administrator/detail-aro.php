<?php
require_once("../config/connection.php");
$nik=$_GET['id'];

$sql = "{call SP_GET_DETAIL_ARO(?,?)}";
$param = array(array($bid, SQLSRV_PARAM_IN),
			   array($nik, SQLSRV_PARAM_IN));
$ex = sqlsrv_query( $conn, $sql, $param) or die( print_r( sqlsrv_errors(), true));
$row = sqlsrv_fetch_array($ex);



$callDKHC = "{call SP_GET_DKH(?,?)}"; 
$options =  array( "Scrollable" => "buffered" );
$paramsDKHC = array(array($bid, SQLSRV_PARAM_IN),array($nik, SQLSRV_PARAM_IN));  
$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC, $options) or die( print_r( sqlsrv_errors(), true));

$numrows=sqlsrv_num_rows($execDKHC);
if($numrows == 0){
	$disable="disabled";
}else{
	$disable="";
}
?>

<?php

		$callDKHC = "{call SP_GET_DKH(?,?)}"; 
		$options =  array( "Scrollable" => "buffered" );
		$paramsDKHC = array(array($bid, SQLSRV_PARAM_IN),array($nik, SQLSRV_PARAM_IN));  
		$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC, $options) or die( print_r( sqlsrv_errors(), true));
		
		$numrows=sqlsrv_num_rows($execDKHC);
	

		$sql1 = "{call SP_TOTAL_COLLECT(?,?)}";
		$param1 = array(array($bid, SQLSRV_PARAM_IN),
					    array($nik, SQLSRV_PARAM_IN));
		$ex1 = sqlsrv_query( $conn, $sql1, $param1) or die( print_r( sqlsrv_errors(), true));
		$row1 = sqlsrv_fetch_array($ex1);
						
						
						
						
						
						

?>
<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<div class="row">

	<div class="col-md-12">
		<div class="card shadow mb-12">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Profile AR Officer</h6>
			</div>
			<div class="card-body">
			
			<form action="" method="post">
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<input type="hidden" name="nik" id="nik" value="<?php echo $row['EMP_NO'];?>">
			<input type="hidden" name="branch" id="branch" value="<?php echo $data['BRANCHID'];?>">
			<input type="hidden" name="col" id="col" value="<?php echo $row['EMP_NO'];?>">
						<label>NIK</label>
						<label>:</label>
						<label><?php echo $row['EMP_NO'];?></label>	
						<br />
						<label>Nama</label>
						<label>:</label>
						<label><?php echo $row['EMP_NAME'];?></label>	
						<br />
						<label>Username</label>
						<label>:</label>
						<label><?php echo $row['USERNAME'];?></label>	
						<br />
						<label>Branch</label>
						<label>:</label>
						<label><?php echo $data['OFFICE_NAME'];?></label>	
						<br />
							
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>BM</label>
						<label>:</label>
						<label><?php echo $data['FULLNAME'];?></label>	
						<br />
						<label>Last Login</label>
						<label>:</label>
						<label><?php if($data['LAST_LOGIN']<>NULL){echo $data['LAST_LOGIN']->format('Y-m-d');}else{echo"-";}?></label>	
						<br />
						<label>Total Collect</label>
						<label>:</label>
						<label><?php echo $row1['IS_COLLECT'];?></label>
						<br />
						<label>Jarak Tempuh</label>
						<label>:</label>
						<label>100km</label>
						<br />
						
					</div>	
				</div>
				</div>
					
					
			</form>
			</div>
		</div>
	</div>
	
	<div class="col-md-12" > <br>
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">List Kostumer</h6>
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
								<td><?php  if(is_null($dataDKHC['TANGGAL_JATUH_TEMPO'])){echo"";} else if($dataDKHC['TANGGAL_JATUH_TEMPO']->format('Y-m-d')=='1900-01-01'){echo"";}else echo $dataDKHC['TANGGAL_JATUH_TEMPO']->format('Y-m-d');?></td>
								<td><?php if($dataDKHC['OVERDUE_DAYS']=== NULL){echo"";} else echo $dataDKHC['OVERDUE_DAYS'];?></td>
								<td>Rp. <?php echo number_format($dataDKHC['TOTAL_TAGIHAN'],0,',','.');?></td>
								<td><?php if($dataDKHC['TANGGAL_JANJI_BAYAR']->format('Y-m-d')=='1900-01-01'){echo"";}else if($dataDKHC['TANGGAL_JANJI_BAYAR']==NULL){echo"";}else{echo $dataDKHC['TANGGAL_JANJI_BAYAR']->format('Y-m-d');}?></td>
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
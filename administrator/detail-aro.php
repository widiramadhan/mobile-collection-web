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
	<div class="col-md-3">
		<div class="card shadow mb-12">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Profile AR Officer</h6>
			</div>
			<div class="card-body">
				<center>
					<img src="assets/img/default-user.png" style="border-radius:50%;width:100px;height:100px;"><br><br>
					<span style="color:#000;font-weight:bold;"><?php echo $row['EMP_NAME'];?></span><br>
					AR Officer
				</center>
				<hr>
				<b>NIK :</b><br>
				<label><?php echo $row['EMP_NO'];?></label><br>
				<b>Username :</b><br>
				<label><?php echo $row['USERNAME'];?></label><br>
				<b>Branch :</b><br>
				<label><?php echo $data['OFFICE_NAME'];?></label><br>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="card shadow mb-12">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Ubah data profile</h6>
			</div>
			<div class="card-body">
				<form method="post" action="update-aro.php?action=update">
					<div class="form-group">
						<label>NIK</label>
						<input type="text" class="form-control" name="nik" disabled value="<?php echo $row['EMP_NO'];?>">
						<input type="hidden" class="form-control" name="emp_no"  value="<?php echo $row['EMP_NO'];?>">
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username" disabled value="<?php echo $row['USERNAME'];?>">
					</div>
					<div class="form-group">
						<label>Branch</label>
						<input type="text" class="form-control" name="branch" disabled value="<?php echo $data['OFFICE_NAME'];?>">
					</div>
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input type="text" class="form-control" name="nama" value="<?php echo $row['EMP_NAME'];?>">
					</div>
					<input type="submit" name="submit" value="Update" class="btn btn-primary" style="width:100%;">
				</form>
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
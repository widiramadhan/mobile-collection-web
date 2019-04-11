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
				<h6 class="m-0 font-weight-bold text-primary">Ubah Data Profile</h6>
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
						<input type="text" class="form-control" name="nama" value="<?php echo $row['NAMA_KOSTUMER'];?>">
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
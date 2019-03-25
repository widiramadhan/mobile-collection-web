<?php
require_once("../config/connection.php");
$call = "{call SP_GET_PROFILE_USER(?,?)}";
$params = array(
					array($sid, SQLSRV_PARAM_IN),
					array($bid, SQLSRV_PARAM_IN));
$exec = sqlsrv_query( $conn, $call, $params) or die( print_r( sqlsrv_errors(), true)); 
$dataProfile = sqlsrv_fetch_array($exec);
?>
<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<div class="row">
	<div class="col-md-3">
		<div class="card shadow mb-12">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Profile Head Officer</h6>
			</div>
			<div class="card-body">
				<center>
					<img src="assets/img/default-user.png" style="border-radius:50%;width:100px;height:100px;"><br><br>
					<span style="color:#000;font-weight:bold;"><?php echo $dataProfile['EMP_NAME'];?></span><br>
					Head Officer
				</center>
				<hr>
				<b>Employer No :</b><br>
				<label><?php echo $dataProfile['EMP_NO'];?></label><br>
				<b>Username :</b><br>
				<label><?php echo $dataProfile['USERNAME'];?></label><br>
				<b>Branch :</b><br>
				<label><?php echo $dataProfile['BRANCH_NAME'];?></label><br>
				<b>Jabatan :</b><br>
				<label><?php echo $dataProfile['ROLE_NAME'];?></label><br>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="card shadow mb-12">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Ubah data profile</h6>
			</div>
			<div class="card-body">
				<form method="post" action="">
					<div class="form-group">
						<label>NIK</label>
						<input type="text" class="form-control" name="emp_no" disabled value="<?php echo $dataProfile['EMP_NO'];?>">
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username" disabled value="<?php echo $dataProfile['USERNAME'];?>">
					</div>
					<div class="form-group">
						<label>Branch</label>
						<input type="text" class="form-control" name="branchid" disabled value="<?php echo $dataProfile['BRANCH_NAME'];?>">
					</div>
					<div class="form-group">
						<label>Jabatan</label>
						<input type="text" class="form-control" name="nama" disabled value="<?php echo $dataProfile['ROLE_NAME'];?>">
					</div>
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input type="text" class="form-control" name="nama" value="<?php echo $dataProfile['EMP_NAME'];?>">
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
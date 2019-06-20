<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
require_once("../config/connection.php");
if(isset($_POST['submit'])){
	$tgl = $_POST['tgl'];
}else{
	$tgl = date("Y-m");
}
?>


<div class="row">
	<div class="col-md-6">
		<div class="card shadow mb-6">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Report ARO</h6>
			</div>
			<div class="card-body">
				<form method="post" action="report_action.php?action=export-aro">
							<div class="col-md-12">
								<div class="form-group">
									<label>Branch</label>
									<select class="form-control" id="branch" name="branch">
									<?php
										echo '<option value="'.$data['BRANCHID'].'" selected>'.$data['OFFICE_NAME'].'</option>';
									?>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Period </label>
									<div class="input-group mb-63">
										<input type="text" name="tgl" id="tgl" class="form-control" value="<?php echo $tgl;?>" autocomplete="off" readonly style="background-color:#FFF;cursor:pointer;">
										<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar"></i></span>
										</div>
									</div>
								</div>
							</div>
							

							
					
					<!--<div class="form-group">
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
					</div>-->
					<div class="pull-left" id="expo">
						<button type="submit" class="btn btn-success" id="btn" name="submit" value='submit'><i class="fa fa-file-excel"></i> Export to Excel
						</button>
					</div><br>
					
				</form>
			</div>
		</div>
	</div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
		$('#tgl').datepicker({
		format: "yyyy-mm",
		changeMonth: true,
        changeYear: true,
		autoclose: true,
		viewMode: "months", 
		minViewMode: "months",
		defaultDate: new Date(),
		minDate: new Date(),
		onSelect: function(dateStr) 
		{         
			$("#tgl").val(dateStr);
		}
	});
	
    
});
</script>

<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
require_once("../config/connection.php");
if(isset($_POST['submit'])){
	$startPeriod = $_POST['startPeriod'];
	$endPeriod = $_POST['endPeriod'];
}else{
	$startPeriod = date("Y-m");
	$endPeriod = date("Y-m");
}
?>


<div class="row">
	<div class="col-md-6">
		<div class="card shadow mb-6">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Report Transaction</h6>
			</div>
			<div class="card-body">
				<form method="post" action="report_action.php?action=export-transaksi">
							<div class="col-md-12">
								<div class="form-group">
										<label>Branch</label>
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
					
							<div class="col-md-12">
									<div class="form-group">
										<label>Start Period </label>
										<div class="input-group mb-63">
											<input type="text" name="startPeriod" id="startPeriod" class="form-control" value="<?php echo $startPeriod;?>" autocomplete="off" readonly style="background-color:#FFF;cursor:pointer;">
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar"></i></span>
												
											</div>
										</div>
									</div>
								
							</div>
							
							<div class="col-md-12">
									<div class="form-group">
										<label>End Period </label>
										<div class="input-group mb-63">
											<input type="text" name="endPeriod" id="endPeriod" class="form-control" value="<?php echo $endPeriod;?>" autocomplete="off" readonly style="background-color:#FFF;cursor:pointer;">
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar"></i></span>
												
											</div>
										</div>
									</div>
								
							</div>
							<input type="text" name="office" id="office" value="<?php echo $data['OFFICE_NAME'];?>" hidden>
							
					
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
					<div class="pull-left" id="sub">
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
		
		$('#startPeriod').datepicker({
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
			$("#startPeriod").val(dateStr);
		}
	});
		$('#endPeriod').datepicker({
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
			$("#endPeriod").val(dateStr);
		}
	});

	
    
});
</script>

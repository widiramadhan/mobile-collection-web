<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
$startDate = "";
$endDate = "";
					
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
				<h6 class="m-0 font-weight-bold text-primary">History AR Officer</h6>
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Start Date </label>
										<div class="input-group mb-3">
											<input type="text" name="startDate" id="startDate" class="form-control" value="<?php echo $startDate;?>" autocomplete="off" readonly style="background-color:#FFF;cursor:pointer;">
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>End Date </label>
										<div class="input-group mb-3">
											<input type="text" name="endDate" id="endDate" class="form-control" value="<?php echo $endDate;?>" autocomplete="off" readonly style="background-color:#FFF;cursor:pointer;">
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
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
</div>
<script>
$( document ).ready(function() {   
	$('#startDate').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		endDate: new Date()
	});
	
	$('#endDate').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		endDate: new Date()
	});
});
</script>
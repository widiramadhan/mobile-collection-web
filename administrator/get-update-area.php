<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
$id=$_GET['id'];
$aro1=$_GET['aro1'];
$aro2=$_GET['aro2'];
$aro3=$_GET['aro3'];
$callCol = "{call SP_GET_COLLECTOR_BY_BRANCH(?)}"; 
									$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
									$execCol = sqlsrv_query( $conn, $callCol, $paramsCol) or die( print_r( sqlsrv_errors(), true));	
							
if(isset($_POST['submit_col'])){
		$branch = $_POST['branch'];
		$col1 = $_POST['col1'];
		$area = $_POST['area'];
		$col2 = $_POST['col2'];
		$col3 = $_POST['col3'];
		$col4 = $_POST['col4'];
		$col5 = $_POST['col5'];
		
		$query = "{call SP_INSERT_MAPPING(?,?,?,?,?,?,?)}";  
		$params = array(array($branch, SQLSRV_PARAM_IN),
						array($area, SQLSRV_PARAM_IN),
						array($col1, SQLSRV_PARAM_IN),
						array($col2, SQLSRV_PARAM_IN),
						array($col3, SQLSRV_PARAM_IN),
						array($col4, SQLSRV_PARAM_IN),
						array($col5, SQLSRV_PARAM_IN));  
		$exec = sqlsrv_query( $conn, $query, $params) or die( print_r( sqlsrv_errors(), true));
		if($exec){
				echo '<script>
				setTimeout(function() {
					swal({
						title : "Success",
						text : "Successfully saved data",
						type: "success",
						timer: 2000,
						showConfirmButton: false
					});  
				},10); 
					window.setTimeout(function(){ 
						window.location.replace("index.php?page=aro-activity");
					} ,2000); 
			  </script>';
	}else{
		echo '<script>
				setTimeout(function() {
					swal({
						title : "Error",
						text : "Please Select Your Check Box",
						type: "error",
						timer: 2000,
						showConfirmButton: false
					});  
				},10); 
					window.setTimeout(function(){ 
						history.back();
					} ,2000); 
			  </script>';
		}
	}
	

//$submit_list2 = $_POST['submit_list'];
?>

<style>
.modal-lg {
    max-width: 70%;
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
								/*if($data['LEVEL'] == 'SUPER ADMIN'){
									
								}else{*/
									echo '<option value="'.$data['BRANCHID'].'" selected>'.$data['OFFICE_NAME'].'</option>';
								//}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Area / Wilayah</label><br>
						<input type="text" name="area" id="area" value="<?php echo $id;?>" readonly>
						<button type="button" class="btn-primary" data-toggle="modal" data-target="#modalsearch"><i class="fa fa-search"></i></button>
						
					</div>
					
					<div class="form-group">
						<label>Collector Name</label>
						<select class="form-control" id="col1" name="col1">
							<option value="<?php echo $aro1;?>" selected><?php echo $aro1;?></option>
							<?php
								/*if($data['LEVEL'] == 'SUPER ADMIN'){
									
								}else{*/
									$callCol = "{call SP_GET_COLLECTOR_BY_BRANCH(?)}"; 
									$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
									$execCol = sqlsrv_query( $conn, $callCol, $paramsCol) or die( print_r( sqlsrv_errors(), true));								
									while($dataCol = sqlsrv_fetch_array($execCol)){
									?>
										<option value="<?php echo $dataCol['EMP_NO'];?>"><?php echo $dataCol['EMP_NO'].' - '.strtoupper($dataCol['EMP_NAME']);?></option>
									<?php
									}
								//}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Collector Name</label>
						<select class="form-control" id="col2" name="col2">
							<option value="" selected>Pilih Collector 2</option>
							<?php
								/*if($data['LEVEL'] == 'SUPER ADMIN'){
									
								}else{*/
									$callCol = "{call SP_GET_COLLECTOR_BY_BRANCH(?)}"; 
									$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
									$execCol = sqlsrv_query( $conn, $callCol, $paramsCol) or die( print_r( sqlsrv_errors(), true));								
									while($dataCol = sqlsrv_fetch_array($execCol)){
									?>
										<option value="<?php echo $dataCol['EMP_NO'];?>"><?php echo $dataCol['EMP_NO'].' - '.strtoupper($dataCol['EMP_NAME']);?></option>
									<?php
									}
								//}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Collector Name</label>
						<select class="form-control" id="col3" name="col3">
							<option value="" selected>Pilih Collector 3</option>
							<?php
								/*if($data['LEVEL'] == 'SUPER ADMIN'){
									
								}else{*/
									$callCol = "{call SP_GET_COLLECTOR_BY_BRANCH(?)}"; 
									$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
									$execCol = sqlsrv_query( $conn, $callCol, $paramsCol) or die( print_r( sqlsrv_errors(), true));								
									while($dataCol = sqlsrv_fetch_array($execCol)){
									?>
										<option value="<?php echo $dataCol['EMP_NO'];?>"><?php echo $dataCol['EMP_NO'].' - '.strtoupper($dataCol['EMP_NAME']);?></option>
									<?php
									}
								//}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Collector Name</label>
						<select class="form-control" id="col4" name="col4">
							<option value="" selected>Pilih Collector 4</option>
							<?php
								/*if($data['LEVEL'] == 'SUPER ADMIN'){
									
								}else{*/
									$callCol = "{call SP_GET_COLLECTOR_BY_BRANCH(?)}"; 
									$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
									$execCol = sqlsrv_query( $conn, $callCol, $paramsCol) or die( print_r( sqlsrv_errors(), true));								
									while($dataCol = sqlsrv_fetch_array($execCol)){
									?>
										<option value="<?php echo $dataCol['EMP_NO'];?>"><?php echo $dataCol['EMP_NO'].' - '.strtoupper($dataCol['EMP_NAME']);?></option>
									<?php
									}
								//}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Collector Name</label>
						<select class="form-control" id="col5" name="col5">
							<option value="" selected>Pilih Collector 5</option>
							<?php
								/*if($data['LEVEL'] == 'SUPER ADMIN'){
									
								}else{*/
									$callCol = "{call SP_GET_COLLECTOR_BY_BRANCH(?)}"; 
									$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
									$execCol = sqlsrv_query( $conn, $callCol, $paramsCol) or die( print_r( sqlsrv_errors(), true));								
									while($dataCol = sqlsrv_fetch_array($execCol)){
									?>
										<option value="<?php echo $dataCol['EMP_NO'];?>"><?php echo $dataCol['EMP_NO'].' - '.strtoupper($dataCol['EMP_NAME']);?></option>
									<?php
									}
								//}
							?>
						</select>
					</div>
					
					
					<div class="pull-right">
						<input type="reset" value="Cancel" class="btn btn-danger">
						<input type="submit" value="Submit" class="btn btn-primary" name="submit_col">
					</div>
					<div style="clear:both;"></div>
				</form>
			</div>
		</div>
	</div>
</div>



<!-- Modal -->
<?php
	if(isset($_POST['submit_list'])){
		$kota = $_POST['kota'];
		$kecamatan = $_POST['kecamatan'];
		$kelurahan = $_POST['kelurahan'];
		$areacolid = $_POST['areacolid'];
		
		
		$queryUpdate = "{call SP_GET_AREA_ARO(?,?,?,?)}"; 
		$parameterUpdate = array(
						array($kota, SQLSRV_PARAM_IN),
						array($kecamatan, SQLSRV_PARAM_IN),
						array($kelurahan, SQLSRV_PARAM_IN),
						array($areacolid, SQLSRV_PARAM_IN)
					);
		$execUpdate = sqlsrv_query( $conn, $queryUpdate, $parameterUpdate) or die( print_r( sqlsrv_errors(), true));
		
				echo "<script type='text/javascript'>
				$(document).ready(function(){
				$('#modalsearch').modal('show');
				});
			  </script>";		
		
	}
?>

<div class="modal fade" id="modalsearch" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form action="" method="post" enctype="multipart/form-data" id="form1" name="form1">
				<div class="modal-header">
				<h3>Search Wilayah</h3>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
				<table  style="border-collapse:separate;border-spacing:6px 6px;">
				<tr>
					<td style="width:100px">Kota</td>
					<td style="width:20px"> : </td>
					<td><input type="text" id="kota" name="kota" placeholder="Nama Kota" style="width:450px" value="<?php if(isset($_POST['kota'])){ echo $kota; } ?>"></td>
				</tr>
				<tr>
					<td style="width:100px">Kecamatan</td>
					<td style="width:20px"> : </td>
					<td><input type="text" id="kecamatan" name="kecamatan" placeholder="Nama Kecamatan" style="width:450px"  value="<?php if(isset($_POST['kecamatan'])){ echo $kecamatan; } ?>"></td>
				</tr>
				<tr>
					<td style="width:100px">Kelurahan</td>
					<td style="width:20px"> : </td>
					<td><input type="text" id="kelurahan" name="kelurahan" placeholder="Nama Kelurahan" style="width:450px"  value="<?php if(isset($_POST['kelurahan'])){ echo $kelurahan; } ?>"> &nbsp;&nbsp;&nbsp; 
					<input type="hidden" value="LIST" name="areacolid" id="areacolid">
					<input type="submit" class="btn btn-primary" value="Cari" name="submit_list" id="submit_list">
					</td>
				</tr>
				</div>
				
			</form>

	<div class="col-md-12">
		
			<div class="card-body">
				<div class="table-responsive">
				 <form action="" method="post" autocomplete="off">
					<table class="table table-bordered dataTable" style="width:100%;" id="example" >
						<thead>
							<tr>
								<th>No</th>
								<th>ID</th>
								<th>Kota</th>
								<th>Kecamatan</th>
								<th>Kelurahan</th>
								<th>Action</th>
								</th>
							</tr>
						</thead>
						<tbody>
					
							<?php
								if(isset($_POST['submit_list'])){
									$no=0;
									while($dataDKHC = sqlsrv_fetch_array($execUpdate)){
									$no++;
								
							?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $dataDKHC['M_AREA_COLL_ID'];?></td>
								<td style="text-align:left;"><?php echo $dataDKHC['KOTA'];?></td>
								<td style="text-align:left;"><?php echo $dataDKHC['KECAMATAN'];?></td>
								<td style="text-align:left;"><?php echo $dataDKHC['KELURAHAN'];?></td>
								<td style="text-align:left;"><a href="index.php?page=get-area&id=<?php echo $dataDKHC['M_AREA_COLL_ID'];?>&kt=<?php echo $dataDKHC['KOTA'];?>&kc=<?php echo $dataDKHC['KECAMATAN'];?>&kl=<?php echo $dataDKHC['KELURAHAN'];?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Detail</a>
								</td>
							</tr>
								<?php } } ?>
						</tbody>
					</table>
					</form>
					<br>
				
				</div>
		
		</div>
	</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#mySelect2').select2();
	
	$('#example').DataTable();
		
});
</script>
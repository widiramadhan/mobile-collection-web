<?php
if(isset($_POST['submit'])){
	//$total=$_POST['numrows'];
	//$branchID = $_POST['branchID'];
	//$m_coll_area_id = $_POST['mAreaColID'];
	//$hari = $_POST['days'];
	
	//echo $total;
	
	
	$no_array = 0;
	foreach($_POST['branchID'] as $k){
		if(!empty($k)){
			$branchid = $_POST['branchID'][$no_array];
			$colid = $_POST['mAreaColID'][$no_array];
			

			//$this->M_insert->insert_looping($branchid, $colid, $keca, $kelu, $days);
			echo $branchid;
		}
		$no_array++;
	}
	/*for($i=1;$x<$selectedDays;$x++){
		$hari_desc = '';
		if($hari == "1"){
			$hari_desc="SENIN";
		}else if($hari == "2"){
			$hari_desc="SELASA";
		}else if($hari == "3"){
			$hari_desc="RABU";
		}else if($hari == "4"){
			$hari_desc="KAMIS";
		}else if($hari == "5"){
			$hari_desc="JUMAT";
		}else if($hari == "6"){
			$hari_desc="SABTU";
		}
	
		$callInsert = "{call SP_INSERT_DKH_PRIORITY_BY_DAYS(?,?,?,?,?)}";
		$paramInsert = array(
							array($branchID, SQLSRV_PARAM_IN),
							array($m_coll_area_id, SQLSRV_PARAM_IN),
							array($hari[$x], SQLSRV_PARAM_IN),
							array($hari_desc, SQLSRV_PARAM_IN),
							array($sid, SQLSRV_PARAM_IN)
						); 
		$execInsert = sqlsrv_query( $conn, $callInsert, $paramInsert) or die( print_r( sqlsrv_errors(), true));
		if($execInsert){
		echo '<script>
					setTimeout(function() {
						swal({
							title : "Success",
							text : "Successfully update data",
							type: "success",
							timer: 2000,
							showConfirmButton: false
						});  
					},10); 
						window.setTimeout(function(){ 
							window.location.replace("index.php?page=aro-priority");
						} ,2000); 
				  </script>';
		}else{
			echo '<script>
					setTimeout(function() {
						swal({
							title : "Error",
							text : "Failed update data",
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
	}*/
}

?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">SETTING PRIORITY DAYS</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form action="aro-action.php?action=insertNew" method="post">
				<table class="table table-bordered" id="dataTables2" width="100%" cellspacing="0" style="font-size:12px;">
					<thead>
						<tr>
							<!--<th style="vertical-align:middle;text-align:center;padding-left:30px;" ><input type="checkbox" id="selectAll"></th>-->
							<th style="vertical-align:middle;text-align:center;">NO</th>
							<th style="vertical-align:middle;text-align:center;">BRANCHID</th>
							<th style="vertical-align:middle;text-align:center;">COLL ID</th>
							<th style="vertical-align:middle;text-align:center;">KECAMATAN</th>
							<th style="vertical-align:middle;text-align:center;">KELURAHAN</th>			
							<th style="vertical-align:middle;text-align:center;">DAYS</th>
							<th style="vertical-align:middle;text-align:center;">ACTION</th>
						</tr>
					</thead>
					<tbody>
						
						<?php
							$query = "{call SP_GET_KELURAHAN_BY_CONTRACT_ID(?)}";
							$params = array(array($bid, SQLSRV_PARAM_IN));
							$options =  array( "Scrollable" => "buffered" );
							$exec = sqlsrv_query( $conn, $query, $params, $options) or die( print_r( sqlsrv_errors(), true));
							$numrows = sqlsrv_num_rows($exec);
							$no = 0;
							$j = 0;
							while($data = sqlsrv_fetch_array($exec)){
								$no++;
								if($data['PRIORITY_ID'] == NULL){
									$selected = "selected";
									$senin = "";
									$selasa = "";
									$rabu = "";
									$kamis = "";
									$jumat = "";
									$sabtu = "";
								}else if($data['PRIORITY_ID'] == "1"){
									$selected = "";
									$senin = "selected";
									$selasa = "";
									$rabu = "";
									$kamis = "";
									$jumat = "";
									$sabtu = "";
								}else if($data['PRIORITY_ID'] == "2"){
									$selected = "";
									$senin = "";
									$selasa = "selected";
									$rabu = "";
									$kamis = "";
									$jumat = "";
									$sabtu = "";
								}else if($data['PRIORITY_ID'] == "3"){
									$selected = "";
									$senin = "";
									$selasa = "";
									$rabu = "selected";
									$kamis = "";
									$jumat = "";
									$sabtu = "";
								}else if($data['PRIORITY_ID'] == "4"){
									$selected = "";
									$senin = "";
									$selasa = "";
									$rabu = "";
									$kamis = "selected";
									$jumat = "";
									$sabtu = "";
								}else if($data['PRIORITY_ID'] == "5"){
									$selected = "";
									$senin = "";
									$selasa = "";
									$rabu = "";
									$kamis = "";
									$jumat = "selected";
									$sabtu = "";
								}else if($data['PRIORITY_ID'] == "6"){
									$selected = "";
									$senin = "";
									$selasa = "";
									$rabu = "";
									$kamis = "";
									$jumat = "";
									$sabtu = "selected";
								}
								
						?>
						<tr>
							<td style="vertical-align:middle;text-align:center;"><?php echo $no;?></td>
							<td style="vertical-align:middle;"><?php echo $data['BRANCH_ID'];?></td>
							<td style="vertical-align:middle;" ><a href="index.php?page=detail-mapping&id=<?php echo $data['M_AREA_COLL_ID'];?>&priority=<?php echo $data['M_AREA_COLL_PRIORITY_ID'];?>"><?php echo $data['M_AREA_COLL_ID'];?></td></a>
							<td style="vertical-align:middle;"><?php echo $data['KECAMATAN'];?></td>
							<td style="vertical-align:middle;"><?php echo $data['KELURAHAN'];?></td>
							<td style="vertical-align:middle;"><?php echo $data['PRIORITY_DESC'];?></td>
							<td style="vertical-align:middle;">
								<select class="form-control" name="days[<?php echo $j;?>]">
									<option value="" <?php echo $selected;?>>PILIH</option>
									<option value="1" <?php echo $senin;?>>SENIN</option>
									<option value="2" <?php echo $selasa;?>>SELASA</option>
									<option value="3" <?php echo $rabu;?>>RABU</option>
									<option value="4" <?php echo $kamis;?>>KAMIS</option>
									<option value="5" <?php echo $jumat;?>>JUMAT</option>
									<option value="6" <?php echo $sabtu;?>>SABTU</option>
								</select>
							</td>
						</tr>
						<input type="hidden" name="priorityID[<?php echo $j;?>]" value="<?php echo $data['M_AREA_COLL_PRIORITY_ID'];?>">
						<input type="hidden" name="branchID[<?php echo $j;?>]" value="<?php echo $data['BRANCH_ID'];?>">
						<input type="hidden" name="mAreaColID[<?php echo $j;?>]" value="<?php echo $data['M_AREA_COLL_ID'];?>">
						<input type="hidden" name="userID[<?php echo $j;?>]" value="<?php echo $sid;?>">
						<input type="hidden" name="kecamatan[<?php echo $j;?>]" value="<?php echo $data['KECAMATAN'];?>">
						<input type="hidden" name="kelurahan[<?php echo $j;?>]" value="<?php echo $data['KELURAHAN'];?>">
								
						<?php $j++; }?>					
					</tbody>
				</table>
				<br>
				<input type="hidden" name="numrows" value="<?php echo $numrows;?>">
				<input type="submit" class="btn btn-primary" name="submit" value="UPDATE" style="width:100%;">
			</form>
		</div>
				
	</div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('#dataTables').DataTable();
});
</script>
 
	

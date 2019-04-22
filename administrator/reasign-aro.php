<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">List AR Officer in Branch</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form action="reasign-aro-action.php?action=save" method="post" enctype="multipart/form-data" id="form">
			<table class="table table-bordered" id="dataTables" width="100%" cellspacing="0" style="font-size:12px;">
				<thead>
					<tr>
						<th style="vertical-align:middle;text-align:center;padding-left:30px;" ><input type="checkbox" id="selectAll"></th>
						<th style="vertical-align:middle;text-align:center;">ID Kolektor</th>
						<th style="vertical-align:middle;text-align:center;">No Kontrak</th>
						<th style="vertical-align:middle;text-align:center;">Nama Kostumer</th>
						<th style="vertical-align:middle;text-align:center;">Tgl Jatuh Tempo</th>
						<th style="vertical-align:middle;text-align:center;">Overdue Days</th>
						<th style="vertical-align:middle;text-align:center;">Total Tagihan</th>
						<th style="vertical-align:middle;text-align:center;">Tgl Janji Bayar</th>
					</tr>
				</thead>
				<tbody>
					<?php
							$query = "{call SP_GET_DKHC_RE_ASSIGN(?)}";
							$params = array(array($bid, SQLSRV_PARAM_IN));  
							$exec = sqlsrv_query( $conn, $query, $params) or die( print_r( sqlsrv_errors(), true));
							$no = 0;
							while($data = sqlsrv_fetch_array($exec)){
								$no++;
							
					?>
                    <tr>
					
					  <td style="vertical-align:middle;text-align:center;"><input type="checkbox" class="aroClass" name="aro[]" id="aro[]" value="<?php echo $data['AGING_COLLECTED_ID'];?>">
					  <td style="vertical-align:middle;"><?php echo $data['EMP_ID'];?></td>
                      <td style="vertical-align:middle;"><?php echo $data['NOMOR_KONTRAK'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['NAMA_KOSTUMER'];?></td>
                      <td style="vertical-align:middle;"><?php echo $data['TANGGAL_JATUH_TEMPO']?></td>
					  <td style="vertical-align:middle;"><?php echo $data['OVERDUE_DAYS'];?></td>
					  <td style="vertical-align:middle;">Rp. <?php echo number_format($data['TOTAL_TAGIHAN'],0,',','.');?></td>
					  <td style="vertical-align:middle;"><?php echo $data['TANGGAL_JANJI_BAYAR']?></td>
                    </tr>
					<?php }?>										
				</tbody>
			</table>
			<br>
			<div class="col-md-3">
					<select class="form-control" id="col" name="col">
							<option value="" selected>Pilih Collector</option>
							<?php
								if($data['LEVEL'] == 'SUPER ADMIN'){
									
								}else{
									$callCol = "{call SP_LOV_ARO_BY_BRANCH(?)}"; 
									$paramsCol = array(array($bid, SQLSRV_PARAM_IN));  
									$execCol = sqlsrv_query( $conn, $callCol, $paramsCol) or die( print_r( sqlsrv_errors(), true));								
									while($dataCol = sqlsrv_fetch_array($execCol)){
									?>
										<option value="<?php echo $dataCol['EMP_NO'];?>" ><?php echo $dataCol['EMP_NO'].' - '.strtoupper($dataCol['EMP_NAME']);?></option>
									<?php
									}
								}
							?>
				    </select><br>
					<input type="hidden" name="branchid" id="branchid" value="<?php echo $bid;?>">
					<button type="submit" class="btn btn-primary"  id="submitaro" disabled="true" style="width:50%;">Update</button>
			</form>
			</div>
		</div>
	</div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('#dataTables').DataTable();
	
	$('#selectAll').click(function(e){
    var table= $(e.target).closest('table');
    $('td input:checkbox',table).prop('checked',this.checked);
	});
	
	
	
	$(function(){
    var checkboxes = $(':checkbox:not(#aro)').click(function(event){
        $('#submitaro').prop("disabled", checkboxes.filter(':checked').length == 0);
    });
    
    $('#aro').click(function(event) {   
        checkboxes.prop('checked', this.checked);
        $('#submitaro').prop("disabled", !this.checked)
    });
});
	

	
} );
</script>
 
	

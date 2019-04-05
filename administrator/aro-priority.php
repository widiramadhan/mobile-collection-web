<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Setting Aro Priority</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTables" width="100%" cellspacing="0" style="font-size:12px;">
				<thead>
					<tr>
						<th style="vertical-align:middle;text-align:center;">NO</th>
						<th style="vertical-align:middle;text-align:center;">BRANCHID</th>
						<th style="vertical-align:middle;text-align:center;">COLL_ID</th>
						<th style="vertical-align:middle;text-align:center;">KECAMATAN</th>
						<th style="vertical-align:middle;text-align:center;">KELURAHAN</th>			
						<th style="vertical-align:middle;text-align:center;">DAYS</th>
						<th style="vertical-align:middle;text-align:center;">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
							$query = "{call SP_GET_ARO_PRIORITY}";
							$exec = sqlsrv_query( $conn, $query) or die( print_r( sqlsrv_errors(), true));
							$no = 0;
							while($data = sqlsrv_fetch_array($exec)){
								$no++;
							
					?>
                    <tr>
					  <td style="vertical-align:middle;text-align:center;"><?php echo $no;?></td>
                      <td style="vertical-align:middle;"><input type="text" name="branch_id" id="branch_id" value="<?php echo $data['BRANCH_ID'];?>"><?php echo $data['BRANCH_ID'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['M_AREA_COLL_ID'];?></td>
                      <td style="vertical-align:middle;"><?php echo $data['KECAMATAN'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['KELURAHAN'];?></td>
					  <td style="vertical-align:middle;">
					  <form action="aro-action.php?action=insert" method="post">
					  <input type="text" name="kecamatan" value="<?php echo $data['KELURAHAN'];?>">
					  <select class="form-control" id="days" name="days">
							<option value="1">Senin</option>
							<option value="2">Selasa</option>
							<option value="3">Rabu</option>
							<option value="4">Kamis</option>
							<option value="5">Jumat</option>
							<option value="6">Sabtu</option>
					 </select>
					  </td>
					   <td style="vertical-align:middle;text-align:center;">
						<a  
					  </form>
                    </tr>
					<?php }?>										
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('#dataTables').DataTable();
} );
</script>
 
	

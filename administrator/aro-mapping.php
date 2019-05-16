<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">List Aro Mapping</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTables" width="100%" cellspacing="0" style="font-size:12px;">
				<thead>
					<tr>
						<th style="vertical-align:middle;text-align:center;">NO</th>
						<th style="vertical-align:middle;text-align:center;">Coll ID</th>
						<th style="vertical-align:middle;text-align:center;">KOTA</th>
						<th style="vertical-align:middle;text-align:center;">KECAMATAN</th>
						<th style="vertical-align:middle;text-align:center;">KELURAHAN</th>
						<th style="vertical-align:middle;text-align:center;">ZIP CODE</th>
						<th style="vertical-align:middle;text-align:center;">ARO 1</th>
						<th style="vertical-align:middle;text-align:center;">ARO 2</th>
						<th style="vertical-align:middle;text-align:center;">ARO 3</th>
						<th style="vertical-align:middle;text-align:center;">ARO 4</th>
						<th style="vertical-align:middle;text-align:center;">ARO 5</th>
						<th style="vertical-align:middle;text-align:center;">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
							$query = "{call SP_GET_ARO_COLL_MAPPING(?)}";
							$params = array(array($bid, SQLSRV_PARAM_IN));  
							$exec = sqlsrv_query( $conn, $query, $params) or die( print_r( sqlsrv_errors(), true));
							$no = 0;
							while($data = sqlsrv_fetch_array($exec)){
								$no++;
							
					?>
                    <tr>
					  <td style="vertical-align:middle;text-align:center;"><?php echo $no;?></td>
                      <td style="vertical-align:middle;"><?php echo $data['M_AREA_COLL_ID'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['KOTA'];?></td>
                      <td style="vertical-align:middle;"><?php echo $data['KECAMATAN'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['KELURAHAN'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['ZIP_CODE'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['ARO_1'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['ARO_2'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['ARO_3'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['ARO_4'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['ARO_5'];?></td>
					 <td style="vertical-align:middle;text-align:center">
						<a href="index.php?page=get-update-area&id=<?php echo $data['M_AREA_COLL_ID'];?>&aro1=<?php echo $data['ARO_1'];?>&aro2=<?php echo $data['ARO_2'];?>&aro3=<?php echo $data['ARO_3'];?>" class="btn btn-primary btn-sm" class="btn btn-primary btn-sm">UPDATE</a>
					  </td>
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
 
	

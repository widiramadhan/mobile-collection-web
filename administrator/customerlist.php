<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">List Customer in Branch</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTables" width="100%" cellspacing="0" style="font-size:12px;">
				<thead>
					<tr>
						<th style="vertical-align:middle;text-align:center;">NO</th>
						<th style="vertical-align:middle;text-align:center;">CONTRACT ID</th>
						<th style="vertical-align:middle;text-align:center;">CUSTOMER NAME</th>
						<th style="vertical-align:middle;text-align:center;">ADDRESS</th>
						<th style="vertical-align:middle;text-align:center;">PHONE NUMBER</th>
						<th style="vertical-align:middle;text-align:center;">STATUS</th>
						<th style="vertical-align:middle;text-align:center;">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
							$query = "{call SP_GET_CUSTOMER_DISTRIBUTION(?)}";
							$params = array(array($bid, SQLSRV_PARAM_IN));  
							$exec = sqlsrv_query( $conn, $query, $params) or die( print_r( sqlsrv_errors(), true));
							$no = 0;
							while($data = sqlsrv_fetch_array($exec)){
								$no++;
							
					?>
                    <tr>
					  <td style="vertical-align:middle;text-align:center;"><?php echo $no;?></td>
                      <td style="vertical-align:middle;"><?php echo $data['NOMOR_KONTRAK'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['NAMA_KOSTUMER'];?></td>
                      <td style="vertical-align:middle;"><?php echo $data['ALAMAT_KTP'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['NOMOR_HANDPHONE'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['DailyCollectibility'];?></td>
					  <td style="vertical-align:middle;">
						<a href="index.php?page=detail-customer&id=<?php echo $data['NOMOR_KONTRAK'];?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Detail</a>
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
 
	

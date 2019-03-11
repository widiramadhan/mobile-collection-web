<div class="col-md-12 col-sm-12 col-xs-12">	
	<div class="card mb-3">
		<div class="card-header">
            <h4>
				<i class="fa fa-users"></i> List AR Officer
			</h4>
		</div>
        <div class="card-body">
			<div class="table-responsive">
                <table class="table table-bordered" id="dataTable" id="datatable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th style="vertical-align:middle;text-align:center;">NO</th>
							<th style="vertical-align:middle;text-align:center;">NIK</th>
							<th style="vertical-align:middle;text-align:center;">USERNAME</th>
							<th style="vertical-align:middle;text-align:center;">FULLNAME</th>
							<th style="vertical-align:middle;text-align:center;">BRANCH</th>
							<th style="vertical-align:middle;text-align:center;">LAST LOGIN</th>
							<th style="vertical-align:middle;text-align:center;">CREATE_DATE</th>
							<th style="vertical-align:middle;text-align:center;width:20%">ACTION</th>
						</tr>
					</thead>
                    <tbody>
					<?php
							$query = "{call SP_GET_ARO(?)}";
							$params = array(array($bid, SQLSRV_PARAM_IN));  
							$exec = sqlsrv_query( $conn, $query, $params) or die( print_r( sqlsrv_errors(), true));
							$no = 0;
							while($data = sqlsrv_fetch_array($exec)){
								$no++;
							
					?>
                    <tr>
					  <td style="vertical-align:middle;text-align:center;"><?php echo $no;?></td>
                      <td style="vertical-align:middle;"><?php echo $data['EMP_NO'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['USERNAME'];?></td>
                      <td style="vertical-align:middle;"><?php echo $data['EMP_NAME'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['BRANCHID'];?></td>
					  <td style="vertical-align:middle;"><?php if($data['LAST_LOGIN']<>NULL){echo $data['LAST_LOGIN']->format('Y-m-d');}else{echo"-";}?></td>
					  <td style="vertical-align:middle;"><?php if($data['CREATE_DATE']<>NULL){echo $data['CREATE_DATE']->format('Y-m-d');}else{echo"-";}?></td>
					  <td style="vertical-align:middle;"></td>
                    </tr>
					<?php }?>										
				</tbody>
  
			</table>
		</div>
	</div>
</div>
<script src="vendors/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('#dataTables').DataTable();
} );
</script>
 
	

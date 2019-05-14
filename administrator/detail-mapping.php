<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
require_once("../config/connection.php");
$id=$_GET['id'];
$priority=$_GET['priority'];

$callArea = "{call SP_GET_AREA_COLL(?,?)}"; 
$optionsArea =  array( "Scrollable" => "buffered" );
$paramsArea = array(array($id, SQLSRV_PARAM_IN),
					array($priority, SQLSRV_PARAM_IN));  
$execArea = sqlsrv_query( $conn, $callArea, $paramsArea, $optionsArea) or die( print_r( sqlsrv_errors(), true));
$numrowsArea=sqlsrv_num_rows($execArea);


?>
<div class="row">
<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Contract In Area</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered dataTable" style="width:100%;font-size:12px;" id="example" >
						<thead>
							<tr>
								<th style="text-align:center;vertical-align:middle;">No</th>
								<th style="text-align:center;vertical-align:middle;">Nama Kolektor</th>
								<th style="text-align:center;vertical-align:middle;">Nomor Kontrak</th>
								<th style="text-align:center;vertical-align:middle;">Nama Kostumer</th>
								<th style="text-align:center;vertical-align:middle;">Kota</th>
								<th style="text-align:center;vertical-align:middle;">Kecamatan</th>
								<th style="text-align:center;vertical-align:middle;">Kelurahan</th>
								<th style="text-align:center;vertical-align:middle;">Zipcode</th>
								<th style="text-align:center;vertical-align:middle;">Days</th>
							</tr>
						</thead>
						<tbody>
					
							<?php
								$no=0;
								while($dataArea = sqlsrv_fetch_array($execArea)){
									$no++;
							?>
							<tr>
								<td style="text-align:center;vertical-align:middle;"><?php echo $no;?></td>
								<td style="text-align:center;vertical-align:middle;" ><?php echo $dataArea['EMP_NAME'];?></td>
								<td style="text-align:center;vertical-align:middle;"><?php echo $dataArea['NOMOR_KONTRAK'];?></td>
								<td style="text-align:center;vertical-align:middle;"><?php echo $dataArea['NAMA_KOSTUMER'];?></td>
								<td style="text-align:center;vertical-align:middle;"><?php echo $dataArea['KOTA'];?></td>
								<td style="text-align:center;vertical-align:middle;"><?php echo $dataArea['KECAMATAN'];?></td>
								<td style="text-align:center;vertical-align:middle;"><?php echo $dataArea['KELURAHAN'];?></td>
								<td style="text-align:center;vertical-align:middle;"><?php echo $dataArea['ZIP_CODE'];?></td>
								<td style="text-align:center;vertical-align:middle;"><?php echo $dataArea['PRIORITY_DESC'];?></td>
								
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<br>
				
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('#example').DataTable({
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"order": [[ 0, "asc" ]],
		"columnDefs": [ {
		"targets": [0,1],
			"orderable": true
		} ]
	});
} );

$('#selectAll').click(function(e){
    var table= $(e.target).closest('table');
    $('td input:checkbox',table).prop('checked',this.checked);
});
</script>
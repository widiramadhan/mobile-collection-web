<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
if(isset($_POST['submit_col'])){
		$branch = $_POST['branch'];
		$pic = $_POST['col'];
		$kelurahan = $_POST['kelurahan'];
		$kecamatan = $_POST['kecamatan'];

		$callDKHC = "{call SP_GET_CONTRACT_PRIORITY(?,?,?,?)}"; 
		$options =  array( "Scrollable" => "buffered" );
		$paramsDKHC = array(array($branch, SQLSRV_PARAM_IN),array($kecamatan, SQLSRV_PARAM_IN),array($kelurahan, SQLSRV_PARAM_IN),array($pic, SQLSRV_PARAM_IN));  
		$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC, $options) or die( print_r( sqlsrv_errors(), true));

		$numrows=sqlsrv_num_rows($execDKHC);
		if($numrows == 0){
			$disable="disabled";
		}else{
			$disable="";
		}

}else{
	$callDKHC = "{call SP_GET_CONTRACT_PRIORITY(?,?,?,?)}"; 
	$paramsDKHC = array(array('null', SQLSRV_PARAM_IN),array('null', SQLSRV_PARAM_IN),array('null', SQLSRV_PARAM_IN),array('null', SQLSRV_PARAM_IN));  
	$execDKHC = sqlsrv_query( $conn, $callDKHC, $paramsDKHC) or die( print_r( sqlsrv_errors(), true));	

	$branch = "";
	$pic = "";
	$disable="disabled";
}

?>
    <style>
        th {
            text-align: center;
            vertical-align: middle;
            font-size: 12px;
        }
        
        td {
            text-align: center;
            vertical-align: middle;
            font-size: 12px;
        }
    </style>
	<form action="" method="post">
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Select AR Officer</h6>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-2">
											<label>Branch</label>
										</div>
										<div class="col-md-5">
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
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-2">
											<label>KELURAHAN</label>
										</div>
										<div class="col-md-5">
									<input type="text" class="form-control" id="kelurahan" name="kelurahan" value="">
									</div>
								</div>
							</div>
						</div>
					</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-2">
											<label>KECAMATAN</label>
										</div>
										<div class="col-md-5">
									<input type="text" class="form-control" id="kecamatan" name="kecamatan" value="">
								</div>
								</div>
							</div>
						</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-2">
									<label>COLLECTOR</label>
									</div>
									<div class="col-md-5">
									<select class="form-control" id="col" name="col">
										<option value="" selected>Pilih Collector</option>
										<?php
									/*if($data['LEVEL'] == 'SUPER ADMIN'){

									}else{*/
										/*echo '<script>alert("'.$data['BRANCHID'].'")</script>';*/
										$callCol = "{call SP_LOV_ARO_BY_BRANCH(?)}"; 
										//$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
										$paramsCol = array(array($data['BRANCHID'], SQLSRV_PARAM_IN));  
										$execCol = sqlsrv_query( $conn, $callCol, $paramsCol) or die( print_r( sqlsrv_errors(), true));	
										$numrowsResult=sqlsrv_num_rows($execCol);									
										while($dataCol = sqlsrv_fetch_array($execCol)){
										?>
											<option value="<?php echo $dataCol['EMP_NO'];?>" <?php if($dataCol[ 'EMP_NO']==$pic){ echo "selected"; }?>>
												<?php echo $dataCol['EMP_NO'].' - '.strtoupper($dataCol['EMP_NAME']);?>
											</option>
											<?php

										}
									//}
								?>
									</select>
									</div>
								</div>
							</div>
						</div>
						<div class="pull-right">
							<input type="submit" value="Search" class="btn btn-primary" name="submit_col">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List DKH Approval</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="priority-days.php?action=insert" method="POST" enctype="multipart/form-data" id="form">
                            <table class="table table-bordered dataTable" style="width:100%;" id="example">
                                <thead>
                                    <tr>
                                        <th style="vertical-align:middle;text-align:center;padding-left:30px;">
                                            <input type="checkbox" id="selectAll">
                                        </th>
                                        <th style="vertical-align:middle;text-align:center;">CONTRACT ID</th>
										<th style="vertical-align:middle;text-align:center;">NAMA CUSTOMER</th>
                                        <th style="vertical-align:middle;text-align:center;">COLL ID</th>
                                        <th style="vertical-align:middle;text-align:center;">KECAMATAN</th>
                                        <th style="vertical-align:middle;text-align:center;">KELURAHAN</th>
                                        <th style="vertical-align:middle;text-align:center;">DAYS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									$no=0;
									$j=0;
									while($dataDKHC = sqlsrv_fetch_array($execDKHC)){
										$no++;
										if($dataDKHC['PRIORITY_ID'] == NULL){
									$selected = "selected";
									$satu = "";
									$dua = "";
									$tiga = "";
									$empat = "";
									$lima = "";
									$enam = "";
									$tujuh = "";
									$delapan = "";
									$sembilan = "";
									$sepuluh = "";
								}else if($dataDKHC['PRIORITY_ID'] == "1"){
									$selected = "";
									$satu = "selected";
									$dua = "";
									$tiga = "";
									$empat = "";
									$lima = "";
									$enam = "";
									$tujuh = "";
									$delapan = "";
									$sembilan = "";
									$sepuluh = "";
								}else if($dataDKHC['PRIORITY_ID'] == "2"){
									$selected = "";
									$satu = "";
									$dua = "selected";
									$tiga = "";
									$empat = "";
									$lima = "";
									$enam = "";
									$tujuh = "";
									$delapan = "";
									$sembilan = "";
									$sepuluh = "";
								}else if($dataDKHC['PRIORITY_ID'] == "3"){
									$selected = "";
									$satu = "";
									$dua = "";
									$tiga = "selected";
									$empat = "";
									$lima = "";
									$enam = "";
									$tujuh = "";
									$delapan = "";
									$sembilan = "";
									$sepuluh = "";
								}else if($dataDKHC['PRIORITY_ID'] == "4"){
									$selected = "";
									$satu = "";
									$dua = "";
									$tiga = "";
									$empat = "selected";
									$lima = "";
									$enam = "";
									$tujuh = "";
									$delapan = "";
									$sembilan = "";
									$sepuluh = "";
								}else if($dataDKHC['PRIORITY_ID'] == "5"){
									$selected = "";
									$satu = "";
									$dua = "";
									$tiga = "";
									$empat = "";
									$lima = "selected";
									$enam = "";
									$tujuh = "";
									$delapan = "";
									$sembilan = "";
									$sepuluh = "";
								}else if($dataDKHC['PRIORITY_ID'] == "6"){
									$selected = "";
									$satu = "";
									$dua = "";
									$tiga = "";
									$empat = "";
									$lima = "";
									$enam = "selected";
									$tujuh = "";
									$delapan = "";
									$sembilan = "";
									$sepuluh = "";
								}
								else if($dataDKHC['PRIORITY_ID'] == "7"){
									$selected = "";
									$satu = "";
									$dua = "";
									$tiga = "";
									$empat = "";
									$lima = "";
									$enam = "";
									$tujuh = "selected";
									$delapan = "";
									$sembilan = "";
									$sepuluh = "";
								}
								else if($dataDKHC['PRIORITY_ID'] == "8"){
									$selected = "";
									$satu = "";
									$dua = "";
									$tiga = "";
									$empat = "";
									$lima = "";
									$enam = "";
									$tujuh = "";
									$delapan = "selected";
									$sembilan = "";
									$sepuluh = "";
								}
								else if($dataDKHC['PRIORITY_ID'] == "9"){
									$selected = "";
									$satu = "";
									$dua = "";
									$tiga = "";
									$empat = "";
									$lima = "";
									$enam = "";
									$tujuh = "";
									$delapan = "";
									$sembilan = "selected";
									$sepuluh = "";
								}
								else if($dataDKHC['PRIORITY_ID'] == "10"){
									$selected = "";
									$satu = "";
									$dua = "";
									$tiga = "";
									$empat = "";
									$lima = "";
									$enam = "";
									$tujuh = "";
									$delapan = "";
									$sembilan = "";
									$sepuluh = "selected";
								}
								
						?>
								
                                        <tr>
                                            <td style="vertical-align:middle;text-align:center;">
                                                <input type="checkbox" class="aroClass" name="contract[]" id="contract[]" value="<?php echo $dataDKHC['NOMOR_KONTRAK'];?>">
												<td style="vertical-align:middle;text-align:left;">
                                                    <?php echo $dataDKHC['NOMOR_KONTRAK'];?>
                                                </td>
												
												<td style="vertical-align:middle;text-align:left;">
                                                    <?php echo $dataDKHC['NAMA_KOSTUMER'];?>
                                                </td>
												
                                                <td style="vertical-align:middle;text-align:left;">
                                                    <?php echo $dataDKHC['EMP_ID'];?>
                                                </td>
                                                <td style="vertical-align:middle;text-align:left;">
                                                    <?php echo $dataDKHC['KECAMATAN'];?>
                                                </td>
                                               <td style="vertical-align:middle;text-align:left;">
                                                    <?php echo $dataDKHC['KELURAHAN'];?>
                                                </td>
                                               <td style="vertical-align:middle;text-align:left;">
                                                    <?php echo $dataDKHC['PRIORITY_DESC'];?>
                                                </td>
                                                <td style="vertical-align:middle;">
													<select class="form-control" name="days[]">
														<option value="" <?php echo $selected;?>></option>
														<option value="1" <?php echo $satu;?>>1</option>
														<option value="2" <?php echo $dua;?>>2</option>
														<option value="3" <?php echo $tiga;?>>3</option>
														<option value="4" <?php echo $empat;?>>4</option>
														<option value="5" <?php echo $lima;?>>5</option>
														<option value="6" <?php echo $enam;?>>6</option>
														<option value="7" <?php echo $tujuh;?>>7</option>
														<option value="8" <?php echo $delapan;?>>8</option>
														<option value="9" <?php echo $sembilan;?>>9</option>
														<option value="10" <?php echo $sepuluh;?>>10</option>
														
													</select>
												</td>
                                        </tr>
										
                                        <?php $j++; } ?>
                                </tbody>
                            </table>
                            <br>
							
                 
							<input type="hidden" id="branch" name="branch" value="<?php echo $branch; ?>" >
                            <button type="submit" class="btn btn-primary"  <?php echo $disable;?>>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script>
        /*$(document).ready(function() {
        	$('#example').DataTable({
        		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        		"order": [[ 0, "asc" ]],
        		"columnDefs": [ {
        		"targets": [0,1],
        			"orderable": true
        		} ]
        	});
        } );*/
        $(document).ready(function() {
            $(function() {
                var checkboxes = $(':checkbox:not(#aro)').click(function(event) {
                    $('#submitaro').prop("disabled", checkboxes.filter(':checked').length == 0);
                });

                var counterChecked = 0;

                $('body').on('change', 'input[type="checkbox"]', function() {
                    this.checked ? counterChecked++ : counterChecked--;
                    counterChecked > 0 ? $('#submitaro').prop("disabled", false) : $('#submitaro').prop("disabled", true);
                });

                $('#aro').click(function(event) {
                    checkboxes.prop('checked', this.checked);
                    $('#submitaro').prop("disabled", !this.checked)
                });
            });

            oTableStaticFlow = $('#example').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [0]
                }],
            });

            $("#selectAll").click(function() {
                var cells = oTableStaticFlow.column(0).nodes(), // Cells from 1st column
                    state = this.checked;

                for (var i = 0; i < cells.length; i += 1) {
                    cells[i].querySelector("input[type='checkbox']").checked = state;
                }
            });
        });
    </script>
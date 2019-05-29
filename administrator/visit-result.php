<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Visit Result</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTables" width="100%" cellspacing="0" style="font-size:12px;">
				<thead>
					<tr>
						<th style="vertical-align:middle;text-align:center;">NO</th>
						<th style="vertical-align:middle;text-align:center;">CONTRACT ID</th>
						<th style="vertical-align:middle;text-align:center;width:80px;">COLLECTOR NAME</th>
						<th style="vertical-align:middle;text-align:center;">CUSTOMER NAME</th>
						<th style="vertical-align:middle;text-align:center;">TOTAL TAGIHAN</th>
						<th style="vertical-align:middle;text-align:center;">STATUS</th>
						<th style="vertical-align:middle;text-align:center;">CREATE DATE</th>
						<th style="vertical-align:middle;text-align:center;">UPLOAD DATE</th>
						<th style="vertical-align:middle;text-align:center;">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
							$meetup="";
							$customerPay="";
							$acceptAmount="";
							$promiseDate="";
							
							$query = "{call SP_GET_VISIT_RESULT_NEW(?)}";
							$params = array(array($bid, SQLSRV_PARAM_IN));  
							$exec = sqlsrv_query( $conn, $query, $params) or die( print_r( sqlsrv_errors(), true));
							$no = 0;
							while($data = sqlsrv_fetch_array($exec)){
								$no++;
								$queryResult = "{call SP_GET_RESULT(?,?)}";
								$paramsResult = array(array($bid, SQLSRV_PARAM_IN),array($data['CONTRACT_ID'], SQLSRV_PARAM_IN));  
								$optionsResult =  array( "Scrollable" => "buffered" );
								$execResult = sqlsrv_query( $conn, $queryResult, $paramsResult, $optionsResult) or die( print_r( sqlsrv_errors(), true));
								$numrowsResult=sqlsrv_num_rows($execResult);
								if($numrowsResult <>0){
									while($dataresult = sqlsrv_fetch_array($execResult)){
										$quest = $dataresult['QUESTION'];
										if($quest == "MS_Q20190226172031880"){$meetup = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172302530"){$contactPerson = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172325360"){$hubunganKontak = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172343540"){$addres = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172405297"){$addresQuestion = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172432320"){$addresNew =$dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172447930"){$unit = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172517357"){$customerPay = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172558067"){$latPayLocation = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172603397"){$longPayLocation = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172624710"){$latLocationMeet = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172628683"){$longLocationMeet = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172644783"){$acceptAmount = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172753329"){$imagesPayLocation = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172753330"){$imagesPayMeet = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172810420"){$promiseDate = $dataresult['ANSWER'];}
										if($quest == "MS_Q20190226172818070"){$result = $dataresult['ANSWER'];}
									}	
								}else{
									$meetup="";
									$customerPay="";
									$acceptAmount="";
									$promiseDate="";
								}
							
					?>
                    <tr>
					  <td style="vertical-align:middle;text-align:center;"><?php echo $no;?></td>
                      <td style="vertical-align:middle;"><?php echo $data['CONTRACT_ID'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['EMP_NAME'];?></td>
					  <td style="vertical-align:middle;"><?php echo $data['NAMA_KOSTUMER'];?></td>
                      <td style="vertical-align:middle;text-align:right">Rp. <?php echo number_format($data['TOTAL_TAGIHAN'],0,',','.');?></td>
					  <td style="vertical-align:middle;text-align:center">
							<?php
								if($meetup == "Ya, bertemu dengan customer"){
									if($promiseDate <> NULL || $promiseDate <> ""){
										echo'<span class="badge badge-pill badge-success">Customer Janji bayar</span>';
									}else if($customerPay == "Ya"){
										echo'<span class="badge badge-pill badge-primary">Customer membayar</span>';
									}else{
										echo"aaa";
									}
								}else if($meetup == "Tidak, bertemu dengan orang lain"){
									if($promiseDate <> NULL || $promiseDate <> ""){
										echo'<span class="badge badge-pill badge-success">Customer Janji bayar</span>';
									}else if($customerPay == "Ya"){
										echo'<span class="badge badge-pill badge-primary">Customer membayar</span>';
									}else{
										echo"aaa";
									}
								}else if($meetup == "Tidak bertemu siapapun"){
									echo'<span class="badge badge-pill badge-danger">Tidak bertemu dengan siapapun</span>';
								}
							?>
					  </td>
					  <td style="vertical-align:middle;text-align:center"><?php echo $data['CREATE_DATE']->format('Y-m-d H:i:s');?></td>
					  <td style="vertical-align:middle;text-align:center"><?php echo  $data['UPLOAD_DATE']->format('Y-m-d H:i:s');?></td>
					  <td style="vertical-align:middle;text-align:center">
						<a href="index.php?page=result-detail&contractID=<?php echo $data['CONTRACT_ID'];?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Detail</a>
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
 
	

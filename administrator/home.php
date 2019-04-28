<?php
	ini_set('memory_limit','256M'); // This also needs to be increased in some cases. Can be changed to a higher value as per need)
	ini_set('sqlsrv.ClientBufferMaxKBSize','524288'); // Setting to 512M
	ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288'); // Setting to 512M - for pdo_sqlsrv
   /*
	//total ARO
	$queryARO = "{call SP_GET_ARO(?)}";
	$optionsARO =  array( "Scrollable" => "buffered" );
	$paramsARO = array(array($bid, SQLSRV_PARAM_IN));  
	$execARO = sqlsrv_query( $conn, $queryARO, $paramsARO, $optionsARO) or die( print_r( sqlsrv_errors(), true));
	$numrowsARO = sqlsrv_num_rows($execARO);
	
	//total DKH yang belum di approve
	$queryTotalDKH = "{call SP_GET_TOTAL_APPROVAL_DKH(?)}";
	$optionsTotalDKH =  array( "Scrollable" => "buffered" );
	$paramsTotalDKH = array(array($bid, SQLSRV_PARAM_IN));  
	$execTotalDKH = sqlsrv_query( $conn, $queryTotalDKH, $paramsTotalDKH, $optionsTotalDKH) or die( print_r( sqlsrv_errors(), true));
	$numrowsTotalDKH = sqlsrv_num_rows($execTotalDKH);
	
	//total customer
	$queryTotalCustomer = "{call SP_GET_CUSTOMER_DISTRIBUTION(?)}";
	$paramsTotalCustomer = array(array($bid, SQLSRV_PARAM_IN));  
	$optionsTotalCustomer =  array( "Scrollable" => "buffered" );
	$execTotalCustomer = sqlsrv_query( $conn, $queryTotalCustomer, $paramsTotalCustomer, $optionsTotalCustomer) or die( print_r( sqlsrv_errors(), true));
	$numrowsTotalCustomer = sqlsrv_num_rows($execTotalCustomer);
	
	//total visit result
	$queryTotalResult = "{call SP_GET_TOTAL_RESULT(?)}";
	$paramsTotalResult = array(array($bid, SQLSRV_PARAM_IN));  
	$optionsTotalResult =  array( "Scrollable" => "buffered" );
	$execTotalResult = sqlsrv_query( $conn, $queryTotalResult, $paramsTotalResult, $optionsTotalResult) or die( print_r( sqlsrv_errors(), true));
	$numrowsTotalResult = sqlsrv_num_rows($execTotalResult);
	
	*/
	
	$queryTotalResult = "{call DASHBOARD_COUNT_DATA(?,?)}";
	$paramsTotalResult = array(array($bid, SQLSRV_PARAM_IN),
							   array($data1['PERIOD'], SQLSRV_PARAM_IN));  
	$execTotalResult = sqlsrv_query( $conn, $queryTotalResult, $paramsTotalResult) or die( print_r( sqlsrv_errors(), true));
	$data2 = sqlsrv_fetch_array( $execTotalResult, SQLSRV_FETCH_ASSOC);

?>
<script src="vendor/highchart/jquery-3.1.1.min.js"></script>
<script src="vendor/highchart/highcharts.js"></script>
<script src="vendor/highchart/highcharts-more.js"></script>
<script src="vendor/highchart/modules/exporting.js"></script>
<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body" style="padding-bottom:0px;">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">AR Officer in Branch</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data2['TOTAL_ARO'];?> AR Officer</div>
						&nbsp;</br>
						&nbsp;</br>
						&nbsp;</br>
					</div>
					<div class="col-auto">
						<i class="fas fa-users fa-2x text-gray-300"></i>
					</div>
				</div>
				<hr>
				<a href="index.php?page=list-aro" style="font-size:12px;text-decoration:none;">See Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Customer is Collectible in Branch</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data2['TOTAL_CUST_AVAIL_COLLECT'];?> / <?php echo $data2['TOTAL_CUST'];?> Customers</div>
						<div style="font-size:12px;" class="font-weight-bold text-gray-600"><?php echo $data2['TOTAL_CUST'];?> Total Customer</div>
						<div style="font-size:12px;" class="font-weight-bold text-gray-600"><?php echo $data2['TOTAL_CUST_AVAIL_COLLECT'];?> is Collectible</div>
						<div style="font-size:12px;" class="font-weight-bold text-gray-600"><?php echo $data2['TOTAL_CUST']-$data2['TOTAL_CUST_AVAIL_COLLECT'];?> is Non-Collectible</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-user fa-2x text-gray-300"></i>
					</div>
				</div>
				<hr>
				<a href="index.php?page=list-customer" style="font-size:12px;text-decoration:none;">See Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Daftar Kunjungan Harian</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data2['TOTAL_DKH'];?> DKH</div>
						<div style="font-size:12px;" class="font-weight-bold text-gray-600"><?php echo $data2['TOTAL_DKH_APV'];?> Approve</div>
						<div style="font-size:12px;" class="font-weight-bold text-gray-600"><?php echo $data2['TOTAL_DKH_APV_YET'];?> Not Approve Yet</div>
						&nbsp;</br>
					</div>
					<div class="col-auto">
						<i class="fas fa-edit fa-2x text-gray-300"></i>
					</div>
				</div>
				<hr>
				<a href="index.php?page=collector-assignment" style="font-size:12px;text-decoration:none;">See Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Visit Result</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data2['TOTAL_CUST_VISIT'];?> Visit Result</div>
						<div style="font-size:12px;" class="font-weight-bold text-gray-600"><?php echo $data2['TOTAL_CUST_VISIT_JANJIBYR']?> Promise</div>
						<div style="font-size:12px;" class="font-weight-bold text-gray-600"><?php echo $data2['TOTAL_CUST_VISIT_BYR'];?> Paid</div>
						<div style="font-size:12px;" class="font-weight-bold text-gray-600"><?php echo $data2['TOTAL_CUST_VISIT_NOTPAID'];?> Non Paid</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-th-large fa-2x text-gray-300"></i>
					</div>
				</div>
				<hr>
				<a href="index.php?page=visit-result" style="font-size:12px;text-decoration:none;">See Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
</div>
<!--
<div class="row">
	<div class="col-md-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Hasil Kunjungan</h6>
			</div>
			<div class="card-body">
				<div class="chart-area">
					<div id="graphicResult" style="width:100%;height:100%;"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Compare</h6>
			</div>
			<div class="card-body">
				<div class="chart-area">
					<div id="graphicCompare" style="width:100%;height:100%;"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Customer Distribution</h6>
			</div>
			<div class="card-body">
				<div class="chart-area">
					<canvas id="myAreaChart"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>-->
<script type="text/javascript">
$(document).ready(function() {	
	var chart = Highcharts.chart('graphicResult', {
		credits: {
		 enabled: false
		},
		exporting: { 
			enabled: false 
		},
		title: {
			text: 'Hasil Kunjungan'
		},
		subtitle: {
			text: ''
		},
		xAxis: {
			categories: ['Customer membayar', 'Customer janji bayar', 'Customer tidak ada']
		},
		series: [{
			type: 'column',
			colorByPoint: true,
			data: [1, 2, 1],
			showInLegend: false
		}]
	});
	
	
	var chart = Highcharts.chart('graphicCompare', {
		chart: {
			type: 'column'
		},
		credits: {
		 enabled: false
		},
		exporting: { 
			enabled: false 
		},
		title: {
			text: 'Perbandingan 3 bulan terakhir'
		},
		subtitle: {
			text: 'Perbandingan customer menunggak dan tidak menunggak'
		},
		legend: {
			align: 'right',
			verticalAlign: 'middle',
			layout: 'vertical'
		},
		xAxis: {
			categories: ['Januari 2019', 'February 2019', 'March 2019'],
			labels: {
				x: -10
			}
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Values'
			}
		},
		series: [{
			name: 'Customer Arrears',
			data: [1, 4, 3]
		}, {
			name: 'Customer not Arrears',
			data: [6, 4, 2]
		}],
		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					legend: {
						align: 'center',
						verticalAlign: 'bottom',
						layout: 'horizontal'
					},
					yAxis: {
						labels: {
							align: 'left',
							x: 0,
							y: -5
						},
						title: {
							text: null
						}
					},
					subtitle: {
						text: null
					},
					credits: {
						enabled: false
					}
				}
			}]
		}
	});
});
</script>



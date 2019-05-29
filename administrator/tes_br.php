<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Mobile Collection - Administrator</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
  <link href="vendor/datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
	<script src="vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">
	<p>aaaaa</p>
	
	<?php
		require_once("../config/connection.php");
		
		$queryAro = "{call SP_GET_TOTAL_TASKLIST_ARO_SUMMARY_NEW(?,?)}";
		$paramsAro = array(array('1502', SQLSRV_PARAM_IN),array('20190501', SQLSRV_PARAM_IN));
		$execAro = sqlsrv_query( $conn, $queryAro, $paramsAro) or die( print_r( sqlsrv_errors(), true));
		
	?>
	
	
	<table class="table table-bordered" id="dataTables" width="100%" cellspacing="0" style="font-size:12px;">
		<thead>
			<tr>
				<th style="text-align:center;vertical-align:middle;">No</th>
				<th style="text-align:center;vertical-align:middle;">Collector Name</th>
				<th style="text-align:center;vertical-align:middle;">Total Account</th>
				<th style="text-align:center;vertical-align:middle;">Total yang sudah dikunjungi</th>
				<th style="text-align:center;vertical-align:middle;">Target</th>
				<th style="text-align:center;vertical-align:middle;">Total amount yang didapat</th>
				<th style="text-align:center;vertical-align:middle;">Period</th>
				<th style="vertical-align:middle;text-align:center;">ACTION</th>
			</tr>
		</thead>
		<tbody>
			<?php
					$no=0;
					while($dataAro = sqlsrv_fetch_array($execAro)){
					$no++;
				?>
			<tr>
				<td style="text-align:center;vertical-align:middle;"><?php echo $no;?></td>
				<td style="text-align:left;vertical-align:middle;"><?php echo $dataAro['EMP_NAME'];?></td>
				<td style="text-align:center;vertical-align:middle;"><?php echo $dataAro['TOTAL'];?></td>
				<td style="text-align:center;vertical-align:middle;"><?php echo $dataAro['TOTAL_VISIT'];?></td>
				<td style="text-align:right;vertical-align:middle;">Rp. <?php echo number_format($dataAro['TOTAL_TAGIHAN'],0,',','.');?></td>
				<td style="text-align:right;vertical-align:middle;">Rp. <?php echo number_format($dataAro['TOTAL_BAYAR'],0,',','.');?></td>
				<td style="text-align:center;vertical-align:middle;"><?php echo $dataAro['PERIOD'];?></td>
			   <td style="vertical-align:middle;text-align:center;">
				<a href="index.php?page=detail-summary&id=<?php echo $dataAro['EmployeeID'];?>&per=<?php echo $dataAro['PERIOD'];?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Detail</a>
			  </td>
			</tr>
			<?php }?>										
		</tbody>
	</table>
	
	
</body>
</html>
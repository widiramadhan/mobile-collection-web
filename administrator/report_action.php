<script src="vendors/jquery/dist/jquery.min.js"></script>
<link rel="stylesheet" href="vendors/sweetalert/sweetalert.min.css">
<script src="vendors/sweetalert/sweetalert.min.js"></script>
<?php
require_once("../config/connection.php");
$action = $_GET['action'];
if($action == 'export-aro'){
	require_once "vendor/PHPExcel/Classes/PHPExcel.php"; 
	date_default_timezone_set("Asia/Jakarta");
	$branch=$_POST['branch'];
	$period=str_replace("-","", $_POST['tgl'])."01";
	
	$date=date('Ymd');
	$time=date('His');
	$datetime=date("ymdHis");
	$title="SFItransaction_".$datetime;
	/*start - BLOCK PROPERTIES FILE EXCEL*/
		$file = new PHPExcel ();
		$file->getProperties ()->setCreator ( "Suzuki Finance" );
		$file->getProperties ()->setLastModifiedBy ( "Suzuki Finance" );
		$file->getProperties ()->setTitle ( $title );
		$file->getProperties ()->setSubject ( "" );
		$file->getProperties ()->setDescription ( "" );
		$file->getProperties ()->setKeywords ( "" );
		$file->getProperties ()->setCategory ( "" );
	/*end - BLOCK PROPERTIES FILE EXCEL*/
	 
	/*start - BLOCK SETUP SHEET*/
		$file->createSheet ( NULL,0);
		$file->setActiveSheetIndex ( 0 );
		$sheet = $file->getActiveSheet ( 0 );
		//memberikan title pada sheet
		$sheet->setTitle ( $title );
	/*end - BLOCK SETUP SHEET*/
	 
	/*start - BLOCK HEADER*/
		$sheet	->setCellValue ( "A1", "NO" )
			->setCellValue ( "B1", "BRANCH ID" )
			->setCellValue ( "C1", "NIK" )
			->setCellValue ( "D1", "NAMA OFFICER" )
			->setCellValue ( "E1", "TOTAL ACCOUNT" )
			->setCellValue ( "F1", "TOTAL VISIT" )
			->setCellValue ( "G1", "TOTAL TAGIHAN" )
			->setCellValue ( "H1", "TOTAL BAYAR" )
			/*->setCellValue ( "I1", "ZIPCODE" )
			->setCellValue ( "J1", "ZIPCODE" )
			->setCellValue ( "K1", "TELP 1" )
			->setCellValue ( "L1", "TELP 2" )
			->setCellValue ( "M1", "EMAIL" )
			->setCellValue ( "N1", "PRODUCT" )
			->setCellValue ( "O1", "ORDER DATE" )*/;
	/*end - BLOCK HEADER*/
	 
	/* start - BLOCK MEMASUKAN DATABASE*/
		$config_serverName2 = '172.16.0.233\SFI_DWH_INSTANCE';
		$config_db2 = 'MOBILE_COLLECTION';
		$config_uid2 = 'sa';
		$config_pwd2 = 'user.100';
		$connectionInfo2 = array( "Database"=>$config_db2, "UID"=>$config_uid2, "PWD"=>$config_pwd2 );
		$conn2 = sqlsrv_connect($config_serverName2, $connectionInfo2);
		
		ini_set('max_execution_time', 0);
		//echo ini_get('max_execution_time');
		
		$callSP = "{call SP_GET_REPORT_ARO(?,?)}"; 
		$parameter = array(
					array($branch, SQLSRV_PARAM_IN),
					array($period, SQLSRV_PARAM_IN)
				);
		$exec = sqlsrv_query( $conn2, $callSP, $parameter) or die( print_r( sqlsrv_errors(), true));

		$nomor=1;
		$no=0;
		while($row=sqlsrv_fetch_array($exec)){
			
			$nomor++;
			$no++;
			$sheet	->setCellValue ( "A".$nomor,  $no )
				->setCellValue ( "B".$nomor,  $row['BranchID'] )
				->setCellValue ( "C".$nomor,  $row['EmployeeID'] )
				->setCellValue ( "D".$nomor,  $row['EMP_NAME'] )
				->setCellValue ( "E".$nomor,  $row['TOTAL'] )
				->setCellValue ( "F".$nomor,  $row['TOTAL_VISIT'] )
				->setCellValue ( "G".$nomor,  $row['TOTAL_TAGIHAN'] )
				->setCellValue ( "H".$nomor,  $row['TOTAL_BAYAR'] )
				/*->setCellValue ( "I".$nomor,  $row['KELURAHAN'] )
				->setCellValue ( "J".$nomor,  $row['ZIPCODE'] )
				->setCellValue ( "K".$nomor,  $row['TELP1'] )
				->setCellValue ( "L".$nomor,  $row['TELP2'] )
				->setCellValue ( "M".$nomor,  $row['EMAIL'] )
				->setCellValue ( "N".$nomor,  $row['UNIT'] )
				->setCellValue ( "O".$nomor,  $row['DTM_CRT']->format('Y-m-d H:i:s') )*/;
		}
	/* end - BLOCK MEMASUKAN DATABASE*/

	/*start - BLOK AUTOSIZE*/
		$sheet ->getColumnDimension ( "A" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "B" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "C" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "D" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "E" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "F" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "G" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "H" )->setAutoSize ( true );
		/*$sheet ->getColumnDimension ( "I" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "I" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "J" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "K" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "L" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "M" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "N" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "O" )->setAutoSize ( true );*/
	/*end - BLOG AUTOSIZE*/
	 
	/* start - BLOCK MEMBUAT LINK DOWNLOAD*/
		ob_end_clean();
		header ( 'Content-Type: application/vnd.ms-excel' );
		//namanya adalah Data Order.xls
		header ( 'Content-Disposition: attachment;filename="'.$title.'.xls"' ); 
		header ( 'Cache-Control: max-age=0' );
		$writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel5' );
		$writer->save ( 'php://output' );
		//ob_end_clean();
	/* start - BLOCK MEMBUAT LINK DOWNLOAD*/
}
if($action == 'export-transaksi'){
	require_once "vendor/PHPExcel/Classes/PHPExcel.php"; 
	date_default_timezone_set("Asia/Jakarta");
	$branch=$_POST['branch'];
	$startPeriod=str_replace("-","", $_POST['startPeriod'])."01";
	$endPeriod=str_replace("-","", $_POST['endPeriod'])."01";
	$office=$_POST['office'];
	
	$date=date('Ymd');
	$time=date('His');
	$datetime=date("ymdHis");
	$title="SFItransaction_".$datetime;
	/*start - BLOCK PROPERTIES FILE EXCEL*/
		$file = new PHPExcel ();
		$file->getProperties ()->setCreator ( "Suzuki Finance" );
		$file->getProperties ()->setLastModifiedBy ( "Suzuki Finance" );
		$file->getProperties ()->setTitle ( $title );
		$file->getProperties ()->setSubject ( "" );
		$file->getProperties ()->setDescription ( "" );
		$file->getProperties ()->setKeywords ( "" );
		$file->getProperties ()->setCategory ( "" );
	/*end - BLOCK PROPERTIES FILE EXCEL*/
	 
	/*start - BLOCK SETUP SHEET*/
		$file->createSheet ( NULL,0);
		$file->setActiveSheetIndex ( 0 );
		$sheet = $file->getActiveSheet ( 0 );
		//memberikan title pada sheet
		$sheet->setTitle ( $title );
	/*end - BLOCK SETUP SHEET*/
	 
	/*start - BLOCK HEADER*/
		$sheet	->setCellValue ( "A1", "NO" )
			->setCellValue ( "B1", "NAMA BRANCH" )
			->setCellValue ( "C1", "CONTRACT ID" )
			->setCellValue ( "D1", "NAMA KOSTUMER" )
			->setCellValue ( "E1", "NIK" )
			->setCellValue ( "F1", "OFFICER NAME" )
			->setCellValue ( "G1", "TOTAL TAGIHAN" )
			->setCellValue ( "H1", "TANGGAL UPLOAD" )
			->setCellValue ( "I1", "PERIOD" )
			->setCellValue ( "J1", "STATUS" )
			/*->setCellValue ( "J1", "ZIPCODE" )
			->setCellValue ( "K1", "TELP 1" )
			->setCellValue ( "L1", "TELP 2" )
			->setCellValue ( "M1", "EMAIL" )
			->setCellValue ( "N1", "PRODUCT" )
			->setCellValue ( "O1", "ORDER DATE" )*/;
	/*end - BLOCK HEADER*/
	 
	/* start - BLOCK MEMASUKAN DATABASE*/
		$config_serverName2 = '172.16.0.233\SFI_DWH_INSTANCE';
		$config_db2 = 'MOBILE_COLLECTION';
		$config_uid2 = 'sa';
		$config_pwd2 = 'user.100';
		$connectionInfo2 = array( "Database"=>$config_db2, "UID"=>$config_uid2, "PWD"=>$config_pwd2 );
		$conn2 = sqlsrv_connect($config_serverName2, $connectionInfo2);
		
		ini_set('max_execution_time', 0);
		//echo ini_get('max_execution_time');
		
		$callSP = "{call SP_GET_REPORT_TRANSACTION(?,?,?)}"; 
		$parameter = array(
					array($branch, SQLSRV_PARAM_IN),
					array($startPeriod, SQLSRV_PARAM_IN),
					array($endPeriod, SQLSRV_PARAM_IN)
				);
				/*var_dump($parameter);
				exit();*/
		$exec = sqlsrv_query( $conn2, $callSP, $parameter) or die( print_r( sqlsrv_errors(), true));

		$nomor=1;
		$no=0;
		while($row=sqlsrv_fetch_array($exec)){
			$nomor++;
			$no++;
			$status="";
			if($row['STATUS'] == 1){
				$status="Customer Membayar";
			}else if($row['STATUS'] == 2){
				$status="Janji Bayar";
			}else if($row['STATUS'] == 3){
				$status="Tidak Bertemu";
			}else{
				$status="Belum Dikunjungi";
			}
			$sheet	->setCellValue ( "A".$nomor,  $no )
				->setCellValue ( "B".$nomor,  $office )
				->setCellValue ( "C".$nomor,  $row['CONTRACT_ID'] )
				->setCellValue ( "D".$nomor,  $row['NAMA_KOSTUMER'] )
				->setCellValue ( "E".$nomor,  $row['EMP_ID'] )
				->setCellValue ( "F".$nomor,  $row['EMP_NAME'] )
				->setCellValue ( "G".$nomor,  $row['TOTAL_TAGIHAN'] )
				->setCellValue ( "H".$nomor,  $row['UPLOAD_DATE'] )
				->setCellValue ( "I".$nomor,  $row['PERIOD'] )
				->setCellValue ( "J".$nomor,  $status)
				/*->setCellValue ( "J".$nomor,  $row['ZIPCODE'] )
				->setCellValue ( "K".$nomor,  $row['TELP1'] )
				->setCellValue ( "L".$nomor,  $row['TELP2'] )
				->setCellValue ( "M".$nomor,  $row['EMAIL'] )
				->setCellValue ( "N".$nomor,  $row['UNIT'] )
				->setCellValue ( "O".$nomor,  $row['DTM_CRT']->format('Y-m-d H:i:s') )*/;
		}
	/* end - BLOCK MEMASUKAN DATABASE*/

	/*start - BLOK AUTOSIZE*/
		$sheet ->getColumnDimension ( "A" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "B" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "C" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "D" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "E" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "F" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "G" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "H" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "I" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "J" )->setAutoSize ( true );
		/*$sheet ->getColumnDimension ( "K" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "L" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "M" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "N" )->setAutoSize ( true );
		$sheet ->getColumnDimension ( "O" )->setAutoSize ( true );*/
	/*end - BLOG AUTOSIZE*/
	 
	/* start - BLOCK MEMBUAT LINK DOWNLOAD*/
		ob_end_clean();
		header ( 'Content-Type: application/vnd.ms-excel' );
		//namanya adalah Data Order.xls
		header ( 'Content-Disposition: attachment;filename="'.$title.'.xls"' ); 
		header ( 'Cache-Control: max-age=0' );
		$writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel5' );
		$writer->save ( 'php://output' );
		//ob_end_clean();
	/* start - BLOCK MEMBUAT LINK DOWNLOAD*/
}
?>
<?php
	$contractID=$_GET['contractID'];
	$queryCust = "{call SP_GET_DETAIL_CUSTOMER_RESULT(?)}";
	$paramsCust = array(array($contractID, SQLSRV_PARAM_IN)); 
	$execCust = sqlsrv_query( $conn, $queryCust, $paramsCust) or die( print_r( sqlsrv_errors(), true));
	$row = sqlsrv_fetch_array($execCust);
?>
<script src="vendor/jquery/jquery.min.js"></script>
<div class="col-md-12" style="font-size:12px;">
	<div class="row">
		<div class="col-md-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Data Customer</h6>
				</div>
				<div class="card-body">
					<center>
						<img src="assets/img/default-user.png" style="border-radius:50%;width:100px;height:100px;"><br><br>
						<span style="color:#000;font-weight:bold;"><?php echo $row['NAMA_KOSTUMER'];?></span><br>
						<?php echo $contractID;?>
					</center>
					<hr>
					<b>Address :</b><br>
					<label><?php echo $row['ALAMAT_KTP'];?></label>
					<hr>
					<b>Phone Number :</b><br>
					<label><?php echo $row['NOMOR_HANDPHONE'];?></label>
					<hr>
					<b>Total Tagihan :</b><br>
					<label>Rp. <?php echo number_format($row['TOTAL_TAGIHAN'],0,',','.');?></label>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Detail Kunjungan</h6>
				</div>
				<div class="card-body">
					<?php
						$queryResult = "{call SP_GET_RESULT(?,?)}";
						$paramsResult = array(array($bid, SQLSRV_PARAM_IN),array($row['NOMOR_KONTRAK'], SQLSRV_PARAM_IN));  
						$optionsResult =  array( "Scrollable" => "buffered" );
						$execResult = sqlsrv_query( $conn, $queryResult, $paramsResult, $optionsResult) or die( print_r( sqlsrv_errors(), true));
						$numrowsResult=sqlsrv_num_rows($execResult);
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
					?>
					<div id="meetup">
						<b>Apakah bertemu dengan customer ?</b><br>
						<?php echo $meetup;?>
						<hr>
					</div>
					<div id="contactPerson">
						<b>Nama Kontak Person</b><br>
						<?php echo $contactPerson;?>
						<hr>
					</div>
					<div id="hubunganKontak">
						<b>Hubungan Kontak Person dengan Kostumer</b><br>
						<?php echo $hubunganKontak;?>
						<hr>
					</div>
					<div id="addres">
						<b>Alamat yang dikunjungi</b><br>
						<?php echo $addres;?>
						<hr>
					</div>
					<div id="addresQuestion">
						<b>Apakah alamat berubah ?</b><br>
						<?php echo $addresQuestion;?>
						<hr>
					</div>
					<div id="addresNew">
						<b>Alamat Baru</b><br>
						<?php echo $addresNew;?>
						<hr>
					</div>
					<div id="unit">
						<b>Apakah unit ada ?</b><br>
						<?php echo $unit;?>
						<hr>
					</div>
					<div id="customerPay">
						<b>Apakah Kostumer Membayar ?</b><br>
						<?php echo $customerPay;?>
						<hr>
					</div>
					<div id="lokasiPembayaran">
						<b>Lokasi Pembayaran</b><br>
						<?php echo $latPayLocation;?>, <?php echo $longPayLocation;?>
						<hr>
					</div>
					<div id="fotoLokasiPembayaran">
						<b>Foto Lokasi Pembayaran</b><br>
						<?php echo $meetup;?>
						<hr>
					</div>
					<div id="lokasi">
						<b>Lokasi</b><br>
						<?php echo $latLocationMeet;?>, <?php echo $longLocationMeet;?>
						<hr>
					</div>
					<div id="foto">
						<b>Foto Lokasi</b><br>
						<?php echo $meetup;?>
						<hr>
					</div>
					<div id="acceptAmount">
						<b>Pembayaran yang diterima</b><br>
						Rp. <?php echo number_format($acceptAmount,0,',','.');?>
						<hr>
					</div>
					<div id="promiseDate">
						<b>Tanggal Janji Bayar</b><br>
						<?php echo $promiseDate;?>
						<hr>
					</div>
					<div id="result">
						<b>Hasil Kunjungan</b><br>
						<?php echo $result;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
var meetup = "<?php echo $meetup;?>";
var addresQuestion = "<?php echo $addresQuestion;?>";
var customerPay = "<?php echo $customerPay;?>";

if(meetup == 'Ya, bertemu dengan customer'){
	document.getElementById('contactPerson').style.display='none';
	document.getElementById('hubunganKontak').style.display='none';
}else if(meetup == 'Tidak, bertemu dengan orang lain'){
	document.getElementById('contactPerson').style.display='block';
	document.getElementById('hubunganKontak').style.display='block';
}else if(meetup == 'Tidak bertemu siapapun'){
	document.getElementById('contactPerson').style.display='none';
	document.getElementById('hubunganKontak').style.display='none';
	document.getElementById('addres').style.display='none';
	document.getElementById('addresQuestion').style.display='none';
	document.getElementById('addresNew').style.display='none';
	document.getElementById('unit').style.display='none';
	document.getElementById('customerPay').style.display='none';
	document.getElementById('lokasiPembayaran').style.display='none';
	document.getElementById('fotoLokasiPembayaran').style.display='none';
	document.getElementById('acceptAmount').style.display='none';
	document.getElementById('promiseDate').style.display='none';
}

if(addresQuestion == "Ya"){
	document.getElementById('addresNew').style.display='block';
}else if(addresQuestion == "Tidak"){
	document.getElementById('addresNew').style.display='none';
}else{
	document.getElementById('addresNew').style.display='none';
}

if(customerPay =="Ya"){
	document.getElementById('lokasiPembayaran').style.display='block';
	document.getElementById('fotoLokasiPembayaran').style.display='block';
	document.getElementById('acceptAmount').style.display='block';
	document.getElementById('lokasi').style.display='none';
	document.getElementById('foto').style.display='none';
	document.getElementById('promiseDate').style.display='none';
}else if (customerPay == "Tidak"){
	document.getElementById('lokasiPembayaran').style.display='none';
	document.getElementById('fotoLokasiPembayaran').style.display='none';
	document.getElementById('acceptAmount').style.display='none';
	document.getElementById('lokasi').style.display='block';
	document.getElementById('foto').style.display='block';
	document.getElementById('promiseDate').style.display='block';
}
</script>
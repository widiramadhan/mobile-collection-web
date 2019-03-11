<?php

$config_serverName = '172.16.1.172';
$config_db = 'MOBILE_COLLECTION';
$config_uid = 'sa';
$config_pwd = 'P@ssw0rd';

/*
$config_serverName = '172.16.0.233\SFI_DWH_INSTANCE';
$config_db = 'SFI_BI';
$config_uid = 'sa';
$config_pwd = 'user.100';*/

$connectionInfo = array( "Database"=>$config_db, "UID"=>$config_uid, "PWD"=>$config_pwd );

$conn = sqlsrv_connect($config_serverName, $connectionInfo);


 /*if( $conn ) {
      echo "<script>alert('Connection Success.')</script>";
 }else{
      echo "<script>alert('Connection Fail.')</script>";
      die( print_r( sqlsrv_errors(), true));
 }*/

?> 


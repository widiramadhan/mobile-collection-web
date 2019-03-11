<link rel="stylesheet" href="vendors/sweetalert/sweetalert.min.css">
<script src="vendors/jquery/jquery.min.js"></script>
<script src="vendors/sweetalert/sweetalert.min.js"></script>
<?php
session_start();
require_once("../config/connection.php");
require_once ("../config/injection.php");

$username=filter_str($_POST['username']);
$password=filter_str($_POST['password']);
$encrypt= md5($password);

$tsql_callSP = "{call SP_LOGIN_CHECK(?,?)}"; 
$params = array(   
			  array($username, SQLSRV_PARAM_IN),
			  array($encrypt, SQLSRV_PARAM_IN)
			);  
$options =  array( "Scrollable" => "buffered" );
$stmt = sqlsrv_query( $conn, $tsql_callSP, $params, $options) or die( print_r( sqlsrv_errors(), true)); 
$check=sqlsrv_num_rows($stmt);
$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);	

if($check > 0){
	$_SESSION['username_cuser'] = $row['USERNAME'];
	echo"<script>window.location='employee-position.php'</script>";
}else{		
	echo '<script>
			setTimeout(function() {
				swal({
					title: "Ops.. Something Wrong!",
					text: "Invalid username or password",
					type: "error"
				}, function() {
					history.back();
				});
			}, 0);
		</script>';
}
?>
<script type="text/javascript">
document.addEventListener("contextmenu", function(e){
    e.preventDefault();
}, false);
document.onkeydown = function(e) {
if(event.keyCode == 123) {
	return false;
	}
	if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
	return false;
	}
	if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
	return false;
	}
	if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
	return false;
	}
	if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
	return false;
	}

	}
</script>
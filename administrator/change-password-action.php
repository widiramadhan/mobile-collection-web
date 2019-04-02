<script src="assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert/sweetalert.min.css">
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<?php
require_once("../config/connection.php");
$action = $_GET['action'];
if($action == 'change'){
	$newid = $_POST['newid'];
	$password_lama = $_POST['password_lama'];
	$konfrimasi_password = $_POST['konfrimasi_password'];
	$password_baru = $_POST['password_baru'];

	$password_lama	= md5($password_lama);
	$konfrimasi_password = md5($konfrimasi_password);
	$password_baru 	= md5($password_baru);
	

	$call = "{call SP_CHECK_PASSWORD(?,?)}"; 
	$param = array(array($newid, SQLSRV_PARAM_IN),array($password_lama, SQLSRV_PARAM_IN));
	$options =  array( "Scrollable" => "buffered" );
	$ex = sqlsrv_query($conn, $call, $param, $options) or die( print_r( sqlsrv_errors(), true));
	$ketemu = sqlsrv_num_rows($ex);


	if($ketemu > 0){
		if($password_baru != $konfrimasi_password){
			echo '<script>
					setTimeout(function() {
						swal({
							title: "Ops.. Something Wrong!",
							text: "Confirmation of password does not match the New Password",
							type: "error"
						}, function() {
							history.back();
						});
					}, 0);
				</script>';
		}else{
			//update dpassword
			$call2 = "{call SP_UPDATE_PASSWORD(?,?)}";
			$param2 = array(array($newid, SQLSRV_PARAM_IN),array($password_baru, SQLSRV_PARAM_IN));
			$ex2 = sqlsrv_query( $conn, $call2, $param2) or die( print_r( sqlsrv_errors(), true));
			if ($ex2) {
			echo '<script>
				setTimeout(function() {
					swal({
						title : "Update Success",
						text : "Successfully update password",
						type: "success",
						timer: 2000,
						showConfirmButton: false
					});  
				},10); 
					window.setTimeout(function(){ 
						window.location.replace("index.php");
					} ,3000); 
			  </script>';
			} else {
			 	echo '<script>
							setTimeout(function() {
								swal({
									title: "Ops.. Something Wrong!",
									text: "Failed to update password",
									type: "error"
							}, function() {
								history.back();
							});
						}, 0);
					</script>';
		}
	}
}else{
	echo '<script>
				setTimeout(function() {
					swal({
						title: "Ops.. Something Wrong!",
						text: "Invalid old password",
						type: "error"
					}, function() {
						history.back();
					});
				}, 0);
			</script>';
}
}
?>

<!--// 	if($execCheck=['PASSWORD'] == $password_konfrimasi){
// 					//jika semua kondisi sudah benar, maka melakukan update kedatabase
// 					//query UPDATE SET password = encrypt md5 password_baru
// 					//kondisi WHERE id user = session id pada saat login, maka yang di ubah hanya user dengan id tersebut
// 			$queryChange = "{call SP_UPDATE_PASSWORD(?,?)}"; 
// 			$parameterChange = array(
// 							array($newid, SQLSRV_PARAM_IN),
// 							array($password_baru, SQLSRV_PARAM_IN)
// 						);
// 			$execChange = sqlsrv_query( $conn, $queryChange, $parameterChange) or die( print_r( sqlsrv_errors(), true));
// 	if($execChange){
// 		echo '<script>
// 				setTimeout(function() {
// 					swal({
// 						title : "Success",
// 						text : "Successfully saved data",
// 						type: "success",
// 						timer: 2000,
// 						showConfirmButton: false
// 					});  
// 				},10); 
// 					window.setTimeout(function(){ 
// 						window.location.replace("index.php?page=promo");
// 					} ,2000); 
// 			  </script>';
// 	}else{
// 		echo '<script>
// 				setTimeout(function() {
// 					swal({
// 						title : "Error",
// 						text : "Failed saved data",
// 						type: "error",
// 						timer: 2000,
// 						showConfirmButton: false
// 					});  
// 				},10); 
// 					window.setTimeout(function(){ 
// 						history.back();
// 					} ,2000); 
// 			  </script>';
// 	}	
// }
// }
?>
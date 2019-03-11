<?php
session_start();
if(isset($_SESSION['username_cuser'])) {
	session_unset();
	session_destroy();
	echo"<script>window.location='login.php'</script>";
}else{
	echo"<script>window.location='login.php'</script>";
}
?>
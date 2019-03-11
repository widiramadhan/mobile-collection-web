<?php
session_start();
if(isset($_SESSION['username_cuser'])) {
   $sid=$_SESSION['username_cuser'];
   session_unset();
}else{
	$sid="";
}
if(isset($_SESSION['branch_cuser'])) {
	$bid=$_SESSION['branch_cuser'];
}else{
	$bid="";
}
if($sid && $bid){
	echo"<script>window.location='index.php'</script>";
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mobile Collection - Administrator</title>
    <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/sb-admin.css" rel="stylesheet">
</head>
<body class="bg" style="background-color:#EEE;">
    <div class="container">
		<br><br>
		<div class="card card-login mx-auto mt-5">
			<form action="checklogin.php" method="post">
				<div class="card-body">
					<center>
						<img src="assets/images/logo.png" style="margin-bottom:20px;">
						<h4>MOBILE COLLECTION</h4>
					</center>
					<br>
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
					</div>
					<div class="form-group">
						<input type="password"  name="password" class="form-control" placeholder="Password" required="required">   
					</div>
					<button type="submit" class="btn btn-danger" style="width:100%;border-radius:0px;">LOGIN</button>
				</div>
			</form>
		</div>
    </div>
<script src="vendors/jquery/jquery.min.js"></script>
<script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendors/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>
<?php } ?>
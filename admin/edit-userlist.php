<?php
require_once("config/connection.php");
$id=$_GET['id'];
?>
<div class="row">
<div class="card col-md-4 col-sm-4 col-xs-4">
 <div class="card-header">
              <h4><i class="fas fa-user" ></i><i class="fas fa-plus" ></i>
              Add User</h4></div>
            <div class="card-body">
			
			<form action="#" method="post" enctype="multipart/form-data" id="form">
				<label>Full Name <span class="mandatory" style="color:red">*</span></label>
				<input type="text" class="form-control" name="fullname" required />
				<br />
				
				<label>Username <span class="mandatory" style="color:red"> *</span></label>
				<input type="text" class="form-control" name="username" required />
				<br />
				
				<label>Password <span class="mandatory" style="color:red">*</span></label>
				<input type="text" class="form-control" name="password" required />
				<br />
				
				<label>Job<span class="mandatory" style="color:red"	>*</span></label>
				<input type="text" class="form-control" name="job" required />
				<br />
				
				<label>Branch<span class="mandatory" style="color:red"	>*</span></label>
				<input type="text" class="form-control" name="branch" required />
				<br />
				
				<label>IMEI<span class="mandatory" style="color:red"	>*</span></label>
				<input type="text" class="form-control" name="IMEI" required />
				<br />
			
				
				<hr />
				<button type="reset" class="btn btn-default pull-right">Clear</button>
				<button type="submit" name="submit" class="btn btn-primary pull-right">Submit</button>
			</form>
			</div>
</div>
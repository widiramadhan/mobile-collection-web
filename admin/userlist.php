<?php
require_once("config/connection.php");

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
				<select class="form-control" name="job" required />
				<option>--Pilih Job--</option>
				<option>Collector</option>
				</select>
				<br />
				
				<label>Branch<span class="mandatory" style="color:red"	>*</span></label>
				<select class="form-control" name="branch" required />
				<option>--Pilih Branch--</option>
				<option>SFI Pusat</option>
				<option>Makasar</option>
				</select>	
				
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
<div class="card col-md-8 col-sm-8 col-xs-8">
    <div class="card-header">
              <h4><i class="fas fa-user"></i><i class="fas fa-table"></i>
              Data User</h4></div>
            <div class="card-body">
			
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" id="datatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th style="vertical-align:middle;text-align:center;">NO</th>
                      <th style="vertical-align:middle;text-align:center;">NAME</th>
					  <th style="vertical-align:middle;text-align:center;">JOB</th>
					  <th style="vertical-align:middle;text-align:center;">BRANCH</th>  
                      <th style="vertical-align:middle;text-align:center;width:20%">Action</th>
                      </tr>
                  </thead>
                    <tbody>
					<?php
							$query = "{call SP_GET_USER}";
							$exec = sqlsrv_query( $conn, $query) or die( print_r( sqlsrv_errors(), true));
							$no = 0;
							while($data = sqlsrv_fetch_array($exec)){
								$no++
							
						?>
					
                    <tr>
					  <td style="vertical-align:middle;text-align:center;"><?php echo $no;?></td>
                      <td style="vertical-align:middle;"><?php echo $data['FULLNAME'];?></td>
					  <td style="vertical-align:middle;">Collector </td>
					  <td style="vertical-align:middle;">SFI Pusat</td>
                      <td style="vertical-align:middle;text-align:center;">
							<a href="index.php?page=tracking-collector-location&id=<?php echo $data['M_USER_ID'];?>">
							<button type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></button>
							</a>
					     	<a href="index.php?page=edit-userlist&id=<?php echo $data['M_USER_ID'];?>">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>	
					  </td>
			
                    </tr>
				<?php }?>					
						
  </tbody>
  
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div></div>
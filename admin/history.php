<?php
require_once("config/connection.php");
?>


<div class="col-md-12 col-sm-12 col-xs-12">	
<form action="search-collector" method="post">
<div class="float-right">
					
					<label style="margin-right:1000px;">&nbsp;Tanggal :</label>	
<div class="pull-right">
				<input type="date" class="input-append" name="tgl" id="tgl" value="Search Collector"  ></input>	
				
				<button type="submit" class="btn btn-success" name="submit" id="submit" style="margin-left:750px;" > <i class="fa fa-search"></i>	Search Collector</button>
			</div>					
						</div>
						<div class="form-group">
							<label>Collector Name :</label>	
							<select class="form-control" name="city" id="city" style="width: 200px" >
										<option value="%">- Pilih - </option>
										<option value="%">Agie Annan </option>
										<option value="%">Andre Taulah </option>
										<option value="%">Arif Tipu</option>
										<option value="%">Bagus Setiawan </option>

							</select>
							
							</div>
							
						
					</form>	
					
<div class="card mb-3">
            <div class="card-header">
              <h4><i class="fas fa-table"></i>
              Data Collector</h4></div>
            <div class="card-body">
			
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="vertical-align:middle;text-align:center;">Nama</th>
                      <th style="vertical-align:middle;text-align:center;">Alamat</th>
                      <th style="vertical-align:middle;text-align:center;">Telp</th>
                      <th style="vertical-align:middle;text-align:center;">Status</th>
                      <th style="vertical-align:middle;text-align:center;">Action</th>
                      </tr>
                  </thead>
                    <tbody>
                    <tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
				      <span class="badge badge-pill badge-success">Janji Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
                  <tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-danger">Tidak Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
				     <span class="badge badge-pill badge-warning">Bertemu Dengan Orangtua</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-primary">Sudah Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-primary">Sudah Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-primary">Sudah Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-primary">Sudah Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-primary">Sudah Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-primary">Sudah Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-primary">Sudah Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-primary">Sudah Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-primary">Sudah Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-primary">Sudah Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-primary">Sudah Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-primary">Sudah Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
					<tr>
                      <td style="vertical-align:middle;text-align:center;">Agie Annan</td>
                      <td style="vertical-align:middle;text-align:center;">Jl.Bersama no.10</td>
                      <td style="vertical-align:middle;text-align:center;">08129388844</td>
                      <td style="vertical-align:middle;text-align:center;">
					  <span class="badge badge-pill badge-primary">Sudah Bayar</span></td>
                      <td style="vertical-align:middle;text-align:center;">
					     	<a href="#">
							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
							</a>
							<a href="#" onclick="return confirm('Are you sure you want to delete this item?');">
							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							</a>
					  </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

          <p class="small text-center text-muted my-5">
            <em>More table examples coming soon...</em>
          </p>

        </div>
	
	
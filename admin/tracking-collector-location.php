<?php
require_once("config/connection.php");
$id=$_GET['id'];
?>


<div class="col-md-12 col-sm-12 col-xs-12">	
<form action="search-collector" method="post">
<div class="float-right">
						<input type="submit" class="btn theme-btn" name="submit" id="submit" value="Search Collector"  style="width:200px;margin-top:10px;height:40px;font-size:12px;padding:10px;"></button>	
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
              <h4><i class="fas fa-map-marker-alt" ></i>
              Maps</h4></div>
            <div class="card-body">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3335.4897668125045!2d106.90764414650549!3d-6.185831589145671!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4cd089cb6f3%3A0x6e4c4bc675dd19b!2sPT.+Suzuki+Finance+Indonesia+Head+Office!5e0!3m2!1sen!2sid!4v1548747279620" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
             
            </div>
</div>
<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
	<script>
	$(document).ready(function() {
		$('#dataTables').DataTable();
	} );
	</script>
 
	

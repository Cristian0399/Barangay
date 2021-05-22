<?php include 'header.php' ?>
<?php include'code.php' ?>

<div class="container">
   <div class="info">

   	<div class="text-center">
   		<h3>Admin Information</h3>
   	</div>	

   	<?php 
   		if (isset($_GET['adminid'])) {
   			$adminid = $_GET['adminid'];

   			$select = $dbcon->query("SELECT `adminid`, `admin_name`, `admin_email`, `admin_pass` FROM `tbladmin` WHERE adminid='$adminid'");

   			while ($row = $select->fetch_assoc()) {?>

   		<div class="flex-center margin-top-50">
			<div class="text-center">
	   		   <table class="table table-stripes">
	              <thead>
	                  <tr>
	                      <th>Admin Name</th>
						         
						  <th>Email</th>
						         
						  <th>Password</th>
						        
	                  </tr>
	              </thead>
	              <tbody> 
	           				<tr>
	                             <td><h4><?php echo $row['admin_name']; ?></h4></td>
	                             <td><h4><?php echo $row['admin_email']; ?></h4></td>
	                             <td> <h4><?php echo $row['admin_pass']; ?></h4></td>
	                             
	                          </tr>
	                </tbody>
	          </table>
    
		         <div class="text-right">
		          	<h4 class='col-md-6' style='padding: 0px'>
		          	   <a class="btn btn-info form-control" data-toggle="modal" data-target="#myModal" href="#">Edit Admin</a>
		           	</h4>

		           	<h4 class='col-md-6' style='padding: 0px'>
		           		<a class="btn btn-danger form-control" href="Staff.php">Go Back</a>
		           	</h4>
		        </div>
			</div>	        
		</div>
			       <div id="myModal" class="modal fade" role="dialog">
				      <div class="modal-dialog">

				        <!-- Modal content-->
				        <div class="modal-content">
				          <div class="modal-header">
				            <button type="button" class="close" data-dismiss="modal">&times;</button>
				            <h4 class="modal-title">Edit Admin</h4>
				          </div>
				          <div class="modal-body">
				              <div class="info">
				                <form method='POST' action='code.php'>
				                  <div class="col-md-6">
				                  			<input type="hidden" name="id" value="<?php echo  $row['adminid']; ?>">
								           <label>Admin Name</label>
								          	<input class="form-control" type='text' name='admin_name' placeholder='Enter name' required='' value='<?php echo $row['admin_name']; ?>'>

 											<label>Email</label>
								          	<input class="form-control" type='email' name='admin_email' placeholder='Enter your Email' required='' value='<?php echo $row['admin_email']; ?>'>

								          	<label>Password</label>
								          	<input class="form-control" type='password' name='admin_pass' placeholder='Enter your Password' required='' value='<?php echo $row['admin_pass']; ?>'>
								   </div>
				             

				                    <div class="text-right">
				                      <h4 class='col-md-6' style='padding: 0px'>
				                       <input class='btn btn-info form-control' type='submit' name='EditStaff' value'Add New Residents'>
				                       </h4>
				                    </div>
				                </form>
				              </div>

				          </div>
				          <div class="modal-footer">
				            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				          </div>
				        </div>

				      </div>
				    </div>

   			<?php	
   			}
   		}

   	?>
 </div>
</div>
 

<?php include 'footer.php' ?>
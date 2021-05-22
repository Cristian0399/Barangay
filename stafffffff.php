<?php include 'header.php' ?>
<?php include'code.php' ?>

<div class="container">
   <div class="info">

   	<div class="text-center">
   		<h3>Personal Information</h3>
   	</div>	

   	<?php 
   		if (isset($_GET['adminid'])) {
   			$id = $_GET['adminid'];

   			$select = $dbcon->query("SELECT * FROM tbladmin WHERE adminid = '$adminid' ");

   			while ($row = $select->fetch_assoc()) {?>

			    	<div class="col-md-2"></div>
			    	<div class="col-md-8">

					    <div class="col-md-6">

					          </div>

					           <label>Admin Name</label>
					           		<h4><?php echo $row['admin_name']; ?></h4>
					           <label>Email</label>
					           		<h4><?php echo $row['admin_email']; ?></h4>
					           <label>Password</label>
					           		<h4><?php echo $row['password']; ?></h4>
					      </div>
					      

					         <div class="text-right">
					          	<h4 class='col-md-6' style='padding: 0px'>
					          	   <a class="btn btn-info form-control" data-toggle="modal" data-target="#myModal" href="#">Edit Resident</a>
					           	</h4>

					           	<h4 class='col-md-6' style='padding: 0px'>
					           		<a class="btn btn-danger form-control" href="Staff.php">Go Back</a>
					           	</h4>
					        </div>

			    	</div>
			    	<div class="col-md-2"></div>

			       <div id="myModal" class="modal fade" role="dialog">
				      <div class="modal-dialog">

				        <!-- Modal content-->
				        <div class="modal-content">
				          <div class="modal-header">
				            <button type="button" class="close" data-dismiss="modal">&times;</button>
				            <h4 class="modal-title">Edit Resident</h4>
				          </div>
				          <div class="modal-body">
				              <div class="info">
				                <form method='POST' action='code.php'>
				                  <div class="col-md-6">

				                      <div class="camera text-center">

				                        <div class="picture" id="editpicture"></div>
				                        <div id="">
				                        	<input type='hidden' name='adminid' value='<?php echo $row['adminid']; ?>'>
				                        </div>
				  

				                      </div>
								           <label>Admin Name</label>
								          <input class="form-control" type='text' name='name' placeholder='Enter your name' required='' value='<?php echo $row['admin_name']; ?>'>

								          <label>Email</label>
								          <input class="form-control" type='email' name='email' placeholder='Enter your email' required='' value='<?php echo $row['admin_email']; ?>'>

								           <label>Password</label>
								          <input class="form-control" type='Password' name='password' placeholder='Enter your password' required='' value='<?php echo $row['password']; ?>'>
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
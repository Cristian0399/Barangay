<style>	
.staffinfo{
		display: flex;
		align-items: center;
		justify-content: center;
		padding-top: 50px;
	}
</style>
<?php include'header.php' ?>

<div class="container-fluid" id="banner">

<?php include'sidebar.php' ?>
	
<div class="col-md-10 right-section dash">
<?php include'babaw.php' ?>
      <div class="tittle-header">
          <h3 style="text-align: center;">Users Information</h3>
      </div>

      <div class="staffinfo">
      	 <div class="info g1">

		   	<div class="text-center">
		   		<h3 class="ai">Account Information</h3>
		   	</div>	

		   	<?php 
		   		include'database/db_connection.php';
		   		if (isset($_GET['adminid'])) {
		   			$adminid = $_GET['adminid'];

		   			$select = $dbcon->query("SELECT * FROM `tbladmin` WHERE adminid='$adminid'");

		   			while ($row = $select->fetch_assoc()) {?>

		   		<div class="flex-center margin-top-50">
					<div class="">
			   		   <table class="table table-stripes">
			                      <h4><b>Username:</b><input class='form-control' type='text' value='<?php echo $row['admin_name']; ?>' readonly></h4>
								  <h4><b>Email:</b><input class='form-control' type='text' value='<?php echo $row['admin_email']; ?>' readonly></h4>
								  <h4><b>Password:</b><input class='form-control' type='password' value='<?php echo $row['admin_pass']; ?>' readonly></h4>
				         <div class="text-center">
				         	 <?php  
				         	  $sess = $_SESSION['admin_name'];
				              $captain = mysqli_query($dbcon,"SELECT * FROM tbladmin WHERE admin_name = '$sess' ");
				              $row2 = mysqli_fetch_array($captain);
				              if ($row2['Role'] == "Captain") {?>
				              		<a href="Staff.php"><input class='btn btn-danger form-control' value="Go Back" style="position:relative;top:-2px;width:125px;left:0px;"></a>
				              	  	<a class="btn btn-primary residents" data-toggle="modal" data-target="#myModal" href="#" style="position:relative;top:-2px;width:125px;left:1px;">Edit</a>
				            <?php
				              }else{?>
				              		<a href="Staff.php"><input class='btn btn-danger form-control' value="Go Back" style="position:relative;top:-2px;width:125px"></a>
				            <?php 
				              }
				            ?>

		                  </div>
				        </div>	        
      	<!-- modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		      <!-- Modal content-->

		      <div class="modal-content modal-dialog modal-sm">
		        <div class="modal-header" style="background-color:black;color:white;">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h3>Manage Admin</h3>
		        </div>
		        <div class="modal-body" style="padding:18px;">
		            <form role="form" method="post" action="code.php">  
                        <fieldset>
                        <input type='hidden' name='adminid' value='<?php echo $_GET['adminid']; ?>'> 

                        	 <div class="form-group">
			                  <label>Admin Role:</label> 
			                    <select class="form-control" placeholder="Name" name="admin_role" type="text" autofocus>
			                    	<?php 
				                    	if ($row['Role'] == "Captain") {?>
			                      			<option>Captain</option>
			                      			<option>Employee</option>
				                    	<?php
				                    	}else{?>
				                    		<option>Employee</option>
				                    		<option>Captain</option>
				                    	<?php 
				                    	}
			                    	?>
			                     
			                    </select>
			                  </div>

                            <div class="form-group">
                            <label>Name:</label> 
                                <input class="form-control" name="admin_name" type="text" value="<?php echo $row['admin_name']; ?>">  
                            </div>

                            <div class="form-group">
                            <label>Email:</label> 
                                <input class="form-control" name="admin_email" type="text" value="<?php echo $row['admin_email']; ?>">  
                            </div> 

                            <div class="form-group">
                            <label>Password:</label>  
                                <input class="form-control" name="admin_pass" type="password" value="<?php echo $row['admin_pass']; ?>">  
                            </div>  

                            <!-- <input class="btn btn-lg btn-success btn-block" type="submit" value="submit" name="register" >   -->
                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="position:relative;top:-2pxpx;width:125px;left:2px;">Cancel</button>
                            <input class='btn btn-info form-control' type='submit' name='EditStaff' value'' style="position:relative;top:0px;width:125px;left: 7px;">
                        </fieldset>  
		            </form>
		        </div>  
		      </div>

		    </div>

		   			<?php	
		   			}
		   		}

		   	?>
		 </div>
<?php include'footer.php' ?>
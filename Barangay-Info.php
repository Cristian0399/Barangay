<?php include'header.php' ?>

<div style="padding: 0px;" class="container-fluid" id="banner">

<?php include'sidebar.php' ?>
	
<div class="col-md-10 right-section dash">
<?php include'babaw.php' ?>
  <div class="tittle-header">
      <h3 style="text-align: center;font-size: 30px">Barangay Information</h3>
       <div class="text-right adminauth">
  	  	<h2 class='text-admin'>Welcome: <a style='font-family: Lucida Fax; color: black; text-decoration: none;' href=""><?php echo$_SESSION['admin_name'];?></a></h2>
  	  </div>
  </div><br>
  <div class="text-center">
  <a href="BarangayOfficials.php" class="btn btn-info">Show Barangay Officials</a>
  <a href="SkOfficials.php" class="btn btn-info">Show Barangay SK Officials</a>
  </div>
  <div class="barangay-info text-center">
  	<h1 style='margin-top: 0px;' class='btn-success'></h1>
  	<div class="container text-left">
  		<?php 
  			$select = mysqli_query($dbcon,"SELECT * FROM tblbarangay");
  			while ($row = mysqli_fetch_array($select)) {?>
	  		<div class="col-md-2">
		  		<div class="picture-logo">
		  			<img class="img-responsive" src="image/<?php echo $row['Logo']; ?>">
		  		</div>
	  		</div>
	  		<div class="col-md-8" style='margin-bottom: 20px; padding-top: 20px'>
	  			<label>Barangay:</label>
	  			<input class='form-control' type='text' value='<?php echo $row['Barangay']; ?>' readonly>

		  		<label>Municipality:</label>
		  		<input class='form-control' type='text' value='<?php echo $row['Municipality']; ?>' readonly>

		  		<label>Province:</label>
		  		<input class='form-control' type='text' value='<?php echo $row['Province']; ?>' readonly>
	  		</div>
	  		<div class="update-button text-right" style='margin-right: 205px;'>
	  			<a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Barangay Information</a>
	  		</div>
  			<?php
  			}
  		?>

		 <div id="myModal" class="modal fade" role="dialog">
	      <div class="modal-dialog">
	        <!-- Modal content-->
	        <div class="modal-content">
	          <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal">&times;</button>
	            <h4 class="modal-title">Update Barangay Information</h4>
	          </div>
	          <div class="modal-body">
	            <div class="update-barangay-info">
	            	<form method='POST' action='code.php'  enctype='multipart/form-data'>
	            		<?php 
				  			$select = mysqli_query($dbcon,"SELECT * FROM tblbarangay");
				  			while ($row = mysqli_fetch_array($select)) {?>
					  		<div class="col-md-5">
						  		<div class="picture-logo2">
						  			<img style='width: 150px; height: 150px; padding-top: 0px' class='img-responsive' src="image/<?php echo $row['Logo']; ?>">
						  			<input style='margin-top: 20px;' type='file' name='logo'>
						  		</div>
					  		</div>
					  		<div class="col-md-7" style='margin-bottom: 20px;'>
					  			<input type='hidden' name='id' value='<?php echo $row['No']; ?>'>
					  			<label>Barangay:</label>
					  			<input class='form-control' type='text' name='barangay' value='<?php echo $row['Barangay']; ?>'>

						  		<label>Municipality:</label>
						  		<input class='form-control' type='text' name='municipality' value='<?php echo $row['Municipality']; ?>'>

						  		<label>Province:</label>
						  		<input class='form-control' type='text' name='province' value='<?php echo $row['Province']; ?>'>
					  		</div>
					  		<div class="update-button text-right" style='margin-right: 10px;'>
					  			<input class='btn btn-success' type='submit' name='update-barangay-info' value='Save Barangay Information' onclick="return confirm('Are You Sure You Want To Update Barangay Information!!!')">
					  			<a class="btn btn-danger"  class="close" data-dismiss="modal">Cancel</a>
					  		</div>
				  			<?php
				  			}
				  		?>
	            	</form>
	            </div>
	          </div>          
	        </div>
	      </div>
	    </div>

  	</div>
  </div>

</div>

</div>

<?php include'footer.php' ?>
<?php include'header.php' ?>

<div class="container-fluid" id="banner">

<?php include'sidebar.php' ?>
	
<div class="col-md-10 right-section">
	<?php include'babaw.php' ?>
		 <div class="tittle-header">
	        <h3 style="text-align: center;">Adding Barangay Officials</h3>
	      </div>
	    <div class="barangayofficials">
	    	<div class="text-left"><br>
	    		<a class="btn btn-danger" href="BarangayOfficials">Back</a>
	    	</div>
	        <div class="table-scroll" style="margin-top:25px;"> 
				<div class="table-responsive">
					<form method='POST' action='code.php'>
						<div class="text-left">
							<label>Official Role</label>
							<select type='text' name='role' style="width: 200px; height: 28px;">
								<option>Barangay Captain</option>
								<option>First Councilor</option>
								<option>Second Councilor</option>
								<option>Third Councilor</option>
								<option>Fourth Councilor</option>
								<option>Fifth Councilor</option>
								<option>Sixth Councilor</option>
								<option>Seventh Councilor</option>
							</select>
						</div>
						<table id="myTable" class="table table-stripes">
					  	<thead>  
					        <tr>  
			                      <th>Full Name</th>
			                      <th>Age</th>
			                      <th>Gender</th>
			                      <th>Purok</th>
			                      <th>Action</th>
					        </tr>  
					        </thead>  
					  
					        <?php  
					        include("database/db_connection.php");  
					      	$id = $_GET['id'];
					        $select=mysqli_query($dbcon,"SELECT * FROM `tblresident` WHERE id = '$id' ");

					        while($row=mysqli_fetch_array($select)) {?>  
					           <tr>
					           		<input type="hidden" name='id' value="<?php echo $row['id']; ?>">
					           		<input type="hidden" name='fn' value="<?php echo $row['FirstName']; ?>">
					           		<input type="hidden" name='mn' value="<?php echo $row['MiddleName']; ?>">
					           		<input type="hidden" name='ln' value="<?php echo $row['LastName']; ?>">
					           		<input type="hidden" name='img' value="<?php echo $row['Picture']; ?>">
		                             <td><?php echo $row['FirstName'] ." ". $row['LastName']; ?></td>
		                             <td><?php echo $row['Age']; ?></td>
		                             <td><?php echo $row['Gender']; ?></td>
		                             <td><?php echo $row['Purok']; ?></td>
		                             <td><input class="btn btn-primary" type="submit" name='add-officials' value="Add to Officials"></td>
	                          </tr>
					        <?php } ?>  
					    </table>
					</form>
			    </div>
			</div> 
	     </div>
	</div>
</div>
<?php include 'footer.php' ?>

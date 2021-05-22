<?php include'header.php' ?>

<div class="container-fluid" id="banner">

<?php include'sidebar.php' ?>
	
<div class="col-md-10 right-section">
<?php include'babaw.php' ?>
	 <div class="tittle-header">
        <h3 class=''>Update Barangay Official Page</h3>
      </div>
    <div class="barangayofficials">
    	
    	<?php 
    	$id = $_GET['id'];
  		include 'database/db_connection.php';
  		$select = mysqli_query($dbcon,"SELECT * FROM tblofficials WHERE residentid = '$id'");
  		while ($row = mysqli_fetch_assoc($select)) {?>
  		<form method='POST' action='code.php' enctype='multipart/form-data'>
    		<input type='hidden' name='id' value='<?php echo $row['residentid'] ?>'>
	  		<h4>Barangay Official Name:</h4>
	  		<input class='form-control' type='text' Name='official-name' value='<?php echo$row['FirstName']." " .$row['MiddleName'].". ".$row['LastName'];  ?>' readonly>
	  		<h4>Barangay Official Role:</h4>
	  		<input class='form-control' type='text' Name='official-role' value='<?php echo $row['role']; ?>' readonly>
	  		<h4>Image:</h4>
	  		   <?php 
              $count = strlen($row['img']);
              if ($count < 100) {?>
              <td><img class="image" src="image/<?php echo $row['img'] ?>"></td>
            <?php
              }else{?>
              <td><img class="image" src="<?php echo $row['img'] ?>"></td>
            <?php
              }
            ?>
	  		<input class='no-background' type='text' name='image' value='<?php echo $row['img'] ?>' readOnly>
	  		<input type='file' name='images2' value=''>
	  		<input class='btn btn-info' type='submit' name='update-official' value='Save'>
	  		<a class='btn btn-danger' href="BarangayOfficials">Cancel</a>
  		</form>
      	<?php 
      		}
      	?>
    
      </div>

</div>
</div>
<?php include 'footer.php' ?>

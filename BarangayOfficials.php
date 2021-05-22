<?php include'header.php' ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div style="padding: 0px;" class="container-fluid" id="banner">

<?php include'sidebar.php' ?>
<?php include'babaw.php' ?>
<div class="col-md-10 right-section">
  <div style="height: auto;!important">
	 <div class="tittle-header">
        <h3 style="text-align: center;font-size: 30px">Barangay Officials Page</h3>
        <div class="text-right adminauth">
            <h2 class='text-admin'>Welcome: <a style='font-family: Lucida Fax; color: black; text-decoration: none' href=""><?php echo $_SESSION['admin_name']; ?></a></h2>
          </div>
      </div> 
   </div><br>
    <div class="barangayofficials overflow" style="padding-top:auto;!important;">
    	<div class="text-left">
        <?php 
        include 'database/db_connection.php';
          $select = mysqli_query($dbcon,"SELECT * FROM tblofficials");
          if (mysqli_num_rows($select) != 8) {
            echo "<a class='btn btn-primary' href='add-officials'> Add Barangay Officials</a>";
            echo "<a class='btn btn-danger' href='manage-officials'> Manage Officials</a>";  
          }else{
            echo "<a class='btn btn-primary' href='manage-officials'>Manage Officials</a>";  
          }
        ?>
    	</div>
    
          	<form method="POST" action="code.php" enctype="multipart/form-data">
          	 <?php 
          		include 'database/db_connection.php';
          		$select = mysqli_query($dbcon,"SELECT * FROM tblofficials WHERE role = 'Barangay Captain' ");
          		while ($row = mysqli_fetch_array($select)) {?>
          			<div class="text-center" id="<?php echo $row['residentid']; ?>">
          				 <?php 
                          $count = strlen($row['img']);
                          if ($count < 100) {?>
                          <td><img class="image-officials" src="image/<?php echo $row['img'] ?>"></td>
                        <?php
                          }else{?>
                          <td><img class="image-officials" src="<?php echo $row['img'] ?>"></td>
                        <?php
                          }
                        ?>
          				  <h3><?php echo $row['FirstName']." ".$row['MiddleName'].". ".$row['LastName']; ?></h3>
        	      		<h4><?php echo $row['role']; ?></h4>
        	      	</div>
              	<?php 
              		}
              	?> 
          	</form>

            <form method="POST" action="code.php" enctype="multipart/form-data">
             <?php 
              include 'database/db_connection.php';
              $select = mysqli_query($dbcon,"SELECT * FROM tblofficials WHERE role = 'First Councilor' ");
              while ($row = mysqli_fetch_assoc($select)) {?>
                <div class="text-center" id="<?php echo $row['residentid']; ?>">
                   <?php 
                            $count = strlen($row['img']);
                            if ($count < 100) {?>
                            <td><img class="image-officials" src="image/<?php echo $row['img'] ?>"></td>
                          <?php
                            }else{?>
                            <td><img class="image-officials" src="<?php echo $row['img'] ?>"></td>
                          <?php
                            }
                          ?>
                   <h3><?php echo $row['FirstName']." " .$row['MiddleName'].". ".$row['LastName']; ?></h3>
                    <h4><?php echo $row['role']; ?></h4>
                  </div>
                <?php 
                  }
                ?>
            </form>

            <form method="POST" action="code.php" enctype="multipart/form-data">
                <?php 
                include 'database/db_connection.php';
                $select = mysqli_query($dbcon,"SELECT * FROM tblofficials WHERE role != 'Barangay Captain' AND role != 'First Councilor' ");
                while ($row = mysqli_fetch_assoc($select)) {?>
                  <div class="text-center col-md-4">
                     <?php 
                              $count = strlen($row['img']);
                              if ($count < 100) {?>
                              <td><img class="image-officials" src="image/<?php echo $row['img'] ?>"></td>
                            <?php
                              }else{?>
                              <td><img class="image-officials" src="<?php echo $row['img'] ?>"></td>
                            <?php
                              }
                            ?>
                     <h3><?php echo $row['FirstName']." " .$row['MiddleName'].". ".$row['LastName']; ?></h3>
                      <h4><?php echo $row['role']; ?></h4>
                    </div>
                  <?php 
                    }
                  ?>
            </form>
     </div>
</div>
</div>
<?php include 'footer.php' ?>

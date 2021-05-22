<?php include'header.php' ?>

<div class="container-fluid" id="banner">

<?php include'sidebar.php' ?>
	
<div class="col-md-10 right-section">
<?php include'babaw.php' ?>
      <div class="tittle-header">
          <h3 style="text-align: center;">Senior Citizen</h3>
      </div>
     <table class="table table-stripes">
          <thead>
              <tr>
                  <th></th>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Full Name</th>
                  <th>Age</th>
                  <th>Gender</th>
                  <th>Purok</th>
                   <th>Action</th>
              </tr>
          </thead>
          <tbody> 
               
                <?php 
                	include 'database/db_connection.php';
                    $resident = $dbcon->query("SELECT * FROM tblresident WHERE Age>=60");
                    while($row=$resident->fetch_assoc()){?>
                      <tr>
                         <td><input type='checkbox' name='SelectedId' value='<?php echo $row['id']; ?>'></td>
                         <td><?php echo $row['id']; ?></td>
                         <?php 
                          $count = strlen($row['Picture']);
                            if ($count > 100) {?>
                               <td><img class="image" src="<?php echo $row['Picture'] ?>"></td>
                          <?php 
                            }else{?>
                               <td><img class="image" src="image/<?php echo $row['Picture'] ?>"></td>
                          <?php 
                            }
                          ?>
                        
                         <td><?php echo $row['FirstName'] ." ". $row['LastName']; ?></td>
                         <td><?php echo $row['Age']; ?></td>
                         <td><?php echo $row['Gender']; ?></td>
                         <td><?php echo $row['Purok']; ?></td>
                         <td><a href="info.php?id=<?php echo $row['id']; ?>">Show Details</a></td>
                      </tr>
                <?php
                    }

                ?>
            </tbody>
      </table>
</div>

</div>
<?php include'footer.php' ?>
<?php include 'header.php' ?>
<?php include'code.php' ?>

<div style="padding: 0px;" class="container-fluid" id="banner">

  <?php include 'sidebar.php' ?>

  <div class="col-md-10 right-section">
  <?php include'babaw.php' ?>
  <?php //include 'adminlogout.php' ?>
    <div id="residents">
        <div class="tittle-header">
            <h3 style="text-align: center;font-size: 30px">Pending Residents</h3>
            <div class="text-right adminauth">
              <h2 class='text-admin'>Welcome: <a style='font-family: Lucida Fax;color: black;text-decoration: none;' href=""><?php echo $_SESSION['admin_name']; ?></a></h2>
            </div>
        </div>

        <div class="action-buttons">
          <form method="POST" action="code.php">
           <?php 
                $login_acc = $_SESSION['admin_name'];
                $select = mysqli_query($dbcon,"SELECT * FROM tbladmin WHERE admin_name = '$login_acc' ");
                while ($row = mysqli_fetch_array($select)) {
                  $role = $row['Role'];
                  if ($role != "Captain") {
                   
                  }else{?>
                     <div class="accept-button">
                      <input class='btn btn-primary' type='submit' name='accept-pending' value='Accept All Pending Records!' onclick="return confirm('Are You Sure You Want To Accept All This Records!!!')">
                      <br>
                      <br>
                    </div>
                  <?php
                  }
                }
              ?>
            <table id="myTable" class="table table-stripes">
                <thead>
                    <tr>
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
                        $recordperpage = 5;
                        if (isset($_GET['page']) && !empty($_GET['page'])) {
                          $currentpage = $_GET['page'];
                        }else{
                          $currentpage = 1;
                        }

                        $startfrom = ($currentpage * $recordperpage) - $recordperpage;
                        $select = mysqli_query($dbcon,"SELECT * FROM tblresident WHERE Status = '' ");
                        $totalrecords = mysqli_num_rows($select);
                        $firstpage = 1;
                        $nextpage = $currentpage + 1;
                        $previouspage = $currentpage -1;
                        $lastpage = ceil($totalrecords/$recordperpage);


                          $residents=mysqli_query($dbcon,"SELECT * FROM `tblresident` WHERE Status = '' LIMIT $startfrom, $recordperpage");
                          while($row= mysqli_fetch_assoc($residents)){?>
                            <tr>
                               <input type='hidden' name='Id' value='<?php echo $row['id']; ?>'>
                               <td><?php echo $row['id']; ?></td>
                               <?php 
                                  $count = strlen($row['Picture']);
                                  if ($count < 100) {?>
                                  <td><img class="image" src="image/<?php echo $row['Picture'] ?>"></td>
                                <?php
                                  }else{?>
                                  <td><img class="image" src="<?php echo $row['Picture'] ?>"></td>
                                <?php
                                  }
                                ?>
                               <td><?php echo $row['FirstName'] ." ". $row['LastName']; ?></td>
                               <td><?php echo $row['Age']; ?></td>
                               <td><?php echo $row['Gender']; ?></td>
                               <td><?php echo $row['Purok']; ?></td>
                               <td>
                                <input class='btn btn-danger' type='submit' name='delete-pending' value='Delete' onclick="return confirm('Are You Sure You Want To Delete This Records!!!')">
                              </td>
                            </tr>
                      <?php
                          }

                      ?>
                  </tbody>
            </table>
        <!-- pagination button -->
            <div class="text-right" style='margin-right: 100px;'>
                <nav aria-label="Page pavigation">
                  <ul class="pagination">
                    <?php 
                      if ($currentpage != $firstpage) {?>
                        <li class="page-item">
                          <a class='page-link' href="?page=<?php echo $firstpage ?>" tabindex="-1" aria-label="previous">
                            <span aria-hidden="true">First</span>
                          </a>
                        </li>
                    <?php
                      }
                    ?>
                    <?php 
                      if ($currentpage >= 2) {?>
                        <li class="page-item">
                          <a class="page-link" href="?page=<?php echo $previouspage; ?>"><?php echo $previouspage; ?></a>
                        </li> 
                    <?php               
                      }
                    ?>
                    <li class="page-item active">
                      <a class="page-link" href="?page=<?php echo $currentpage; ?>"><?php echo $currentpage; ?></a>
                    </li>
                    <?php 
                      if ($currentpage != $lastpage) {?>
                        <li class="page-item">
                          <a class="page-link" href="?page=<?php echo $nextpage; ?>"><?php echo $nextpage; ?></a>
                        </li>

                        <li class="page-item">
                          <a class='page-link' href="?page=<?php echo $lastpage ?>" aria-label="next">
                            <span aria-hidden="true">Last</span>
                          </a>
                        </li>
                    <?php 
                      }
                    ?>
                  </ul>
                </nav>
            </div>
          </form>
        </div>
      </div>
  </div>

</div>



<?php include 'footer.php' ?>
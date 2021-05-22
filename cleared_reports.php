<?php include 'header.php' ?>
<?php include'code.php' ?>

<div style="padding: 0px;" class="container-fluid" id="banner">

  <?php include 'sidebar.php' ?>

    <div class="col-md-10 right-section">
    <?php include'babaw.php' ?>
    <?php //include 'adminlogout.php' ?>

      <div id="residents">
        <div class="tittle-header">
            <h3 style="text-align: center;font-size: 30px">Barangay Reports Records</h3>
            <div class="text-right adminauth">
              <h2 class='text-admin'>Welcome:&nbsp;<span><a style='font-family: Lucida Fax;color: black; text-decoration: none;' href=""><?php echo $_SESSION['admin_name']; ?></a></span></h2>
          </div>
        </div>
          <div class="container overflow">
            <div class="tab-content">
              <div id="permit" class="tab-pane fade in active">
                  <form method='POST' action='code.php'>
                    <div class="resident">
                      <div class="table"  style="margin-right:100px">
                        <table class="table table-stripes">
                          <h1 class='files-text'>Barangay Certificate Released Reports</h1>
                          <thead>
                            <tr>
                                <th>Date</th>
                                <th>Permit </th>
                                <th>Clearance </th>
                                <th>Residency </th>
                                <th>Indigency </th>
                                <th>Total </th>
                              <!--   <th>Action</th> -->
                            </tr>
                          </thead>
                          <tbody>
                              <?php 
                                include 'database/db_connection.php';
                                 $recordperpage = 5;
                                  if (isset($_GET['page']) && !empty($_GET['page'])) {
                                    $currentpage = $_GET['page'];
                                  }else{
                                    $currentpage = 1;
                                  }

                                  $startfrom = ($currentpage * $recordperpage) - $recordperpage;
                                  $select = mysqli_query($dbcon,"SELECT * FROM tblnotification_cleared");
                                  $totalrecords = mysqli_num_rows($select);
                                  $firstpage = 1;
                                  $nextpage = $currentpage + 1;
                                  $previouspage = $currentpage -1;
                                  $lastpage = ceil($totalrecords/$recordperpage);

                                  $view_indigency=mysqli_query($dbcon,"SELECT * FROM `tblnotification_cleared` LIMIT $startfrom, $recordperpage ");//select query for viewing users.  
                                  while($row=mysqli_fetch_array($view_indigency)) {?>
                                    <tr>
                                        <input type="hidden" name="no" value="<?php echo $row['No']; ?>">
                                        <td><?php echo $row['Date']; ?></td>
                                        <td><?php echo $row['Permit']; ?></td>
                                        <td><?php echo $row['Clearance']; ?></td>
                                        <td><?php echo $row['Residency']; ?></td>
                                        <td><?php echo $row['Indigency']; ?></td>
                                        <?php 
                                          $total = ($row['Permit'] + $row['Clearance'] +  $row['Residency'] + $row['Indigency']);
                                        ?>
                                        <td><?php echo $total; ?></td>
                                        <!-- <td><input class="btn btn-danger" type="submit" name="delete-permit" value="Delete"></td> -->
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
                      </div>
                    </div>
                  </form>
              </div>
            </div>
        </div>
    </div>
</div>

<?php include'footer.php' ?>
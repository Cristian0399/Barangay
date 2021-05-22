<?php include 'header.php' ?>
<?php include'code.php' ?>

<div class="container-fluid" id="banner">

  <?php include 'sidebar.php' ?>

    <div class="col-md-10 right-section">
    <?php include'babaw.php' ?>
    <?php //include 'adminlogout.php' ?>

      <div id="residents">
        <div class="tittle-header">
            <h3 style="text-align: center;font-size: 30px">Barangay Reports Records:</h3>
            <div class="text-right adminauth">
              <h2 class='text-admin'>Welcome:&nbsp;<span><a style='font-family: Lucida Fax;color: black;text-decoration: none;' href=""><?php echo $_SESSION['admin_name'];?></a></span></h2>
          </div>
        </div>
          <div class="container overflow">
            <ul class="nav nav-tabs">
                <?php 
                 include'database/db_connection.php';
                 $select = mysqli_query($dbcon,"SELECT * FROM tbltransaction WHERE Type='Business' AND status = '' ");
                 $business_count = mysqli_num_rows($select);

                 $select2 = mysqli_query($dbcon,"SELECT * FROM tbltransaction WHERE Type='Clearance' AND status = '' ");
                 $clearance_count = mysqli_num_rows($select2);

                 $select3 = mysqli_query($dbcon,"SELECT * FROM tbltransaction WHERE Type='Indigency' AND status = '' ");
                 $indigency_count = mysqli_num_rows($select3);

                 $select4 = mysqli_query($dbcon,"SELECT * FROM tbltransaction WHERE Type='Residency' AND status = '' ");
                 $residency_count = mysqli_num_rows($select4);
                ?>
              <li><a href="reports">Business Permit / <span class='count-report'><?php echo $business_count; ?></span></a></li>
              <li><a href="reports_clearance">Barangay Clearance / <span class='count-report'><?php echo $clearance_count; ?></span></a></li>
              <li class="active"><a href="reports_indigency">Certificate Of Indigency / <span class='count-report'><?php echo $indigency_count; ?></span></a></li>
              <li><a href="reports_residency">Certificate Of Residency / <span class='count-report'><?php echo $residency_count; ?></span></a></li>
              <?php 
                $login_acc = $_SESSION['admin_name'];
                $select = mysqli_query($dbcon,"SELECT * FROM tbladmin WHERE admin_name = '$login_acc' ");
                while ($row = mysqli_fetch_array($select)) {
                  $role = $row['Role'];
                  if ($role != "Captain") {
                   
                  }else{?>
                    <div class="text-right" style='margin-right: 80px; margin-top:5px;'>
                      <form method='POST' action='code.php'>
                        <input class='btn btn-info' type='submit' name='clear_notification' value='Cleared Notification'>
                      </form>
                    </div>
                  <?php
                  }
                }
              ?>
            </ul>

            <div class="tab-content" style="margin-right: 80px;">
              <div id="indigency" class="tab-pane fade in active">
                 <form method='POST' action='code.php'>
                  <div class="resident">
                    <div class="table">
                      <table class="table table-stripes">
                        <h1 class='files-text'>Barangay Indigency Transaction Records:</h1>
                        <thead>
                          <tr>
                              <th>Fullname</th>
                              <th>Transaction</th>
                              <th>Date Issued</th>
                               <th>Date Expire</th>
                               <th>Approved by</th>
                               <th>Action</th>
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
                                $select = mysqli_query($dbcon,"SELECT * FROM tbltransaction WHERE Type ='Indigency'");
                                $totalrecords = mysqli_num_rows($select);
                                $firstpage = 1;
                                $nextpage = $currentpage + 1;
                                $previouspage = $currentpage -1;
                                $lastpage = ceil($totalrecords/$recordperpage);

                                $view_indigency=mysqli_query($dbcon,"SELECT * FROM `tbltransaction` WHERE Type ='Indigency' LIMIT $startfrom, $recordperpage ");//select query for viewing users.  
                                while($row=mysqli_fetch_array($view_indigency)) {
                                $now = date("Y-m-d");
                                if ($row['DateExp'] <= $now) {?>
                                <form method="POST" action="code.php">
                                    <tr>
                                      <input type="hidden" name="no" value="<?php echo $row['No']; ?>">
                                      <td style="color:red;"><?php echo $row['FullName']; ?></td>
                                      <td style="color:red;"><?php echo $row['Transaction']; ?></td>
                                      <td style="color:red;"><?php echo $row['DateGet']; ?></td>
                                      <td style="color:red;"><?php echo $row['DateExp']; ?></td>
                                      <td style="color:red;"><?php echo $row['admin']; ?></td>
                                      <td><input class="btn btn-danger" type="submit" name="delete-indigency" value="Delete"></td>
                                    </tr>
                                    <?php      
                                    } elseif($row['status'] == ''){?>
                                    <tr style='background-color: lightblue;'>
                                        <input type="hidden" name="no" value="<?php echo $row['No']; ?>">
                                        <td><?php echo $row['FullName']; ?></td>
                                        <td><?php echo $row['Transaction']; ?></td>
                                        <td><?php echo $row['DateGet']; ?></td>
                                        <td><?php echo $row['DateExp']; ?></td>
                                        <td><?php echo $row['admin']; ?></td>
                                        <td><input class="btn btn-danger" type="submit" name="delete-indigency" value="Delete" onclick="return confirm('Are you sure you want to delete this Records!!')"></td>
                                    </tr>
                                  
                                  <?php 
                                  }  else{?>
                                    <tr>
                                        <input type="hidden" name="no" value="<?php echo $row['No']; ?>">
                                        <td><?php echo $row['FullName']; ?></td>
                                        <td><?php echo $row['Transaction']; ?></td>
                                        <td><?php echo $row['DateGet']; ?></td>
                                        <td><?php echo $row['DateExp']; ?></td>
                                        <td><?php echo $row['admin']; ?></td>
                                        <td><input class="btn btn-danger" type="submit" name="delete-indigency" value="Delete" onclick="return confirm('Are you sure you want to delete this Records!!')"></td>
                                    </tr>
                                </form>
                                <?php 
                                }
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
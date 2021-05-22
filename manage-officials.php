<?php include'header.php' ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container-fluid" id="banner">

<?php include'sidebar.php' ?>
<?php include'babaw.php' ?>	

<div class="col-md-10 right-section">
	<div style="height: 12vh;!important">
	
	  <div class="tittle-header">
        <h3 style="text-align: center;">Manage Officials </h3>
    </div>
   </div>
    <div class="barangayofficials overflow" style="padding-top: auto;!important">
          <div class="action-buttons">
            <form method="POST" action="code.php">
              <a class='btn btn-danger' href="BarangayOfficials.php">BACK</a>
              <input class="btn btn-danger" type="submit" name="delete-all-officials" value="Delete Officials" onclick="return confirm('Are you sure you want to delete this records!!!')">
               <div class="records">
                  
              </div>

              <table id="myTable" class="table table-stripes">
                  <thead>
                      <tr>
                        <td></td>
                          <th>ID</th>
                          <th>Image</th>
                          <th>Full Name</th>
                          <th>Position</th>
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
                          $select = mysqli_query($dbcon,"SELECT * FROM tblofficials");
                          $totalrecords = mysqli_num_rows($select);
                          $firstpage = 1;
                          $nextpage = $currentpage + 1;
                          $previouspage = $currentpage -1;
                          $lastpage = ceil($totalrecords/$recordperpage);


                            $residents=mysqli_query($dbcon,"SELECT * FROM `tblofficials` LIMIT $startfrom, $recordperpage");
                            while($row= mysqli_fetch_assoc($residents)){?>
                              <tr>
                                <td><input type="checkbox" name='selected[]' value='<?php echo $row['Id']; ?>'></td>
                                 <td><?php echo $row['residentid']; ?></td>
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
                                 <td><?php echo $row['FirstName'].' '. $row['LastName']; ?></td>
                                 <td><?php echo $row['role']; ?></td>
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
</div>
<?php include 'footer.php' ?>

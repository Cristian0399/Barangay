<?php include 'header.php' ?>
<?php include'code.php' ?>

<div class="container-fluid" id="banner">


<?php include 'sidebar.php' ?>

<div class="col-md-10 right-section">
<?php include'babaw.php' ?>
  <div id="residents">
      <div class="tittle-header">
          <h3 style="text-align: center; font-size: 30px">Residents</h3>
          <div class="text-right adminauth">
            <h2 class='text-admin'>Welcome: <span><a style='font-family: Lucida Fax; color: black;text-decoration: none;' href=""><?php echo $_SESSION['admin_name']; ?></span></a></h2>
          </div>
      </div>

      <div class="action-buttons">
        <form method="POST" action="code.php">

          <a class="btn btn-primary residents" data-toggle="modal" data-target="#myModal" href="#"><li style="list-style: none;">Add Residents</li></a>
          <input class="btn btn-danger" type="submit" name="DeleteMultipleRecords" value="Delete Residents" onclick="return confirm('Are you sure you want to Delete this Records!!!')">
           <div class="records">
                <div class="flex2">
                  <input class='hhh' style="width: 350px;" type='text' name='number' id="myInput" onkeyup="myFunction()" placeholder="Search Residents Name here...">
                </div>
          </div>

          <table id="myTable" style="padding-top: 1px" class="table table-stripes">
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
                      $recordperpage = 5;
                      if (isset($_GET['page']) && !empty($_GET['page'])) {
                        $currentpage = $_GET['page'];
                      }else{
                        $currentpage = 1;
                      }

                      $startfrom = ($currentpage * $recordperpage) - $recordperpage;
                      $select = mysqli_query($dbcon,"SELECT * FROM tblresident WHERE Status != '' ");
                      $totalrecords = mysqli_num_rows($select);
                      $firstpage = 1;
                      $nextpage = $currentpage + 1;
                      $previouspage = $currentpage -1;
                      $lastpage = ceil($totalrecords/$recordperpage);


                        $residents=mysqli_query($dbcon,"SELECT * FROM `tblresident` WHERE Status != '' LIMIT $startfrom, $recordperpage");
                        while($row= mysqli_fetch_assoc($residents)){?>
                          <tr>
                             <td><input type='checkbox' name='SelectedId[]' value='<?php echo $row['id']; ?>'></td>
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
                             <td><a href="info.php?id=<?php echo $row['id']; ?>">Show Details</a></td>
                          </tr>
                    <?php
                        }

                    ?>
                </tbody>
          </table>
           <script>
            function myFunction() {
              var input, filter, table, tr, td, i, navigate;
              input = document.getElementById("myInput");
              filter = input.value.toUpperCase();
              table = document.getElementById("myTable");
              tr = table.getElementsByTagName("tr");
              navigate = document.getElementById("navigate");
              for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[3];
                if (td) {
                  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    navigate.style.display ="block";
                  } else {
                    tr[i].style.display = "none";
                    navigate.style.display ="none";
                  }
                }       
              }
            }
            </script>
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

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Resident</h4>
          </div>
          <div class="modal-body">
              <div class="info">
                <form method='POST' action='code.php' enctype='multipart/form-data'>
                  <div class="col-md-6">

                      <div class="camera text-center">

                        <div class="picture" id="picture"></div>
                        <div id="profileImage">
                          <input type="hidden" name="profileImage">
                        </div>
                          <div class="col-md-6" style='padding:0px;'>
                              <a href="#" class="form-control btn btn-primary" onClick="preview_snapshot()">Open Camera</a>
                          </div>

                          <div class="col-md-6" style='padding:0px;'>
                              <a href="#" class="form-control btn btn-success" onClick="save_photo()">Capture</a>
                          </div>

                        <input class="form-control" type='file' name='images2'>

                      </div>
                      <label>Lastname</label>
                      <input class="form-control" type='text' name='LastName' placeholder='Enter Lastname' required=''>
                      
                      <label>Firstname</label>
                      <input class="form-control" type='text' name='FirstName' placeholder='Enter Firstname' required=''>
                      
                      <label>Middle Name</label>
                      <input class="form-control" type='text' name='MiddleName' placeholder='Enter Middle Name' required=''>
                  </div>

                  <div class="col-md-6" style='margin-bottom: 30px;'>
                      <label>Gender</label>
                      <select class="form-control" type='text' name='Gender'>
                        <option>Male</option>
                        <option>Female</option>
                      </select> 

                      <label>Birth Date</label>
                        <input class="form-control" id='bd' type='date' name='BirthDate' placeholder='Enter Birthday' required=''>
                    
                      <label>Civil Status</label>
                      <select class="form-control" type='text' name='CivilStatus'>
                        <option>Single</option>
                        <option>Married</option>
                      </select> 
                      
                      <label>Citizenship</label>
                        <input class="form-control" type='text' name='Citizenship' placeholder='Enter Citizanship' required=''>
                      
                      <label>Father Name</label>
                        <input class="form-control" type='text' name='Father' placeholder='Enter Name of Father' required=''>
                      
                      <label>Mother Name</label>
                        <input class="form-control" type='text' name='Mother' placeholder='Enter Name of Mother' required=''>
                     
                      <label>Household Number</label>
                        <input class="form-control" type='number' name='HouseHoldNumber' placeholder='Enter Household Number' required=''>
                      
                      <label>Purok</label>
                        <input class="form-control" type='text' name='Purok' placeholder='Enter Purok' required=''>  
                  </div>
                  <div class="margin-top-20 text-right" style='padding: 0px 20px 0px 0px;'>
                    <a href="residents.php"><input class='btn btn-danger form-control' value="Cancel" style="position:relative;top:-2pxpx;width:125px;left:16px;"></a>
                    <input class='btn btn-primary form-control' type='submit' name='AddResidents' value'Add New Residents' style="position:relative;top:0px;width:125px;left: 14px;">
                  </div>
                </form>
              </div>
          </div>          
        </div>

      </div>
    </div>

</div>

</div>



<?php include 'footer.php' ?>
<?php include'header.php' ?>

<div style="padding: 0px;" class="container-fluid" id="banner">

<?php include'sidebar.php' ?>
  
<div class="col-md-10 right-section">
  <?php include'babaw.php' ?>
  <?php include'code.php' ?>

  <div class="tittle-header">
        <h3 style="text-align: center;font-size: 30px">Residency Page</h3>
        <div class="text-right adminauth">
            <h2 class='text-admin'>Welcome:&nbsp;<span><a style='font-family: Lucida Fax;color: black;text-decoration: none' href=""><?php echo $_SESSION['admin_name']; ?></a></span></h2>
        </div>
    </div>
    <div class="staffrecords">
      <div class="flex-parent">
        <div class="flex1">
          <label class="Search-text">Search Resident:</label>
          <input class='search-input' type='text' name='number' id="myInput" onkeyup="myFunction()" placeholder="Enter Resident Name...">
        </div>
    </div>

    <div class="table-scroll" style="margin-top:25px;"> 
      <div class="table-responsive">
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
            include("database/db_connection.php");  

            $recordperpage = 5;
            if (isset($_GET['page']) && !empty($_GET['page'])) {
              $currentpage = $_GET['page'];
            }else{
              $currentpage = 1;
            }

            $startfrom = ($currentpage * $recordperpage) - $recordperpage;
            $select = mysqli_query($dbcon,"SELECT * FROM tblresident WHERE Status != ''");
            $totalrecords = mysqli_num_rows($select);
            $firstpage = 1;
            $nextpage = $currentpage + 1;
            $previouspage = $currentpage -1;
            $lastpage = ceil($totalrecords/$recordperpage);

            $select2=mysqli_query($dbcon,"SELECT * FROM `tblresident` WHERE Status != '' LIMIT $startfrom, $recordperpage");
            while($row=mysqli_fetch_array($select2))
            {  
            
            ?>  
      
           <tr>
              <input type='hidden' name='id' value='<?php echo $row['id']; ?>'>

             <td><?php
              echo $row['id'];
              $_SESSION['id'] = $row['id'];
              ?></td>
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
             <td><a class='btn btn-primary' data-toggle="modal" data-target="#myModal" residentid="<?php echo $row['id']; ?>" >Issue Certificate of Residency</a></td>
          </tr>
          
          <?php } ?>  
        </tbody>
      </table> 
    <!-- pagination button -->
        <div class="text-right" id="navigate" style='margin-right: 100px;'>
            <nav aria-label="Page navigation">
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
        <script>
        function myFunction() {
          var input, filter, table, tr, td, i, navigate;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");
          navigate = document.getElementById("navigate");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
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
      </div>
    </div>
 <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content modal-dialog modal-sm">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Barangay Residency</h4>
                </div>
              <div class="modal-body " id="profileForm">
                <form method='POST' action='code.php'>
                  <?php 
                    include 'database/db_connection.php';
                     $select = mysqli_query($dbcon,"SELECT * FROM tblbarangay");
                    while ($row2 = mysqli_fetch_assoc($select)) {?>
                    <input type='hidden' name='admin' value='<?php echo $_SESSION['admin_name']; ?>'>
                    <input type='hidden' name='municipality' value='<?php echo $row2['Municipality'];; ?>'>
                    <input type='hidden' name='barangay' value='<?php echo $row2['Barangay'];; ?>'>
                    <input type='hidden' name='province' value='<?php echo $row2['Province'];; ?>'>
                    <?php 
                    }
                  ?>
                   <input type='hidden' name='id'>
                   <h4>Living Since:</h4>
                   <input class='form-control' type='text' name='since' >
                   <h4>Enter OR No.</h4>
                   <input class='form-control' type='number' name='OR' >

                   <div class="buttons text-right" style='margin-top:20px;'>
                      <input class='btn btn-primary' type='submit' name='submit-residency' value='Proceed'>
                      <a data-dismiss="modal" class='btn btn-danger'>Cancel</a>
                   </div>
                 </form>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php' ?>
<?php include'header.php' ?>

<div style="padding: 0px;" class="container-fluid" id="banner">

<?php include'sidebar.php' ?>
  
<div class="col-md-10 right-section">
  <?php include'babaw.php' ?>
  <?php include'code.php' ?>

  <div class="tittle-header">
        <h3 style="text-align: center;font-size: 30px">User Page</h3>
        <div class="text-right adminauth">
            <h2 class='text-admin'>Welcome: <a style='font-family: Lucida Fax;color: black; text-decoration: none;' href=""><?php echo $_SESSION['admin_name']; ?></a></h2>
        </div>
    </div>
    <div class="staffrecords">
      <div class="flex-parent">
        <div class="flex1">
           <a class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="#"><li style="list-style-type:none;width:175px;">Add Users</li></a>
        </div>
        <div class="flex2">
          <input class='hhh' type='text' style="width: 350px" name='number' id="myInput" onkeyup="myFunction()" placeholder="Search user here...">
        </div>
    </div>

<div class="table-scroll" style="margin-top: 0px;"> 
  <div class="table-responsive">
    <table id="myTable" class="table table-stripes">
      <thead>  
        <tr>  
            <th>Id</th> 
            <th>Username</th>  
            <th>Email</th>  
            <th>Action</th>  
        </tr>  
      </thead>  
        <?php  
        include("database/db_connection.php");  

        $recordperpage = 5;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
          $currentpage = $_GET['page'];
        }else{
          $currentpage = 1;
        }

        $startfrom = ($currentpage * $recordperpage) - $recordperpage;
        $select = mysqli_query($dbcon,"SELECT * FROM tbladmin");
        $totalrecords = mysqli_num_rows($select);
        $firstpage = 1;
        $nextpage = $currentpage + 1;
        $previouspage = $currentpage -1;
        $lastpage = ceil($totalrecords/$recordperpage);

        $view_admin_query=mysqli_query($dbcon,"SELECT * FROM `tbladmin` LIMIT $startfrom, $recordperpage");//select query for viewing users.  
        while($row=mysqli_fetch_array($view_admin_query))//while look to fetch the result and store in a array $row.  
        {  
            $adminid=$row[0];  
            $admin_name=$row[1]; 
            $admin_email=$row[2]; 
            $admin_pass=$row[3]; 
        ?>  
  
        <tr>  
          <form method='POST' action='code.php'>
<!--here showing results in the table -->  
            <input type='hidden' name='id' value='<?php echo $adminid; ?>'>
            <td><?php echo $adminid;  ?></td> 
            <td><?php echo $admin_name;  ?></td>  
            <td><?php echo $admin_email;  ?></td>

            <?php 
              $sess = $_SESSION['admin_name'];
              $captain = mysqli_query($dbcon,"SELECT * FROM tbladmin WHERE admin_name = '$sess' ");
              $row2 = mysqli_fetch_array($captain);
              if ($row2['Role'] == "Captain") {?>
               <td><a href="staff-info.php?adminid=<?php echo $row['adminid']; ?>">Show Details</a> | <input class='red' type='submit' name='delete' value='Delete' onclick="return confirm('Are you sure you want to delete this staff!!')"></td>
            <?php
              }else{?>
               <td><a href="staff-info.php? adminid=<?php echo $row['adminid']; ?>">Show Details</a></td>
            <?php 
              }
            ?>
            
          </form>
        </tr>  
      
      <?php } ?>  
      
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
    td = tr[i].getElementsByTagName("td")[1];
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
        <div class="modal-header" style="background-color:black;color:white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3>Manage Staff</h3>
        </div>
        <div class="modal-body" style="padding:18px;">
            <form role="form" method="post">  
              <fieldset> 
                  <div class="form-group">
                  <label>Admin Role:</label> 
                    <select class="form-control" placeholder="Name" name="admin_role" type="text" autofocus>
                      <option>Captain</option>
                      <option>Employee</option>
                    </select>
                  </div>

                  <div class="form-group">
                  <label>Username:</label> 
                      <input class="form-control" placeholder="Enter Username" name="admin_name" type="text" required>  
                  </div>

                  <div class="form-group">
                  <label>Email:</label> 
                      <input class="form-control" placeholder="Enter Email" name="admin_email" type="text" required>  
                  </div> 

                  <div class="form-group">
                  <label>Password:</label>  
                      <input class="form-control" placeholder=" Enter Password" name="admin_pass" type="password" value="" required>  
                  </div>  

                  <!-- <input class="btn btn-lg btn-success btn-block" type="submit" value="submit" name="register" >   -->
                  <a href="Staff.php"><input class='btn btn-danger form-control' value="Cancel" style="position:relative;top:-2pxpx;width:125px;left:2px;"></a>
                  <input class='btn btn-primary form-control' type='submit' name='register' value'' style="position:relative;top:0px;width:125px;left: 7px;">
              </fieldset>  
            </form>
        </div>  
      </div>

    </div>
</div>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>  
</html> 


<?php  
  
include("database/db_connection.php");//make connection here  
if(isset($_POST['register']))  
{  
    $admin_role=$_POST['admin_role'];
    $admin_name=$_POST['admin_name'];//here getting result from the post array after submitting the form.  
    $admin_email=$_POST['admin_email'];//same  
    $admin_pass=$_POST['admin_pass'];//same  

    $hash_pass = password_hash($admin_pass, PASSWORD_DEFAULT);
     
    //here query check weather if user already registered so can't register again.  
    $check_email_query="SELECT * FROM tbladmin WHERE admin_name ='$admin_name'";  
    $run_query=mysqli_query($dbcon,$check_email_query);  
  
    if(mysqli_num_rows($run_query)>0)  
    {  
      echo "<script>alert('Email $admin_name is already exist in our database, Please try another one!')</script>";  
      exit();  
    } 

    $select = mysqli_query($dbcon,"SELECT * FROM tbladmin WHERE Role = 'Captain' ");

    if ((mysqli_num_rows($select) > 0) AND $admin_role == 'Captain') {
       echo"<script>window.alert('Captain Account Already Reistered')</script>";  
        echo"<script>window.open('Staff.php','_self')</script>"; 
    }else{
           //insert the user into the database.  
          $insert_admin="INSERT INTO `tbladmin` VALUES (NULL,'$admin_name','$admin_email','$hash_pass','$admin_role')";
          if(mysqli_query($dbcon,$insert_admin))  
      { 
          echo "Registered successfully!"; 
          echo"<script>window.open('Staff.php','_self')</script>";  
      }   
    }
}  
  
?> 

</div>
</div>

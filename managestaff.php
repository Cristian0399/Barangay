<?php  
session_start();  
  
if(!$_SESSION['admin_name'])  
{  
  
   header("Location: adminlogin.php"); 
}  
?>
<html>  
<head lang="en">  
    <meta charset="UTF-8">
    <link href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initialscale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css">  
    <title>Manage Staff</title>  
</head>  
<style>
  
    .web{
        height: 108px;
        padding-top: 27px;
        font-size: 29px;
        background-color: white;
        color: yellow;
        width: 100%;
    }
    .tab{
        margin-top: -20px;
    }
    .adminform{
      font-size: 17px;
      padding-top: 10px;
    }
    .j{
      margin-top: -20px;
      border-color: none;
    }

    * {
  box-sizing: border-box;
}

#myInput {
 
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}

</style>
 
</style>  
  
<body data-spy="scroll" data-target=".navbar" data-offset="50">  

  <div class="panel panel-default">

  <div class="panel-body text-center web">Web-based Barangay Records System <br>
    <ul class="nav navbar-nav navbar-right">
        <div class="adminform" style ="">
            <a href="adminmainform.php" class="text-right" value="">
            <?php  echo $_SESSION['admin_name'];?></a>
               <a href="adminlogin.php">&nbsp;<span class="glyphicon glyphicon-chevron-down"></span></a>
         </div>
      </ul>
  </div>
  </div>
    <!-- Navigation Bar -->
<nav class="navbar navbar-default j">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#Home">Home</a></li>
        <li><a href="#About">About</a></li>
        <li><a href="#About">Files</a></li>
        <li><a href="managestaff.php">Staff</a></li>
        <li data-toggle="modal" data-target="#myModal"><a href="registerresident">Residents</a></li> 
        <li><a href="#About">Barangay Officials</a></li>
        <li><a href="#About">Backup and Restore</a></li>
        <!-- <li><a href="#">Reports</a></li> -->
      </ul>
    </div>
  </div>
</nav>

<div class="">
    <div class="">
        <!-- Trigger the modal with a button -->
      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="border-radius: 0px;">Manage Staff</button>
    </div>
<!-- <div class="row" style="">
    <div class="col-md-6">
        <div class="searchtext" style="position: relative;top: -47px;">
        <div style="width: 30%;"><input type="text" id="myInput" onkeyup="myFunction()" placeholder=" Search Staff ID here..." title="Type in a name"></div>
        </div>
        <div class="col-md-6 search" style="position: relative;top: -106px;">
        <button type="button" class="btn btn-info btn-lg" style="border-radius: 0px;">Search</button>
        </div>
    </div>
</div> -->
</div>

<div class="table-scroll"> 
  <div class="table-responsive">
<table id="myTable" class="table-bordered table-hover" style="table-layout: fixed;">
  <thead>  
  
        <tr>  
  
             <th>Id</th> 
            <th>Name</th>  
            <th>Email</th>  
            <th>Action</th>  
        </tr>  
        </thead>  
  
        <?php  
        include("database/db_connection.php");  
        $view_admin_query="SELECT * FROM `tbladmin`";//select query for viewing users.  
        $run=mysqli_query($dbcon,$view_admin_query);//here run the sql query.  
  
        while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
        {  
            $adminid=$row[0];  
            $admin_name=$row[1]; 
            $admin_email=$row[2]; 
            $admin_pass=$row[3];  
        ?>  
  
        <tr>  
<!--here showing results in the table -->  
            <td><?php echo $adminid;  ?></td> 
            <td><?php echo $admin_name;  ?></td>  
            <td><?php echo $admin_email;  ?></td>  
            <td>
                <div class="row">
                    <div class="col-md-4">
                        <a href="delete.php?del=<?php echo $adminid ?>"><button class="btn btn-danger">Delete</button></a>
                    </div>
                    <div class="col-md-4">
                        <a href="updaterecord.php?del=<?php echo $adminid ?>"><button class="btn btn-danger">Edit</button></a>
                    </div>
                    <div class="col-md-4">
                        <a href=".php?del=<?php echo $adminid ?>"><button class="btn btn-danger">Details</button></a>
                    </div>
                </div>
                </td>  
        </tr>  
  
        <?php } ?>  
  
    </table> 
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
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
          <h4 class="modal-title">Manage Staff</h4>
        </div>
        <div class="modal-body">
            <form role="form" method="post">  
                        <fieldset> 
                            <div class="form-group">
                            <label>Name:</label> 
                                <input class="form-control" placeholder="Name" name="admin_name" type="text" autofocus>  
                            </div>

                            <div class="form-group">
                            <label>Email:</label> 
                                <input class="form-control" placeholder="Enter your email" name="admin_email" type="text">  
                            </div> 

                            <div class="form-group">
                            <label>Password:</label>  
                                <input class="form-control" placeholder="Password" name="admin_pass" type="password" value="">  
                            </div>  

                            <input class="btn btn-lg btn-success btn-block" type="submit" value="submit" name="register" >  
  
                        </fieldset>  
            </form>
        </div>  
      </div>

    </div>
  </div> 

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="footer text-center" style="background-color: grey; height: 50px; padding-top: 16px; color:white">Copyright &copy: All rights reserved |Web-based Barangay Records System|</div>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>  
</html> 


<?php  
  
include("database/db_connection.php");//make connection here  
if(isset($_POST['register']))  
{  
    $admin_name=$_POST['admin_name'];//here getting result from the post array after submitting the form.  
    $admin_email=$_POST['admin_email'];//same  
    $admin_pass=$_POST['admin_pass'];//same  
      
  
    if($admin_name=='')  
    {  
        //javascript use for input checking  
        echo"<script>alert('Please enter the name')</script>";  
exit();//this use if first is not work then other will not show  
    }  
  
   if($admin_email=='')  
    {  
        echo"<script>alert('Please enter the email')</script>";  
    exit();  
    }

    if($admin_pass=='')  
    {  
        echo"<script>alert('Please enter the password')</script>";  
exit();  
    }  
  
     
//here query check weather if user already registered so can't register again.  
    $check_email_query="SELECT * FROM tbladmin WHERE admin_email='$admin_email'";  
    $run_query=mysqli_query($dbcon,$check_email_query);  
  
    if(mysqli_num_rows($run_query)>0)  
    {  
echo "<script>alert('Email $admin_email is already exist in our database, Please try another one!')</script>";  
exit();  
    }  
//insert the user into the database.  
    $insert_admin="INSERT INTO `tbladmin`(`admin_name`, `admin_email`, `admin_pass`) VALUES ('$admin_name','$admin_email','$admin_pass')";
        if(mysqli_query($dbcon,$insert_admin))  
    { 
        echo "Registered successfully!"; 
        echo"<script>window.open('managestaff.php','_self')</script>";  
    }   
}  
  
?> 
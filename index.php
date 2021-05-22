<?php  
session_start();
  
?>  
<html>  
<head lang="en">  
    <meta charset="UTF-8"> 
    <link href="font-awesome/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initialscale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css">  
    <title>Admin Login</title>  
</head>  
<style>  
    .login-panel {  
        margin-top: 20px;  
     }
    #Register{
    	width: 50%;
    }
    .bg-img{
        background-image: url("");
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        width: 100%;
        height: 100vh;
    }
    .right{
        float: right;
    }
    h1{
        font-family: Arial Rounded MT Bold;
        color: white;
        font-size: 2em;
        font-weight: bold;
        margin: 0px;
        padding: 0px;
    }
    form input.email {
      background-image: url("image/userko");
      background-repeat: no-repeat;
      background-size: 20px;
      background-position: 215px 7px;
    }
    form input.pass {
      background-image: url("image/pass2");
      background-repeat: no-repeat;
      background-size: 20px;
      background-position: 215px 7px;
    }

    .panel-body{
        padding: 0px;
        margin: 0px;
        background-image: url("image/logo");
    }
    .img{
        color:white;
        background-color: rgba(13, 13, 13, 0.6);
        width: 40%;
        box-shadow: 4px -3px 14px black;
    }  
    .overlay{
        height: 100%;
        width: 100%;
        background-color: rgba(0,0,0,.2);
    }
</style>  
<body>

<div class="bg-img">
    <div class="overlay">
        <div class="container" style="width: 50%; float: center;">  
            <br><br><br> <br><br><br> <br><br><br><br>
            <div class="row">  
                <div class="col-md-6 col-md-offset-4 img"> 
                     <br>
                        <h1 class="panel-title text-center">SIGN IN</h1><hr>
                        <div class="panel-body">
                            <form role="form" method="POST" action='adminlogin.php'>  
                                    <div class="form-group"  >
                                    <label class="control-label" for="email">Username:</label>
                                    <input class="email form-control" placeholder="| Enter Username" name="admin_name" type="" autofocus required>  
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label" for="pwd">Password:</label>  
                                        <input class="pass form-control" placeholder="| Password" name="admin_pass" type="password" value="" required="">  
                                    </div>
                                    <hr>
                                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="adminlogin" style="padding:4px;border-radius:30px;">
                            </form>  
                        </div>
                        </div> 
                </div>  
            </div>  
        </div>
    </div>
</div>


  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>  
  
</html>  

<?php  

include("database/db_connection.php");  
  
if(isset($_POST['adminlogin']))//this will tell us what to do if some data has been post through form with button.  
{   
    $admin_name=$_POST['admin_name'];  
    $admin_pass=$_POST['admin_pass']; 
  
    $admin_query="SELECT * FROM `tbladmin` WHERE admin_name='$admin_name' OR admin_email = '$admin_name' AND admin_pass='$admin_pass'";  
  
    $run_query=mysqli_query($dbcon,$admin_query);  
  
    if(mysqli_num_rows($run_query)>0) 
    {  
        $select = mysqli_query($dbcon,"SELECT * FROM tblresident");

        while ($row = mysqli_fetch_array($select)) {
            $id = $row['id'];
            $bd = new DateTime($row['BirthDate']);
            $datenow = new DateTime();
            $diff = $bd->diff($datenow);
            $Age = $diff->y;
            
            $update = "UPDATE tblresident SET Age='$Age' WHERE id = '$id'";

            if(mysqli_query($dbcon,$update))  
            {  
                echo "<script>window.open('dashboard.php','_self')</script>";
                $_SESSION['admin_name']=$admin_name;  
            }
        }
    }  
    else {echo"<script>alert('Admin Details are incorrect..!')</script>";}  
}  
  



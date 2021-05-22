<?php  
 
include("database/db_connection.php");  
$delete_id=$_GET['del'];  
$delete_query="DELETE FROM `tbladmin` WHERE adminid='$delete_id'";//delete query  
$run=mysqli_query($dbcon,$delete_query);  
if($run)  
{  
//javascript function to open in the same window   
    echo "<script>window.open('Staff.php?deleted=user has been deleted','_self')</script>";  
}  
  
?>
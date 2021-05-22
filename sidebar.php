<style>
/* Fixed sidenav, full height */
.sidenav {
    height: fixed;
    width: 300px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    overflow-x: hidden;
    padding-top: 20px;
}
/* Main content */
.main {
    margin-left: 200px; /* Same as the width of the sidenav */
    font-size: 20px; /* Increased text to enable scrolling */
    padding: 0px 10px;
    background-color: #434343;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
    float: left;
    padding-right: 8px;

}

/* Some media queries for responsiveness */
/*@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}*/
.controls a{
  text-decoration: none;
  font-size: 1.1em;
  color: black;
}
.controls a:hover{
  color: black;
  text-decoration: none;
}
.count{
  text-align: center;
  background-color: green;
  font-size: 10px;
  font-weight: bold;
  margin-left: 5px;
  position: absolute;
  color: white;
  height: 15px;
  width: 30px;
}
img{
    border-radius: 100%;
    margin-top: 1.8%;
    border: 5px groove #0088ff47;
    /*sidebar*/
}
div.dropdown-container{
  font-size: 115%;
  font-family: sans-serif;
  background-color: gray;
}
.caret{
  color: black;
}
#sidebar ul li{
  list-style: none;
  padding-left: 100px;
  padding: 15px 10px;
  border-bottom: 1px solid rgba(100,100,100,3.0);
}
li {
  font-size: 100%;
  text-decoration: none;
}
ul li:hover {
  background: gray;
  color: black;
}
ul {
  padding: 0px;
  text-align: center;
  text-decoration: none;
}
div a {
  text-decoration: none;
}
.black{
  display: block;
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  margin-left: auto;
  margin-right: auto;
  border-style: inset;
  border-width: 1px;
  width: 99%;
}
.dropdown-btn:hover{
  background-color: gray;
}
.ww:hover{
  background-color: darkgray;
}
</style>
<div style="padding: 0px;" class="col-md-2 controls">
  <div class="text-center">
    <?php 
     include'database/db_connection.php';
      $select = mysqli_query($dbcon,"SELECT * FROM tblbarangay");
      while ($row = mysqli_fetch_array($select)) {?>
        <img src="image/<?php echo $row['Logo']; ?>" width="140px" height="140px">
    <?php
      }
      
    ?>
  </div>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <h4 class='text-center'>
    <hr class='black'>
    </h4>
    <div id="sidebar">
    <div class="nav nav-pills nav-stacked choices" style= "list-style-type:none;">
      <ul>
      <li><a href="dashboard.php"> Dashboard</a></li>
      <li><a href="Barangay-info.php"> Barangay Information</a></li>
      <li><a href="BarangayOfficials.php"> Barangay Officials</a></li>
      <li><a href="SkOfficials.php"> SK Officials</a></li>
      <li><a href="Staff.php"> Users</a></li>
      <li><a href="residents.php"> Residents</a></li>
      <li><a href="pending-residents.php"> Pending Residents</a></li>
      <button style="color: black; border-bottom: 1px solid rgba(100,100,100,3.0); padding: 15px 10px; width: 194px; font-size: 100%;"  class="dropdown-btn">Issue Certificates
        <span class="caret"></span></button>
      <div class="dropdown-container">
      <li style="font-size: 70%" class="ww"><a href="permit.php">Permit</a><br></li>
      <li style="font-size: 70%" class="ww"><a href="indigency.php">Cerficate of Indigency</a><br></li>
      <li style="font-size: 70%" class="ww"><a href="clearance.php">Clearance</a><br></li>
      <li style="font-size: 70%" class="ww"><a href="residency.php">Cerficate of Residency</a></li>
      </div>
      <div class="reports">
        <?php  
         include'database/db_connection.php';
         $select = mysqli_query($dbcon,"SELECT * FROM tbltransaction WHERE status = '' ");
         $count = mysqli_num_rows($select);
        ?>
      </div>
        <li><a href='reports.php'> Reports</a><span class='count'><?php echo $count; ?></span></li>
       <li><a href="cleared_reports.php">Released Reports</a></li>
        <!-- <h5 class='margin-top-50'><li><a href="BackRestore.php"><span class="glyphicon glyphicon-heart"></span> Back-up and Restore</a></li></h5> -->
        <li><a href="adminlogin.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
    </div>
      <?php
?>
    </div>

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } 
    else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
<?php include 'header.php' ?>
<?php include'code.php' ?>

<div class="container" style="width: 500px;">
   <div class="info">

    <div class="text-center info">

      <h3><b>Personal Information</b></h3>
    </div>  
  <div class="inside" style="border-style: groove;">
    <?php 
      if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $select = $dbcon->query("SELECT * FROM tblresident WHERE id = '$id' ");

        while ($row = $select->fetch_assoc()) {?>

            <div class="col-md-2"></div>
            <div class="col-md-8">

              <div class="col-md-12">

                    <div class="camera text-center">
                    <?php 
                      $count = strlen($row['Picture']);
                      if ($count < 100) {?>
                      <td><img class="picture2" src="image/<?php echo $row['Picture'] ?>"></td>
                    <?php
                      }else{?>
                      <td><img class="picture2" src="<?php echo $row['Picture'] ?>"></td>
                    <?php
                      }
                    ?>
                    </div>
                <div class="text-center" style="padding-bottom: 15px">
                <a href="residents.php"><input class='btn btn-danger form-control' style="width: 100px" value="Back"></a>
                <a class="btn btn-primary form-control" style="width: 100px" data-toggle="modal" data-target="#myModal" href="#">Edit Resident</a>
              </div>
            </div>
              </div>
              <div class="row text-center" >
                <div class="col-md-6">
                  <label>Last Name</label>
                  <p><?php echo $row['LastName']; ?></p>
                 <label>First Name</label>
                    <p><?php echo $row['FirstName']; ?></p>
                 <label>Middle Name</label>
                    <p><?php echo $row['MiddleName']; ?></p>
                 <label>Gender</label>
                  <p><?php echo $row['Gender']; ?></p>
                  <label>Age</label>
                      <p><?php echo $row['Age']; ?></p>
                      <label>Birth Date</label>
                    <p><?php echo $row['BirthDate']; ?></p>
                </div>

                <div class="col-md-6">
                    <label>Civil Status</label>
                    <p><?php echo $row['CivilStatus']; ?></p>
                      <label>Father</label>
                        <p><?php echo $row['FathersName']; ?></p>
                     <label>Mother</label>
                        <p><?php echo $row['MothersName']; ?></p>
                     <label>Citizenship</label>
                        <p><?php echo $row['Citizenship']; ?></p>
                     <label>Household Number</label>
                        <p><?php echo $row['HouseHoldNumber']; ?></p>
                     <label>Purok</label>
                        <p><?php echo $row['Purok']; ?></p>                   
                </div>
              </div> 
        </div>        
      </div>     
            <div class="col-md-2"></div>

             <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

               <!--   Modal content -->
                <div class="modal-content">
                  <div class="modal-header jheader">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Resident</h4>
                  </div>
                  <div class="modal-body">
              <div class="info">
                <form method='POST' action='code.php' enctype='multipart/form-data'>
                  <input type="hidden" name="profileImage" id="profileImage2" value="<?php echo $row['Picture']; ?>">
                  <div class="col-md-6">

                      <div class="camera text-center">

                        <div class="picture" id="picture2"></div>
                        <div id="profileImage2"></div>

                          <div class="col-md-6" style='padding:0px;'>
                              <a class="form-control btn btn-info" onClick="preview_snapshot2()">Open Camera</a>
                          </div>

                          <div class="col-md-6" style='padding:0px;'>
                              <a class="form-control btn btn-success" onClick="save_photo2()">Capture</a>
                          </div>

                        <input class="form-control" type='file' name='images2'>

                      </div>
                      <input type='hidden' name='id' value='<?php echo $_GET['id']; ?>'>
                      
                       <label>Last Name</label>
                      <input class="form-control" type='text' name='LastName' placeholder='Enter User Email' required='' value='<?php echo $row['LastName']; ?>'>
                     
                     <label>First Name</label>
                      <input class="form-control" type='text' name='FirstName' placeholder='Enter User Email' required='' value='<?php echo $row['FirstName']; ?>'>
                      
                      <label>Middle Name</label>
                      <input class="form-control" type='text' name='MiddleName' placeholder='Enter User Email' required='' value='<?php echo $row['MiddleName']; ?>'>
                  </div>

                  <div class="col-md-6">
                      <label>Gender</label>
                        <select class="form-control" type='text' name='Gender'>
                          <?php 
                            if ($row['Gender'] == 'Male') {?>
                               <option>Male</option>
                              <option>Female</option>
                            <?php
                            }else{?>
                              <option>Female</option>
                              <option>Male</option>
                            <?php
                            }
                          ?>
                        </select> 
                      
                      <label>BirthDate</label>
                        <input class="form-control" type='date' name='BirthDate' placeholder='Enter User Email' required='' value='<?php echo $row['BirthDate']; ?>'>
                      
                      <label>CivilStatus</label>
                      <select class="form-control" type='text' name='CivilStatus'>
                           <?php 
                            if ($row['CivilStatus'] == 'Single') {?>
                                <option>Single</option>
                                <option>Married</option>
                            <?php
                            }else{?>
                              <option>Married</option>
                              <option>Single</option>
                            <?php
                            }
                          ?>
                       
                      </select> 

                      <label>Citizenship</label>
                        <input class="form-control" type='text' name='Citizenship' placeholder='Enter User Email' required='' value='<?php echo $row['Citizenship']; ?>'>
                      
                      <label>FatherName</label>
                        <input class="form-control" type='text' name='Father' placeholder='Enter User Email' required=''  value='<?php echo $row['FathersName']; ?>'>
                      
                      <label>MotherName</label>
                        <input class="form-control" type='text' name='Mother' placeholder='Enter User Email' required=''  value='<?php echo $row['MothersName']; ?>'>
                     
                      <label>Household Number</label>
                        <input class="form-control" type='number' name='HouseHoldNumber' placeholder='Enter User Email' required='' value='<?php echo $row['HouseHoldNumber']; ?>'>
                     
                      <label>Purok</label>
                        <input class="form-control" type='text' name='Purok' placeholder='Enter User Email' required='' value='<?php echo $row['Purok']; ?>'>
                  </div>
                    <a  class='btn btn-danger' data-dismiss="modal" style="position:relative;top:-2px;width:125px;left:16px;">Cancel</a>
                    <input class='btn btn-info form-control' type='submit' name='EditResidents' value'Add New Residents' style="position:relative;top:10px;width:125px;left: 15px;margin-bottom:25px;">
                </form>
              </div>
          </div>
                </div>

              </div>
            </div>

        <?php 
        }
      }
    ?>

  </div>
</div>
<?php include 'footer.php' ?>
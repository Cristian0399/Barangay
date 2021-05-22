<?php 

include'database/db_connection.php';


if(isset($_POST['AddResidents'])){
	$Picture = $_POST['profileImage'];
	$LastName = $_POST['LastName'];
	$FirstName = $_POST['FirstName'];
	$MiddleName = $_POST['MiddleName'];
	$Gender = $_POST['Gender'];
	$BirthDate = $_POST['BirthDate'];
	$CivilStatus = $_POST['CivilStatus'];
	$Citizenship = $_POST['Citizenship'];
	$Father = $_POST['Father'];
	$Mother = $_POST['Mother'];
	$HouseHoldNumber = $_POST['HouseHoldNumber'];
	$Purok = $_POST['Purok'];
	
	$bd = new DateTime($BirthDate);
	$datenow = new DateTime();
	$diff = $bd->diff($datenow);
	$Age = $diff->y;

	$target_dir = "image/";
 	$target_file = $target_dir . basename($_FILES['images2']["name"]);
 	$image_file = pathinfo($target_file,PATHINFO_EXTENSION);
 	$img2 = basename($_FILES['images2']["name"]);

 	if ($img2 == "") {
 		$insert="INSERT INTO tblresident VALUES (NULL,'$Picture','$LastName','$FirstName','$MiddleName',
		'$Gender','$Age','$BirthDate','$CivilStatus','$Citizenship','$Father','$Mother','$HouseHoldNumber','$Purok','')";
	
			if(mysqli_query($dbcon,$insert))  
		    {  
		        echo"<script>window.open('residents.php','_self')</script>";  
		    } 
 	}else{
 	
		$insert="INSERT INTO tblresident VALUES (NULL,'$img2','$LastName','$FirstName','$MiddleName',
		'$Gender','$Age','$BirthDate','$CivilStatus','$Citizenship','$Father','$Mother','$HouseHoldNumber','$Purok','')";

		if (move_uploaded_file($_FILES['images2']['tmp_name'],$target_file)) {
			if(mysqli_query($dbcon,$insert))  
		    {  
		        echo"<script>window.open('residents.php','_self')</script>";   
		    } 
		}else{
	 			echo"<script>window.alert('Invalid Image')</script>";  
	 			echo"<script>window.open('residents.php','_self')</script>"; 
	 	}	
 	}
}


    if (isset($_POST['DeleteMultipleRecords'])) {
    	$ids = $_POST['SelectedId'];
    	foreach ($ids as $id) {
    		$delete = "DELETE FROM tblresident WHERE id = '$id'";
			if(mysqli_query($dbcon,$delete))  
		    {  
		        echo"<script>window.open('residents.php','_self')</script>";  
		    } 
    	}
    }

    if (isset($_POST['delete-all-officials'])) {
    	$selected = $_POST['selected'];
		if (!$selected) {
			header('location: BarangayOfficials.php');  
		}else{
			foreach ($selected as $id) {
	    		$delete = "DELETE FROM tblofficials WHERE Id = '$id'";
				if(mysqli_query($dbcon,$delete))  
			    {  
			        echo"<script>window.open('BarangayOfficials.php','_self')</script>";  
			    } 
	    	}
		}
    }


    if (isset($_POST['delete-all-sk-officials'])) {
		$selected = $_POST['selected'];
		if (!$selected) {
			header('location: SkOfficials.php');  
		}else{
			foreach ($selected as $id) {
	    		$delete = "DELETE FROM tblsk WHERE No = '$id'";
				if(mysqli_query($dbcon,$delete))  
			    {  
			        echo"<script>window.open('SkOfficials.php','_self')</script>"; 
			    } 
	    	}
		}
    }

	if (isset($_POST['delete'])) {
		$id = $_POST['id'];

		$delete = "DELETE FROM tbladmin WHERE adminid = '$id'";
		if(mysqli_query($dbcon,$delete))  
	    {  
	        echo"<script>window.open('staff.php','_self')</script>";  
	    } 
    }


if(isset($_POST['EditResidents'])){
    $id = $_POST['id'];
	$Picture = $_POST['profileImage'];
	$LastName = $_POST['LastName'];
	$FirstName = $_POST['FirstName'];
	$MiddleName = $_POST['MiddleName'];
	$Gender = $_POST['Gender'];
	$BirthDate = $_POST['BirthDate'];
	$CivilStatus = $_POST['CivilStatus'];
	$Citizenship = $_POST['Citizenship'];
	$Father = $_POST['Father'];
	$Mother = $_POST['Mother'];
	$HouseHoldNumber = $_POST['HouseHoldNumber'];
	$Purok = $_POST['Purok'];

	$bd = new DateTime($BirthDate);
	$datenow = new DateTime();
	$diff = $bd->diff($datenow);
	$Age = $diff->y;

	$target_dir = "image/";
 	$target_file = $target_dir . basename($_FILES['images2']["name"]);
 	$image_file = pathinfo($target_file,PATHINFO_EXTENSION);
 	$img2 = basename($_FILES['images2']["name"]);

	if ($img2 == "") {
		$update = " UPDATE `tblresident` SET `Picture` = '$Picture',`LastName`='$LastName',`FirstName`='$FirstName',`MiddleName`='$MiddleName',`Gender`='$Gender',`Age`='$Age',`BirthDate`='$BirthDate',`CivilStatus`='$CivilStatus',`Citizenship`='$Citizenship',`FathersName`='$Father',`MothersName`='$Mother',`HouseHoldNumber`='$HouseHoldNumber',`Purok`='$Purok',`Status`='Accepted'
		WHERE `tblresident`.`id` = '$id' ";

		if(mysqli_query($dbcon,$update))  
	    {  
    		$update2 = "UPDATE `tblofficials` SET FirstName ='$FirstName',MiddleName='$MiddleName',LastName='$LastName',img ='$Picture'
			WHERE `tblofficials`.`residentid` = '$id' ";
			if (mysqli_query($dbcon,$update2)) {
				echo"<script>window.open('residents.php','_self')</script>";   
			}
	    } 
 	}
 	else{

		if (move_uploaded_file($_FILES['images2']['tmp_name'],$target_file)) {
			$update = " UPDATE `tblresident` SET `Picture` = '$img2',`LastName`='$LastName',`FirstName`='$FirstName',`MiddleName`='$MiddleName',`Gender`='$Gender',`Age`='$Age',`BirthDate`='$BirthDate',`CivilStatus`='$CivilStatus',`Citizenship`='$Citizenship',`FathersName`='$Father',`MothersName`='$Mother',`HouseHoldNumber`='$HouseHoldNumber',`Purok`='$Purok',`Status`='Accepted' 
			WHERE `tblresident`.`id` = '$id' ";
		
			if(mysqli_query($dbcon,$update))  
		    {  
		    	$update2 = "UPDATE `tblofficials` SET FirstName ='$FirstName',MiddleName='$MiddleName',LastName='$LastName',img ='$img2'
				WHERE `tblofficials`.`residentid` = '$id' ";
				if (mysqli_query($dbcon,$update2)) {
					echo"<script>window.open('residents.php','_self')</script>";   
				}
		    } 
		}else{
 			echo"<script>window.alert('Invalid Image')</script>";  
 			echo"<script>window.open('residents.php','_self')</script>"; 
 		}	
 	}
}

if(isset($_POST['EditStaff'])){
	$id = $_POST['adminid'];
	$admin_role = $_POST['admin_role'];
    $admin_name = $_POST['admin_name'];
 	$admin_email = $_POST['admin_email'];
  	$admin_pass = $_POST['admin_pass'];

  	$hash_pass = password_hash($admin_pass, PASSWORD_DEFAULT);

	$update = "UPDATE `tbladmin` SET `admin_name`='$admin_name',`admin_email`='$admin_email',`admin_pass`='$hash_pass', Role='$admin_role'
	WHERE `tbladmin`.`adminid` = '$id' ";
	
	if(mysqli_query($dbcon,$update))  
    {  
        echo"<script>window.open('Staff.php','_self')</script>";  
    } 
}

// print clearance
if (isset($_POST['submit-clearance'])) {
	$admin = $_POST['admin'];
  	$municipal = $_POST['municipality'];
	$barangay = $_POST['barangay'];
	$province = $_POST['province'];
	$id = $_POST['id'];
  	$OR = $_POST['OR'];
  	$transaction = "Barangay Clearance";
  	$type = "Clearance";
	$issued = date("Y-m-d");
	$y = Date("Y") + 1;
	$m = Date("m");
	$d = Date("d");
	$expire = $y."-".$m ."-". $d;


	$select = mysqli_query($dbcon,"SELECT * FROM tblresident WHERE id = $id");
	if (mysqli_num_rows($select) > 0) {
		$row = mysqli_fetch_assoc($select);
		$fn = $row['FirstName'];
		$ln = $row['LastName'];
		$fullname = $fn." ".$ln;
		$insert = "INSERT INTO tbltransaction VALUES (NULL,'$id','$fullname','$type','$transaction','$issued','$expire','$admin','')";
		if (mysqli_query($dbcon,$insert)) {
			echo"<script>window.open('clearance_print.php?id=$id&OR=$OR&municipal=$municipal&barangay=$barangay&province=$province','_blank','location=yes,height=1200,width=1200,scrollbars=yes,status=yes')</script>";
			echo "<script>window.open('clearance.php','_self')</script>";
		}
	}
}

//print permit
if (isset($_POST['submit-permit'])) {
	$admin = $_POST['admin'];
	$municipal = $_POST['municipality'];
	$barangay = $_POST['barangay'];
	$province = $_POST['province'];
	$id = $_POST['id'];
  	$OR = $_POST['OR'];
	$business = $_POST['business'];
	$type = "Business";
	
	// Date
	$y = Date("Y");
	$m = Date("m");
	$d = Date("d");
	$issued = $y."-".$m."-".$d;
	$expire = ($y + 1)."-".$m."-".$d;

	$select = mysqli_query($dbcon,"SELECT * FROM tblresident WHERE id = $id");
	if (mysqli_num_rows($select) > 0) {
		$row = mysqli_fetch_assoc($select);
		$fn = $row['FirstName'];
		$ln = $row['LastName'];
		echo $fn;
		$fullname = $fn." ".$ln;
		$insert = "INSERT INTO tbltransaction VALUES (NULL,'$id','$fullname','$type','$business','$issued','$expire','$admin','')";
		if (mysqli_query($dbcon,$insert)) {
			echo"<script>window.open('permit_print.php?id=$id&OR=$OR&business=$business&municipal=$municipal&barangay=$barangay&province=$province','_blank','location=yes,height=1200,width=1200,scrollbars=yes,status=yes')</script>";
  			echo "<script>window.open('permit.php','_self')</script>";
		}
	}
}

//print residency
if (isset($_POST['submit-residency'])) {
	$admin = $_POST['admin'];
	$municipal = $_POST['municipality'];
	$barangay = $_POST['barangay'];
	$province = $_POST['province'];
	$id = $_POST['id'];
  	$OR = $_POST['OR'];
  	$since = $_POST['since'];
  	$transaction = "Barangay Residency";
  	$type = "Residency";
	$issued = date("Y-m-d");
	// Date
	$y = Date("Y");
	$m = Date("m");
	$d = Date("d");
	$expire = ($y + 1)."-".$m."-".$d;


	$select = mysqli_query($dbcon,"SELECT * FROM tblresident WHERE id = $id");
	if (mysqli_num_rows($select) > 0) {
		$row = mysqli_fetch_assoc($select);
		$fn = $row['FirstName'];
		$ln = $row['LastName'];
		$fullname = $fn." ".$ln;
		$insert = "INSERT INTO tbltransaction VALUES (NULL,'$id','$fullname','$type','$transaction','$issued','$expire','$admin','')";
		if (mysqli_query($dbcon,$insert)) {
			echo"<script>window.open('residency_print.php?id=$id&OR=$OR&municipal=$municipal&barangay=$barangay&province=$province&since=$since','_blank','location=yes,height=1200,width=1200,scrollbars=yes,status=yes')</script>";
  			echo "<script>window.open('residency.php','_self')</script>";
		}
	}
}

//print residency
if (isset($_POST['submit-indigency'])) {
	$admin = $_POST['admin'];
	$municipal = $_POST['municipality'];
	$barangay = $_POST['barangay'];
	$province = $_POST['province'];
	$id = $_POST['id'];
  	$OR = $_POST['OR'];
  	$transaction = "Barangay Indigency";
  	$type = "Indigency";
	$issued = date("Y-m-d");
	$y = Date("Y");
	$m = Date("m");
	$d = Date("d");
	if ($m < 10) {
		$month = "0".$m;
	}else{
		$month = $m;
	}
	$calmonth = $month + 6;

	if ($calmonth > 12) {
		$totalmonth = $calmonth - 12;
		$totalyear = $y + 1;
		$expire = $totalyear."-".$totalmonth."-".$d;
	}else{
		$expire = $y."-".($month + 6)."-". $d;
	}
	
	$select = mysqli_query($dbcon,"SELECT * FROM tblresident WHERE id = $id");
	if (mysqli_num_rows($select) > 0) {
		$row = mysqli_fetch_assoc($select);
		$fn = $row['FirstName'];
		$ln = $row['LastName'];
		$fullname = $fn." ".$ln;
		$insert = "INSERT INTO tbltransaction VALUES (NULL,'$id','$fullname','$type','$transaction','$issued','$expire','$admin','')";
		if (mysqli_query($dbcon,$insert)) {
			echo"<script>window.open('indigency_print.php?id=$id&OR=$OR&municipal=$municipal&barangay=$barangay&province=$province','_blank','location=yes,height=1200,width=1200,scrollbars=yes,status=yes')</script>";
  			echo "<script>window.open('indigency.php','_self')</script>";
		}
	}
}

// Add Officials
if (isset($_POST['add-officials'])) {
	$id = $_POST['id'];
	$fn = $_POST['fn'];
	$mn = $_POST['mn'];
	$ln = $_POST['ln'];
	$img = $_POST['img'];
	$role = $_POST['role'];

	$officials = mysqli_query($dbcon,"SELECT * FROM tblsk WHERE ResidentId = '$id' ");

	if (mysqli_num_rows($officials) > 0) {
		echo"<script>window.alert('$fn $ln is already an Sk Official')</script>";
		echo "<script>window.open('BarangayOfficials.php','_self')</script>";
	}else{
	  	$select = mysqli_query($dbcon,"SELECT * FROM tblofficials WHERE residentid = '$id' ");
	  	$select2 = mysqli_query($dbcon,"SELECT * FROM tblofficials");
	  	$select3 = mysqli_query($dbcon,"SELECT * FROM tblofficials WHERE role = '$role' ");
	  	$count = mysqli_num_rows($select2);
	  	
	  	if (mysqli_num_rows($select3) > 0){
	  		echo"<script>window.alert('Officials role is already exist')</script>";
			echo "<script>window.open('BarangayOfficials.php','_self')</script>";
	  	}else{
		  		if (mysqli_num_rows($select) > 0) {
				echo"<script>window.alert('Information is Already An Officials')</script>";
				echo "<script>window.open('BarangayOfficials.php','_self')</script>";
		  	}elseif ($count == 8){
				echo"<script>window.alert('Officials Is Already Full')</script>";
				echo "<script>window.open('BarangayOfficials.php','_self')</script>";
			}else{
				$insert = "INSERT INTO tblofficials VALUES (NULL,'$id','$fn','$mn','$ln','$role','$img')";
				if (mysqli_query($dbcon,$insert)) {
					echo "<script>window.open('BarangayOfficials.php','_self')</script>";
				}
			}
	  	}
  	}
}


//Add Sk Official 
if (isset($_POST['add-sk-officials'])) {
	$id = $_POST['id'];
	$fn = $_POST['fn'];
	$mn = $_POST['mn'];
	$ln = $_POST['ln'];
	$img = $_POST['img'];
	$role = $_POST['role'];

	$officials = mysqli_query($dbcon,"SELECT * FROM tblofficials WHERE residentid = '$id' ");

	if (mysqli_num_rows($officials) > 0) {
		echo"<script>window.alert('$fn $ln is already an Brangay Official')</script>";
		echo "<script>window.open('BarangayOfficials.php','_self')</script>";
	}else{
		
	  	$select = mysqli_query($dbcon,"SELECT * FROM tblsk WHERE residentid = '$id' ");
	  	$select2 = mysqli_query($dbcon,"SELECT * FROM tblsk");
	  	$select3 = mysqli_query($dbcon,"SELECT * FROM tblsk WHERE role = '$role' ");
	  	$count = mysqli_num_rows($select2);
	  	
	  	if (mysqli_num_rows($select3) > 0){
	  		echo"<script>window.alert('SK Officials role is already exist')</script>";
			echo "<script>window.open('SkOfficials.php','_self')</script>";
	  	}else{
		  		if (mysqli_num_rows($select) > 0) {
				echo"<script>window.alert('Information is Already An Officials')</script>";
				echo "<script>window.open('SkOfficials.php','_self')</script>";
		  	}elseif ($count == 8){
				echo"<script>window.alert('Officials Is Already Full')</script>";
				echo "<script>window.open('SkOfficials.php','_self')</script>";
			}else{
				$insert = "INSERT INTO tblsk VALUES (NULL,'$id','$fn','$mn','$ln','$role','$img')";
				if (mysqli_query($dbcon,$insert)) {
					echo "<script>window.open('SkOfficials.php','_self')</script>";
				}
			}
	  	}
	}

}


//update Officials

if(isset($_POST['update-official'])){
	$id = $_POST['id'];
	$name = $_POST['official-name'];
	$role = $_POST['official-role'];
	$img1 = $_POST['image'];
 	$target_dir = "image/";
 	$target_file = $target_dir . basename($_FILES['images2']["name"]);
 	$image_file = pathinfo($target_file,PATHINFO_EXTENSION);
 	$img2 = basename($_FILES['images2']["name"]);
 	
 	$select = mysqli_query($dbcon,"SELECT * FROM tblresident WHERE id='$id'");
 	if (mysqli_num_rows($select) > 0) {
 		if ($img2 == "") {
	 		$update = "UPDATE `tblofficials` SET name ='$name',role='$role',img ='$img1'
			WHERE `tblofficials`.`residentid` = '$id' ";
			if(mysqli_query($dbcon,$update))  
			    {  
			       echo"<script>window.open('BarangayOfficials.php','_self')</script>";  
			    } 
	 	}else{
			$update = "UPDATE `tblofficials` SET name ='$name',role='$role',img ='$img2'
			WHERE `tblofficials`.`residentid` = '$id' ";

			if (move_uploaded_file($_FILES['images2']['tmp_name'],$target_file)) {
				if(mysqli_query($dbcon,$update))  
			    {  
			       echo"<script>window.open('BarangayOfficials.php','_self')</script>";  
			    } 
			}else{
		 			echo"<script>window.alert('Invalid Image')</script>";  
		 			echo"<script>window.open('BarangayOfficials.php','_self')</script>";
		 	}	
	 	}
 	}else{
 		echo"<script>window.alert('Records is not Registered in Resident')</script>";  
		echo"<script>window.open('BarangayOfficials.php','_self')</script>";
 	}

 
}




if (isset($_POST['delete-permit'])) {
	$no = $_POST['no'];

	$delete = "DELETE FROM tbltransaction WHERE No = '$no'";
	if(mysqli_query($dbcon,$delete))  
    {  
        echo"<script>window.open('reports.php','_self')</script>";  
    } 
}

if (isset($_POST['delete-indigency'])) {
	$no = $_POST['no'];

	$delete = "DELETE FROM tbltransaction WHERE No = '$no'";
	if(mysqli_query($dbcon,$delete))  
    {  
        echo"<script>window.open('reports_indigency.php','_self')</script>";  
    } 
}

if (isset($_POST['delete-clearance'])) {
	$no = $_POST['no'];

	$delete = "DELETE FROM tbltransaction WHERE No = '$no'";
	if(mysqli_query($dbcon,$delete))  
    {  
        echo"<script>window.open('reports_clearance.php','_self')</script>";  
    } 
}

if (isset($_POST['delete-residency'])) {
	$no = $_POST['no'];

	$delete = "DELETE FROM tbltransaction WHERE No = '$no'";
	if(mysqli_query($dbcon,$delete))  
    {  
        echo"<script>window.open('reports_residency.php','_self')</script>";  
    } 
}

// clear notification

if (isset($_POST['clear_notification'])) {
	
	$permit = mysqli_query($dbcon,"SELECT * FROM tbltransaction WHERE Type='Business' AND status = '' ");
	$clearance = mysqli_query($dbcon,"SELECT * FROM tbltransaction WHERE Type='Clearance' AND status = '' ");
	$residency = mysqli_query($dbcon,"SELECT * FROM tbltransaction WHERE Type='Residency' AND status = '' ");
	$indigency = mysqli_query($dbcon,"SELECT * FROM tbltransaction WHERE Type='Indigency' AND status = '' ");

	$count1 = mysqli_num_rows($permit);
	$count2 = mysqli_num_rows($clearance);
	$count3 = mysqli_num_rows($residency);
	$count4 = mysqli_num_rows($indigency);

	$date = date("Y-m-d");
	$status = "Viewed";

	$insert = "INSERT INTO tblnotification_cleared VALUES(NULL,'$date','$count1','$count2','$count3','$count4')";
	if(mysqli_query($dbcon,$insert))  
    {  
    	$select = mysqli_query($dbcon,"SELECT * FROM tbltransaction WHERE status = '' ");
    	while ($row = mysqli_fetch_assoc($select)) {
    		$id = $row['Id'];
    		$update = "UPDATE tbltransaction SET status = '$status' WHERE Id = '$id' ";
    		if (mysqli_query($dbcon,$update)) {
    			 echo"<script>window.open('reports.php','_self')</script>";  
    		}
    	}
    } else{
    	 echo"<script>window.open('reports.php','_self')</script>";  
    }
}


if (isset($_POST['accept-pending'])) {
	$select = mysqli_query($dbcon,"SELECT * FROM tblresident WHERE Status = '' ");
	while ($row = mysqli_fetch_array($select)) {
		$update = "UPDATE tblresident SET Status = 'Accepted' ";
		if (mysqli_query($dbcon,$update)) {
			echo"<script>window.open('residents.php','_self')</script>";
		}
	}
}

if (isset($_POST['delete-pending'])) {
	$id = $_POST['Id'];
	$delete = "DELETE FROM tblresident WHERE id = '$id' ";
	if (mysqli_query($dbcon,$delete)) {
		echo"<script>window.open('pending-residents.php','_self')</script>";
	}
}


if (isset($_POST['update-barangay-info'])) {
	$id = $_POST['id'];
	$barangay = $_POST['barangay'];
	$municipality = $_POST['municipality'];
	$province = $_POST['province'];

	$target_dir = "image/";
 	$target_file = $target_dir . basename($_FILES['logo']["name"]);
 	$image_file = pathinfo($target_file,PATHINFO_EXTENSION);
 	$img2 = basename($_FILES['logo']["name"]);
 	
	if ($img2 == "") {
 		$update = "UPDATE `tblbarangay` SET Municipality ='$municipality',Province='$province',Barangay ='$barangay'
		WHERE `tblbarangay`.`No` = '$id' ";
		if(mysqli_query($dbcon,$update))  
		    {  
		       echo"<script>window.open('Barangay-Info.php','_self')</script>";  
		    } 
 	}else{
		$update = "UPDATE `tblbarangay` SET Municipality ='$municipality',Province='$province',Barangay ='$barangay',Logo ='$img2'
		WHERE `tblbarangay`.`No` = '$id' ";

		if (move_uploaded_file($_FILES['logo']['tmp_name'],$target_file)) {
			if(mysqli_query($dbcon,$update))  
		    {  
		       echo"<script>window.open('Barangay-Info.php','_self')</script>";  
		    } 
		}else{
	 			echo"<script>window.alert('Invalid Image')</script>";  
	 			echo"<script>window.open('Barangay-Info.php','_self')</script>";
	 	}	
 	}
}
?>
<style>
	.list{
		text-decoration: none;
		background-color: rgba(135,135,135,.5);
		margin-top: 49px;
	    /*height: 61px;*/
	    padding: 18px;
	    font-size: 10px;	}
	.list li a{
		text-decoration: none;
		margin-top: 49px;
	    height: 61px;
	    padding: 18px;
	    font-size: 20px;
		color: white;
	}
	h2.text-admin {
		font-family: Lucida Fax;
	}
	.parent{
    	display: flex;
    	flex-flow: row wrap;
    }
	.dasboard-overlay1{
	    background-color: rgba(0,0,0,.6);
	    background-color: #141921;
	    color: white;
	    margin: 3px;
	    width: 355px;
    }
    div.dasboard-overlay2{
    	background-color: rgba(0,0,0,.6);
    	background-color: #333e4f;
    	color: white;
    	margin: 3px;
    	width: 355px;
    }
     div.dasboard-overlay3{
    	background-color: rgba(0,0,0,.6);
    	background-color: #414347;
    	color: white;
    	margin: 3px;
    	width: 355px;
    }
     div.dasboard-overlay4{
    	background-color: rgba(0,0,0,.6);
    	background-color: #403d32;
    	color: white;
    	margin: 3px;
    	width: 355px;
    }
     div.dasboard-overlay5{
    	background-color: rgba(0,0,0,.6);
    	background-color: #403632;
    	color: white;
    	margin: 3px;
    	width: 355px;
    }
    h1{
    	text-align: center;
    	color: white;
    }
    .gg{
    	text-align: center;
    	font-size: 15px;
    }
    div li:hover{
    	background-color: darkgray;    }
</style>
<?php include'header.php' ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div style="padding: 0px;" class="container-fluid" id="banner">
<?php include'sidebar.php' ?>	
<?php include'babaw.php' ?>
<div class="col-md-10 right-section dash">
      <div class="tittle-header">
          <h3 style="font-family: Lucida Fax; text-align: center; font-size: 30px">Dashboard</h3>
           <div class="text-right adminauth">
      	  	<h2 class='text-admin'>Welcome: <a style='font-family: Lucida Fax; color: black; text-decoration: none;'href=""><?php echo $_SESSION['admin_name'];?></a></h2>
      	  </div>
      </div>
      	<div class="parent">
      	<div class="dasboard-overlay1">
		<br>
			<h2 class="gg">Total Number of Residents</h2> <br>
			<?php 
				include'database/db_connection.php';
	            $resident = $dbcon->query("SELECT * FROM tblresident");
	           	if(mysqli_num_rows($resident)>0)  
				    {  
				  		$count = mysqli_num_rows($resident);
				  		echo "<h1>$count</h1>";
				    }
				else{
				  		echo "<h1>0</h1>";
				    }  
			?>
			<div class="text-center list"><li style="list-style-type:none;"><a href="residents.php">View Master List</a></li></div>
	</div>
		<div class="dasboard-overlay2">
			<br>
			<h2 class="gg">Total Number of Minors</h2> <br>
			 <?php 
	            $resident = $dbcon->query("SELECT * FROM tblresident WHERE Age < 18");
	           		if(mysqli_num_rows($resident)>0)  
					    {  
					  		$count = mysqli_num_rows($resident);
					  		echo "<h1>$count</h1>";
					    }
					else{
					  		echo "<h1>0</h1>";
					  	}
	        ?>
	        <div class="text-center list"><li style="list-style-type:none;"><a href="minor_citizen.php">View Master List</a></li></div>
	    </div>
		<div class="dasboard-overlay3">
			<br>
			<h2 class="gg">Total Number of Señor Citizens</h2> <br>
				 <?php 
	            	$resident = $dbcon->query("SELECT * FROM tblresident WHERE Age >= 60");
	           		if(mysqli_num_rows($resident)>0)  
					    {  
					  		$count = mysqli_num_rows($resident);
					  		echo "<h1>$count</h1>";
					    }
					else{
					  		echo "<h1>0</h1>";
					  	}
	        ?>
	        <div class="text-center list"><li style="list-style-type:none;"><a href="senior_citizen.php">View Master List</a></li></div>
	    </div>
		<div class="dasboard-overlay4">
			<br>
			<h2 class="gg">Total Number of Male</h2> <br>
				 <?php 
	            	$resident = $dbcon->query("SELECT * FROM tblresident WHERE Gender = 'Male' ");
	           		if(mysqli_num_rows($resident)>0)  
					    {  
					  		$count = mysqli_num_rows($resident);
					  		echo "<h1>$count</h1>";
					    }
					else{
					  		echo "<h1>0</h1>";
					  	}
	        ?>
	        <div class="text-center list"><li style="list-style-type:none;"><a href="gender_male.php">View Master List</a></li></div>
	    </div>
	    <div class="dasboard-overlay5">
			<br>
			<h2 class="gg">Total Number of Female</h2> <br>
				 <?php 
	            	$resident = $dbcon->query("SELECT * FROM tblresident WHERE Gender = 'Female' ");
	           		if(mysqli_num_rows($resident)>0)  
					    {  
					  		$count = mysqli_num_rows($resident);
					  		echo "<h1>$count</h1>";
					    }
					else{
					  		echo "<h1>0</h1>";
					  	}
	        ?>
	        <div class="text-center list"><li style="list-style-type:none;"><a href="gender_female.php">View Master List</a></li></div>
	    </div>
	</div>
</div>


</div>

<?php include'footer.php' ?>
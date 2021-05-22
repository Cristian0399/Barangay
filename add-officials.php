<?php include'header.php' ?>

<div class="container-fluid" id="banner">

<?php include'sidebar.php' ?>
	
<div class="col-md-10 right-section">
<?php include'babaw.php' ?>
	 <div class="tittle-header">
        <h3 style="text-align: center">Add Barangay Officials</h3>
      </div>
    <div class="barangayofficials" style="padding-top: 10px">
    	<div class="text-left">
    		<a class="btn btn-danger" href="BarangayOfficials" style="width: 100px">Back</a>
    	</div>
    	<div class="row">
	    	 <div class="text-left col-md-6">
		          <label class="Search-text">Search Resident:</label>
		          <input class='' type='text' name='number' id="myInput" onkeyup="myFunction()" placeholder="Search records here...">
	        </div>
	       
	        
        </div>
        <div class="table-scroll" style="margin-top:25px;"> 
			<div class="table-responsive">
			
				<table id="myTable" class="table table-stripes table-hover">
				  <thead>  
				        <tr>  
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
				        $select = mysqli_query($dbcon,"SELECT * FROM tblresident WHERE Status !='' LIMIT $startfrom, $recordperpage");
				        $totalrecords = mysqli_num_rows($select);
				        $firstpage = 1;
				        $nextpage = $currentpage + 1;
				        $previouspage = $currentpage -1;
				        $lastpage = ceil($totalrecords/$recordperpage);
				        $select=mysqli_query($dbcon,"SELECT * FROM `tblresident` WHERE Status !='' ");

				        while($row=mysqli_fetch_array($select)) {?>  
				           <tr>
					      		<form method='POST' action='code.php'>
					           		<input type="hidden" name='id' value="<?php echo $row['id']; ?>">
					           		<input type="hidden" name='name' value="<?php echo $row['FirstName']." ".$row['LastName']; ?>">
					           		<input type="hidden" name='img' value="<?php echo $row['Picture']; ?>">
		                             <td><?php echo $row['FirstName'] ." ". $row['LastName']; ?></td>
		                             <td><?php echo $row['Age']; ?></td>
		                             <td><?php echo $row['Gender']; ?></td>
		                             <td><?php echo $row['Purok']; ?></td>
		                             <td><a href="save-officials.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to Add this Records to Officials!!!')">Add to Officials</a></td>
                        		</form>
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
     </div>
</div>
</div>
<?php include 'footer.php' ?>

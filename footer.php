<!DOCTYPE html>
<html>
		  <script src="js/jquery.min.js"></script>
		  <script src="angular/angular.min.js"></script>
		  <script src="js/bootstrap.min.js"></script>
		  <script src="webcam/webcam.js"></script>
		  <script src="webcam/webcam2.js"></script>

		  <script>
		  	$('#myModal').on('show.bs.modal', function (e) {
			  // get information to update quickly to modal view as loading begins
			  var opener=e.relatedTarget;//this holds the element who called the modal
			   
			   //we get details from attributes
			  var id=$(opener).attr('residentid');

			//set what we got to our form
			  $('#profileForm').find('[name="id"]').val(id);
			   
			});

		  </script>
		</body>  
  
</html> 

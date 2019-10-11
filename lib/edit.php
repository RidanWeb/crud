<?php

	include "connection.php";

	// secound-condition----------------

	if (isset($_POST['edit_btn'])) {
		$update_edit_id = $_POST['editid'];
		$name = $_POST['studentname'];
		$email = $_POST['studentemail'];
		$gender = $_POST['studentgender'];
		$age = $_POST['studentage'];

		$updateSql = "UPDATE student_info SET name = '$name', email = '$email', gender = $gender, age = $age WHERE id = $update_edit_id ";

		if ($conn->query($updateSql)) {
			header("location:../index.php");
		}else{
			die($conn->error);
		}

	}
	// first-condition----------------

	if (isset($_GET['id'])) {
		$edit_id = $_GET['id'];

		$selectSql = "SELECT id, name, email, gender, age FROM student_info WHERE id = $edit_id";
		$result_info = $conn->query($selectSql);

		if ($result_info->num_rows>0) {
			
			while ($row_student = $result_info->fetch_assoc()) {
				
		


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Edit</title>
    <style>
		label{
			color: #ffffff;
			font-size: 1.2vw;
		}
	</style>
  </head>
  <body class="bg-danger">

    	<!-- forn-Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="header">
					<h1 class="text-white my-5 text-center">Edit Your Data</h1>
				</div>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<input type="hidden" name="editid" value="<?php echo $edit_id;?>">
				  <div class="form-group">
				    <label for="exampleInputName1">Enter Your Name</label>
				    <input type="text" class="form-control" name="studentname" value="<?php echo $row_student['name'];?>" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Enter Email address</label>
				    <input type="email" class="form-control" name="studentemail" value="<?php echo $row_student['email'];?>" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlSelect1">Enter Your Gender</label>
				    <select class="form-control" name="studentgender">
				      <option value="0" 
				      	<?php
	      					if ($row_student['gender'] == 0){
	      						echo "selected";
	      					}
      					?>
				      >Male</option>
				      <option value="1"
				      	<?php
	      					if ($row_student['gender'] == 1){
	      						echo "selected";
	      					}
				      	?>
				      >Female</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputAge1">Enter Your Age</label>
				    <input type="number" class="form-control" name="studentage" value="<?php echo $row_student['age'];?>" required>
				  </div>
				  
				  <button type="submit" class="btn btn-info" name="edit_btn">Update Data</button>
				</form>
			</div>
		</div>
	</div>

 <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

<?php
			}

		}else{
			header("location:../index.php");
		}
	}else{
		header("location:../index.php");
	}
?>









<!-- <link rel="shortcut icon" type="image/png" href="images/til.png"> -->

<?php

	include "lib/connection.php";
	// Data insert start
	$result = "";
	$resultsus = "";
	if (isset($_POST['subbtn'])) {
		$name = $_POST['studentname'];
		$email = $_POST['studentemail'];
		$gender = $_POST['studentgender'];
		$age = $_POST['studentage'];
		$pass = md5($_POST['studentpass']);
		$Cpass = md5($_POST['studentcpass']);

		if ($pass == $Cpass) {
			
			$insertSql = "INSERT INTO student_info(name,email,gender,age,pass) VALUES ('$name','$email',$gender,$age,'$pass')";

			if ($conn->query($insertSql)) {
				$resultsus = "Student Data Added Successfully";
			}else{
				die($conn->error);
			}


		}else{
			$result = "Password Not Matched";
		}
	}
	// Data insert end



	$selectSql = "SELECT * FROM student_info";

	$Student_all_data = $conn->query($selectSql);

	$data_rows = $Student_all_data->num_rows;


?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Crud</title>
	
	<style>
		label{
			color: #ffffff;
			font-size: 1.2vw;
		}
	</style>




  </head>
  <body class="bg-info">


	<!-- forn-Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="header">
					<h1 class="text-white my-5 text-center">Fill Up This Form</h1>
				</div>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				  <div class="form-group">
				    <label for="exampleInputName1">Enter Your Name</label>
				    <input type="text" class="form-control" name="studentname" placeholder="Enter Name" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Enter Email address</label>
				    <input type="email" class="form-control" name="studentemail" placeholder="Enter email" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlSelect1">Enter Your Gender</label>
				    <select class="form-control" name="studentgender">
				      <option selected value="0">Male</option>
				      <option value="1">Female</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputAge1">Enter Your Age</label>
				    <input type="number" class="form-control" name="studentage" placeholder="Enter Age" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Enter Your Password</label>
				    <input type="password" class="form-control" name="studentpass" placeholder="Enter Password" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputCPassword1">Confirm Your Password</label>
				    <input type="password" class="form-control" name="studentcpass" placeholder="Confirm Password" required>
				  </div>
				  <div class="show text-danger">
					<?php echo $result; ?>
				  </div>
				  <div class="show text-success">
					<?php echo $resultsus; ?>
				  </div>
				  
				  <button type="submit" class="btn btn-lg btn-primary" name="subbtn">Submit</button>
				</form>
			</div>
		</div>
	</div>
	<!-- forn-Start -->

	
	<!-- Show_data-table -->
	<div class="Show_data-table mt-5">
		<div class="container">
			<div class="row">
				<div class="col-md-8 offset-md-2">
				  <div class="header-two">
					<h1 class="text-white mb-5 text-center">Student Information</h1>
				  </div>
					<table class="table table-striped table-bordered table-dark">
					  <thead>
					    <tr>
					      <th scope="col">Name</th>
					      <th scope="col">Email</th>
					      <th scope="col">Gender</th>
					      <th scope="col">Age</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <?php if($data_rows > 0){?>
					  	<?php while($student_row = $Student_all_data->fetch_assoc()){?>
					  <tbody>
					    <tr>
					      <td><?php echo $student_row['name'];?></td>
					      <td><?php echo $student_row['email'];?></td>
					      <td><?php 
						      if($student_row['gender'] == 0){
						      	echo "Male";
						      }else{
						      	echo "Female";
						      }?>
					      </td>
					      <td><?php echo $student_row['age'];?></td>
					      <td>
					      	<a class="btn btn-primary" href="lib/edit.php?id=<?php echo $student_row['id'];?>" role="button">Edit</a>
					      	<a class="btn btn-danger" onclick="return confirm('Are you sure to delete?');" href="lib/delete.php?id=<?php echo $student_row['id'];?>" role="button">Delete</a>
					      </td>
					    </tr>
					  </tbody>
					<?php } ?>
					<?php }else{?>
					  <tbody>
					    <tr>
					      <td colspan="5"><h3 class="text-center text-info ">No Student Data To Show</h3></td>
					    </tr>
					  </tbody>
					<?php }?>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Show_data-table -->


	




    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<meta charset="utf-8">
		<title>Register</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>



	<body>
		<div class="form-group col-sm-4 mx-auto m-5">
			<div class="m-3"><h1 class="text-center">Register</h1></div>
			<br>


			<form action="./register.php" method="post" autocomplete="off">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
					  <div class="input-group-text"><i class="fas fa-user"></i></div>
					</div>
					<input type="text" class="form-control" name="username" placeholder="Username" id="username" required>
				</div>

				<br>

				<div class="input-group mb-2">
					<div class="input-group-prepend">
					  <div class="input-group-text"><i class="fas fa-lock"></i></div>
					</div>
					<input type="password" class="form-control" name="password" placeholder="Password" id="password" required>
				</div>

				<br>



				<div class="input-group mb-2">
					<div class="input-group-prepend">
					  <div class="input-group-text"><i class="fas fa-lock"></i></div>
					</div>
					<input type="password" class="form-control" name="password2" placeholder="Re-enter Password" id="password2" required>
				</div>

				<br>



				<div class="input-group mb-2">
					<div class="input-group-prepend">
					  <div class="input-group-text"><i class="fas fa-envelope"></i></div>
					</div>
					<input type="text" class="form-control" name="email" placeholder="Email" id="email" required>
				</div>
				
				

				<?php
					if(isset($_SESSION["register_error"]))
					{
						echo(
							'<div class="alert alert-danger text-center" role="alert">'
							.$_SESSION["register_error"].
							'</div>'
						);
						
					}
            	?>  



				<br>
				
				<div class="text-center">
					<input type="submit" class="btn btn-primary m-2" value="Register">
				</div>
			</form>
		</div>

		
	</body>


</html>


<?php
    unset($_SESSION["register_error"]);
?>
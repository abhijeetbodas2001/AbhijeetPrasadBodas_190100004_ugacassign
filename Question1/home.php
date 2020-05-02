<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
?>


<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<meta charset="utf-8">
		<title>Home Page</title>
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="float-left">
					<a href="profile.php"><i class="fas fa-user-circle m-3"></i>Profile</a>
				
					<a href="logout.php"><i class="fas fa-sign-out-alt m-3"></i>Logout</a>
				</div>
		
		</nav>


		<div>
			<h2 class="text-center">Home Page</h2>
			<br>
			<?php 
				if(!isset($_SESSION['is_new_register']))
				{
					echo "<p class='text-center'>Welcome, ".$_SESSION['name']."!</p>"; 
				}
				else	
				{
					echo "<p class='text-center'>You have been successfully registered, ".$_SESSION['name']."!</p>"; 
				}
					
				unset($_SESSION['is_new_register']);
				
			?>
			
		</div>


	</body>
</html>
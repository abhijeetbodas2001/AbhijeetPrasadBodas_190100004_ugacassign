<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');

$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>


<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<meta charset="utf-8">
		<title>Profile Page</title>
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>

	<body class="loggedin">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="float-left">
			
				<a href="home.php"><i class="fas fa-home m-3"></i>Home</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt m-3"></i>Logout</a>
			</div>
		</nav>


		<div>
			<h2 class="text-center">Profile Page</h2>
			<div>
				
				<p class="text-center">
					Your account details are below:
					<br>
					Username: <?=$_SESSION['name']?>
					<br>
					Email: <?=$_SESSION['email']?>
				</p>

										
			</div>
		</div>
	</body>
</html>
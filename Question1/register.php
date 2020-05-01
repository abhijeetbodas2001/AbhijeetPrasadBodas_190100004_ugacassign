<?php
	
	session_start();
	
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'phplogin';

	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if (mysqli_connect_errno()) 
	{
		exit('Failed to connect to MySQL: ' . mysqli_connect_error());
	}










	if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) 
	{
		$stmt->bind_param('s', $_POST['username']);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows > 0) 
		{
			$register_error = "Username already exists";    
        	$_SESSION["register_error"] = $register_error;
        	header("location: registerForm.php");
		} 
		else 
		{
			if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) 
			{
				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
				$stmt->execute();
				


				$_SESSION['name']= $_POST['username'];
				$_SESSION['email']= $_POST['email'];
				$_SESSION['loggedin'] = TRUE;
				header("location: home.php");
		
			} 
			else 
			{
				echo 'Could not prepare statement!';
			}
		}

		$stmt->close();
	} 
	else 
	{
		echo 'Could not prepare statement!';
	}
	$con->close();
?>



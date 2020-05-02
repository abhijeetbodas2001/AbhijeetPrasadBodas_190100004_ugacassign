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
	else if (!ctype_alnum($_POST['username'])) 
	{

		$_SESSION["register_error"] = "Username must contain only alphanumeric characters";
		header("location: registerForm.php");

	}
	else if(strlen($_POST['password']) >20 || strlen($_POST['password'])< 5)
	{

		$_SESSION["register_error"] = "Password must be between 5 and 20 characters long";
		header("location: registerForm.php");

	}
	elseif($_POST['password'] != $_POST['password2'])
	{

		$_SESSION["register_error"] = "Passwords don't match";
		header("location: registerForm.php");

	}
	else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
	{ 

		$_SESSION["register_error"] = "Please enter a valid email address";
		header("location: registerForm.php");

	}
	else
	{

		$stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?');
	
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
				$_SESSION['is_new_register'] = TRUE;
				header("location: home.php");
		
			}	 
			else 
			{
				echo 'Could not prepare statement!';
			}
		
		}

		$stmt->close();
	
	}




	$con->close();


?>



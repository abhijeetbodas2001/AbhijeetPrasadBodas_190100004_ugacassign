
    
<?php
    
session_start();
    

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if ( mysqli_connect_errno() )
{
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}



if ($stmt = $con->prepare('SELECT id, password, email, username FROM accounts WHERE username = ?')) 
{
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
    $stmt->store_result();
    

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password, $email, $username);
        $stmt->fetch();
        
        if (password_verify($_POST['password'], $password)) 
        {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $username;
            $_SESSION['id'] = $id;

            header('Location: home.php');
        }
        else
        {
            $error = "Wrong password!";    
            $_SESSION["error"] = $error;
            header("location: index.php");
        }


    } 
    else 
    {
        $error = "Username does not exist!";
        $_SESSION["error"] = $error;
        header("location: index.php");
    }


	$stmt->close();
}
?>




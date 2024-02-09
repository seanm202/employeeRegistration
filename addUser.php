<?php
	require_once "pdo.php";                                                      //Add
	session_start();
	if (  isset($_SESSION['userId']) )
	{
		die('Not logged in');
	}

	function test_input($data)
	{
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
	if(isset($_POST['submitUserDetails']))
	{

		if(!isset($_POST['userName']))
		{
			echo("Name is missing!!!");

		}
		else if(!isset($_POST['userEmail']))
		{
			echo("Email is missing!!!");

		}
		else if(!isset($_POST['userPassword']))
				{
					echo("Password is missing!!!");

				}
		else if( isset($_POST['userName']) && isset($_POST['userEmail']))
		{

				$email = test_input($_POST["userEmail"]);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					$_SESSION['error'] = "Email must have an at-sign (@)";
					return;
				}
				else
				{
					$password=$_POST['userPassword'];
					$salt = 'XyZzy12*_';
					$storedHash = hash('md5', $salt.$password);
					//$_POST['user_id']=$_SESSION['user_id'];
					echo("<p>Handling POST data...</p>\n");
					$sql = "INSERT INTO users (name,email,password) VALUES (:name,:email,:password)";
					$stmt = $pdo->prepare($sql);

					$stmt->execute(array(':name' => $_POST['userName'],':email' => $_POST['userEmail'],':password' => $storedHash));
					$_SESSION['success'] = "User Added!!!";
		      header('Location: login.php');
					return;
				}
		}
	}


?>

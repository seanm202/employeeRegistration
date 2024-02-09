<?php
	require_once "pdo.php";                                                 //Login
	session_start();
	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}
	if ( isset($_POST['cancel'] ) )
	{
		header("Location: index.php");
		return;
	}


	if ( isset($_POST['log']))
	{

		if ( isset($_POST['username']) && isset($_POST['password'])  )
		{
			$_SESSION["email"]=$_POST["username"];
			$email = test_input($_SESSION["email"]);

		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
          $_SESSION['error'] = "Email must have an at-sign (@)";
					return;
    }
		echo("<p>Handling POST data...</p>\n");

		$sql = "SELECT userId,name,email,password FROM users
			WHERE email = :un";


		$_SESSION['password']=$_POST['password'];
		$_SESSION['email']=$_POST['username'];
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
        ':un' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$algo="md5";
		$p=$_POST['password'];
		$po=$row['password'] ?? 0;

		/*
		Password checking
		*/
		$salt = 'XyZzy12*_';
		$storedHash = hash('md5', $salt.$p);
		/*
		Password checking
		*/
		if ( !($storedHash == $po) )
		{
			$_SESSION["error"]="Incorrect password";
				header("Location: login.php");

		}
		else
		{
			$_SESSION['user_Id'] = $row['userId'];
			$_SESSION['name'] = $row['name'];
			$_SESSION['flash'] = "Login Success";

				header("Location: view.php");
					return;

		}

	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->


<link rel="stylesheet" type="text/css" href="loginC.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="allDetails">
	<div class="addEmp">

	<h2><a href="index.php">Add Employees</a></h2>
	</div>
	<div class="loginDetails">
		<h2>Log In</h2> 	<?php
			if(isset($_SESSION['error']))
			{
			echo("<h3 style='color:red;font-size:30px;'>".htmlentities($_SESSION['error'])."</h3><br>");
			unset($_SESSION['error']);
			}
			if(isset($_SESSION['success']))
			{
			echo("<h3 style='color:green;font-size:30px;'>".htmlentities($_SESSION['success'])."</h3><br>");
			unset($_SESSION['success']);
			}
			?>
	<form method="POST" action="">
  <div class="form-group username">
    <label for="exampleInputEmail1">Email : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp" placeholder="Enter email">

  </div>
  <div class="form-group password">
    <label for="exampleInputPassword1">Password : &nbsp;</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group log">
  <input type="submit" name="log" class="btn btn-primary" value="Login"></input>
</div>
</form>
</div>
<div class="inBetween"></div>
<div class="registerDetails">
<h2>Create Account</h2>
	<?php
	if(isset($_SESSION['error']))
	{
	echo("<h3 style='color:red;font-size:30px;'>".htmlentities($_SESSION['error'])."</h3><br>");
	unset($_SESSION['error']);
	}
	if(isset($_SESSION['success']))
	{
	echo("<h3 style='color:green;font-size:30px;'>".htmlentities($_SESSION['success'])."</h3><br>");
	unset($_SESSION['success']);
	}
	?>
	<form method="POST" enctype="multipart/form-data" action="addUser.php">
  <div class="form-group userName">
    <label for="name">Name :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="userName" aria-describedby="emailHelp" placeholder="Enter Name">
  </div>
  <div class="form-group userEmail">
    <label for="userEmail">Email :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input type="email" class="form-control" name="userEmail" id="exampleInputPassword1" placeholder="Enter Email">
  </div>  <div class="form-group userPassword">
    <label for="userPassword">Password :&nbsp;</label>
    <input type="password" class="form-control" name="userPassword" id="exampleInputPassword1" placeholder="Enter Password">
  </div>
	<div class="form-group submitUserDetails">
  <input type="submit" name="submitUserDetails" class="btn btn-primary" value="Register"></input></div>
</form>
</div></div>


</body>
</html>

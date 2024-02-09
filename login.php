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
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./CSS/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./CSS/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./CSS/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./CSS/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./CSS/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./CSS/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./CSS/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./CSS/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./CSS/login/main.css">
	<link rel="stylesheet" type="text/css" href="./CSS/login/util.css">

<link rel="stylesheet" type="text/css" href="appCSS.css">
<script src="appJS.js"></script>
<!--===============================================================================================-->
</head>
<body>

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
	<br><br><br><br>
	<form method="POST" action="">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" name="log" class="btn btn-primary">Login</button>
</form>
<br><br><br><br>
<div>
<h2>Create Account</h2>
	<?php
	if(isset($_SESSION['error']))
	{
	echo("<h3 style='color:red;font-size:30px;'>".htmlentities($_SESSION['error'])."</h3><br>");
	unset($_SESSION['error']);
	}
	if(isset($_SESSION['success']))
	{
	echo("<h3 style='color:green;font-size:30px;'>".htmlentities($_SESSION['error'])."</h3><br>");
	unset($_SESSION['error']);
	}
	?>
	<form method="POST" enctype="multipart/form-data" action="addUser.php">
  <div class="form-group">
    <label for="name">Name : </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="userName" aria-describedby="emailHelp" placeholder="Enter Name">
  </div>
  <div class="form-group">
    <label for="userEmail">Email : </label>
    <input type="email" class="form-control" name="userEmail" id="exampleInputPassword1" placeholder="Enter Email">
  </div>  <div class="form-group">
    <label for="userPassword">Password</label>
    <input type="password" class="form-control" name="userPassword" id="exampleInputPassword1" placeholder="Enter Password">
  </div>  <div class="form-group">
    <label for="profilePhoto">Upload Profile Photo</label>
    <input type="password" class=".form-control-file" name="profilePhoto" id="exampleInputPassword1">
  </div>
  <button type="submit" name="submitUserDetails" class="btn btn-primary">Register</button>
</form>
</div>
	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="./CSS/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="./CSS/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="./CSS/vendor/bootstrap/js/popper.js"></script>
	<script src="./CSS/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="./CSS/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="./CSS/vendor/daterangepicker/moment.min.js"></script>
	<script src="./CSS/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="./CSS/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="./JS/js/main.js"></script>

</body>
</html>

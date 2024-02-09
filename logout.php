<?php

require_once "pdo.php";
session_start();                                                                                      //Logout
unset($_SESSION['password']);
unset($_SESSION['email']);                                                                          //Logout
unset($_SESSION['name']);
unset($_SESSION['user_Id']);
header('Location: index.php');
  ?>
  <!DOCTYPE html>
<html>
<head><title>Logout</title></head>
<body>

<h1>Logging out........</h1>
</body>
</html>

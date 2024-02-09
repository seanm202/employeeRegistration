<?php
require_once "pdo.php";
include "add.php";
session_start();
 ?>
<!DOCTYPE>
<html>
 <head>

 </head>
 <body>
   <h2><a href="login.php">Login</a></h2>
   <h2>Employee Registration Form with Admin Review</h2>
   <br>
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
<form method="POST" enctype="multipart/form-data" action="add.php">
  <label for="name">Name :
  <input type="text" name="name" required></input><br>
  <label for="fathersName">Father's Name :
  <input type="text" name="fathersName" required></input><br>
  <label for="mobileNumber">Mobile Number :
  <input type="text" name="mobileNumber" required></input><br>
  <label for="dob">Date Of Birth :
  <input type="date" name="dob" required></input><br>
  <label for="job">Applied for (Job Position) :
  <input type="text" name="job" required></input><br>
  <label for="email">Email :
  <input type="email" name="email" required></input><br>
  <label for="profilePhoto">Upload Profile Photo :
  <input type="file" name="profilePhoto" required></input><br>
  <input type="submit" name="submitDetails" value="Submit"></input><br>
</form>
 </body>
 </html>

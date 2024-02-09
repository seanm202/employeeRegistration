<?php
require_once "pdo.php";
include "add.php";
session_start();
 ?>
<!DOCTYPE>
<html>
 <head>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="aPPC.css">
 </head>
 <body>
   <div>
   <h2 class="loginPosition">Employee Registration Form with Admin Review</h2>
   <h2 class="loginPosition"><a href="login.php">Login</a></h2>
 </div>
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
   <div class="allMain">
<div class="center">
<form method="POST" enctype="multipart/form-data" action="add.php">
  <div class="nameFathersName"><div class="name dist"><label for="name">Name :&nbsp;
  <input type="text" name="name" required></input><br></div>
  <div class="fathersName dist"><label for="fathersName">Father's Name :&nbsp;
  <input type="text" name="fathersName" required></input><br></div></div>
  <div class="mobileNumberDob"><div class="mobileNumber dist"><label for="mobileNumber">Mobile Number :&nbsp;
  <input type="text" name="mobileNumber" required></input><br></div>
  <div class="dob dist"><label for="dob">Date Of Birth :&nbsp;<br>
  <input type="date" name="dob" required></input><br></div></div>
  <div class="jobEmail"><div class="job dist"><label for="job">Job Position (Applied for) :&nbsp;
  <input type="text" name="job" required></input><br></div>
  <div class="email dist"><label for="email">Email :&nbsp;<br>
  <input type="email" name="email" required></input><br></div></div>
  <div class="profilePhotoSubmitDetails"><div class="profilePhoto dist"><label for="profilePhoto">Upload Profile Photo :&nbsp;
  <input type="file" name="profilePhoto" required></input><br></div>
  <div class="submitButton dist"><input type="submit" name="submitDetails" value="Submit"></input><br></div></div>
</form>
</div>
</div>
 </body>
 </html>

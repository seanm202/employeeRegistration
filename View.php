<?php
require_once "pdo.php";                                                        //View
session_start();
if ( !isset($_SESSION['user_Id']) ) {
  die('Not logged in');
}


if (isset($_SESSION['flash'])) {
  echo('<p style="color: green;">'.$_SESSION['flash']."</p>\n");
   unset($_SESSION['flash']);
}
if (isset($_SESSION['delete'])) {
  echo('<p style="color: green;">'.$_SESSION['delete']."</p>\n");
   unset($_SESSION['delete']);
}

if ( isset($_POST['logout'] ) )
	{
		header("Location: Logout.php");
		return;
	}

	$stmt = $pdo->query("SELECT * FROM employee");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>



<!DOCTYPE html>
<html>
<head>
<title>SEAN MANJALY</title>

<link rel="stylesheet" type="text/css" src="appCSS.css">
<script src="appJS.js"></script>
</head>
<body>
<form method="POST">
	<p>
<input type="submit" name="logout" value="Logout"/></p>
</form>
<?php
foreach ( $rows as $row ) {
  echo('
  <div class="employeeIdDet" style="display: flex;">
      <div style="padding:20px;">
        <h2>Employee Id : '.$row['employeeId'].' </h2><hr>
        <img src="'.$row['photoLoc'].'"/ style="height:150px;width:150px;">
        <h2>Name : '.$row['name'].'</h2><hr>
      </div>
      <div style="padding:20px;"><br>
        <h2>DOB : '.$row['dateOfBirth'].'</h2><hr>
        <h2>Father\'s Name : '.$row['fathersName'].'</h2><hr>
        <h2>Mobile Number : '.$row['mobileNumber'].'</h2>
        <h2>Email : '.$row['email'].'</h2>
        <h2>Position  Applied For : '.$row['employeeId'].'</h2>
        <h2>Remarks : </h2>
        <form method="POST" action="update.php">
        <input type="hidden" name="employeeId" value="'.$row['employeeId'].'"></input>
        </div>
      <div style="padding:20px;" class="deleteEmployeeData">
      <div style="padding:20px;">
      <textarea name="employeeRemarks" value="'.$row['remarks'].'" placeholder="Remarks"></textarea >
      <input type="submit" name="editEmployeeData" value="Update"></input>
    </form></div>
    <div style="padding:20px;">
      <form method="POST" action="delete.php">
      <input type="hidden" name="employeeId" value="'.$row['employeeId'].'"></input>
      <input type="submit" name="deleteEmployeeData" value="Delete"></input>
    </form></div>
      </div>
    </div>
    <hr>
    <hr>
    <hr>');
}
?>



</body>
</html>

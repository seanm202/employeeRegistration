<?php
require_once "pdo.php";
	if(isset($_POST['deleteEmployeeData'])){
	$sql="DELETE FROM employee WHERE employeeId=:employeeId";
		$stmt=$pdo->prepare($sql);
		$stmt->execute(array(':employeeId'=>$_POST['employeeId']));
		$_SESSION['success']='Record Deleted';
		header("Location:View.php");
	return;
	}
	?>

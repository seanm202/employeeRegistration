<?php
require_once "pdo.php";
	if(isset($_POST['editEmployeeData'])){
	$sql="UPDATE employee SET remarks=:remarks WHERE employeeId=:employeeId";
		$stmt=$pdo->prepare($sql);
		$stmt->execute(array(':remarks'=>$_POST['employeeRemarks'],':employeeId'=>$_POST['employeeId']));
		$_SESSION['success']='Record updated';
		header('Location:View.php');
	return;
	}
	if(isset($_POST['cancel'])){
	header('Location:View.php');
	}
	?>

<?php 
	
	include_once "connection.php";

	$roomno = $_GET['roomno'];
	$seater = $_GET['seater'];
	$fees = $_GET['fees'];

	$con = getConnection();

	$ins = "insert into rooms (room_no, seater, fees) values (?, ?, ?)";

	$statement = $con->prepare($ins);
	$statement->bind_param("sii",$roomno, $seater, $fees);
	if ($statement->execute() == true) {
		header("location: ../pages/addroom.php?msg=1");
		$statement->close();
	}else{
		header("location: ../pages/addroom.php?msg=0");
		$statement->close();
	}
	$con->close();

?>
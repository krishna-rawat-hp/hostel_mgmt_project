<?php
	include_once 'connection.php';
	$email = $_GET['id'];
if (!empty($email)) {
	$con = getConnection();
	// sql to delete a record
	$sql = "DELETE FROM hostel_detail WHERE email='$email'";

	if ($con->query($sql) === TRUE) {
	    header("location: ../pages/manageroom.php?msg=1");
	} else {
	    header("location: ../pages/manageroom.php?msg=0");
	}

	$con->close();
}
	

?>
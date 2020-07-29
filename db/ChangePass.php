<?php
	include_once "./connection.php";

	$email = $_GET['userid'];
	$oldpass = $_GET['oldpass'];
	$newpass = $_GET['newpass'];

	if (!empty($email)) {
		$conn = getConnection();

		$update = "update user set password=? where password=? and email=?";

		 //prepae statement 
		 if ($stmt = $conn->prepare($update)) {
		 	$stmt->bind_param("sss",$newpass, $oldpass, $email);
		 	
		 if($stmt->execute() and $stmt->affected_rows == 1){
		 	header("location: ../pages/view_profile.php?id=3"); 
		 }else{
		 	header("location: ../pages/view_profile.php?id=4");
		 }
		}
		 $stmt->close();
		 $conn->close();
}else{
	echo "all fields are required";
	die();
}
?>
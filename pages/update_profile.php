<?php
	$regno = $_GET['regno'];
	$name = $_GET['name'];
	$email = $_GET['email'];
	$cno = $_GET['cno'];

	if (!empty($regno)) {
	$host = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "hostel_mgmt";

	$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

	if (mysqli_connect_error()) {
		die('connection_error('.mysqli_connect_errno().')'.mysqli_connect_error());
	}else{
		 $update = "update admin set name=?, email=?, contact_no=? where id=?";

		 //prepae statement 

		 $stmt = $conn->prepare($update);
		 $stmt->bind_param("ssii",$name, $email, $cno, $regno);

		 if ($stmt->execute() == true) {
		 	header("location: view_profile_admin.php?id=1"); 
		 }else{
		 	header("location: view_profile_admin.php?id=2");
		 }
		 $stmt->close();
		 $conn->close();
	}
}else{
	echo "all fields are required";
	die();
}

?>
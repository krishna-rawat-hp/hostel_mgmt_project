<?php 

$username = $_POST['name'];
$fathername = $_POST['fname'];
$dob = $_POST['date'];
$course = $_POST['course'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$password = $_POST['password'];

if (!empty($dob) && !empty($course)) {
	$host = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "hostel_mgmt";

	$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

	if (mysqli_connect_error()) {
		die('connection_error('.mysqli_connect_errno().')'.mysqli_connect_error());
	}else{
		 $sel = "select email from user where email = ? limit 1";
		 $ins = "insert into user (name, fname, email, date, gender, contact_no, password, course_id) values (?, ?, ?, ?, ?, ?, ?, ?)";

		 //prepae statement 

		 $stmt = $conn->prepare($sel);
		 $stmt->bind_param("s",$email);
		 $stmt->execute();
		 $stmt->bind_result($email);
		 $stmt->store_result();
		 $rs = $stmt->num_rows;

		 if ($rs == 0) {
		 	$stmt->close();

		 	$stmt = $conn->prepare($ins);
		 	$stmt->bind_param("sssssisi",$username, $fathername, $email, $dob, $gender, $contact, $password, $course);
		 	$stmt->execute();
		 	echo "New Record Inserted Successfully"; 
		 }else{
		 	echo "Someone Already Registered with that Email";
		 }
		 $stmt->close();
		 $conn->close();
	}
}else{
	echo "all fields are required";
	die();
}

?>
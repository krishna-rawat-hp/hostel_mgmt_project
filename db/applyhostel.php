<?php
	
	include_once 'connection.php';

	$roomno = $_GET['room'];
	$seater = $_GET['seater'];
	$fees = $_GET['fees'];
	$status = $_GET['fstatus'];
	$date = $_GET['date'];
	$duration = $_GET['duration'];
	$amount = $_GET['amount'];
	$email = $_GET['email'];
	$address = $_GET['address'];

	if (!empty($roomno) && !empty($seater) && !empty($fees) && !empty($status) && !empty($date) && !empty($duration) && !empty($amount) &&  !empty($email) && !empty($address)) {
		
		$conn = getConnection();

		$result = mysqli_query($conn, "SELECT seater FROM rooms WHERE room_no='$roomno'");
		$row = mysqli_fetch_array($result);
		$seater = $row['seater'];

		$result1 = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM hostel_detail WHERE room_no='$roomno'");
		$row1 = mysqli_fetch_array($result1);
		$count = $row1['count'];

		if($seater > $count){
		 $sel = "select email from hostel_detail where email = ? limit 1";
		 $ins = "insert into hostel_detail (room_no, status, stay_date, duration, total_amount, email, address) values (?, ?, ?, ?, ?, ?, ?)";

		 //prepae statement 

		 $stmt = $conn->prepare($sel);
		 $stmt->bind_param("s",$email);
		 $stmt->execute();
		 $stmt->bind_result($email1);
		 $stmt->store_result();
		 $rs = $stmt->num_rows;

		 if ($rs == 0) {
		 	$stmt->close();
		 	$stmt = $conn->prepare($ins);
		 	$stmt->bind_param("ssssiss",$roomno, $status, $date, $duration, $amount, $email, $address);
		 	if($stmt->execute()){
		 		$stmt->close();
		 		$select = "select room_no from hostel_detail where email=?";
					$stmt1 = $conn->prepare($select);
					$stmt1->bind_param("s",$email);
					$stmt1->execute();
					$stmt1->bind_result($r_n);
					$stmt1->store_result();
					$stmt1->fetch(); 
					$stmt1->close();
					
					$update = "update user set room_no=? where email=?";

				 //prepae statement 
				 if ($stmt2 = $conn->prepare($update)) {
		 		$stmt2->bind_param("ss",$r_n, $email);
		 	
				 if($stmt2->execute() and $stmt2->affected_rows == 1){
				 		header("location: ../pages/applyhostel.php?msg=1");
				 }
				}
		 	}else{
		 		header("location: ../pages/applyhostel.php?msg=0");
		 	} 
		 }else{
		 	header("location: ../pages/applyhostel.php?msg=2");
		 }
	}else{
		header("location: ../pages/applyhostel.php?msg=3");
	}
		 $conn->close();
}else{
	echo "all fields are required";
	die();
}

?>
<?php
	
	$val = $_GET['val'];

	if (!empty($val)) {
		$host = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$dbname = "hostel_mgmt";

		$con = new mysqli($host, $dbuser, $dbpass, $dbname);

		if (mysqli_connect_error()) {
			die('connection error ('.mysqli_connect_errno().')'.mysqli_connect_error());
		}else{
			$sel = "select seater, fees from rooms where room_no=?";
			$stmt1 = $con->prepare($sel);
			$stmt1->bind_param("s",$val);
			$stmt1->execute();
			$stmt1->bind_result($seater, $fees);
			$stmt1->store_result();
			if($stmt1->fetch()){
				header("location: applyhostel.php?seater=".$seater."&fees=".$fees."&val=".$val);
				$stmt1->close();
			}else{
				header("location: applyhostel.php?seater=0 & fees=0");
				$stmt1->close();
		}
		$con->close();
	}
}

 ?>
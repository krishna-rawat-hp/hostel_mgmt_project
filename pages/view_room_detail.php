<?php
	session_start();
	if (!isset($_SESSION['userid'])) {
		header('location:user_login.php');
	}else{
		$email = $_SESSION['userid'];
	}
?>

<?php 

if (!empty($email)) {
		$host = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$dbname = "hostel_mgmt";

		$con = new mysqli($host, $dbuser, $dbpass, $dbname);

		if (mysqli_connect_error()) {
			die('connection error ('.mysqli_connect_errno().')'.mysqli_connect_error());
		}else{
			$select = "select id, room_no, status, stay_date, duration, total_amount, email, address from hostel_detail where email=?";

			$stmt = $con->prepare($select);
			$stmt->bind_param("s",$email);
			$stmt->execute(); 
			$stmt->bind_result($id, $roomno, $status, $date, $duration, $amount, $email, $address);
			$stmt->store_result();
			$rs = $stmt->num_rows;	

			if ($rs == 1) {
				$stmt->fetch();
				$stmt->close();
			}else{
				$msg = 0; 
				$stmt->close();
			}
			$con->close();
		}
	}
?>


<!DOCTYPE html>
<html>
<head>

	<?php include_once "../common_lib/bs_links.php";?>
	<?php include_once "../common_lib/title.php";?>

	<?php
		if(isset($_GET['msg'])){
	?>
		<script type="text/javascript">
			if(<?php echo $_GET['msg'];?> == 1){
				alert("Room is Approved for You :)");
			}
			
		</script>
	<?php
		}
	?>
	<script type="text/javascript">
		if (<?php echo $msg; ?>== 0) {
			alert("please First Apply For Hostel Room !!");
			window.location = "./applyhostel.php";
		}
	</script>

</head>
<body style="background-color: #ccffff;">
	<div>
		<nav class="navbar navbar-expand-md bg-dark navbar-dark">
		   <a class="navbar-brand text-danger" id="hom" href="user_home.php?userid=<?php echo $_SESSION['userid'];?> & pass=<?php echo $_SESSION['password']; ?>" >HOME</a>
		    <ul class="navbar-nav">
		    	 <li class="nav-item">
		      <a class="nav-link text-warning ml-5" href="view_profile.php" id="navbardrop">
		          View Profile
		        </a>
		      </li>
		       <li class="nav-item">
		      <a class="nav-link text-warning ml-4" href="change_password.php" id="navbardrop">
		          Change Password
		        </a>
		      </li>
		       <li class="nav-item">
		      <a class="nav-link text-warning ml-4" href="applyhostel.php" id="navbardrop">
		          Apply for Hostel
		        </a>
		      </li>
		       <li class="nav-item">
		      <a class="nav-link text-warning ml-4" href="view_room_detail.php" id="navbardrop">
		          View Room Details
		        </a>
		      <li class="nav-item">
		      <a class="nav-link text-warning ml-4" href="about_us.php" id="navbardrop">
		          About Us
		        </a>
		      </li>
		    </ul>
	  </nav>
</div>
<div align="center">
	<h1 style="text-align: center; font-weight: bold; font-size: 36px; font-family: cursive; margin-top: 40px; margin-left: -50px;">YOUR ROOM DETAIL</h1>
	<hr style="background-color: black; width: 50%;">
	<table class="mt-5">
		<tr>
			<td><h3 style="font-weight: 600;">Registration number </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"><?php echo $id; ?></p></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Room No </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"><?php echo $roomno; ?></p></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">With Food</h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"><?php echo $status; ?></p></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Stay From </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"><?php echo $date; ?></p></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Duration </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"><?php echo $duration; ?></p></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Total Amount </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"><?php echo $amount ; ?></p></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Email </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"><?php echo $email; ?></p></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Address </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"><?php echo $address; ?></p></td>
		</tr>
	</table>
</div>
</body>
</html>
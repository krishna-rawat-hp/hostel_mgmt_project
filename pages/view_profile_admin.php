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
			$select = "select id, name, email, contact_no from admin where email=?";

			$stmt = $con->prepare($select);
			$stmt->bind_param("s",$email);
			$stmt->execute(); 
			$stmt->bind_result($id, $admin_name, $email, $Contact_no);
			$stmt->store_result();
			$rs = $stmt->num_rows;	

			if ($rs == 1) {
				$stmt->fetch();
				$stmt->close();
			}else{
				header("location: admin_login.php?msg=Invalid");
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
		if(isset($_GET['id'])){
	?>
		<script type="text/javascript">
			if(<?php echo $_GET['id'];?> == 1){
				alert("Profile Updated Successfully :)");
			}else if(<?php echo $_GET['id'];?> == 2){
				alert("Unable to Update Profile :(");
			}else if(<?php echo $_GET['id'];?> == 3){
				alert("Pasword Change Successfully");
				window.location="change_password_admin.php";
			}else{
				alert("Sorry Some Problem Occur in Changing Password :(");
				window.location="change_password_admin.php";
			}
			
		</script>
	<?php
		}
	?>

</head>
<body style="background-color: #bfff00;">
	<div>
		<nav class="navbar navbar-expand-md bg-dark navbar-dark">
		    <a class="navbar-brand text-danger" id="hom" href="admin_home.php?userid=<?php echo $_SESSION['userid'];?> & pass=<?php echo $_SESSION['password']; ?>" >HOME</a>
		    <ul class="navbar-nav">
		    	 <li class="nav-item">
		      <a class="nav-link text-warning ml-5" href="view_profile_admin.php" id="navbardrop">
		          View Profile
		        </a>
		      </li>
		       <li class="nav-item">
		      <a class="nav-link text-warning ml-4" href="change_password_admin.php" id="navbardrop">
		          Change Password
		        </a>
		      </li>
		       <li class="nav-item dropdown">
		      <a class="nav-link dropdown-toggle text-warning ml-4" href="#" id="navbardrop" data-toggle="dropdown">
		          Rooms
		        </a>
		        <div class="dropdown-menu">
		        	<a class="dropdown-item" href="addroom.php">Add Rooms</a>
		        	<a class="dropdown-item" href="view_room.php">View Rooms</a>
		        	<a class="dropdown-item" href="manageroom.php">Manage Rooms</a>
		        </div>
		      </li>
		      <li class="nav-item">
		      <a class="nav-link text-warning ml-4" href="about_us.php" id="navbardrop">
		          About Us
		        </a>
		      </li>
		    </ul>
	  </nav>
</div>

<div align="center">
	<form action="update_profile.php" method="GET">
	<h1 style="text-align: center; font-weight: bold; font-size: 36px; font-family: cursive; margin-top: 40px; margin-left: -50px;">ADMIN PROFILE</h1>
	<hr style="background-color: black; width: 50%;">
	<table class="mt-5">
		<tr>
			<td><h3 style="font-weight: 600;">Registration number </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><input type="text" name="regno" style="font-weight: bold; color: red; font-size: 20px;" value="<?php echo $id; ?>" readonly></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Name </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><input type="text" name="name" style="font-weight: bold; color: red; font-size: 20px;" value="<?php echo $admin_name; ?>"></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Email Id </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><input type="text" name="email" style="font-weight: bold; color: red; font-size: 20px;" value="<?php echo $email; ?>"></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Contact No </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><input type="text" name="cno" style="font-weight: bold; color: red; font-size: 20px;" value="<?php echo $Contact_no; ?>"></td>
		</tr>
		<tr>
			<td colspan="3" class="text-center"><input type="submit" name="submit" class="btn btn-success mt-4" style="width: 100px; font-size: 20px;" value="EDIT"></td>
		</tr>
	</table>
	</form>
</div>
</body>
</html>
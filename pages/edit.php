<?php

	include_once '../db/connection.php';
	$email = $_GET['id'];

	if (!empty($email)) {
			$con = getConnection();
			$select = "select id, name, fname, email, date, gender, contact_no, course_id from user where email=?";

			$stmt = $con->prepare($select);
			$stmt->bind_param("s",$email);
			$stmt->execute(); 
			$stmt->bind_result($id, $uname, $fname, $email, $date, $gender, $Contact_no, $course);
			$stmt->store_result();
			$rs = $stmt->num_rows;	

			if ($rs == 1) {
				if($stmt->fetch()){
					$v1 = $course;

					$sel = "select course_name from course where course_id=?";
					$stmt1 = $con->prepare($sel);
					$stmt1->bind_param("i",$v1);
					$stmt1->execute();
					$stmt1->bind_result($course_name);
					$stmt1->store_result();
					$stmt1->fetch(); 
					$stmt1->close();
				}
				$stmt->close();
			}else{
				header("location: user_login.php?msg=Invalid");
				$stmt->close();
			}
			$con->close();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once "../common_lib/bs_links.php";?>
	<?php include_once "../common_lib/title.php";?>
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
	<h1 style="text-align: center; font-weight: bold; font-size: 36px; font-family: cursive; margin-top: 40px; margin-left: -50px;">STUDENT PERSONAL DETAILS</h1>
	<hr style="background-color: black; width: 50%;">
	<table class="mt-5">
		<tr>
			<td><h3 style="font-weight: 600;">Registration number </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"> <?php echo $id; ?></p></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Student Name </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"> <?php echo $uname; ?></p></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Father Name </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"> <?php echo $fname; ?></p></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Email Id </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"> <?php echo $email; ?></p></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Date Of Birth </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"> <?php echo $date; ?></p></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Gender </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"> <?php echo $gender; ?></p></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Contact No </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><p style="font-weight: bold; color: red; font-size: 20px;"> <?php echo $Contact_no; ?></p></td>
		</tr>
	</table>
	</form>
</div>
</body>
</html>
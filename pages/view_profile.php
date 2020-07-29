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
			}else{
				alert("Sorry Some Problem Occur in Changing Password :(");
				window.location="change_password.php";
			}
			
		</script>
	<?php
		}
	?>

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
	<form action="update_profile.php" method="GET">
	<h1 style="text-align: center; font-weight: bold; font-size: 36px; font-family: cursive; margin-top: 40px; margin-left: -50px;">USER PROFILE</h1>
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
			<td><input type="text" name="uname" style="font-weight: bold; color: red; font-size: 20px;" value="<?php echo $uname; ?>"></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Father Name </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><input type="text" name="fname" style="font-weight: bold; color: red; font-size: 20px;" value="<?php echo $fname; ?>"></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Email Id </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><input type="text" name="email" style="font-weight: bold; color: red; font-size: 20px;" value="<?php echo $email; ?>"></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Date Of Birth </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><input type="date" name="dob" style="font-weight: bold; color: red; font-size: 20px;" value="<?php echo $date; ?>"></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Gender </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><input type="radio" style="font-weight: bold; color: red; font-size: 20px;" name="gender" value="male" <?php echo ($gender=='male')?'checked':'' ?>>Male
				<input type="radio" name="gender" style="font-weight: bold; color: red; font-size: 20px;" value="female" <?php echo ($gender=='female')?'checked':'' ?>>Female</td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Contact No </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><input type="text" name="cno" style="font-weight: bold; color: red; font-size: 20px;" value="<?php echo $Contact_no; ?>"></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Course </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td>
			<select id="course" name="course" class="form-control mb-1"  style="width: 100%">
			  <option value="" <?php if($course=="") echo 'selected="selected"'; ?>>None</option>
			  <option value="1" <?php if($course=="1") echo 'selected="selected"'; ?>>BE</option>
			  <option value="2" <?php if($course=="2") echo 'selected="selected"'; ?>>ME</option>
			  <option value="3" <?php if($course=="3") echo 'selected="selected"'; ?>>MBA</option>
			  <option value="4" <?php if($course=="4") echo 'selected="selected"'; ?>>BCA</option>
			  <option value="5" <?php if($course=="5") echo 'selected="selected"'; ?>>BBA</option>
			  <option value="6" <?php if($course=="6") echo 'selected="selected"'; ?>>MPHARMA</option>
			  <option value="7" <?php if($course=="7") echo 'selected="selected"'; ?>>BPHARMA</option>
			  <option value="8" <?php if($course=="8") echo 'selected="selected"'; ?>>Diploma</option>
			</select></td>
		</tr>
		<tr>
			<td colspan="3" class="text-center"><input type="submit" name="submit" class="btn btn-success mt-4" style="width: 100px; font-size: 20px;" value="EDIT"></td>
		</tr>
	</table>
	</form>
</div>
</body>
</html>
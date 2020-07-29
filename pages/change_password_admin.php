<?php
	session_start();
	if (!isset($_SESSION['userid'])) {
		header('location:user_login.php');
	}else{
		$email = $_SESSION['userid'];
	}
?>

<!DOCTYPE html>
<html>
<head>

	<?php include_once "../common_lib/bs_links.php";?>
	<?php include_once "../common_lib/title.php";?>

	<script type="text/javascript">
		
		function passCheck(){
			var a = document.getElementById('newpass').value;
			var b = document.getElementById('cpass').value;

			if (a.length < 5) {
				document.getElementById('test1').innerHTML = "**Passwords length should greater 5**";
				return false;
			}
			if (a.length > 25) {
				document.getElementById('test1').innerHTML = "**Passwords length should less 25**";
				return false;
			}
			if (a!=b) {
				document.getElementById('test1').innerHTML = "** Passwords are not same **";
				return false;
			}else{
				return true;
			}
		}

	</script>

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
	<h1 style="text-align: center; font-weight: bold; font-size: 36px; font-family: cursive; margin-top: 40px; margin-left: -50px;">CHANGE PASSWORD</h1>
	<hr style="background-color: black; width: 50%;">


	<form onsubmit="return passCheck();" action="../db/ChangePassAdmin.php" method="GET">

	<input type="hidden" name="userid" id="userid" value="<?php echo $email;?>">
	<table class="mt-5">
		<tr>
			<td><h3 style="font-weight: 600;">Current Password </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><input type="password" name="oldpass" id="oldpass" style="font-weight: bold; color: red; font-size: 20px;" placeholder="Enter Old Password" required></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">New Password </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><input type="password" name="newpass" id="newpass" style="font-weight: bold; color: red; font-size: 20px;" placeholder="Enter New Password"></td>
		</tr>
		<tr>
			<td><h3 style="font-weight: 600;">Confirm Password </h3></td>
			<td><h3 class="ml-3 mr-3"> : </h3></td>
			<td><input type="password" name="cpass" id="cpass" style="font-weight: bold; color: red; font-size: 20px;" placeholder="Re-Enter New Password"><br><span id="test1" style="color: red;"></span></td>
		</tr>
		<tr>
			<td colspan="3" class="text-center"><input type="submit" name="submit" value="CHANGE" class="btn btn-danger mt-3"></ins></td>
			
		</tr>
	</table>
	</form>
</div>
</body>
</html>
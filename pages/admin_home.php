<?php 
	session_start();
	$userid = $_GET['userid'];
	$pass = $_GET['pass'];
	$_SESSION['userid'] = $userid;
	$_SESSION['password'] = $pass;

	if (!empty($userid) && !empty($pass)) {
		$host = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$dbname = "hostel_mgmt";

		$con = new mysqli($host, $dbuser, $dbpass, $dbname);

		if (mysqli_connect_error()) {
			die('connection error ('.mysqli_connect_errno().')'.mysqli_connect_error());
		}else{
			$select = "select name from admin where email=? and password=?";

			$stmt = $con->prepare($select);
			$stmt->bind_param("ss",$userid, $pass);
			$stmt->execute(); 
			$stmt->bind_result($uname);
			$stmt->store_result();
			$rs = $stmt->num_rows;

			if ($rs == 1) {
				if($stmt->fetch()){
					$_SESSION['username'] = $uname; 
				}
				$stmt->close();
			}else{
				header("location: admin_login.php?msg=Invalid");
				$stmt->close();
			}
			$con->close();
		}
	}
?>


<?php
    if(!isset($_SESSION['username'])){
        header('location:user_login.php');
    }else{
    	$v1 = $_SESSION['userid'];
    	$v2 = $_SESSION['password'];
    }
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "../common_lib/bs_links.php";?>
	<?php include_once "../common_lib/title.php";?>
</head>
<body style="overflow-x: hidden; overflow-y: hidden;">
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
  
	<div class="row" id="wlcm" style="height: 50px; background-color: #ff0000;">
		<div class="col-md-6"><p style="font-size: 20px; padding-top: 5px; padding-left: 10px; font-weight: bold;">Welcome : <?php echo " ".$_SESSION['username']; ?></p></div>
		<div class="col-md-6 text-right"> <a href="logout.php" class='btn btn-link p-2 m-0 text-success' style="text-align: right; font-weight: bold; font-size: 20px;" id="link">LOGOUT</a></div>
	</div>
	<div id="main" style="width: 100%; height: 600pt; background-color: #0040ff">
		<h1 class="text-center" style="padding-top: 200px; font-weight: bold; color: white;">WELCOME TO HOSTEL MANAGEMENT</h1>
	</div>

</body>
</html>
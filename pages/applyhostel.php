<?php 
	session_start();
	 if(!isset($_SESSION['userid'])){
        header('location:user_login.php');
    }else{
    	$email = $_SESSION['userid'];
    	$name = $_SESSION['username'];
    }
	
	
if (!empty($email)) {
	$host = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "hostel_mgmt";

	$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

	if (mysqli_connect_error()) {
		die('connection_error('.mysqli_connect_errno().')'.mysqli_connect_error());
	}else{
		 $sel = "select email from hostel_detail where email = ? limit 1";
		 $stmt = $conn->prepare($sel);
		 $stmt->bind_param("s",$email);
		 $stmt->execute();
		 $stmt->bind_result($email);
		 $stmt->store_result();
		 $rs = $stmt->num_rows;

		 if ($rs == 1) {
			header("location: view_room_detail.php?msg=1");	 
			$conn->close();
		 }
		 $stmt->close();
		 
	}
}else{
	echo "Something Wrong !!";
	die();
}

?>



<!DOCTYPE html>
<html>
<head>
  	<?php include_once "../common_lib/bs_links.php";?>
	<?php include_once "../common_lib/title.php";?>

	<?php 
	    include_once "../db/connection.php";
	    include_once "../db/room_db.php";
    ?>

	<script type="text/javascript" src="../js/hostelapply.js"></script>

	<?php
		if(isset($_GET['msg'])){
			$msg = $_GET['msg'];
	?>
		<script type="text/javascript">
			if(<?php echo $msg; ?> == "0"){
				alert("some Errom occur !!");
			}else if(<?php echo $msg; ?> == "3"){
				alert("Room Capacity Is Already Full !!");
			}
		</script>
	<?php
		}
	?>
</head>

<body>	
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

	<div>
	<img src="../images/7.jpg" height="695px" width="100%" > 
    <div class="container ">
      <div class="jumbotron bg-light carousel slide" style="height:620px;width: 600px;margin-top: -670px; margin-left: 340px; ">
		<h2 align="center" style="margin-top: -50px;">Registration</h2><hr>
		<h4 align="left" style="margin-top: -10px;">Room related Info</h4>
		<form action="../db/applyhostel.php" method="GET"> 
		<table border="0" align="center">
		

				<td ><label for="roomno">Room No:</label></td>
					<td >
						<select id="room" name="room" class="form-control" style="width: 100% " onchange="getDetails();">
						  <option value="" >Select Room</option>
						  <?php 
						  	$query = "select room_no from rooms";
						  	$sql = mysqli_query($conn, $query);
						  	//$row = mysqli_num_rows($sql);
						  	while ($row = mysqli_fetch_assoc($sql)) {
						  	?>
						  		<option value="<?php echo $row['room_no'];?>"><?php echo $row['room_no'];?></option>
						  <?php	
							}
							$conn->close();
						  ?>
						</select>
					</td>	
		        </tr>

		<tr>
		<td><label for="seater">Seater: </label></td>
		<td><input id="seater"  class="form-control" maxlength="50" placeholder="Seater" name="seater"  type="text" /></td>
		</tr>

		<tr>
		<td><label for="Fees">Fees(PM): </label></td>
		<td><input id="fees"  class="form-control" maxlength="50" placeholder="Fees Per Month" name="fees"  type="text" /></td>
		</tr>
            <tr>
		<td>Food Status : </td>
		<td> <input type="radio" id="No" name="fstatus" value="No" onchange="radioCheck();"> Without Food <input type="radio" id="Yes" name="fstatus" value="Yes" onchange="radioCheck();">With Food(Rs2000.0 extra per month)</td>
		</tr>
		<tr>
		<td><label for="Date">Stay From: </label></td>
		<td><input style="width: 100%" class="form-control" type="date" value="None" id="date" name="date"></td>
		
		</tr>
		</tr>
		<tr>
		<td><label for="Duration">Duration: </label></td>
		<td >
			<select id="duration" name="duration" class="form-control"  style="width: 100%">
			  <option >Select Duration in month</option>
			  <option value="1">1</option>
			  <option value="2">2</option>
			  <option value="3">3</option>
			  <option value="4">4</option>
			  <option value="5">5</option>
			  <option value="6">6</option>
			  <option value="7">7</option>
			  <option value="8">8</option>
			  <option value="9">9</option>
			  <option value="10">10</option>
			  <option value="11">11</option>
			  <option value="12">12</option>
			</select>
		</td>	
		</tr>
		<tr>
		<td><label for="Amount">Total Amount: </label></td>
		<td><input id="amount" name="amount"  class="form-control" maxlength="50" placeholder="Total Amount"  type="text" /></td>
		

		<tr>
			<td colspan="2"><h4 align="left" style="margin-top: 15px;">Personal Info</h4></td>
		</tr>
		<tr>
		<td><label for="Name">Name: </label></td>
		<td><input id="name"  class="form-control" maxlength="50" placeholder="Enter Name" name="name"  type="text"  value="<?php echo $name; ?>" /></td>
		</tr>
       <tr>
		<td><label for="Email">Email: </label></td>
		<td><input id="email"  class="form-control" maxlength="50" placeholder="Enater Email" name="email"  type="text" value="<?php echo $email; ?>" /></td>
		</tr>
		<tr>
		<td><label for="address">Address: </label></td>
		<td><textarea rows="1" cols="40" id="address" name="address" placeholder="Enter Address"></textarea></td>
		</tr>
		<tr>
		<td align="center"><input type="submit" class="btn btn-success" value="Submit"></td>
		<td><input type="reset" class="btn btn-danger" value="Reset"></td>
		</tr>
	
	</table>
  </form>
  </div>
  </div>
</div>
</body>
</html>
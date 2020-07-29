<!DOCTYPE html>
<html>
<head>
	<?php include_once "../common_lib/bs_links.php";?>
	<?php include_once "../common_lib/title.php";?>
	<?php include_once "../db/connection.php";?>
</head>
<body style="overflow-x: hidden;">
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

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
	<h1 class="text-center mt-4">VIEW ROOM DETAILS</h1>
	<hr class="bg-info w-60% ">
</div>
<div class="col-md-2"></div>
<div class="col-md-2"></div>	
<div class="col-md-8">
<table class="table table-hover border table-borderd table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">S.No.</th>
      <th scope="col">Room No</th>
      <th scope="col">Seater</th>
      <th scope="col">Fees</th>
    </tr>
  </thead>
  <tbody>
  <?php
  	$con = getConnection();
  	$sql = "select * from rooms";
  	$result = $con->query($sql);
  	if(($result-> num_rows) > 0){
  		$sno = 0;
  		while ($row = $result->fetch_assoc()) {
  			$sno++;

  			echo "<tr><td>".$sno."</td><td>".$row['room_no']."</td><td>".$row['seater']."</td><td>".$row['fees']."</td></tr>";
  		}
  		echo "</table>";
  	}else{
  		echo "Sorry No Records Found";
  	}
  $con->close();
  ?>
  </tbody>
</table>
</div>
<div class="col-md-2"></div>
</div>
</body>
</html>
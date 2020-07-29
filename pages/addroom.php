<!DOCTYPE html>
<html >
<head>
  	<?php include_once "../common_lib/bs_links.php";?>
	<?php include_once "../common_lib/title.php";?>

	<?php
		if(isset($_GET['msg'])){
	?>
		<script type="text/javascript">
			if(<?php echo $_GET['msg'];?> == 1){
				alert("Room Added Successfully :)");
			}else{
				alert("Sorry Some Problem Occur in Adding Room :(");
			}
			
		</script>
	<?php
		}
	?>
</head>
<body >
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
	<img src="../images/4.jpg"height="695pt" width="100%"> 
    <div class="container ">
      <div class="jumbotron  carousel slide" style="height:350px;width: 600px;margin-top: -550px;margin-left: 250px;  ">
	
  		<h2 align="center">Add Room</h2><hr>
			<form action="../db/addroom.php" method="GET">
			  <table border="0" align="center">
			    <tr>
					<td ><label for="Roomno">Room No </label></td>
					<td> : </td>
					<td > <input class="form-control" type="text" name="roomno" id="roomno" maxlength="3" placeholder="Enter Room No" required /></td>	
		        </tr>

		        <tr>
					<td><label for="Seater">Seater</label></td>
					<td> : </td>
					<td><input  class="form-control" id="seater"   placeholder="Enter Seater" name="seater" type="text" required /></td>
			    </tr>

			    <tr>
					<td><label for="Fees">Fees</label></td>
					<td> : </td>
					<td><input id="fees"  class="form-control"   placeholder="Enter Fees" name="fees" type="text" required /></td>
					<tr>
					<td align="center" colspan="3"><input type="submit" class="btn btn-warning  mt-3" name="submit" value="Add Room"></td>
				</tr>
			    </tr>

			 </table>

			 </form>

		</div>
	</div>		

</body>
</html>
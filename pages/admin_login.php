<!DOCTYPE html>
<html>
<head>
	<?php include_once "../common_lib/bs_links.php";?>
	<?php include_once "../common_lib/title.php";?>

	<!-- External files -->
	<link rel="stylesheet" type="text/css" href="../css/login.css">

	<?php
		if(isset($_GET['msg'])){
	?>
		<script type="text/javascript">
			alert("Invalid Username or Password !!");
		</script>
	<?php
		}
	?>
	
</head>
<body style="overflow-x: hidden;">
	<div class="row">
		<div class="col-md-1">
			<?php include_once "../common_lib/navbar_first.php";?>
		</div>
	<div class="col-md-11" id="img-div">
	<img src="../images/112.jpg" width="100%" height="750vh">
	<div id="login">
			
			<div id="login-row" class="row justify-content-center align-item-center">
			
			<div id="login-column" class="col-md-6">
				
				<div id="login-box" class="col-md-12">
					
					<form id="login-form" class="form" action="admin_home.php" method="GET">
						<h2 class="text-center text-light"><b>LOGIN</b></h2>
						<hr class="bg-warning">
						
						<div class="form-group">
							<label for="username" class="text-light" style="font-size: 20px;"><b>Userid :</b></label><br>
							<input type="text" name="userid" id="userid" class="form-control" style="font-size: 20px; font-weight: bold;" placeholder="Enter Your Email">
						</div>

						<div class="form-group">
							<label for="password" class="text-light" style="font-size: 20px;"><b>Password :</b></label><br>
							<input type="password" name="pass" id="pass" class="form-control" style="font-size: 20px; font-weight: bold;" placeholder="Enter Your Password">
						</div>

						<div class="form-group">
							<input type="submit" name="submit" class="btn btn-danger" style="font-size: 18px;" value="  Login  ">
						</div>
					</form>

				</div>

			</div>

			</div>

		</div>
	  </div>
	</div>
</body>
</html>
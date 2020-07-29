<!DOCTYPE html>
<html lang="en">
<head>
  
  	<?php include_once "../common_lib/bs_links.php";?>
	<?php include_once "../common_lib/title.php";?>

	<script type="text/javascript">
		
		function passCheck(){
			var a = document.getElementById('password').value;
			var b = document.getElementById('cpassword').value;

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

<body style="overflow-x: hidden;">
	<div class="row">
	<div class="col-md-1">
		<?php include_once "../common_lib/navbar_first.php";?>
	</div>
	<div class="col-md-11">
	<img src="../images/6.jpg" width="100%" height="750px;" > 
    
  
    <div class="container ">
      <div class="jumbotron bg-light carousel slide" style="height:560px;width: 400px;margin-top: -640px;margin-left: 340px; ">
		<h2 align="center" style="margin-top: -30px;">Registration form</h2><hr>
		<form onsubmit="return passCheck();" action="../db/reg.php" method="post">
		<table border="0" align="center">
		

		<tr>
		<td><label for="id">Name : </label></td>
		<td><input id="id"  class="form-control mb-1" maxlength="50"  placeholder="Name" name="name" type="text" required/></td>
		</tr>

		<tr>
		<td><label for="name">Father Name: </label></td>
		<td><input id="name"  class="form-control mb-1" maxlength="50" placeholder="Father Name" name="fname"  type="text" required/></td>
		</tr>

		<tr>
		<td><label for="course">DOB : </label></td>
		<td><input style="width: 100%" class="form-control mb-1" type="date" id="date" name="date" required></td>
		</tr>

		<tr>
		<td><label for="branch">Course: </label></td>
		<td >
			<select id="course" name="course" class="form-control mb-1"  style="width: 100%">
			  <option value="">None</option>
			  <option value="1">BE</option>
			  <option value="2">ME</option>
			  <option value="3">MBA</option>
			  <option value="4">BCA</option>
			  <option value="5">BBA</option>
			  <option value="6">MPHARMA</option>
			  <option value="7">BPHARMA</option>
			  <option value="8">Diploma</option>
			</select>
		</td>	
		</tr>

		<tr>
		<td>Gender : </td>
		<td> <input type="radio"   name="gender" value="male" required> Male <input type="radio" name="gender" value="female" required> Female</td>
		</tr>

		<tr>
		<td><label for="email">Email:</label></td>
		<td><input id="email" class="form-control mt-1 mb-1"  maxlength="50"  placeholder="Email" name="email" type="text" required/></td>
		</tr>

		<tr>
		<td><label for="Contact No">Contact No:</label></td>
		<td><input id="Contact No"  class="form-control mb-1"  maxlength="50"  placeholder="Contact No" name="contact" type="text" required /></td>
		</tr>

		<tr>
		<td><label for="password">Password:</label></td>
		<td><input id="password"  class="form-control mb-1" maxlength="50" placeholder="Password" name="password" type="password" required/></td>
		</tr>

		<tr>
		<td><label for="confirm password">Confirm Password:</label></td>
		<td><input id="cpassword"  class="form-control" maxlength="50" placeholder="Confirm password" name="cpassword" type="password" required/><span id="test1" style="color: red; font-size: 12px;"></span></td>
		</tr>

		<tr>
		<td align="center"><input type="submit" name="submit" value="Submit" class="btn btn-success mt-2"></td>
		<td><input type="reset" name="reset" value="Reset" class="btn btn-danger mt-2"></td>
		</tr>
	
	</table>
</form>
</div>
</div>
</div>
</div>

</body>
</html>
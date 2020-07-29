<!DOCTYPE html>
<html>
<head>
  <?php include_once "../common_lib/bs_links.php";?>
  <?php include_once "../common_lib/title.php";?>
  <?php include_once "../db/connection.php";?>

  <?php
    if(isset($_GET['msg'])){
  ?>
    <script type="text/javascript">
      if(<?php echo $_GET['msg'];?> == 1){
        alert("Record Deleted Successfully :)");
      }else{
        alert("Sorry Some Problem Occur in Deleting Record :(");
      }
      
    </script>
  <?php
    }
  ?>

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
<div class="col-md-12">
  <h1 class="text-center mt-4">MANAGE ROOM DETAILS</h1>
  <hr class="bg-info w-60% ">
</div> 
<div class="col-md-12">
<table class="table table-hover border table-borderd table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Reg. Id</th>
      <th scope="col">Room No</th>
      <th scope="col">With Food</th>
      <th scope="col">Stay From</th>
      <th scope="col">Duration</th>
      <th scope="col">Total Fees</th>
      <th scope="col">Student Id</th>
      <th scope="col">Student Address</th>
      <th scope="col">Student Personal Detail</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $con = getConnection();
    $sql = "select * from hostel_detail";
    $result = $con->query($sql);
    if(($result-> num_rows) > 0){
      while ($row = $result->fetch_assoc()) {

        echo "<tr><td>".$row['id']."</td><td>".$row['room_no']."</td><td>".$row['status']."</td><td>".$row['stay_date']."</td><td>".$row['duration']."</td><td>".$row['total_amount']."</td><td>".$row['email']."</td><td>".$row['address']."</td><td style='text-align:center;'><a href='./edit.php?id=".$row['email']."' class='btn btn-link'>VIEW</a></td><td><a href='../db/delete.php?id=".$row['email']."' class='btn btn-link'>DELETE</a></td></tr>";
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
</div>
</body>
</html>
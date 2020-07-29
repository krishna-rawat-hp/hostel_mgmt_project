<?php
    function getConnection(){
        $con = mysqli_connect("localhost", "root", "", "hostel_mgmt");
        if(mysqli_connect_errno()){
            die("Error: ".mysqli_connect_error());
        }
        return $con;
    }
    

?>
<?php
    include_once "../db/connection.php";
    include_once "../db/room_db.php";
    
    $data = file_get_contents("php://input");
    $rooms = json_decode($data);
    $roomno =  $rooms->{'roomno'};
    $roomDetail =  getRoomDetailByNo($roomno);
    echo json_encode($roomDetail);
?>